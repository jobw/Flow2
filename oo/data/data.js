var data;
let myConfig

async function fetchhistodatres() {
    var worker = new Worker('dataWorker.js');
    
    document.getElementById('loading').style.visibility = "visible";
    worker.postMessage([
        document.getElementById("dayv").value,
        document.getElementById("monthv").value,
        document.getElementById("dayt").value,
        document.getElementById("montht").value
    ]);


    worker.addEventListener('message', function(e){    
        console.log('worker is done!');
        data = e.data[0];
        document.getElementById('at').innerText += e.data[1];
        document.getElementById('data').innerText = e.data[2];
        document.getElementById('loading').style.visibility = "hidden";
        myConfig = {
            type: 'line',
            title: {
              text: 'CO2 verloop (gemiddeld per uur)',
              fontSize: 24,
            },
            legend: {
              draggable: true,
            },
            scaleX: {
              // Set scale label
              label: { text: 'Days' },
              // Convert text on scale indices
              labels: e.data[4]
            },
            scaleY: {
              // Scale label with unicode character
              label: { text: 'Temperature (°c)' }
            },
            plot: {
              // Animation docs here:
              // https://www.zingchart.com/docs/tutorials/styling/animation#effect
              animation: {
                effect: '1',
                method: '8A',
                sequence: '12',
                speed: 10,
              }
            },
            series: [
              {
                // plot 1 values, linear data
                values: e.data[3],
                text: 'Week 1',
              }
            ]
          };
        renderchart();
    })
}


// Render Method[3]
function renderchart(){
    zingchart.render({
    id: 'myChart',
    data: myConfig,
  });
}
