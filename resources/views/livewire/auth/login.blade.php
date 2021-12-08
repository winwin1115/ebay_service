<script src="../assets/js/login.js"></script>

<section>
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8">
                        <div class="card-header pb-0 text-left bg-transparent">
                            <h3 class="font-weight-bolder text-info text-gradient">{{ __('ログイン') }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('login') }}" method="POST" role="form text-left" id="loginForm">
                                {{ csrf_field() }}
                                <div class="mb-3">
                                    <label for="email">{{ __('メールアドレス') }}</label>
                                    <div class="form-group">
                                        <input name="email" id="email" type="email" class="form-control" placeholder="メールアドレス"
                                            aria-label="メールアドレス" aria-describedby="email-addon">
                                    </div>
                                    @if(session()->has('credent'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('credent') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="password">{{ __('パスワード') }}</label>
                                    <div class="form-group">
                                        <input name="password" id="password" type="password" class="form-control" placeholder="パスワード"
                                            aria-label="パスワード" aria-describedby="password-addon">
                                    </div>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="password">{{ __('ライセンス') }}</label>
                                    <div class="form-group">
                                        <input name="license" id="license" type="password" class="form-control" placeholder="ライセンス"
                                            aria-label="ライセンス" aria-describedby="password-addon">
                                    </div>
                                    @if(session()->has('license'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('license') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-check form-switch">
                                    <input name="remember_me" class="form-check-input" type="checkbox"
                                        id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">{{ __('ログイン情報を保存') }}</label>
                                </div> --}}
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn bg-gradient-info w-100 mt-4 mb-0">{{ __('ログイン') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <a href="{{ route('forgot-password') }}"
                                class="text-info text-gradient font-weight-bold">{{ __('パスワードをお忘れですか') }}</a>
                            <p class="mb-4 text-sm mx-auto">{{ __(' アカウントがない方は') }}
                                <a href="{{ route('sign-up') }}"
                                    class="text-info text-gradient font-weight-bold">{{ __('こちらへ') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                        <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                            style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
