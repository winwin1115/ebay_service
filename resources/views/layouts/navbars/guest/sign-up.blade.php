<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
    <div class="container">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white">
            
        </a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="{{ route('sign-up') }}" class="nav-link text-white me-2">
                        <i class="fas fa-user-circle opacity-6  me-1"></i>
                        新規登録
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link text-white me-2">
                        <i class="fas fa-key opacity-6  me-1"></i>
                        ログイン
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                    <a href="{{ asset('assets/files/ebay.zip') }}" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-light">eBay拡張機能ダウンロード</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
