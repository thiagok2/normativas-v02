$(document).ready(function() {

    function slug(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆĞÍÌÎÏİŇÑÓÖÒÔÕØŘŔŠŞŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇğíìîïıňñóöòôõøðřŕšşťúůüùûýÿžþÞĐđßÆa·/_,:;";
        var to   = "AAAAAACCCDEEEEEEEEGIIIIINNOOOOOORRSSTUUUUUYYZaaaaaacccdeeeeeeeegiiiiinnooooooorrsstuuuuuyyzbBDdBAa------";
        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    };

    $("#nome1").keyup(function(){
          
        var slug = function(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆĞÍÌÎÏİŇÑÓÖÒÔÕØŘŔŠŞŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇğíìîïıňñóöòôõøðřŕšşťúůüùûýÿžþÞĐđßÆa·/_,:;";
            var to   = "AAAAAACCCDEEEEEEEEGIIIIINNOOOOOORRSSTUUUUUYYZaaaaaacccdeeeeeeeegiiiiinnooooooorrsstuuuuuyyzbBDdBAa------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        };

       
        $("#friendly_url").val( slug($('#nome').val()) );    
    });

    $('.phone').mask('(00) 0000-0000');

    $('select[name=estado_id]').change(function () {
        var uf = $(this).val();
        $.get('/api/unidades/' + uf + '/municipios', function (busca) {
            $('select[id=municipio_id]').empty();
                $('select[id=municipio_id]').append('<option value="selecione"> </option>');
            $.each(busca, function (key, value) {
                $('select[id=municipio_id]').append('<option value="' + value.id + '">' + value.nome + '</option>');
            });
            
        });
    });

    $('select[name=municipio_id]').change(function () {
        var municipio = $( "#municipio_id option:selected" ).text();
        $("#nome").val("Conselho Municipal de Educação de "+municipio);
        $("#sigla").val(slug(municipio));
    });

    $("#tbl-conselhos").on("click", ".modal-unidade", function () {
        
        var unidadeId = $(this).attr("data-conselho-id");

        $.ajax({
            type: 'GET',
            url: '/api/unidades/'+unidadeId
        }).done(function (result) {

            $("#unidade_id").val(result.unidade.id);
            $("#conselho_titulo").text(result.unidade.nome);
            $("#conselho_nome").val(result.unidade.nome);
            $("#conselho_sigla").val(result.unidade.sigla);

            $("#gestor_nome").val(result.gestor.name);
            $("#gestor_email").val(result.gestor.email);

            //console.log(result);
        }).fail(function (msg) {
            console.log(JSON.stringify(msg));
            
        }).always(function (msg) {

        });


        $('#modalAtualizarConvidar').modal('show');
    });
});