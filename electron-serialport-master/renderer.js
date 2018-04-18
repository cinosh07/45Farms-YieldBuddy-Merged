////Blooming Light Schedule
//Light_Schedule,11,30,23,30
//setlightschedule,11,30,23,30
//
////Grow Light Schedule
//Light_Schedule,5,30,23,30
//setlightschedule,5,30,23,30
//
////GROW and Blooming Watering
//Watering_Schedule,7,15,1,2,15,15,11
//setwateringschedule,7,15,1,2,15,15,11
//
////Sensors Definition
//Sensors,4.48,0.00,17.00,50.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,17.37,0.00,0.00,0.00
//Time,Apr 16, 2018 01:21:24 PM,4,16,2018,13,21,24
//
//	//Time
//	"0" => "Sensors_Time",
//
//	//Sensors
//	"1" => "Sensors_pH1",
//	"2" => "Sensors_pH2",
//	"3" => "Sensors_Temp",
//	"4" => "Sensors_RH",
//	"5" => "Sensors_TDS1",
//	"6" => "Sensors_TDS2",
//	"7" => "Sensors_CO2",
//	"8" => "Sensors_Light",
//	"9" => "Sensors_Water",
//	"10" => "Sensors_MagX",
//	"11" => "Sensors_MagY",
//	"12" => "Sensors_MagZ",
//	"13" => "Sensors_TankTotal",
//	"14" => "Sensors_Tank1",
//	"15" => "Sensors_Tank2",
//	"16" => "Sensors_Tank3",
//	"17" => "Sensors_Tank4",   
//	"18" => "Sensors_WaterTempP1",
//	"19" => "Sensors_WaterTempP2",
//	"20" => "Sensors_WaterTempP3",
//	"21" => "Sensors_WaterTempP4",
//
//
////Relays Commands
//Relays,0,1,0,1,1,0,1,1
//Relay_isAuto,1,1,1,1,0,0,0,1
//
//Relay 1 (Water Pump 1)
//Relay1 isAuto 0
//Relay1 isAuto 1
//Relay1 off
//Relay1 on
//
//Relay 2 (Water Supply 1)
//Relay2 isAuto 0
//Relay2 isAuto 1
//Relay2 off
//Relay2 on
//
//Relay 3 (pH UP)
//Relay3 isAuto 0
//Relay3 isAuto 1
//Relay3 off
//Relay3 on
//
//Relay 4 (Tap Water Solenoid)
//Relay4 isAuto 0
//Relay4 isAuto 1
//Relay4 off
//Relay4 on
//
//Relay 5 (Exhaust Fan)
//Relay5 isAuto 0
//Relay5 isAuto 1
//Relay5 off
//Relay5 on
//
//Relay 6 (Humidifier)
//Relay6 isAuto 0
//Relay6 isAuto 1
//Relay6 off
//Relay6 on
//
//Relay 7 (A/C - Intake Fan)
//Relay7 isAuto 0
//Relay7 isAuto 1
//Relay7 off
//Relay7 on
//
//Relay 8 (Light/Ballast)
//Relay8 isAuto 0
//Relay8 isAuto 1
//Relay8 off
//Relay8 on
//
//
//
////Commands
//setlightschedule,$Light_ON_hour,$Light_ON_min,$Light_OFF_hour,$Light_OFF_min
//setwateringschedule,$Pump_start_hour,$Pump_start_min,$Pump_every_hours,$Pump_every_mins,$Pump_for,$Pump_times
//setpH1,$pH1Value_Low,$pH1Value_High
//setRH,$RHValue_Low,$RHValue_High,$Humidifier_ON,$Humidifier_OFF,$Dehumidifier_ON,$Dehumidifier_OFF
//setdate,$Arduino_month,$Arduino_day,$Arduino_year,$Arduino_hour,$Arduino_min,$Arduino_sec
//
//
//SetPoint_Tank1,50.00,200.00,200.00,190.00,0,LOW
//SetPoint_Tank2,50.00,200.00,200.00,190.00,0,OK
//

const serialport = require('serialport');
const createTable = require('data-table');
var localPorts;
var yieldPort;
var combo = document.getElementById("combo");
var remote = require('electron').remote;


