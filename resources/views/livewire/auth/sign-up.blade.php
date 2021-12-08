<script src="../assets/js/signup.js"></script>

<section class="h-100-vh">
    <div class="page-header align-items-start section-height-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    {{-- <h2 class="text-white mb-2 mt-5">{{ __('アカウント登録') }}</h2> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h3 class="font-weight-bolder text-info text-gradient">{{ __('新規登録') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST" role="form text-left" id="registerForm">
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <div class="form-group">
                                    <input name="first_name" type="text" class="form-control" placeholder="姓">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <input name="last_name" type="text" class="form-control" placeholder="名">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control" placeholder="メールアドレス" aria-label="メールアドレス" aria-describedby="email-addon">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <input name="password" id="password" type="password" class="form-control"　placeholder="パスワード" aria-label="パスワード" aria-describedby="password-addon">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <input name="confirm_password" type="password" class="form-control"　placeholder="確認用パスワード">
                                </div>
                            </div>
                            {{-- <div class="form-check form-check-info text-left">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('I agree the') }} <a href="javascript:;"
                                        class="text-dark font-weight-bolder">{{ __('Terms and Conditions') }}</a>
                                </label>
                            </div> --}}
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">登録する</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">{{ __('すでにアカウントがある方は ') }}
                                <a href="{{ route('login') }}" class="text-dark font-weight-bolder">{{ __('ログイン') }}</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
