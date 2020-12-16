$(document).ready(function () {
    showGraph('Y');
    showDisk('Y');
});

var graph2 = document.getElementById('chart-container');


function showGraph(time) {
    {
        let graph = document.getElementById('chart-container').getElementsByTagName('canvas');
        for(let i= 0;i<graph.length;i++){
            graph[i].style.display= 'none';
        }

        document.getElementById("graphCanvas"+time).style.display = 'block';

        $.post("./money.php",{ time : time})
        .done(function (data) {
            var date = [];
            var amount = [];

            for (var i in data) {
                date.push(data[i].date);
                amount.push(data[i].montant);
            }

            var chartdata = {
                labels: date,
                datasets: [
                    {
                        label: 'Amount',

                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: amount
                    }
                ]
            };

            var graphTarget = $("#graphCanvas"+time);

            var barGraph = new Chart(graphTarget, {
                type: 'line',
                data: chartdata
            });
        });
    }
}

function showDisk(time) {
    {
        let graph = document.getElementById('chart-container-disk').getElementsByTagName('canvas');
        for(let i= 0;i<graph.length;i++){
            graph[i].style.display= 'none';
        }

        document.getElementById("graph-disk"+time).style.display = 'block';
        
        $.post("./disk.php",{ time : time})
        .done(
            function (data) {
                console.log(data);
                var date = [];
                var amount = [];

                for (var i in data) {
                    date.push(data[i].Libelle);
                    amount.push(data[i].montant);
                }

                var chartdata = {
                    labels: date,
                    datasets: [
                        {
                            fill: true,
                            backgroundColor: [
                                '#B4C6E7',
                                '#FCE4D6',
                                '#C6E0B4',
                                '#A6A6A6',
                                '#FFE699',
                                '#FFD966'],
                            data: amount,
                            // Notice the borderColor 
                            borderColor: 'black',
                            borderWidth: 1
                        }
                    ]
                };

                var graphTarget = $("#graph-disk"+time);

                var barGraph = new Chart(graphTarget, {
                    type: 'pie',
                    data: chartdata
                });
            });
    }
}

document.getElementById('btn-3d').addEventListener('click', () => {
    showGraph('D')
});

document.getElementById('btn-1s').addEventListener('click', () => {
    showGraph('S')
});

document.getElementById('btn-1m').addEventListener('click', () => {
    showGraph('M')
});

document.getElementById('btn-1y').addEventListener('click', () => {
    showGraph('Y')
});

document.getElementById('disk-3d').addEventListener('click', () => {
    showDisk('D')
});

document.getElementById('disk-1s').addEventListener('click', () => {
    showDisk('S')
});

document.getElementById('disk-1m').addEventListener('click', () => {
    showDisk('M')
});

document.getElementById('disk-1y').addEventListener('click', () => {
    showDisk('Y')
});

