$(document).ready(function() {
    $("#nome").keyup(function(){
          
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
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
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
});