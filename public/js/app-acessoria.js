$(document).ready(function() {

    $('select[name=estado_id]').change(function () {
        var uf = $(this).val();
        $.get('/api/unidades/' + uf + '/municipios-todos', function (busca) {
            $('select[id=municipio_id]').empty();
                $('select[id=municipio_id]').append('<option value="selecione"> </option>');
            $.each(busca, function (key, value) {
                $('select[id=municipio_id]').append('<option value="' + value.id + '">' + value.nome + '</option>');
            });
            
        });
    });

    $('.phone').mask('(00) 0000-0000');

    $('select[name=estado_id]').change(function () {
        var estado = $( "#estado_id option:selected" ).text();
        $("#nome").val("Acessoria dos Conselhos de Educação de "+estado);
        
    });

});