<!doctype html>
<html lang="en">
    <head>
        <title>eBay Listing Product Alert!</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-sm-12 m-auto">
                    <p> {{$user_name}}さん。 </p>
                    <p> eBay出品ツールを利用いただきありがとうございます。 </p>
                    <p> 現在、 {{$item_name}}(商品ID: {{$item_id}})の在庫がございません。</p>
                    <p> だから、対策してください。</p>
                    <br/>
                    <p> Copyright(c) 2021 eBay出品サービス. All rights reserved.</p>
                </div>
            </div>
        </div>
    </body>
</html>