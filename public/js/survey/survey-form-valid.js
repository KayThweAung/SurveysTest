$(document).ready(function () {

    //for incomedate for datetimepicker
    $('.datepicker').each(function (k, v) {
        var $input = $(v).find('.input-datepicker');
        $input.datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                date: 'far fa-calendar-alt',
                previous: "fas fa-chevron-left",
                next: "fas fa-chevron-right",
            },
        });
        $(v).find('span.input-group-text').click(function (e) {
            $input.focus();
        });
    });

    //check jquery validation for income form
    $('#survey-form').validate({
        errorClass: 'error',
        ignore: "",
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
            },
            phone_number: {
                required: true,
            },
            date_of_birth: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter name.",
            },
            email: {
                required: "Please enter your email address.",
            },
            phone_number: {
                required: "Please enter phone number.",
            },
            ndate_of_birth: {
                required: "Please enter date of birth.",
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