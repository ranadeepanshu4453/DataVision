document.addEventListener('DOMContentLoaded', function () {
    const chartData = JSON.parse(document.getElementById('chartData').textContent);

    let graphtype = "bar";
    const chartInstances = [];

    function createCharts(type) {
        chartInstances.forEach(instance => instance.destroy());
        chartInstances.length = 0;

        chartData.forEach(data => {
            const ctx = document.getElementById(data.id).getContext('2d');

            const chart = new Chart(ctx, {
                type: type,
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: data.label,
                        data: data.values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            chartInstances.push(chart);
        });
    }

    createCharts(graphtype);

    document.getElementById('toggleEigh').addEventListener('change', function () {
        graphtype = this.checked ? 'line' : 'bar';
        createCharts(graphtype);
    });
});

document.getElementById('printBtn').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    let content = document.getElementById('content-to-print');

    doc.html(content, {
        callback: function (doc) {
            doc.save('screen-data.pdf');
        },
        x: 10,
        y: 10,
        width: 190,
        windowWidth: 650
    });
});
