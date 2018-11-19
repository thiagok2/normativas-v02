
$(function () {
  try {

    var elementsExists = document.getElementById('myCanvasContainer');

    if (elementsExists) {
      TagCanvas.textColour = '#363636';
      TagCanvas.outlineColour = '#ff9999';
      TagCanvas.weight = true;
      TagCanvas.weightFrom = 'data-weight';
      TagCanvas.wheelZoom = false;
      TagCanvas.zoom = 1.1;
      TagCanvas.Start('myCanvas');

      // TagCanvas.textColour = '#8B2500';
      // TagCanvas.outlineColour = '#ffdd99';
      // TagCanvas.weight = true;
      // TagCanvas.weightFrom = 'data-weight';
      // TagCanvas.wheelZoom = false;
      // TagCanvas.zoom = 1.1;
      // TagCanvas.Start('myCanvas2');
    }





  } catch (e) {
    // something went wrong, hide the canvas container
    //document.getElementById('myCanvasContainer').style.display = 'none';
    //document.getElementById('myCanvasContainer2').style.display = 'none';
  }
});

$(document).ready(function() {
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

})

})