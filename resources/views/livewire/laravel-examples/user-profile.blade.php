<script src="../assets/js/profile.js"></script>
<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('プロファイル情報') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('profile-update') }}" method="POST" role="form text-left" id="profileForm">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name" class="form-control-label">{{ __('姓') }}</label>
                                <div class="form-group">
                                    <input name="first_name" class="form-control" type="text" value="{{$user_info['first_name']}}" id="first_name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name" class="form-control-label">{{ __('名') }}</label>
                                <div class="form-group">
                                    <input name="last_name" class="form-control" type="text" value="{{$user_info['last_name']}}" id="last_name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{ __('メールアドレス') }}</label>
                                <div class="form-group">
                                    <input name="email" class="form-control" type="email" value="{{$user_info['email']}}" id="user-email" readonly="readonly" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="license" class="form-control-label">{{ __('ライセンス') }}</label>
                                <div class="form-group">
                                    <input name="license" class="form-control" type="text" value="{{$user_info['license']}}" id="license" readonly="readonly" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ '保存する' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
