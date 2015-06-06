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
                
<!---------------------GRAFICO BAR---------------->
                <div style="width: 97%">
                    <canvas id="canvas1" height="450" width="600"></canvas>
                </div>
<!---------------------FIM GRAFICO------------------>

            </div>
        </div>
    </div>
</div>  


<script>
    var randomScalingFactor11 = function () {
        return Math.round(Math.random() * 100)
    };

    var barChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: [randomScalingFactor1(), randomScalingFactor1(), randomScalingFactor1(), randomScalingFactor1(), randomScalingFactor1(), randomScalingFactor1(), randomScalingFactor1()]
            },
            {
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,0.8)",
                highlightFill: "rgba(151,187,205,0.75)",
                highlightStroke: "rgba(151,187,205,1)",
                data: [randomScalingFactor1(), randomScalingFactor1(), randomScalingFactor1(), randomScalingFactor1(), randomScalingFactor1(), randomScalingFactor1(), randomScalingFactor1()]
            }
        ]

    }
    window.onload = function () {
        var ctx = document.getElementById("canvas1").getContext("2d");
        window.myBar = new Chart(ctx).Bar(barChartData, {
            responsive: true
        });
    }

</script>