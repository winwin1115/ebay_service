var Users = (function () {
    var handleTables = function () {
        var table = $("#users-datatable").DataTable({
            searching: false,
            info: false,
            // pagingType: 'full_numbers',
            language: {
                oPaginate: {
                    sFirst: "初へ",
                    sPrevious: "前へ",
                    sNext: "次へ",
                    sLast: "後へ",
                },
                lengthMenu: "表示 _MENU_ エントリ",
            },
        });
    };

    return {
        // main function to initiate the module
        init: function () {
            handleTables();
        },
    };
})();

$(document).ready(function () {
    Users.init();

    $(".gen-modal-btn").click(function () {
        $("#gen_hidden_id").val($(this).data("id"));
        $("#gen_token_hidden_id").val($(this).data("token"));
    });

    $("#generate-confirm-btn").click(function () {
        var user_id = $("#gen_hidden_id").val();
        var _token = $("#gen_token_hidden_id").val();
        $("#modal-token-generate").modal("hide");

        $.ajax({
            url: "generate-token",
            type: "POST",
            data: {
                user_id: user_id,
                _token: _token,
            },
            success: function (response) {
                if (response.status == "200") {
                    setTimeout("location.reload()", 2000);
                }
            },
            error: function () {

            },
        });
    });

    $(".delete-modal-btn").click(function () {
        $("#delete_hidden_id").val($(this).data("id"));
        $("#delete_token_hidden_id").val($(this).data("token"));
    });

    $("#delete-confirm-btn").click(function () {
        var user_id = $("#delete_hidden_id").val();
        var _token = $("#delete_token_hidden_id").val();
        $("#modal-delete").modal("hide");

        $.ajax({
            url: "delete-token",
            type: "POST",
            data: {
                user_id: user_id,
                _token: _token,
            },
            success: function (response) {
                if (response.status == "200") {
                    setTimeout("location.reload()", 2000);
                }
            },
            error: function () {
            },
        });
    });
});
