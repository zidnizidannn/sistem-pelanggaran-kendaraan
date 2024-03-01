
const NAMA_BULAN = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

var ctx = document.getElementById('myChart').getContext('2d');
var myChart;
const now = new Date();
var year = now.getFullYear(), month = now.getMonth(), date = now.getDate();

function generateDrowdownItem(targetSelector, start, end) {
    const target = document.querySelector(targetSelector);
    while(target.children.length > 0) {
        target.removeChild(target.children[0]);
    }
    var list = undefined;
    if(!end) {
        list = start;
        start = 0;
        end = list.length - 1;
    }
    for(var i = start; i <= end; i++) {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.classList.add('dropdown-item');
        a.textContent = list ? list[i] : i;
        a.dataset.index = i;
        li.appendChild(a);
        target.appendChild(li);
    }
}

function attachItemClickHandler(dropdownId, onClick) {
    const dropdown = document.getElementById(dropdownId);
    const toggle = dropdown.querySelector('.dropdown-toggle');
    dropdown.addEventListener('click', function(e) {
        if (e.target.classList.contains('dropdown-item')) {
            const selection = e.target.textContent;
            toggle.textContent = selection;
            if(onClick) onClick(e.target.dataset.index, selection);
        }
    });
}

function makeChart(data, label) {
    console.log(data)
    if(myChart) myChart.destroy();
    data.data = data.data.map(el=>parseInt(el));
    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: label,
                fill: false,
                data: data.data,
                backgroundColor: 'rgba(52, 119, 235, 0.2)',
                borderColor: 'rgba(52, 119, 235, 1)',
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
}
