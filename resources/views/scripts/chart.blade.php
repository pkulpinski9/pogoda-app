<?php
$dataHumidity = array();
$dataTemp = array();
foreach ($city->archives as $archive) {
    $y = $archive->old_humidity;
    $x = $archive->created_at->format('Y-m-d H:i:s');
    $y1 = $archive->old_temp;
    $x1 = $archive->created_at->format('Y-m-d H:i:s');
    array_push ($dataHumidity, ["label" => $x, "y" => $y]);
    array_push ($dataTemp, ["label" => $x1, "y" => $y1]);
}
?>

<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                fontFamily: "Calibri",
                text: "Wykres wilgotności w czasie"
            },
            axisY:{
                includeZero: true
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#ffffff",
                indexLabelPlacement: "inside",
                dataPoints: @php echo json_encode($dataHumidity) @endphp
            }]
        });
        chart.render();

        $("#dataHumidity").click(function () {
            chart.options.title.text = "Wykres wilgotności w czasie";
            chart.options.data[0].dataPoints = @php echo json_encode($dataHumidity) @endphp;
            chart.render();
        });
        $("#dataTemp").click(function () {
            chart.options.title.text = "Wykres temperatury w czasie";
            chart.options.data[0].dataPoints = @php echo json_encode($dataTemp) @endphp;
            chart.render();
        });
    }
</script>
