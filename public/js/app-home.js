window.onload = function() {
    try {
        TagCanvas.textColour = '#363636';
        TagCanvas.outlineColour = '#ff9999';
        TagCanvas.weight = true;
        TagCanvas.weightFrom = 'data-weight';
        TagCanvas.wheelZoom = false;
        TagCanvas.zoom = 1.1;
        TagCanvas.Start('myCanvas');

        TagCanvas.textColour = '#8B2500';
        TagCanvas.outlineColour = '#ffdd99';
        TagCanvas.weight = true;
        TagCanvas.weightFrom = 'data-weight';
        TagCanvas.wheelZoom = false;
        TagCanvas.zoom = 1.1;
        TagCanvas.Start('myCanvas2');





        // Donut Chart
        var donut = new Morris.Donut({
        element  : 'uf-chart',
        resize   : true,
        colors   : ['#3c8dbc', '#f56954', '#00a65a'],
        data     : [
            { label: 'CEE-MG', value: 12 },
            { label: 'CEE-DF', value: 30 },
            { label: 'MEC', value: 20 },
            { label: 'CEE-AL', value: 12 },
            { label: 'CEE-PE', value: 24 },
            { label: 'CME-SP', value: 14 },
            { label: 'CEE-SC', value: 6 },
            { label: 'CEE-RS', value: 3 },
            { label: 'CEM-SE', value: 8 },
            { label: 'CEE-BA', value: 12 },
            { label: 'CEE-CE', value: 4 },

          ],
          hideHover: 'auto'
        });

    } catch(e) {
      // something went wrong, hide the canvas container
      document.getElementById('myCanvasContainer').style.display = 'none';
      document.getElementById('myCanvasContainer2').style.display = 'none';
    }
  };