var token = "";

var data;

var co2count5 = 0;
var co2count20 = 0;

var lastvalco2 = 0;
var last5valco2 = [];
var prevlast5valco1 = 0;
var last20valco2 = [];
var prevlast20valco1 = 0;


var tempcount5 = 0;
var tempcount20 = 0;

var lastvaltemp = 0;
var last5valtemp = [];
var prevlast5valtemp = 0;
var last20valtemp = [];
var prevlast20valtemp = 0;


var humidcount5 = 0;
var humidcount20 = 0;

var lastvalhumid = 0;
var last5valhumid = [];
var prevlast5valhumid = 0;
var last20valhumid = [];
var prevlast20valhumid = 0;

function httpGet() {
    setInterval(() => {
        console.log("requesting");
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", "https://api.allthingstalk.io/device/device_id/assets", false);
        xmlHttp.setRequestHeader("Authorization", "Bearer " + token);
        xmlHttp.send(null);
        data = JSON.parse(xmlHttp.responseText);

        document.getElementById('co2trendtijd').innerText = data[0].state.at.split('T')[0] + " om " + data[0].state.at.split('T')[1].split('Z')[0].split('.')[0];

        if (data[0].state.value != lastvalco2) {
            document.getElementById('co2').textContent = data[0].state.value;

            if (lastvalco2 != 0) {
                document.getElementById('co2trend1').innerText = lastvalco2
                if (data[0].state.value > lastvalco2) {
                    document.getElementById('co2trend1arrow').innerText = ' ↑ ';
                    document.getElementById('co2trend1div').style.color = "red";
                } else {
                    document.getElementById('co2trend1arrow').innerText = " ↓ ";
                    document.getElementById('co2trend1div').style.color = "green";
                }
            }

            lastvalco2 = data[0].state.value;
            last5valco2[co2count5] = data[0].state.value;

            co2count5++;
            if (co2count5 > 4) {
                co2count5 = 0;
                var last5valco2sum = 0;
                for (let i = 0; i < last5valco2.length; i++) {
                    last5valco2sum += last5valco2[i];
                }
                var last5valco2avg = last5valco2sum / last5valco2.length;
                console.log(last5valco2sum + " / " + last5valco2.length + " = " + last5valco2avg);
                if (prevlast5valco1 != 0) {
                    if (prevlast5valco1 < last5valco2avg) {
                        document.getElementById('co2trend2arrow').innerText = ' ↑ ';
                        document.getElementById('co2trend2div').style.color = "red";
                    } else {
                        document.getElementById('co2trend2arrow').innerText = " ↓ ";
                        document.getElementById('co2trend2div').style.color = "green";
                    }
                }
                document.getElementById('co2trend2').innerText = parseInt(last5valco2avg);
                prevlast5valco1 = last5valco2avg;
            }

            last20valco2[co2count20] = data[0].state.value;

            co2count20++;
            if (co2count20 > 19) {
                co2count20 = 0;
                var last20valco2sum = 0;
                for (let i = 0; i < last20valco2.length; i++) {
                    last20valco2sum += last20valco2[i];
                }
                var last20valco2avg = last20valco2sum / last20valco2.length;
                console.log(last20valco2sum + " / " + last20valco2.length + " = " + last20valco2avg);
                if (prevlast20valco1 != 0) {
                    if (prevlast20valco1 < last20valco2avg) {
                        document.getElementById('co2trend3arrow').innerText = ' ↑ ';
                        document.getElementById('co2trend3div').style.color = "red";
                    } else {
                        document.getElementById('co2trend3arrow').innerText = " ↓ ";
                        document.getElementById('co2trend3div').style.color = "green";
                    }
                }
                document.getElementById('co2trend3').innerText = parseInt(last20valco2avg);
                prevlast20valco1 = last20valco2avg;
            }

        }

        if (data[2].state.value != lastvaltemp) {
            document.getElementById('temp').textContent = data[2].state.value;
 
            if (lastvaltemp != 0) {
                document.getElementById('temptrend1').innerText = lastvaltemp
                if (data[0].state.value > lastvaltemp) {
                    document.getElementById('temptrend1arrow').innerText = ' ↑ ';
                    document.getElementById('temptrend1div').style.color = "red";
                } else {
                    document.getElementById('temptrend1arrow').innerText = " ↓ ";
                    document.getElementById('temptrend1div').style.color = "green";
                }
            }


            lastvaltemp = data[2].state.value;
            last5valtemp[tempcount5] = data[2].state.value;

            tempcount5++;
            if (tempcount5 > 4) {
                tempcount5 = 0;
                var last5valtempsum = 0;
                for (let i = 0; i < last5valtemp.length; i++) {
                    last5valtempsum += last5valtemp[i];
                }
                var last5valtempavg = last5valtempsum / last5valtemp.length;
                console.log(last5valtempsum + " / " + last5valtemp.length + " = " + last5valtempavg);
                if (prevlast5valtemp != 0) {
                    if (prevlast5valtemp < last5valtempavg) {
                        document.getElementById('temptrend2arrow').innerText = ' ↑ ';
                        document.getElementById('temptrend2div').style.color = "red";
                    } else {
                        document.getElementById('temptrend2arrow').innerText = " ↓ ";
                        document.getElementById('temptrend2div').style.color = "green";
                    }
                }
                document.getElementById('temptrend2').innerText = parseInt(last5valtempavg);
                prevlast5valtemp = last5valtempavg;
            }

            last20valtemp[tempcount20] = data[2].state.value;

            tempcount20++;
            if (tempcount20 > 19) {
                tempcount20 = 0;
                var last20valtempsum = 0;
                for (let i = 0; i < last20valtemp.length; i++) {
                    last20valtempsum += last20valtemp[i];
                }
                var last20valtempavg = last20valtempsum / last20valtemp.length;
                console.log(last20valtempsum + " / " + last20valtemp.length + " = " + last20valtempavg);
                if (prevlast20valtemp != 0) {
                    if (prevlast20valtemp < last20valtempavg) {
                        document.getElementById('temptrend3arrow').innerText = ' ↑ ';
                        document.getElementById('temptrend3div').style.color = "red";
                    } else {
                        document.getElementById('temptrend3arrow').innerText = " ↓ ";
                        document.getElementById('temptrend3div').style.color = "green";
                    }
                }
                document.getElementById('temptrend3').innerText = parseInt(last20valtempavg);
                prevlast20valtemp = last20valtempavg;
            }

        }

        if (data[1].state.value != lastvalhumid) {
            document.getElementById('humid').textContent = data[1].state.value;
 
            if (lastvalhumid != 0) {
                document.getElementById('humidtrend1').innerText = lastvalhumid
                if (data[0].state.value > lastvalhumid) {
                    document.getElementById('humidtrend1arrow').innerText = ' ↑ ';
                    document.getElementById('humidtrend1div').style.color = "red";
                } else {
                    document.getElementById('humidtrend1arrow').innerText = " ↓ ";
                    document.getElementById('humidtrend1div').style.color = "green";
                }
            }


            lastvalhumid = data[1].state.value;
            last5valhumid[humidcount5] = data[1].state.value;

            humidcount5++;
            if (humidcount5 > 4) {
                humidcount5 = 0;
                var last5valhumidsum = 0;
                for (let i = 0; i < last5valhumid.length; i++) {
                    last5valhumidsum += last5valhumid[i];
                }
                var last5valhumidavg = last5valhumidsum / last5valhumid.length;
                console.log(last5valhumidsum + " / " + last5valhumid.length + " = " + last5valhumidavg);
                if (prevlast5valhumid != 0) {
                    if (prevlast5valhumid < last5valhumidavg) {
                        document.getElementById('humidtrend2arrow').innerText = ' ↑ ';
                        document.getElementById('humidtrend2div').style.color = "red";
                    } else {
                        document.getElementById('humidtrend2arrow').innerText = " ↓ ";
                        document.getElementById('humidtrend2div').style.color = "green";
                    }
                }
                document.getElementById('humidtrend2').innerText = parseInt(last5valhumidavg);
                prevlast5valhumid = last5valhumidavg;
            }

            last20valhumid[humidcount20] = data[1].state.value;

            humidcount20++;
            if (humidcount20 > 19) {
                humidcount20 = 0;
                var last20valhumidsum = 0;
                for (let i = 0; i < last20valhumid.length; i++) {
                    last20valhumidsum += last20valhumid[i];
                }
                var last20valhumidavg = last20valhumidsum / last20valhumid.length;
                console.log(last20valhumidsum + " / " + last20valhumid.length + " = " + last20valhumidavg);
                if (prevlast20valhumid != 0) {
                    if (prevlast20valhumid < last20valhumidavg) {
                        document.getElementById('humidtrend3arrow').innerText = ' ↑ ';
                        document.getElementById('humidtrend3div').style.color = "red";
                    } else {
                        document.getElementById('humidtrend3arrow').innerText = " ↓ ";
                        document.getElementById('humidtrend3div').style.color = "green";
                    }
                }
                document.getElementById('humidtrend3').innerText = parseInt(last20valhumidavg);
                prevlast20valhumid = last20valhumidavg;
            }

        }



        if (data[0].state.value <= 700) {
            document.getElementById('co2live').style.color = "green";
            document.getElementById('shorttxttxt').style.color = "green";
            document.getElementById('shorttxttxt').textContent =
                "Er is een CO2 waarde van " + data[0].state.value + " gemeten, deze waarde is prima! \n" +
                "Een CO2 waarde van onder de 700 PPM wordt geadviseerd, u bent goed bezig, houdt de kamer onder deze waarde. ";
        } else if(data[0].state.value > 700) {
            if(data[0].state.value >1200){
                document.getElementById('co2div').style.color = "red";
                document.getElementById('shorttxttxt').style.color = "red";
                document.getElementById('shorttxttxt').textContent =
                "Er is een CO2 waarde van " + data[0].state.value + " gemeten, deze waarde is te hoog. \n" +
                "Er wordt sterk geadviseerd dat u de ruimte lucht, dit kunt u het beste doen door toch te creëren. " +
                "Dit doet u door 2 verschillende punten van de ruimte te openen, het beste zou zijn als u 2 ramen kunt openen, het liefst niet naast elkaar op dezelfde muur." +
                "Het openen van een raam en een duer, of zelfs 2 deuren als de ruimdte geen ramen heeft werkt ook."
            }else{
                document.getElementById('co2div').style.color = "orange";
                document.getElementById('shorttxttxt').style.color = "orange";
                document.getElementById('shorttxttxt').textContent =
                "Er is een CO2 waarde van " + data[0].state.value + " gemeten, deze waarde is niet ooptimaal. \n" +
                "Zorg er voor dat de waarde niet boven de 1200 PPM stijgt, het meest gezonde zou onder de 700 PPM zijn. De ruimte luchten kan hierbij helpen.";
            }
        }

    }, 4000);
    return
}

