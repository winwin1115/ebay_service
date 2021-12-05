<script src="../assets/js/users.js"></script>

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white"><strong>登録されたすべてユーザーについてご覧出来ます。</strong></span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
					<h6>すべてユーザー</h6>
				</div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="users-datatable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-left text-uppercase text-secondary font-weight-bolder opacity-7">
                                        名前
                                    </th>
                                    <th class="text-left text-uppercase text-secondary font-weight-bolder opacity-7">
                                        メールアドレス
                                    </th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        利用状態
                                    </th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        登録日付
                                    </th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        操作
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_info as $index => $item)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                        </td>
                                        <td class="text-left">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->first_name }} {{ $item->last_name }}</p>
                                        </td>
                                        <td class="text-left">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->email }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->user_type }}</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->user_type }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('user-profile') }}" class="mx-3" data-bs-toggle="tooltip"　data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
