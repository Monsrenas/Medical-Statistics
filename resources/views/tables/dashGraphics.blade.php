<body>
    <div style="width: 600px;">
    <canvas id="lineChart" width="800" height="400"></canvas>
    </div>    
    <script>
        function generarGraficoLineas(valoresX, valoresY, valoresGrafico, valoresGrafico2) {
            var ctx = document.getElementById('lineChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: valoresX,
                    datasets: [{
                        label: 'Datos de prueba para la generacion de graficos',
                        data: valoresY,
                        borderColor: 'rgb(75, 192, 192)',
                        fill: false
                    }, {
                        label: 'Gráfico Para probar todos los elementos a modificar',
                        data: valoresGrafico,
                        borderColor: 'rgb(255, 99, 132)',
                        fill: false
                    },
                    {
                        label: 'Gráfico 2',
                        data: valoresGrafico2,
                        borderColor: 'rgb(255, 99, 192)',
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Eje X'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Eje Y'
                            }
                        }]
                    }
                }
            });
        }

        // Ejemplo de uso:
        var valoresX = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
        var valoresY = [65, 59, 80, 81, 56];
        var valoresGrafico = [28, 48, 40, 19, 86];
        var valoresGrafico2 = [48, 58, 20, 69, 86];
        generarGraficoLineas(valoresX, valoresY, valoresGrafico, valoresGrafico2);
    </script>
</body>