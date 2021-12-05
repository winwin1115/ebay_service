var RegisterForm = (function () {
    // Login form validation
    var handleValidation = function () {
        // for more info visit the official plugin documentation:
        // http://docs.jquery.com/Plugins/Validation
        var form = $("#registerForm");

        form.validate({
            errorElement: "span", // default input error message container
            errorClass: "help-block help-block-error", // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    minlength: 8,
                    required: true,
                },
                confirm_password: {
                    equalTo: "#password",
                },
            },
            messages: {
                first_name: "姓を入力してください。",
                last_name: "名を入力してください。",
                email: {
                    required: "メールを入力してください。",
                    email: "有効なメールアドレスを入力してください。",
                },
                password: {
                    minlength: "8文字以上入力してください。",
                    required: "パスワードを入力してください。",
                },
                confirm_password: "同じ値をもう一度入力してください。"
            },
            highlight: function (element) {
                // hightlight error inputs
                $(element)
                    .closest(".form-group .form-control")
                    .addClass("is-invalid"); // set invalid class to the control group
            },
            unhighlight: function (element) {
                // revert the change done by hightlight
                $(element)
                    .closest(".form-group .form-control")
                    .removeClass("is-invalid") // set invalid class to the control group
                    .closest(".form-group .form-control")
                    .addClass("is-valid"); // set valid class to the control group
            },
            success: function (label) {
                label
                    .closest(".form-group .form-control")
                    .removeClass("is-invalid"); // set success class to the control group
            },
        });
    };

    return {
        // main function to initiate the module
        init: function () {
            handleValidation();
        },
    };
})();

jQuery(document).ready(function () {
    RegisterForm.init();
});
