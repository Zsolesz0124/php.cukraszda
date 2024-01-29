<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<div style="width: 600px; height: 400px; margin: auto;">
    <canvas id="myChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function () {
        // Setup
        const type_names = <?php echo json_encode($viewData['uzenet']['tipus']) ?>;
        const type_count = <?php echo json_encode($viewData['uzenet']['darab']) ?>;
        const data = {
            labels: type_names,
            datasets: [{
                label: 'Sütemények típusonkénti száma',
                data: type_count,
                borderWidth: 2,
                backgroundColor: 'rgba(130,119,171,0.8)',
            }]
        };

        // Config
        const config = {
            type: 'bar',
            data,
            options: {
                plugins: {
                    legend: {
                        title: {
                            padding: 10
                        },
                        labels: {
                            color: '#ffffff',
                            font: {
                                size: 18
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            color: '#ffffff',
                        },
                        beginAtZero: true,
                    },
                    x: {
                        ticks: {
                            color: '#ffffff',
                        }
                    }
                }
            },
        }

        // Render
        const myChart = new Chart(
            $('#myChart'),
            config
        );
    });
</script>
</body>
</html>
