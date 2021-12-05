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
                    sLast: "後へ"
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
});
