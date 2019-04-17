
function deleteUpload(fileId){
    console.log('deleting::'+fileId);
    $.ajax("/admin/lote/upload/"+fileId+"/delete").done(function() {
        $( "#tr_upload_id_"+fileId).remove();

    });
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


        if(ano && data_publicacao && numero && tipo_documento_id && assunto_id && titulo && ementa){
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
                $('#tr_doc_'+id).hide(1000);
            }).fail(function (msg) {
                console.log('falhou');
               alert('Problemas na operação: '+msg);
            }).always(function (msg) {
                console.log('ALWAYS');
            });

        }else{
                alert('Preencha todos os campos');
        }
    });


    if ( $("#fileupload") ){

        $('#fileupload').fileupload({
            dataType: 'json',
            add: function (e, data) {
                if($('#ano').val()  
                        && $('#tipo_documento_id').val() && $('#tipo_documento_id').val() != 0 
                        && $('#assunto_id').val() && $('#assunto_id').val() != 0){

                    $('#loading').text('Enviando...');
                    $('#progress').removeClass('hidden');
                    $('#alertas').addClass('hidden');
                    console.log($('#assunto_id').val());
                    data.submit();

                }else{
                    $('#alertas').removeClass('hidden');
                    $('#alertas').text("Preencha os campos obrigatórios")
                }
            
            },
            done: function (e, data) {
                $('#uploads').removeClass('hidden');
                $.each(data.result.files, function (index, file) {
                    $("<tr id='tr_upload_id_"+file.id+"'/>").html(
                        '<td>'  +   file.ano +'</td>'+  
                        '<td>'  +   file.tipo_documento_nome    + '</td>'+
                        '<td>'  +   file.assunto_nome    + '</td>'+
                        '<td>'  +   file.name   + '</td>'+
                        '<td>'  +   file.tags   + '</td>'+
                        '<td>('  +   file.size + ' KB)'+ '</td>'+
                        "<td><button type='button' onclick='deleteUpload("+file.id+")' value='Remover' class='btn btn-danger'>Remover</button>"
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
