
function deleteUpload(fileId){
    console.log('deleting::'+fileId);

    if (confirm('Tem certeza que deseja deletar este registro?')) {
        $.ajax("/admin/lote/upload/"+fileId+"/delete").done(function() {
            $('#tr_doc_'+fileId).hide(600);
            triggerAlertSuccess("success");
        });
    }

}



$(function () {
    console.log('api-normativas');

    $(".bootstrap-tagsinput > input").on('keydown',function (e) {

        if (e.which == 9 || e.which == 13)
        {
            $("#palavras_chave").tagsinput('add',$(this).val());
            $(this).val("");
            e.preventDefault();
        }

    });

    $('.select2').select2({
            "language": {
                "noResults": function(){
                    return "Sem resultados";
                }
            },
             escapeMarkup: function (markup) {
                 return markup;
            }

    });

    $("#palavras_chave").tagsinput({
        trimValue: true,
        confirmKeys: [9,188,13]
    });



    $(".bootstrap-tagsinput > input").on('keydown',function (e) {

        if (e.which == 9 || e.which == 13){
            $("#palavras_chave").tagsinput('add',$(this).val());
            $(this).val("");
            e.preventDefault();
        }
    });

    $('.btn_salvar').click(function() {
        var id = $(this).data('id');
        var ano = $('#ano_'+id).val().trim();
        var data_publicacao = $('#data_publicacao_'+id).val().trim();
        var numero = $('#numero_'+id).val().trim();

        var tipo_documento_id = $('#tipo_documento_id_'+id).val().trim();
        var assunto_id = $('#assunto_id_'+id).val().trim();
        var titulo = $('#titulo_'+id).val().trim();

        var ementa = $('#ementa_'+id).val().trim();

        var isValid = true;

        $('#tr_doc_' + id).find(':input').each(function () {
            if ($(this).prop('required')) {
                if (!$(this).is(':valid')) {
                    $(this).addClass('invalid');
                    isValid = false;
                    console.log($(this));
                } else {
                    $(this).removeClass('invalid');
                }
            }
        });


        //if(ano && data_publicacao && numero && tipo_documento_id && assunto_id && titulo && ementa){
        if(isValid){
            var data = {
                "ano": ano,
                "data_publicacao": data_publicacao,
                "numero": numero,
                "tipo_documento_id": tipo_documento_id,
                "assunto_id": assunto_id,
                "titulo": titulo,
                "ementa": ementa
            }

            console.log('222');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'update-item-lote/'+id,
                data: data
            }).done(function () {
                console.log('sucesso');
                triggerAlertSuccess("success");
                $('#tr_doc_'+id).hide(600);

            }).fail(function (msg) {
                console.log(JSON.stringify(msg));
                triggerAlertSuccess("danger");
                $('#alertas').removeClass('hidden');
                $('#alertas-msg').text(JSON.stringify(msg));
            }).always(function (msg) {

            });

        }else{
            alert('Preencha todos os campos');
        }
    });




    if ( $("#fileupload") ){

        $('#fileupload').fileupload({
            dataType: 'json',
            limitMultiFileUploads: 10,
            multipart:true,
            add: function (e, data) {
                if($('#ano').val()
                        && $('#tipo_documento_id').val() && $('#tipo_documento_id').val() != 0
                        && $('#assunto_id').val() && $('#assunto_id').val() != 0){

                    $('#loading').text('Enviando...');
                    $('#progress').removeClass('hidden');
                    $('#alertas').addClass('hidden');

                    data.submit();

                }else{
                    $('#alertas').removeClass('hidden');
                    $('#alertas-msg').text("Preencha os campos obrigatórios(Ano, Tipo de Documento e Assunto)");
                }

            },
            done: function (e, data) {
                $('#uploads').removeClass('hidden');
                $.each(data.result.files, function (index, file) {
                    var tags =  file.tags != null ? file.tags : '';
                    if(file.size == 0 ){
                        $('#alertas').removeClass('hidden');
                        $('#progress').addClass('hidden');
                        $('#alertas-msg').text("O arquivo "+ file.name + " não pode ser indexado. Verifique o tamanho(até 5MB) e extensão do arquivo(PDF).");
                    }else{
                        $("<tr id='tr_doc_"+file.id+"'/>").html(
                            '<td>'  +   file.ano +'</td>'+
                            '<td>'  +   file.tipo_documento_nome    + '</td>'+
                            '<td>'  +   file.assunto_nome    + '</td>'+
                            '<td>'  +   file.name   + '</td>'+
                            '<td>'  +   tags   + '</td>'+
                            '<td class="text-muted">('  +   file.size + ' KB)'+ '</td>'+
                            "<td><button type='button' onclick='deleteUpload("+file.id+")' value='Remover' class='btn btn-danger btn-sm' style='margin:5px;'><span class='fa fa-trash-o fa-lg' aria-hidden='true'></span></button>"
                            )

                            .appendTo($('#files_list'));

                        if ($('#file_ids').val() != '') {
                            $('#file_ids').val($('#file_ids').val() + ',');
                        }
                        $('#file_ids').val($('#file_ids').val() + file.id);

                        if ($('#ids').val() != '') {
                            $('#ids').val($('#ids').val() + ',');
                        }
                        $('#ids').val($('#ids').val() + file.id);

                        $('#alertas').addClass('hidden');
                        $('#progress').removeClass('hidden');
                    }


                });
                $('#loading').text('');
            },
            progressall: function (e, data) {

                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        });
    }



});


var timeOutVar = null;
function triggerAlertSuccess(alertType) {
    $(".autoclose-alert-" + alertType).show();
    $(".autoclose-alert-" + alertType).stop().fadeIn(0);
    clearTimeout(timeOutVar);
    timeOutVar = window.setTimeout(function () {
        $(".autoclose-alert-" + alertType).stop().fadeOut(1000, function () {
            $(this).hide();
        });
    }, 4000);
}