document.getElementById('sendCommand').addEventListener('click', sendCommand);
remote.getGlobal('sharedObj').connect = function () {
    
    
    var serialPort = combo.options[combo.selectedIndex].text;
    
    yieldPort = new serialport(serialPort, {
        baudRate: 115200,
        parser: serialport.parsers.readline("\n")
//        dataBits: 8, // this is the default for Arduino serial communication
//        parity: 'none', // this is the default for Arduino serial communication
//        stopBits: 1, // this is the default for Arduino serial communication
//        flowControl: false
    });



// Open errors will be emitted as an error event
    yieldPort.on('error', function (err) {
        console.log('Error: ', err.message);
    });
//    global.sharedObj = {
//    airTempVal: 0,
//    waterTemp1Val: 0,
//    ph1Val:0,
//    rhVal:0,
//    Temp: 0,
//    Relay1: 'off',
//    Relay1IsOn: 0,
//    Relay2: 'off',
//    Relay2IsOn: 0,
//    Relay3: 'off',
//    Relay3IsOn: 0,
//    Relay4: 'off',
//    Relay4IsOn: 0,
//    Relay5: 'off',
//    Relay5IsOn: 0,
//    Relay6: 'off',
//    Relay6IsOn: 0,
//    Relay7: 'off',
//    Relay7IsOn: 0,
//    Relay8: 'off',
//    Relay8IsOn: 0,
//    Tank1Status: 'LOW',
//    Tank2Status: 'HIGH',
//    lightSchedule: ['setlightschedule',5,30,23,30],
//    waterSchedule:['setwateringschedule',7,15,1,2,15,15,11],
//    time:['Apr 16',' 2018 01:21:24 PM',4,16,2018,13,21,24]
//    };


    remote.getGlobal('sharedObj').serialSend = function (command) {

        console.log('Command Sent : ' + command);

        for (var i = 0; i < command.length; i++) {
            yieldPort.write(new Buffer(command[i], 'ascii'), function (err, results) {
                // console.log('Error: ' + err);
                // console.log('Results ' + results);
            });
        }
        ;
        yieldPort.write(new Buffer('\n', 'ascii'), function (err, results) {
            // console.log('err ' + err);
            // console.log('results ' + results);
        });

    };
    yieldPort.on('data', function (data) {

        var message = '';
        message = data;
        var dataSplited = [];
        dataSplited = message.split(',');
        if (dataSplited[0] === 'Sensors') {

//            document.getElementById('ph').innerHTML = 'PH: ' + dataSplited[1];
//            document.getElementById('airtemp').innerHTML = 'Air Temp: ' + dataSplited[3];
//            document.getElementById('humidity').innerHTML = 'Humidity: ' + dataSplited[4];
//            document.getElementById('watertemp').innerHTML = 'Water Temp: ' + dataSplited[18];

            remote.getGlobal('sharedObj').ph1Val = parseFloat(dataSplited[1]);
            remote.getGlobal('sharedObj').airTempVal = parseFloat(dataSplited[3]);
            if (parseFloat(dataSplited[18]) > -45.0) {
                remote.getGlobal('sharedObj').waterTemp1Val = parseFloat(dataSplited[18]);
            }

            remote.getGlobal('sharedObj').rhVal = parseFloat(dataSplited[4]);





        } else if (dataSplited[0] === 'Time') {
            
            document.getElementById('ArduinoClockTime').innerHTML = dataSplited[1] + ' ' + dataSplited[2];

        } else if (dataSplited[0] === 'Watering_Schedule') {
            
            document.getElementById('watering').innerHTML = 'Watering: ' + dataSplited;

        } else if (dataSplited[0] === 'Light_Schedule') {
            var startHour = parseInt(dataSplited[1]);
            var stopHour = parseInt(dataSplited[3]);
            if (stopHour - startHour === 12) {
                
                document.getElementById("buttonBloom").classList.add('ButtonClassSelected');
                document.getElementById("buttonBloom").classList.remove('ButtonClass');
                document.getElementById("buttonBloom").disabled = true;
                
                document.getElementById("buttonGrow").classList.add('ButtonClass');
                document.getElementById("buttonGrow").classList.remove('ButtonClassSelected');
                document.getElementById("buttonGrow").disabled = false;
                
            } else if (stopHour - startHour > 12) {
                document.getElementById("buttonGrow").classList.add('ButtonClassSelected');
                document.getElementById("buttonGrow").classList.remove('ButtonClass');
                document.getElementById("buttonGrow").disabled = true;
                
                document.getElementById("buttonBloom").classList.add('ButtonClass');
                document.getElementById("buttonBloom").classList.remove('ButtonClassSelected');
                document.getElementById("buttonBloom").disabled = false;
                
            }
            document.getElementById('light').innerHTML = 'Light: ' + dataSplited;

        } else if (dataSplited[0] === 'Relays') {

            if (dataSplited[1] === '0') {
                remote.getGlobal('sharedObj').Relay1 = 0;
                document.getElementById('relay1').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay1').setAttribute('title', 'Relay 1 OFF');
                document.getElementById('relay1').setAttribute('alt', 'Relay 1 OFF');
            } else {
                remote.getGlobal('sharedObj').Relay1 = 1;
                document.getElementById('relay1').setAttribute('src', 'img/relay_on.jpg');
                document.getElementById('relay1').setAttribute('title', 'Relay 1 ON');
                document.getElementById('relay1').setAttribute('alt', 'Relay 1 ON');
            }
            if (dataSplited[2] === '0') {
                remote.getGlobal('sharedObj').Relay2 = 0;
                document.getElementById('relay2').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay2').setAttribute('title', 'Relay 2 OFF');
                document.getElementById('relay2').setAttribute('alt', 'Relay 2 OFF');
            } else {
                remote.getGlobal('sharedObj').Relay2 = 1;
                document.getElementById('relay2').setAttribute('src', 'img/relay_on.jpg');
                document.getElementById('relay2').setAttribute('title', 'Relay 2 ON');
                document.getElementById('relay2').setAttribute('alt', 'Relay 2 ON');
            }

            if (dataSplited[3] === '0') {
                remote.getGlobal('sharedObj').Relay3 = 0;
                document.getElementById('relay3').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay3').setAttribute('title', 'Relay 3 OFF');
                document.getElementById('relay3').setAttribute('alt', 'Relay 3 OFF');
            } else {
                remote.getGlobal('sharedObj').Relay3 = 1;
                document.getElementById('relay3').setAttribute('src', 'img/relay_on.jpg');
                document.getElementById('relay3').setAttribute('title', 'Relay 3 ON');
                document.getElementById('relay3').setAttribute('alt', 'Relay 3 ON');
            }
            if (dataSplited[4] === '0') {
                remote.getGlobal('sharedObj').Relay4 = 0;
                document.getElementById('relay4').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay4').setAttribute('title', 'Relay 4 OFF');
                document.getElementById('relay4').setAttribute('alt', 'Relay 4 OFF');
            } else {
                remote.getGlobal('sharedObj').Relay4 = 1;
                document.getElementById('relay4').setAttribute('src', 'img/relay_on.jpg');
                document.getElementById('relay4').setAttribute('title', 'Relay 4 ON');
                document.getElementById('relay4').setAttribute('alt', 'Relay 4 ON');
            }
            if (dataSplited[5] === '0') {
                remote.getGlobal('sharedObj').Relay5 = 0;
                document.getElementById('relay5').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay5').setAttribute('title', 'Relay 5 OFF');
                document.getElementById('relay5').setAttribute('alt', 'Relay 5 OFF');
            } else {
                remote.getGlobal('sharedObj').Relay5 = 1;
                document.getElementById('relay5').setAttribute('src', 'img/relay_on.jpg');
                document.getElementById('relay5').setAttribute('title', 'Relay 5 ON');
                document.getElementById('relay5').setAttribute('alt', 'Relay 5 ON');
            }
            if (dataSplited[6] === '0') {
                remote.getGlobal('sharedObj').Relay6 = 0;
                document.getElementById('relay6').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay6').setAttribute('title', 'Relay 6 OFF');
                document.getElementById('relay6').setAttribute('alt', 'Relay 6 OFF');
            } else {
                remote.getGlobal('sharedObj').Relay6 = 1;
                document.getElementById('relay6').setAttribute('src', 'img/relay_on.jpg');
                document.getElementById('relay6').setAttribute('title', 'Relay 6 ON');
                document.getElementById('relay6').setAttribute('alt', 'Relay 6 ON');
            }
            if (dataSplited[7] === '0') {
                remote.getGlobal('sharedObj').Relay7 = 0;
                document.getElementById('relay7').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay7').setAttribute('title', 'Relay 7 OFF');
                document.getElementById('relay7').setAttribute('alt', 'Relay 7 OFF');
            } else {
                remote.getGlobal('sharedObj').Relay7 = 1;
                document.getElementById('relay7').setAttribute('src', 'img/relay_on.jpg');
                document.getElementById('relay7').setAttribute('title', 'Relay 7 ON');
                document.getElementById('relay7').setAttribute('alt', 'Relay 7 ON');
            }
            if (dataSplited[8] === '0') {
                remote.getGlobal('sharedObj').Relay8 = 0;
                document.getElementById('relay8').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay8').setAttribute('title', 'Relay 8 OFF');
                document.getElementById('relay8').setAttribute('alt', 'Relay 8 OFF');
            } else {
                remote.getGlobal('sharedObj').Relay8 = 1;
                document.getElementById('relay8').setAttribute('src', 'img/relay_on.jpg');
                document.getElementById('relay8').setAttribute('title', 'Relay 8 ON');
                document.getElementById('relay8').setAttribute('alt', 'Relay 8 ON');
            }

//            document.getElementById('relays').innerHTML = 'Relays: ' + dataSplited;

        } else if (dataSplited[0] === 'Relay_isAuto') {
            if (dataSplited[1] === '0') {
                remote.getGlobal('sharedObj').Relay1IsOn = 0;
                document.getElementById('relay1Auto').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay1Auto').setAttribute('title', 'Relay 1 Manual');
                document.getElementById('relay1Auto').setAttribute('alt', 'Relay 1 Manual');
            } else {
                remote.getGlobal('sharedObj').Relay1IsOn = 1;
                document.getElementById('relay1Auto').setAttribute('src', 'img/auto.jpg');
                document.getElementById('relay1Auto').setAttribute('title', 'Relay 1 Auto');
                document.getElementById('relay1Auto').setAttribute('alt', 'Relay 1 Auto');
            }
            if (dataSplited[2] === '0') {
                remote.getGlobal('sharedObj').Relay2IsOn = 0;
                document.getElementById('relay2Auto').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay2Auto').setAttribute('title', 'Relay 2 Manual');
                document.getElementById('relay2Auto').setAttribute('alt', 'Relay 2 Manual');
            } else {
                remote.getGlobal('sharedObj').Relay2IsOn = 1;
                document.getElementById('relay2Auto').setAttribute('src', 'img/auto.jpg');
                document.getElementById('relay2Auto').setAttribute('title', 'Relay 2 Auto');
                document.getElementById('relay2Auto').setAttribute('alt', 'Relay 2 Auto');
            }

            if (dataSplited[3] === '0') {
                remote.getGlobal('sharedObj').Relay3IsOn = 0;
                document.getElementById('relay3Auto').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay3Auto').setAttribute('title', 'Relay 3 Manual');
                document.getElementById('relay3Auto').setAttribute('alt', 'Relay 3 Manual');
            } else {
                remote.getGlobal('sharedObj').Relay3IsOn = 1;
                document.getElementById('relay3Auto').setAttribute('src', 'img/auto.jpg');
                document.getElementById('relay3Auto').setAttribute('title', 'Relay 3 Auto');
                document.getElementById('relay3Auto').setAttribute('alt', 'Relay 3 Auto');
            }
            if (dataSplited[4] === '0') {
                remote.getGlobal('sharedObj').Relay4IsOn = 0;
                document.getElementById('relay4Auto').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay4Auto').setAttribute('title', 'Relay 4 Manual');
                document.getElementById('relay4Auto').setAttribute('alt', 'Relay 4 Manual');
            } else {
                remote.getGlobal('sharedObj').Relay4IsOn = 1;
                document.getElementById('relay4Auto').setAttribute('src', 'img/auto.jpg');
                document.getElementById('relay4Auto').setAttribute('title', 'Relay 4 Auto');
                document.getElementById('relay4Auto').setAttribute('alt', 'Relay 4 Auto');
            }
            if (dataSplited[5] === '0') {
                remote.getGlobal('sharedObj').Relay5IsOn = 0;
                document.getElementById('relay5Auto').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay5Auto').setAttribute('title', 'Relay 5 Manual');
                document.getElementById('relay5Auto').setAttribute('alt', 'Relay 5 Manual');
            } else {
                remote.getGlobal('sharedObj').Relay5IsOn = 1;
                document.getElementById('relay5Auto').setAttribute('src', 'img/auto.jpg');
                document.getElementById('relay5Auto').setAttribute('title', 'Relay 5 Auto');
                document.getElementById('relay5Auto').setAttribute('alt', 'Relay 5 Auto');
            }
            if (dataSplited[6] === '0') {
                remote.getGlobal('sharedObj').Relay6IsOn = 0;
                document.getElementById('relay6Auto').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay6Auto').setAttribute('title', 'Relay 6 Manual');
                document.getElementById('relay6Auto').setAttribute('alt', 'Relay 6 Manual');
            } else {
                remote.getGlobal('sharedObj').Relay6IsOn = 1;
                document.getElementById('relay6Auto').setAttribute('src', 'img/auto.jpg');
                document.getElementById('relay6Auto').setAttribute('title', 'Relay 6 Auto');
                document.getElementById('relay6Auto').setAttribute('alt', 'Relay 6 Auto');
            }
            if (dataSplited[7] === '0') {
                remote.getGlobal('sharedObj').Relay7IsOn = 0;
                document.getElementById('relay7Auto').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay7Auto').setAttribute('title', 'Relay 7 Manual');
                document.getElementById('relay7Auto').setAttribute('alt', 'Relay 7 Manual');
            } else {
                remote.getGlobal('sharedObj').Relay7IsOn = 1;
                document.getElementById('relay7Auto').setAttribute('src', 'img/auto.jpg');
                document.getElementById('relay7Auto').setAttribute('title', 'Relay 7 Auto');
                document.getElementById('relay7Auto').setAttribute('alt', 'Relay 7 Auto');
            }
            if (dataSplited[8] === '0') {
                remote.getGlobal('sharedObj').Relay8IsOn = 0;
                document.getElementById('relay8Auto').setAttribute('src', 'img/relay_off.jpg');
                document.getElementById('relay8Auto').setAttribute('title', 'Relay 8 Manual');
                document.getElementById('relay8Auto').setAttribute('alt', 'Relay 8 Manual');
            } else {
                remote.getGlobal('sharedObj').Relay8IsOn = 1;
                document.getElementById('relay8Auto').setAttribute('src', 'img/auto.jpg');
                document.getElementById('relay8Auto').setAttribute('title', 'Relay 8 Auto');
                document.getElementById('relay8Auto').setAttribute('alt', 'Relay 8 Auto');
            }
//            document.getElementById('relaysauto').innerHTML = 'Relays is auto: ' + dataSplited;

        } else if (dataSplited[0] === 'SetPoint_Tank1') {

            var value = 0; //dataSplited[6]
            var valueString = '';
            valueString = dataSplited[6];

            if (valueString.indexOf('OK') > -1) {
                value = 1;
            }
            remote.getGlobal('sharedObj').Tank1Status = value;
            document.getElementById('tank1Gauge').onclick();

        } else if (dataSplited[0] === 'SetPoint_Tank2') {
            var value = 0; //dataSplited[6]
            var valueString = '';
            valueString = dataSplited[6];

            if (valueString.indexOf('OK') > -1) {
                value = 1;
            }

            remote.getGlobal('sharedObj').Tank2Status = value;
            document.getElementById('tank2Gauge').onclick();

        }
        console.log('Data:', data);
    });

};
serialport.list((err, ports) => {
    localPorts = ports;
    console.log('ports', ports);
    if (err) {
        document.getElementById('error').textContent = err.message;
        return;
    } else {
        document.getElementById('error').textContent = '';
    }

    if (ports.length === 0) {
        document.getElementById('error').textContent = 'No ports discovered';
    }

    //const headers = Object.keys(ports[0]);
    //const table = createTable(headers);
    //tableHTML = '';
    //table.on('data', data => tableHTML += data);
    //table.on('end', () => document.getElementById('ports').innerHTML = tableHTML);
    localPorts.forEach(port => {
        var option = document.createElement("option");
        option.text = port.comName;
        option.value = port.comName;
        try {
            combo.add(option, null); //Standard 
        } catch (error) {
            combo.add(option); // IE only
        }
    }
    );
    //table.end();

    console.log('Ports : ' + localPorts);


});

function sendCommand() {

    var command = document.getElementById('commandText').value;

    console.log('Command Sent : ' + command);

    for (var i = 0; i < command.length; i++) {
        yieldPort.write(new Buffer(command[i], 'ascii'), function (err, results) {
            // console.log('Error: ' + err);
            // console.log('Results ' + results);
        });
    }
    ;
    yieldPort.write(new Buffer('\n', 'ascii'), function (err, results) {
        // console.log('err ' + err);
        // console.log('results ' + results);
    });

}
;



