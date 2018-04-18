

var SerialPort = require('serialport');
var port = new SerialPort('USB\\VID_2341&PID_0042', {
  baudRate: 115200
});
 
port.write('main screen turn on', function(err) {
  if (err) {
    return console.log('Error on write: ', err.message);
  }
  console.log('message written');
});
 
// Open errors will be emitted as an error event
port.on('error', function(err) {
  console.log('Error: ', err.message);
});

port.on('data', function (data) {
  console.log('Data:', data);
});

port.write('Relay7 on');
