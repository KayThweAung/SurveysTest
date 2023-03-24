$(function () {

    $('#login-form').validate({
        errorClass: 'error',
        rules: {
            email: {
                required: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Please enter your email address.",
            },
            password: {
                required: "Please enter your password .",
            },
        },
        errorPlacement: function (error, element) {
            $("." + element.attr("name") + "Error").append(error);
            $("#" + element.attr("name") + "ServerError").css('display', 'none');
        },
        highlight: function (element, errorClass, validClass) {
            $("#" + $(element).attr("name")).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            $("#" + $(element).attr("name")).removeClass(errorClass);
        },
        onfocusout: function (element) {
            $("#" + $(element).attr("name") + "ServerError").css('display', 'none');
            return $(element).valid();
        },

    });
});

