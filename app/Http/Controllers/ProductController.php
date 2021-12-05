<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Trading\Services as tServices;
use \DTS\eBaySDK\Trading\Types as tTypes;
use \DTS\eBaySDK\Trading\Enums;
use \DTS\eBaySDK\BusinessPoliciesManagement\Services;
use \DTS\eBaySDK\BusinessPoliciesManagement\Types;

use App\Models\User;
use App\Models\Currency;
use App\Models\Product;
use App\Mail\FirstEmail;

class ProductController extends Controller
{
    public function getbusinesspolicy(Request $request)
    {
        $service = new Services\BusinessPoliciesManagementService([
            'credentials' => config('ebayconfig.production.credentials'),
            'authToken' => config('ebayconfig.production.authToken'),
            'globalId' => Constants\GlobalIds::US
        ]);

        $ebay_request = new Types\GetSellerProfilesRequest();
        $ebay_request->includeDetails = true;
        $ebay_response = $service->getSellerProfiles($ebay_request);

        if($ebay_response->ack !== 'Success') {
            if(isset($ebay_response->errorMessage)) {
                foreach ($ebay_response->errorMessage->error as $error) {
                    printf('Error: %s\n', $error->message);
                }
            }
            return response()->json(['status' => '500']);
        }
        else {
            $paymentList = [];
            $returnList = [];
            $shippingList = [];
            $paymentRows = (object) [];
            $returnRows = (object) [];
            $shippingRows = (object) [];
            if (isset($ebay_response->paymentProfileList)) {
                foreach ($ebay_response->paymentProfileList->PaymentProfile as $profile) {
                    $paymentRows->profileId = $profile->profileId;
                    $paymentRows->profileName = $profile->profileName;
                    $paymentRows->profileDesc = $profile->profileDesc;
                    array_push($paymentList, $paymentRows);
                    $paymentRows = (object) [];
                }
            }
        
            if (isset($ebay_response->returnPolicyProfileList)) {
                foreach ($ebay_response->returnPolicyProfileList->ReturnPolicyProfile as $profile) {
                    $returnRows->profileId = $profile->profileId;
                    $returnRows->profileName = $profile->profileName;
                    $returnRows->profileDesc = $profile->profileDesc;
                    array_push($returnList, $returnRows);
                    $returnRows = (object) [];
                }
            }
        
            if (isset($ebay_response->shippingPolicyProfile)) {
                foreach ($ebay_response->shippingPolicyProfile->ShippingPolicyProfile as $profile) {
                    $shippingRows->profileId = $profile->profileId;
                    $shippingRows->profileName = $profile->profileName;
                    $shippingRows->profileDesc = $profile->profileDesc;
                    array_push($shippingList, $shippingRows);
                    $shippingRows = (object) [];
                }
            }

            return response()->json(['status' => '200', 'paymentList' => $paymentList, 'returnList' => $returnList, 'shippingList' => $shippingList]);
        }
    }

