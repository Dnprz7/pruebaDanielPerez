document.addEventListener('DOMContentLoaded', function () {
    var projectDataElement = document.getElementById('project-chart');
    var projectData = JSON.parse(projectDataElement.getAttribute('project_data'));

    new Chart(projectDataElement, {
        type: 'bar',
        data: {
            labels: Object.keys(projectData),
            datasets: [{
                label: 'Projects per month of 2024',
                data: Object.values(projectData),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1.5,
                barPercentage: 0.5
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        stepSize: 1
                    }
                }]
            }
        }
    });
});