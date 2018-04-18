const electron = require('electron')
// Module to control application life.
const app = electron.app
// Module to create native browser window.
const BrowserWindow = electron.BrowserWindow

const path = require('path')
const url = require('url')

// Keep a global reference of the window object, if you don't, the window will
// be closed automatically when the JavaScript object is garbage collected.
let mainWindow

global.sharedObj = {
    airTempVal: 0,
    waterTemp1Val: 0,
    ph1Val:0,
    rhVal:0,
    Temp: 0,
    Relay1: 0,
    Relay1IsOn: 0,
    Relay2: 0,
    Relay2IsOn: 0,
    Relay3: 0,
    Relay3IsOn: 0,
    Relay4: 0,
    Relay4IsOn: 0,
    Relay5: 0,
    Relay5IsOn: 0,
    Relay6: 0,
    Relay6IsOn: 0,
    Relay7: 0,
    Relay7IsOn: 0,
    Relay8: 0,
    Relay8IsOn: 0,
    Tank1Status: 0,
    Tank2Status: 0,
    lightSchedule: ['setlightschedule',5,30,23,30],
    waterSchedule:['setwateringschedule',7,15,1,2,15,15,11],
    time:['Apr 16',' 2018 01:21:24 PM',4,16,2018,13,21,24],
    serialSend: null,
    connect: null
    };

function createWindow () {
  // Create the browser window.
  mainWindow = new BrowserWindow({frame: false,width: 1400, height: 850})

  // and load the index.html of the app.
  mainWindow.loadURL(url.format({
    pathname: path.join(__dirname, 'index.html'),
    protocol: 'file:',
    slashes: true
  }))

  // Open the DevTools.
  //mainWindow.webContents.openDevTools()

  // Emitted when the window is closed.
  mainWindow.on('closed', function () {
    // Dereference the window object, usually you would store windows
    // in an array if your app supports multi windows, this is the time
    // when you should delete the corresponding element.
    mainWindow = null
  })
}

// This method will be called when Electron has finished
// initialization and is ready to create browser windows.
// Some APIs can only be used after this event occurs.
app.on('ready', createWindow)

// Quit when all windows are closed.
app.on('window-all-closed', function () {
  // On OS X it is common for applications and their menu bar
  // to stay active until the user quits explicitly with Cmd + Q
  app.quit()
})

app.on('activate', function () {
  // On OS X it's common to re-create a window in the app when the
  // dock icon is clicked and there are no other windows open.
  if (mainWindow === null) {
    createWindow()
  }
})

// In this file you can include the rest of your app's specific main process
// code. You can also put them in separate files and require them here.
