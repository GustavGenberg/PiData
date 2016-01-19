<div id="chart_div" style="width: 400px; height: 120px;"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

            var PiData = [];

            setInterval(function () {
                $.get("PiData.php", function (data) {
                    PiData = JSON.parse(data);
                });
            }, 500);

            google.charts.load('current', {'packages':['gauge']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['CPU_TMP', 0],
                ['CPU_USG', 0],
                ['RAM_USG', 0],
                ['DISK_USG', 0]
                ]);

                var options = {
                width: 400, height: 120,
                redFrom: 70, redTo: 100,
                yellowFrom:50, yellowTo: 70,
                minorTicks: 5
                };

                var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                chart.draw(data, options);
                setInterval(function() {
                    
                    data.setValue(0, 1, PiData.cpu_temperature);
                    data.setValue(1, 1, PiData.cpu_percent_usage);
                    data.setValue(2, 1, PiData.ram_percent_usage);
                    data.setValue(3, 1, PiData.disk_percent_usage);
                    
                    
                    chart.draw(data, options);
                }, 1000);
            }
        </script>
