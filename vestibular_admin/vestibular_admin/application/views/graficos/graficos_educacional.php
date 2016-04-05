<div class="row-fluid">
    <div class="span6">
        <div class="box">
            <div class="box-header">
                <span class="title">
                    <i class="icon-bar-chart"></i>
                    <?php echo get_phrase('gráfico'); ?>
                </span>
            </div>
            <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">

                <!---------------------GRAFICO---------------->
                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                <!---------------------FIM------------------>
            </div>
        </div>
    </div>


    <div class="span6">
        <div class="box">
            <div class="box-header">
                <span class="title">
                    <i class="icon-bar-chart"></i>
                    <?php echo get_phrase('gráfico'); ?>
                </span>
            </div>
            <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">

                <!---------------------GRAFICO ---------------->
                <div id="container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                <!---------------------FIM------------------>
            </div>
        </div>
    </div>
</div>  



<div class="row-fluid">
    <div class="span6">
        <div class="box">
            <div class="box-header">
                <span class="title">
                    <i class="icon-bar-chart"></i>
                    <?php echo get_phrase('gráfico'); ?>
                </span>
            </div>
            <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">

                <!---------------------GRAFICO---------------->
                <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                <!---------------------FIM ------------------>
            </div>
        </div>
    </div>


    <div class="span6">
        <div class="box">
            <div class="box-header">
                <span class="title">
                    <i class="icon-bar-chart"></i>
                    <?php echo get_phrase('gráfico'); ?>
                </span>
            </div>
            <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">

                <!---------------------GRAFICO---------------->





                <!---------------------FIM ------------------>
            </div>
        </div>
    </div>
</div>  

<script>

    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Average Rainfall'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Tokyo',
                    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

                }, {
                    name: 'New York',
                    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

                }, {
                    name: 'London',
                    data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

                }, {
                    name: 'Berlin',
                    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

                }]
        });
    });</script>


<script>
    $(function () {

        // Make monochrome colors and set them as default for all pies
        Highcharts.getOptions().plotOptions.pie.colors = (function () {
            var colors = [],
                    base = Highcharts.getOptions().colors[0],
                    i;

            for (i = 0; i < 10; i += 1) {
                // Start out with a darkened base color (negative brighten), and end
                // up with a much brighter color
                colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
            }
            return colors;
        }());

        // Build the chart
        $('#container1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Browser market shares at a specific website, 2014'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                        ['Firefox', 45.0],
                        ['IE', 26.8],
                        {
                            name: 'Chrome',
                            y: 12.8,
                            sliced: true,
                            selected: true
                        },
                        ['Safari', 8.5],
                        ['Opera', 6.2],
                        ['Others', 0.7]
                    ]
                }]
        });
    });
</script>


<script>
    $(function () {
        $('#container2').highcharts({
            title: {
                text: 'Combination chart'
            },
            xAxis: {
                categories: ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums']
            },
            labels: {
                items: [{
                        html: 'Total fruit consumption',
                        style: {
                            left: '50px',
                            top: '18px',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                        }
                    }]
            },
            series: [{
                    type: 'column',
                    name: 'Jane',
                    data: [3, 2, 1, 3, 4]
                }, {
                    type: 'column',
                    name: 'John',
                    data: [2, 3, 5, 7, 6]
                }, {
                    type: 'column',
                    name: 'Joe',
                    data: [4, 3, 3, 9, 0]
                }, {
                    type: 'spline',
                    name: 'Average',
                    data: [3, 2.67, 3, 6.33, 3.33],
                    marker: {
                        lineWidth: 2,
                        lineColor: Highcharts.getOptions().colors[3],
                        fillColor: 'white'
                    }
                }, {
                    type: 'pie',
                    name: 'Total consumption',
                    data: [{
                            name: 'Jane',
                            y: 13,
                            color: Highcharts.getOptions().colors[0] // Jane's color
                        }, {
                            name: 'John',
                            y: 23,
                            color: Highcharts.getOptions().colors[1] // John's color
                        }, {
                            name: 'Joe',
                            y: 19,
                            color: Highcharts.getOptions().colors[2] // Joe's color
                        }],
                    center: [100, 80],
                    size: 100,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                }]
        });
    });


</script>