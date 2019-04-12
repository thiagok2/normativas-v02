
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
                    '<td>'  +   file.id +'</td>'+
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
    

});
