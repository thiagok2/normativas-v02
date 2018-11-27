
$(function () {
  try {

    var elementsExists = document.getElementById('myCanvasContainer');

    if (elementsExists) {
      TagCanvas.textColour = '#363636';
      TagCanvas.outlineColour = '#ff9999';
      TagCanvas.weight = true;
      TagCanvas.weightFrom = 'data-weight';
      TagCanvas.wheelZoom = false;
      TagCanvas.zoom = 1;
      TagCanvas.Start('myCanvas');

    }

  } catch (e) {
    document.getElementById('myCanvasContainer').style.display = 'none';
  }

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

  $('.cpf').mask('000.000.000-00', 
            {reverse: true});

});