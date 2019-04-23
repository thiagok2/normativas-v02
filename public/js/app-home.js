
$(function () {
    //Conselhos confirmados
    var url = '/api/unidades/confirmadas/periodo';
    $.getJSON(url, function (data) {
        var ctxConsConfirmados = document.getElementById('chartConsConfirmados')
        var labels = [];
        var criados = [];
        var confirmados = [];

        $.each(data, function (key, item) {
            labels.push(item.mes_ano_abrev);
            criados.push(item.criados);
            confirmados.push(item.confirmados);
        });

        var chartConsConfirmados = new Chart(ctxConsConfirmados, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Criados',
                        data: criados,
                        backgroundColor: 'rgba(36, 123, 160, 0.2)',
                        borderColor: 'rgba(36, 123, 160, 1)'
                    },
                    {
                        label: 'Confirmados',
                        data: confirmados,
                        backgroundColor: ['rgba(112, 192, 179, 0.2)'],
                        borderColor: ['rgba(112, 192, 179, 1)']

                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
    //fim conselhos confirmados

    //Documentos enviados
    var url ="/api/documentos/enviados/6meses";
    $.getJSON(url, function(data) {
        var ctxUploadsMeses = document.getElementById("chartUploadsMeses");
        var labels = [];
        var enviados = [];

        $.each(data, function(key, item) {
            labels.push(item.mes_ano_abrev);
            enviados.push(item.enviados);
            console.log(item.enviados);
        });

        var chartUploadsMeses = new Chart(ctxUploadsMeses, {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Enviados",
                        data: enviados,
                        backgroundColor: "rgba(36, 123, 160, 0.2)",
                        borderColor: "rgba(36, 123, 160, 1)"
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true
                            }
                        }
                    ]
                }
            }
        });
    });
    //fim documentos enviados

    //assuntos
    var url ="/api/documentos/assuntos/total"
    $.getJSON(url, function (data) {
        var ctxAssuntos = document.getElementById("chartAssuntos");
        var labels = [];
        var total = [];
        var percent = [];
        $.each(data, function (key, item) {
            labels.push(item.nome);
            total.push(item.total);
            percent.push(item.percent);
        });

        data = {
            datasets: [
                {
                    data: total,
                    backgroundColor: ["#f012be", "#605ca8", "#00a65a", "#00a65a", "#00a65a", "#00a65a", "#00a65a", "#00a65a", "#00a65a", "#00a65a", "#00a65a", "#00a65a", "#00a65a", "#00a65a", "#00a65a"]
                }
            ],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: labels
        };
        var myDoughnutChart = new Chart(ctxAssuntos, {
            type: "pie",
            data: data,
            options:{legend:{display:false}}
        });
    });
    //fim assuntos

    //tipos
    var url = "/api/documentos/tipos/total"
    $.getJSON(url, function (data) {
        var ctxTipos = document.getElementById("chartTipos");
        var labels = [];
        var total = [];
        var percent = [];
        $.each(data, function (key, item) {
            labels.push(item.nome);
            total.push(item.total);
            percent.push(item.percent);
        });

        data = {
            datasets: [
                {
                    data: total,
                    backgroundColor: ["#001f3f", "#39cccc", "#337ab7", "#337ab7", "#337ab7", "#337ab7", "#337ab7", "#337ab7", "#337ab7", "#337ab7", "#337ab7", "#337ab7", "#337ab7", "#337ab7", "#337ab7"]
                }
            ],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: labels
        };
        var myDoughnutChart = new Chart(ctxTipos, {
            type: "pie",
            data: data,
            options: { legend: { display: false } }
        });
    });
    //fim tipos

  try {

    var elementsExists = document.getElementById('myCanvasContainer');

    if (elementsExists) {
      TagCanvas.textColour = '#363636';
      TagCanvas.outlineColour = '#ff9999';
      //TagCanvas.weight = true;
      //TagCanvas.weightFrom = 'data-weight';
      TagCanvas.wheelZoom = false;
      //TagCanvas.zoom = 1.25;
      TagCanvas.Start('myCanvas');

    }

    var elementsExists = document.getElementById('myCanvasContainer2');

    if (elementsExists) {
      TagCanvas.textColour = '#363636';
      TagCanvas.outlineColour = '#ff9999';
      //TagCanvas.weight = true;
      //TagCanvas.weightFrom = 'data-weight';
      TagCanvas.wheelZoom = false;
      //TagCanvas.zoom = 1.25;
      TagCanvas.Start('myCanvas2');

    }

  } catch (e) {
    document.getElementById('myCanvasContainer').style.display = 'none';
    document.getElementById('myCanvasContainer2').style.display = 'none';
  }

});
