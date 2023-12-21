document.addEventListener('DOMContentLoaded', function () {


 const ctx = document.getElementById('gaugeChart').getContext('2d');

    const gaugeChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [],
            datasets: [{
                data: [],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                ],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'City Distribution',
            },
        },
    });

    function updateGaugeChart() {
        fetch('data_fetcher.php')
            .then(response => response.json())
            .then(data => {
                const labels = Object.keys(data);
                const values = Object.values(data);

                gaugeChart.data.labels = labels;
                gaugeChart.data.datasets[0].data = values;

                gaugeChart.update();
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    updateGaugeChart();
    setInterval(updateGaugeChart, 5000);






    // Line Chart
const lineCtx = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Quantity',
            borderColor: 'rgba(75, 192, 192, 3)',
            backgroundColor: 'rgba(75, 102, 192, 2)',
            data: [],
        }]
    },
    options: {
        scales: {
            x: {
                type: 'category',
                
            },
            y: {
                type: 'linear',
                position: 'left',
            },
        },
          elements: {
                    line: {
                        tension: 0.4, // Adjust the curve tension
                    },
                },
                animation: {
                    duration: 1000, // Animation duration in milliseconds
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                tooltips: {
                    enabled: true,
                },
            },
        });

// Function to update line chart
function updateLineChart() {
    // Fetch latest data from backend
        fetch('data_fetcher.php?graphType=line_chart')
        .then(response => response.json())
        .then(data => {
        // Update line chart data
        lineChart.data.labels = data.labels;
        lineChart.data.datasets[0].data = data.values;

        // Update line chart
        lineChart.update();
    })
        .catch(error => {
                console.error('Error fetching bar chart data:', error);
            });
}
 
    updateLineChart();
    setInterval(updateLineChart, 5000);



     // Bar Chart
        var barCtx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: [], // Add initial data here
                datasets: [{
                    label: 'Salary',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    data: [], // Add initial data here
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 1000, // Animation duration in milliseconds
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                tooltips: {
                    enabled: true,
                },
            },
        });

        // Function to update bar chart
        function updateBarChart() {
            // Fetch latest data from backend
            fetch('data_fetcher.php?graphType=bar_chart')
                .then(response => response.json())
                .then(data => {
                    // Update bar chart
                    barChart.data.labels = data.labels;
                    barChart.data.datasets[0].data = data.values;

                    // Set a different background color for each bar
                    barChart.data.datasets[0].backgroundColor = generateRandomColors(data.labels.length);

                    // Update bar chart
                    barChart.update();
                })
                .catch(error => {
                    console.error('Error fetching bar chart data:', error);
                });
        }

        // Generate random background colors
        function generateRandomColors(count) {
            const colors = [];
            for (let i = 0; i < count; i++) {
                colors.push(getRandomColor());
            }
            return colors;
        }

        // Get a random color
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Update bar chart initially and every 5 seconds
        updateBarChart();
        setInterval(updateBarChart, 5000);
    });