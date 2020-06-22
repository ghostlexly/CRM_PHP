/*=========================================================================================
    File Name: dashboard-analytics.js
    Description: intialize advance cards
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Version: 1.0
    Author: Pixinvent
    Author URL: hhttp://www.themeforest.net/user/pixinvent
    ==========================================================================================*/

$(window).on('load', function() {





// ***********************
// GRAPHIQUE CA ANNEE EN COURS
// ***********************

$.get("/statistiques/thisYearRevenue.php", function( results ) {
    results = window.JSON.parse(results);
    // Split timestamp and data into separate arrays
    var labels = [], data=[];
    results["packets"].forEach(function(packet) {
      labels.push(packet.timestamp);
      data.push(parseFloat(packet.payloadString));
    });

    window.thisYearmax_CA = results.max_CA;

    // Revenue - CharJS Line
    Chart.defaults.derivedLine = Chart.defaults.line;
    var draw = Chart.controllers.line.prototype.draw;
    var custom = Chart.controllers.line.extend({
        draw: function() {
            draw.apply(this, arguments);
            var ctx = this.chart.chart.ctx;
            var _stroke = ctx.stroke;
            ctx.stroke = function() {
                ctx.save();
                ctx.shadowColor = '#ffb6c0';
                ctx.shadowBlur = 30;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 20;
                _stroke.apply(this, arguments)
                ctx.restore();
            }
        }
    });

    Chart.controllers.derivedLine = custom;
    var ctx = document.querySelector("#thisYearRevenue").getContext('2d');
    var thisYearRevenueChart = new Chart(ctx, {
        type: 'derivedLine',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                borderWidth: 4,
                borderColor: '#FF4961',
                pointBackgroundColor: "#FFF",
                pointBorderColor: "#FF4961",
                pointHoverBackgroundColor: "#FFF",
                pointHoverBorderColor: "#FF4961",
                pointRadius: 0,
                pointHoverRadius: 6,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                displayColors: false,
                callbacks: {
                    label: function(e, d) {
                        // return '${e.xLabel} : ${e.yLabel}'
                    },
                    title: function() {
                        return;
                    }
                }
            },
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    },
                }],
                yAxes: [{
                    ticks: {
                        padding: 10,
                        stepSize: 5000,
                        max: parseInt(window.thisYearmax_CA),
                        min: 0,
                    },
                    gridLines: {
                        display: true,
                        drawBorder: false,
                        lineWidth: 1,
                        zeroLineColor: '#e5e5e5',
                    }
                }]
            }
        }
    });






// ***********************
// GRAPHIQUE CA ANNEE DERNIERE
// ***********************

$.get("/statistiques/lastYearRevenue.php", function( results ) {
    results = window.JSON.parse(results);
    // Split timestamp and data into separate arrays
    var labels = [], data=[];
    results["packets"].forEach(function(packet) {
      labels.push(packet.timestamp);
      data.push(parseFloat(packet.payloadString));
    });


var ctx2 = document.querySelector("#lastYearRevenue").getContext('2d');
    var lastYearRevenueChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                borderWidth: 4,
                borderDash: [8, 4],
                borderColor: '#c3c3c3',
                pointBackgroundColor: "#FFF",
                pointBorderColor: "#c3c3c3",
                pointHoverBackgroundColor: "#FFF",
                pointHoverBorderColor: "#c3c3c3",
                pointRadius: 0,
                pointHoverRadius: 6,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                displayColors: false,
                callbacks: {
                    label: function(e, d) {
                        // return '${e.xLabel} : ${e.yLabel}'
                    },
                    title: function() {
                        return;
                    }
                }
            },
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                	display: false,
                    gridLines: {
                        display: false,
                    },
                }],
                yAxes: [{
                    ticks: {
                        padding: 10,
                        stepSize: 5000,
                        max: parseInt(window.thisYearmax_CA),
                        min: 0,
                    },
                    gridLines: {
                        display: true,
                        drawBorder: false,
                        zeroLineColor: '#e5e5e5',
                    }
                }]
            }
        }
    });

});



});










// ***********************
// GRAPHIQUE MARGES
// ***********************


    // Hit Rate Chart - CharJS Doughnut
    var Prctg_Marge = $('#marge_pourcentage').val();
    Chart.defaults.hitRateDoughnut = Chart.defaults.doughnut;
    var draw = Chart.controllers.doughnut.prototype.draw;
    var customDoughnut = Chart.controllers.doughnut.extend({
        draw: function() {
            draw.apply(this, arguments);
            var ctx = this.chart.chart.ctx;
            var _fill = ctx.fill;
            var width = this.chart.width,
            height = this.chart.height;

            var fontSize = (height / 114).toFixed(2);
            this.chart.ctx.font = fontSize + "em Verdana";
            this.chart.ctx.textBaseline = "middle";

            var text = Prctg_Marge + "%",
            textX = Math.round((width - this.chart.ctx.measureText(text).width) / 2),
            textY = height / 2;

            this.chart.ctx.fillText(text, textX, textY);

            ctx.fill = function() {
                ctx.save();
                ctx.shadowColor = '#bbbbbb';
                ctx.shadowBlur = 30;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 12;
                _fill.apply(this, arguments)
                ctx.restore();
            }
        }
    });

    Chart.controllers.hitRateDoughnut = customDoughnut;
    var ctx = document.getElementById("hit-rate-doughnut");
    var myDoughnutChart = new Chart(ctx, {
        type: 'hitRateDoughnut',
        data: {
            labels: ["Marge", "Frais"],
            datasets: [{
                label: "Favourite",
                backgroundColor: ["#28D094", "#FF4961"],
                data: [Prctg_Marge, 100 - Prctg_Marge],
            }]
        },
        options: {
            responsive: true,
            title: {
                display: false
            },
            legend: {
                display: false
            },
            layout: {
                padding: {
                    left: 16,
                    right: 16,
                    top: 16,
                    bottom: 16
                }
            },
            cutoutPercentage: 92,
            animation:{
                animateScale : false,
                duration: 2500
            }
        }
    });























