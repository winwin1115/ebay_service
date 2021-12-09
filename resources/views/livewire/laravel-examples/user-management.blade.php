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
                                        ライセンス
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
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->first_name }}
                                                {{ $item->last_name }}</p>
                                        </td>
                                        <td class="text-left">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->email }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->license }}</p>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $item->created_at->format('Y-m-d') }}</span>
                                        </td>
                                        <td class="text-center">
                                            {{-- <a href="{{ route('user-profile', $item->id) }}" class="mx-1"
                                                data-bs-toggle="tooltip" data-bs-original-title="ユーザー編集">
                                                <i class="fas fa-user-edit text-success"></i>
                                            </a> --}}
                                            @if (!$item->use_status)
                                            <a class="mx-1 gen-modal-btn cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#modal-token-generate" data-id="{{ $item->id }}" data-token="{{csrf_token()}}">
                                                <i class="fas fa-id-card-alt text-info"></i> ライセンス発行
                                            </a>
                                            @else
                                            <a class="mx-1 delete-modal-btn cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete" data-id="{{ $item->id }}" data-token="{{csrf_token()}}">
                                                <i class="fas fa-trash text-danger"></i> ライセンス削除
                                            </a>
                                            @endif
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

<div class="modal fade" id="modal-token-generate" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">ライセンス発行</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label style="font-size: 14px;">このライセンスを本当に発行しますか？</label>

                    <input type="hidden" id="gen_hidden_id" value="" />
                    <input type="hidden" id="gen_token_hidden_id" value="" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-success" id="generate-confirm-btn">確認</button>
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">キャンセル</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">ライセンス削除</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label style="font-size: 14px;">このライセンスを本当に削除しますか？</label>

                    <input type="hidden" id="delete_hidden_id" value="" />
                    <input type="hidden" id="delete_token_hidden_id" value="" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-success" id="delete-confirm-btn">確認</button>
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">キャンセル</button>
            </div>
        </div>
    </div>
</div>
