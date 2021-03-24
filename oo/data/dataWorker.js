var token = "";
var data;
var amount = 0;
var stringtosendavg = "";
var stringtosenddates = "";

self.addEventListener('message', function(e){
    const xmlHttp = new XMLHttpRequest();

    xmlHttp.addEventListener('readystatechange', () => {
        if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            console.log('parsing data');
            data = JSON.parse(xmlHttp.responseText);
            console.log('handling data');
            var values = [];
            var dates =[];
            var lastval = 0;
            data.data.forEach(async function (item, i) {
                stringtosenddates += "Op: " + data.data[i].at.split('T')[0] + " om: "+ data.data[i].at.split('T')[1].split(':')[0]  + " uur -> \n";
                dates[i]= data.data[i].at.split('T')[0] + " " + data.data[i].at.split('T')[1].split(':')[0] + ":"+data.data[i].at.split('T')[1].split(':')[1];
                if (data.data[i].data == null) {
                    stringtosendavg += "No data at that time \n";
                    values[i] = lastval;
                } else {
                    stringtosendavg += data.data[i].data.avg + "\n";
                    lastval = data.data[i].data.avg;
                    values[i] = data.data[i].data.avg;
                }
            });
            console.log("worker is done getting data!");
            self.postMessage([data,stringtosenddates, stringtosendavg, values, dates]);
            self.close();
        }
    });

    var dayv = e.data[0];
    var monthv = e.data[1];
    var dayt = e.data[2];
    var montht = e.data[3];


    if(dayv.length >2 || dayv.length < 1){
        dayv = "0" +1;
    }
    if(dayv.length <2){
        dayv = "0"+e.data[0];
    }

    if(monthv.length >2 || monthv.length < 1){
        monthv = "0" +1;
    }
    if(monthv.length <2){
        monthv = "0"+e.data[1];
    }

    if(dayt.length >2 || dayt.length < 1){
        dayt = "0" +2;
    }
    if(dayt.length <2){
        dayt = "0"+e.data[2];
    }

    if(montht.length >2 || montht.length < 1){
        montht = "0" +3;
    }
    if(montht.length <2){
        montht = "0" +e.data[3];
    }

    if(monthv > montht){
        monthv = 1;
    }
    if(monthv == montht && dayv > dayt){
        dayv=1;
    }
    if(monthv > 12){
        monthv=12;
    }
    if(montht > 12){
        montht = 12;
    }
    if (dayv >31){
        dayv = 31;
    }
    if (dayt > 31){
        dayt = 31;
    }


    xmlHttp.open("GET", "https://api.allthingstalk.io/asset/asset_id/activity?from=2021-" + monthv +"-"+ dayv+"T00:00:00Z&to=2021-" + montht +"-"+ dayt+"T00:00:00Z&resolution=hour");
    xmlHttp.setRequestHeader("Authorization", "Bearer " + token);

    xmlHttp.send();
});
