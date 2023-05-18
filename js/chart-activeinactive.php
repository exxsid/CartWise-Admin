<?php
require_once 'includes\activeinactiveusers.php'
?>

<script>
    window.addEventListener("load", () => {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            title: {
                text: "Generation of Electricity in US - 2007 to 2016"
            },
            subtitles: [{
                text: "In Gigawatt Hours"
            }],
            legend: {
                cursor: "pointer",
                itemclick: toggleDataSeries
            },
            toolTip: {
                shared: true
            },
            data: [{
                    type: "stackedArea",
                    name: "Coal",
                    showInLegend: true,
                    visible: false,
                    yValueFormatString: "#,##0 GWh",
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "stackedArea",
                    name: "Petroleum",
                    showInLegend: true,
                    yValueFormatString: "#,##0 GWh",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "stackedArea",
                    name: "Natual Gas",
                    showInLegend: true,
                    visible: false,
                    yValueFormatString: "#,##0 GWh",
                    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "stackedArea",
                    name: "Nuclear",
                    showInLegend: true,
                    visible: false,
                    yValueFormatString: "#,##0 GWh",
                    dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "stackedArea",
                    name: "Hydroelectric",
                    showInLegend: true,
                    visible: false,
                    yValueFormatString: "#,##0 GWh",
                    dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "stackedArea",
                    name: "Solar",
                    showInLegend: true,
                    yValueFormatString: "#,##0 GWh",
                    dataPoints: <?php echo json_encode($dataPoints6, JSON_NUMERIC_CHECK); ?>
                }
            ]
        });

        chart.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart.render();
        }

    });
</script>