    public function additem(Request $request)
    {
        $siteId = Constants\SiteIds::US;
        $service = new tServices\TradingService([
            'credentials' => config('ebayconfig.production.credentials'),
            'production' => true,
            'siteId' => $siteId
        ]);

        $ebay_request = new tTypes\AddItemRequestType();
        $ebay_request->RequesterCredentials = new tTypes\CustomSecurityHeaderType();
        $ebay_request->RequesterCredentials->eBayAuthToken = config('ebayconfig.production.authToken');

        $item = new tTypes\ItemType();
        $item->Title = $request->title;
        
        $item->Description = $request->description;
        $item->ListingDuration = Enums\ListingDurationCodeType::C_GTC;
        $item->ListingType = Enums\ListingTypeCodeType::C_FIXED_PRICE_ITEM;
        $item->Location = 'Beverly Hills';
        $item->StartPrice = new tTypes\AmountType(['value' => 15.99]);
        $item->Country = 'JP';
        $item->Currency = 'USD';
        $item->Quantity = intval($request->quantity);
        $item->ConditionID = intval($request->product_status);
        
        $item->ItemSpecifics = new tTypes\NameValueListArrayType();
        $specific = new tTypes\NameValueListType();
        $specific->Name = 'Brand';
        $specific->Value[] = $request->brand;
        $item->ItemSpecifics->NameValueList[] = $specific;

        $specific = new tTypes\NameValueListType();
        $specific->Name = 'Type';
        $specific->Value[] = $request->product_type;
        $item->ItemSpecifics->NameValueList[] = $specific;

        $specific = new tTypes\NameValueListType();
        $specific->Name = 'Model';
        $specific->Value[] = $request->model;
        $item->ItemSpecifics->NameValueList[] = $specific;
        
        
        $item->ReturnPolicy = new tTypes\ReturnPolicyType();
        $item->ReturnPolicy->ReturnsAcceptedOption = 'ReturnsNotAccepted';
        
        $item->PrimaryCategory = new tTypes\CategoryType();
        $item->PrimaryCategory->CategoryID = $request->categoryid;
        $item->PictureDetails = new tTypes\PictureDetailsType();
        $item->PictureDetails->GalleryType = Enums\GalleryTypeCodeType::C_GALLERY;
        $image = [];
        for($i = 0; $i < count($request->image_data); $i++)
            array_push($image, $request->image_data[$i]);
        $item->PictureDetails->PictureURL = $image;

        $item->SellerProfiles = new tTypes\SellerProfilesType();
        $payment_spec = new tTypes\SellerPaymentProfileType();
        $payment_spec->PaymentProfileID = intval($request->paymentId);
        $payment_spec->PaymentProfileName = $request->paymentName;
        $item->SellerProfiles->SellerPaymentProfile = $payment_spec;
        $return_spec = new tTypes\SellerReturnProfileType();
        $return_spec->ReturnProfileID = intval($request->returnId);
        $return_spec->ReturnProfileName = $request->returnName;
        $item->SellerProfiles->SellerReturnProfile = $return_spec;
        $shipping_spec = new tTypes\SellerShippingProfileType();
        $shipping_spec->ShippingProfileID = intval($request->shippingId);
        $shipping_spec->ShippingProfileName = $request->shippingName;
        $item->SellerProfiles->SellerShippingProfile = $shipping_spec;
        $ebay_request->Item = $item;
        // $container = new tTypes\AddItemRequestContainerType();
        // $container->MessageID = '123';
        // $container->Item = $item;

        // $ebay_request->AddItemRequestContainer[] = $container;

        $ebay_response = $service->addItem($ebay_request);

        if (isset($ebay_response->Errors)) {
            foreach ($ebay_response->Errors as $error) {
                printf($error);
            }
            return response()->json(['status' => '500']);
        }
        
        if ($ebay_response->Ack !== 'Failure') {
            printf($ebay_response->ItemID);
            $product = new Product;
            $product->title = $request->title;
            $product->image_data = $request->image_data[0];
            $product->price = $request->price;
            $product->stock = $request->quantity;
            $product->product_status = $request->product_status;
            $product->from_type = 'Yahoo_Auction';
            $product->site_url = $request->site_url;
            $product->item_id = $ebay_response->ItemID;
            $product->user_id = $request->user_id;
            $product->save();
            return response()->json(['status' => '200']);
        }
    }

    public function getproduct(Request $request) {
        if($request->from_type == 'all')
            $product = Product::where(['user_id' => $request->user_id])->get();
        else {
            $product = Product::where(['user_id' => $request->user_id, 'from_type' => $request->from_type])->get();
        }
        if($product)
            return response()->json(['status' => '200', 'data' => $product]);
        else {
            return response()->json(['status' => '500']);
        }
    }

    public function updateproduct(Request $request)
    {
        $product = Product::where(['site_url' => $request->site_url])->update(['auto_check' => 2]);
        if($product)
            return response()->json(['status' => '200']);
        else {
            return response()->json(['status' => '500']);
        }
    }

    public function checkproduct(Request $request)
    {
        $currency = Currency::where(['user_id' => $request->user_id])->first();
        if($currency)
        {
            $currency_rate = $currency['currency_rate'];
            $profit_rate = $currency['profit_rate'];
        }
        else {
            $currency_rate = '';
            $profit_rate = '';
        }
        
        $price = round($request->price / $currency_rate * $profit_rate, 2);
        if(!$request->stock)
        {
            $product = Product::where(['site_url' => $request->site_url])->update(['price' => $price, 'stock' => $request->stock, 'auto_check' => 1]);

            $item_info = Product::where(['site_url' => $request->site_url])->first();
            $item_id = $item_info['item_id'];
            $item_name = $item_info['title'];
            $user_info = User::where(['id' => $request->user_id])->first();
            $user_name = $user_info['first_name'];

            $to_email = $user_info['email'];
            Mail::to($to_email)->send(new FirstEmail($item_id, $item_name, $user_name));
            return response()->json(['status' => '200']);
        }
        else {
            $product = Product::where(['site_url' => $request->site_url])->update(['price' => $price, 'stock' => $request->stock]);
        }
    }
}