// ***********************
// TAUX DE CONVERSION
// ***********************
    // Deals Chart - CharJS Doughnut
    var CONVERSION_DEVIS_VALIDEES = jQuery("#CONVERSION_DEVIS_VALIDEES").val();
    var CONVERSION_DEVIS_ENATTENTE = jQuery("#CONVERSION_DEVIS_ENATTENTE").val();
    var CONVERSION_POURCENTAGE = jQuery("#CONVERSION_POURCENTAGE").val();

    Chart.defaults.dealsDoughnut = Chart.defaults.doughnut;
    var draw = Chart.controllers.doughnut.prototype.draw;
    var customDealDoughnut = Chart.controllers.doughnut.extend({
        draw: function() {
            draw.apply(this, arguments);
            var ctx = this.chart.chart.ctx;
            var _fill = ctx.fill;
            var width = this.chart.width,
            height = this.chart.height;

            var fontSize = (height / 114).toFixed(2);
            this.chart.ctx.font = fontSize + "em Verdana";
            this.chart.ctx.textBaseline = "middle";

            var text = CONVERSION_POURCENTAGE + "%",
            textX = Math.round((width - this.chart.ctx.measureText(text).width) / 2),
            textY = height / 2;

            this.chart.ctx.fillText(text, textX, textY);

            ctx.fill = function() {
                ctx.save();
                ctx.shadowColor = '#FF4961';
                ctx.shadowBlur = 30;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 12;
                _fill.apply(this, arguments)
                ctx.restore();
            }
        }
    });

    Chart.controllers.dealsDoughnut = customDealDoughnut;
    var ctx = document.getElementById("deals-doughnut");
    var myDoughnutChart = new Chart(ctx, {
        type: 'dealsDoughnut',
        data: {
            labels: ["Devis", "Devis validées"],
            datasets: [{
                label: "Favourite",
                borderWidth: 0,
                backgroundColor: ["#ff7b8c", "#FFF"],
                data: [CONVERSION_DEVIS_ENATTENTE, CONVERSION_DEVIS_VALIDEES],
            }]
        },
        options: {
            responsive: true,
            title: {
                display: false
            },
            legend: {
                display: false
            },
            layout: {
                padding: {
                    left: 16,
                    right: 16,
                    top: 16,
                    bottom: 16
                }
            },
            cutoutPercentage: 94,
            animation:{
                animateScale : false,
                duration: 5000
            }
        }
    });















// ***********************
// CA TOTAL
// ***********************


$.get("/statistiques/CA_Total.php", function( results ) {
    results = window.JSON.parse(results);
    // Split timestamp and data into separate arrays
    var labels = [], data=[];
    results["packets"].forEach(function(packet) {
      labels.push(packet.timestamp);
      data.push(parseFloat(packet.payloadString));
    });


    //Total Earnings
    var ctx3 = document.getElementById("earning-chart").getContext("2d");

    // Chart Options
    var earningOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetStrokeWidth : 3,
        pointDotStrokeWidth : 4,
        tooltipFillColor: "rgba(0,0,0,0.8)",
        legend: {
            display: false,
            position: 'bottom',
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: false,
            }],
            yAxes: [{
                display: false,
                ticks: {
                    min: 0,
                    max: parseInt(results.max_CA)
                },
            }]
        },
        title: {
            display: false,
            fontColor: "#FFF",
            fullWidth: false,
            fontSize: 40,
            text: '82%'
        }
    };

    // Chart Data
    var earningData = {
        labels: labels,
        datasets: [{
            label: "Chiffre d'affaire",
            data: data,
            backgroundColor: 'rgba(255,117,136,0.12)',
            borderColor: "#FF4961",
            borderWidth: 3,
            strokeColor : "#FF4961",
            capBezierPoints: true,
            pointColor : "#fff",
            pointBorderColor: "#FF4961",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 3,
            pointRadius: 5,
            pointHoverBackgroundColor: "#FFF",
            pointHoverBorderColor: "#FF4961",
            pointHoverRadius: 7,
        }]
    };

    var earningConfig = {
        type: 'line',

        // Chart Options
        options : earningOptions,

        // Chart Data
        data : earningData
    };

    // Create the chart
    var earningChart = new Chart(ctx3, earningConfig);
 });


    // Vector Maps
    // -----------------------------------
    $('#world-map-markers').vectorMap({
      map: 'world_mill',
      backgroundColor: '#fff',
      zoomOnScroll: false,
      series: {
        regions: [{
          values: visitorData,
          scale: ['#ff7588', '#fddde1'],
          normalizeFunction: 'polynomial'
        }]
      },
      onRegionTipShow: function(e, el, code){
        el.html(el.html()+' (Visitor - '+visitorData[code]+')');
      }
    });


    //Sessions by Browser
    // -----------------------------------
    Morris.Donut({
        element: 'sessions-browser-donut-chart',
        data: [{
            label: "Chrome",
            value: 3500
        }, {
            label: "Firefox",
            value: 2500
        }, {
            label: "Safari",
            value: 2000
        }, {
            label: "Opera",
            value: 1000
        },{
            label: "Internet Explorer",
            value: 500
        } ],
        resize: true,
        colors: ['#40C7CA', '#FF7588', '#2DCEE3', '#FFA87D', '#16D39A']
    });
});
