$(function () {

    $("#palavras_chave").tagsinput({
        trimValue: true,
        confirmKeys: [9,188,13]
    });

    $(".bootstrap-tagsinput > input").on('keydown',function (e) {

        if (e.which == 9 || e.which == 13)
        {
            $("#palavras_chave").tagsinput('add',$(this).val());
            $(this).val("");
            e.preventDefault();
        }

    });

});