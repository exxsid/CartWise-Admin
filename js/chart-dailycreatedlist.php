<?php
require_once './includes/dailycreatedlist.php'
?>

<script>
    window.addEventListener("load", () => {

        var dailyChart = new CanvasJS.Chart("chartContainerDaily", {

            axisX: {
                title: "Temperature",
                suffix: " °C"
            },
            axisY: {
                title: "Viscosity (in mPa·s)",
                suffix: " mPa·s"
            },
            data: [{
                type: "area",
                markerSize: 0,
                xValueFormatString: "#,##0 °C",
                yValueFormatString: "#,##0.000 mPa·s",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        dailyChart.render();

    });
</script>