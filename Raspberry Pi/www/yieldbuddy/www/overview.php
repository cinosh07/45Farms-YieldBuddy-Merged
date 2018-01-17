<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['username'];
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/yieldbuddy2/www/users/' . $_SESSION['username'] . '.xml')) {
    header('Location: index.php');
    die;
}

#$page = $_SERVER['PHP_SELF'];
#$sec = "2";
#header("Refresh: $sec; url=$page");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <LINK REL="SHORTCUT ICON"
              HREF="/yieldbuddy2/www/img/favicon.ico">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>yieldbuddy</title>
            <style type="text/css">
                body {
                    background-image: url(img/background.png);
                    margin-top: 0px;
                    background-color: #000;
                }
                body, td,th {
                    font-family: Arial, Helvetica, sans-serif;
                    color: #000;
                    font-weight: bold;
                    position: relative;
                    font-size: 14px;
                }
                color.white {
                    font-family: Arial, Helvetica, sans-serif;
                    color: #FFF;
                    font-weight: bold;
/*                    position: relative;*/
                    font-size: 10px;
                }
                .description {
                    font-size: 9px;
                }
                .onoff
                {
                width:120px;
                height:120px;
                padding:1px 2px 3px 3px;	
                font-size:24px;
                font-weight: bold;
                background:lightgray;
                text-align:center ! important;
                position:relative;

                
                }
                .onoff div
                {
                width:106px;
                height:106px;
                min-height:106px;	
                background:red;
                overflow:hidden;
                border-top:1px solid gray;
                border-right:1px solid white;
                border-bottom:1px solid white;
                border-left:1px solid gray;			
                margin:0 auto;
                color:white;
                }
                a:link {
                    color: #999;
                    text-decoration: none;
                }
                a:visited {
                    text-decoration: none;
                    color: #999;
                }
                a:hover {
                    text-decoration: underline;
                    color: #999;
                }
                a:active {
                    text-decoration: none;
                    color: #999;
                }
                .CenterPageTitles {
                    text-align: center;
                }
                .CenterPageTitles td {
                    color: #FFF;
                }
            </style>
            <style type="text/css">
                div.cssbox {
                    font-family: Verdana, Geneva, sans-serif;
                    border: 2px solid #000000 ;
                    border-radius: 40px ;
                    padding: 20px ;
                    background-color: #FFFFFF ;
                    color: #000 ;
                    width: 90% ;
                    margin-left: auto ;
                    margin-right: auto ;
                }
            </style>
    </head>
    <script language = "JavaScript">
        function preloader()
        {
            RelayONImage = new Image();
            RelayONImage.src = "img/relay_on.jpg";
            RelayOFFImage = new Image();
            RelayOFFImage.src = "img/relay_off.jpg";
        }
    </script>
    <script>
        var airTempVal = 0;
        var waterTemp1Val = 0;
		var ph1Val = 0;
		var rhVal = 0;
		var Temp = 0;
<!-- Gauge Code Starts -->
var Gauge=function(b){function l(a,b){for(var c in b)"object"==typeof b[c]&&"[object Array]"!==Object.prototype.toString.call(b[c])&&"renderTo"!=c?("object"!=typeof a[c]&&(a[c]={}),l(a[c],b[c])):a[c]=b[c]}function q(){z.width=b.width;z.height=b.height;A=z.cloneNode(!0);B=A.getContext("2d");C=z.width;D=z.height;t=C/2;u=D/2;f=t<u?t:u;A.i8d=!1;B.translate(t,u);B.save();a.translate(t,u);a.save()}function v(a){var b=new Date;G=setInterval(function(){var c=(new Date-b)/a.duration;1<c&&(c=1);var f=("function"==
typeof a.delta?a.delta:M[a.delta])(c);a.step(f);1==c&&clearInterval(G)},a.delay||10)}function k(){G&&clearInterval(G);var a=I-n,h=n,c=b.animation;v({delay:c.delay,duration:c.duration,delta:c.fn,step:function(b){n=parseFloat(h)+a*b;E.draw()}})}function e(a){return a*Math.PI/180}function g(b,h,c){c=a.createLinearGradient(0,0,0,c);c.addColorStop(0,b);c.addColorStop(1,h);return c}function p(){var m=93*(f/100),h=f-m,c=91*(f/100),e=88*(f/100),d=85*(f/100);a.save();b.glow&&(a.shadowBlur=h,a.shadowColor=
"rgba(0, 0, 0, 0.5)");a.beginPath();a.arc(0,0,m,0,2*Math.PI,!0);a.fillStyle=g("#ddd","#aaa",m);a.fill();a.restore();a.beginPath();a.arc(0,0,c,0,2*Math.PI,!0);a.fillStyle=g("#fafafa","#ccc",c);a.fill();a.beginPath();a.arc(0,0,e,0,2*Math.PI,!0);a.fillStyle=g("#eee","#f0f0f0",e);a.fill();a.beginPath();a.arc(0,0,d,0,2*Math.PI,!0);a.fillStyle=b.colors.plate;a.fill();a.save()}function w(a){var h=!1;a=0===b.majorTicksFormat.dec?Math.round(a).toString():a.toFixed(b.majorTicksFormat.dec);return 1<b.majorTicksFormat["int"]?
(h=-1<a.indexOf("."),-1<a.indexOf("-")?"-"+(b.majorTicksFormat["int"]+b.majorTicksFormat.dec+2+(h?1:0)-a.length)+a.replace("-",""):""+(b.majorTicksFormat["int"]+b.majorTicksFormat.dec+1+(h?1:0)-a.length)+a):a}function d(){var m=81*(f/100);a.lineWidth=2;a.strokeStyle=b.colors.majorTicks;a.save();if(0===b.majorTicks.length){for(var h=(b.maxValue-b.minValue)/5,c=0;5>c;c++)b.majorTicks.push(w(b.minValue+h*c));b.majorTicks.push(w(b.maxValue))}for(c=0;c<b.majorTicks.length;++c)a.rotate(e(45+c*(270/(b.majorTicks.length-
1)))),a.beginPath(),a.moveTo(0,m),a.lineTo(0,m-15*(f/100)),a.stroke(),a.restore(),a.save();b.strokeTicks&&(a.rotate(e(90)),a.beginPath(),a.arc(0,0,m,e(45),e(315),!1),a.stroke(),a.restore(),a.save())}function J(){var m=81*(f/100);a.lineWidth=1;a.strokeStyle=b.colors.minorTicks;a.save();for(var h=b.minorTicks*(b.majorTicks.length-1),c=0;c<h;++c)a.rotate(e(45+c*(270/h))),a.beginPath(),a.moveTo(0,m),a.lineTo(0,m-7.5*(f/100)),a.stroke(),a.restore(),a.save()}function s(){for(var m=55*(f/100),h=0;h<b.majorTicks.length;++h){var c=
F(m,e(45+h*(270/(b.majorTicks.length-1))));a.font=20*(f/200)+"px Arial";a.fillStyle=b.colors.numbers;a.lineWidth=0;a.textAlign="center";a.fillText(b.majorTicks[h],c.x,c.y+3)}}function x(a){var h=b.valueFormat.dec,c=b.valueFormat["int"];a=parseFloat(a);var f=0>a;a=Math.abs(a);if(0<h){a=a.toFixed(h).toString().split(".");h=0;for(c-=a[0].length;h<c;++h)a[0]="0"+a[0];a=(f?"-":"")+a[0]+"."+a[1]}else{a=Math.round(a).toString();h=0;for(c-=a.length;h<c;++h)a="0"+a;a=(f?"-":"")+a}return a}function F(a,b){var c=
Math.sin(b),f=Math.cos(b);return{x:0*f-a*c,y:0*c+a*f}}function N(){a.save();for(var m=81*(f/100),h=m-15*(f/100),c=0,g=b.highlights.length;c<g;c++){var d=b.highlights[c],r=(b.maxValue-b.minValue)/270,k=e(45+(d.from-b.minValue)/r),r=e(45+(d.to-b.minValue)/r);a.beginPath();a.rotate(e(90));a.arc(0,0,m,k,r,!1);a.restore();a.save();var l=F(h,k),p=F(m,k);a.moveTo(l.x,l.y);a.lineTo(p.x,p.y);var p=F(m,r),n=F(h,r);a.lineTo(p.x,p.y);a.lineTo(n.x,n.y);a.lineTo(l.x,l.y);a.closePath();a.fillStyle=d.color;a.fill();
a.beginPath();a.rotate(e(90));a.arc(0,0,h,k-0.2,r+0.2,!1);a.restore();a.closePath();a.fillStyle=b.colors.plate;a.fill();a.save()}}function K(){var m=12*(f/100),h=8*(f/100),c=77*(f/100),d=20*(f/100),k=4*(f/100),r=2*(f/100),l=function(){a.shadowOffsetX=2;a.shadowOffsetY=2;a.shadowBlur=10;a.shadowColor="rgba(188, 143, 143, 0.45)"};l();a.save();n=0>n?Math.abs(b.minValue-n):0<b.minValue?n-b.minValue:Math.abs(b.minValue)+n;a.rotate(e(45+n/((b.maxValue-b.minValue)/270)));a.beginPath();a.moveTo(-r,-d);a.lineTo(-k,
0);a.lineTo(-1,c);a.lineTo(1,c);a.lineTo(k,0);a.lineTo(r,-d);a.closePath();a.fillStyle=g(b.colors.needle.start,b.colors.needle.end,c-d);a.fill();a.beginPath();a.lineTo(-0.5,c);a.lineTo(-1,c);a.lineTo(-k,0);a.lineTo(-r,-d);a.lineTo(r/2-2,-d);a.closePath();a.fillStyle="rgba(255, 255, 255, 0.2)";a.fill();a.restore();l();a.beginPath();a.arc(0,0,m,0,2*Math.PI,!0);a.fillStyle=g("#f0f0f0","#ccc",m);a.fill();a.restore();a.beginPath();a.arc(0,0,h,0,2*Math.PI,!0);a.fillStyle=g("#e8e8e8","#f5f5f5",h);a.fill()}
function L(){a.save();a.font=40*(f/200)+"px Led";var b=x(y),h=a.measureText("-"+x(0)).width,c=f-33*(f/100),g=0.12*f;a.save();var d=-h/2-0.025*f,e=c-g-0.04*f,h=h+0.05*f,g=g+0.07*f,k=0.025*f;a.beginPath();a.moveTo(d+k,e);a.lineTo(d+h-k,e);a.quadraticCurveTo(d+h,e,d+h,e+k);a.lineTo(d+h,e+g-k);a.quadraticCurveTo(d+h,e+g,d+h-k,e+g);a.lineTo(d+k,e+g);a.quadraticCurveTo(d,e+g,d,e+g-k);a.lineTo(d,e+k);a.quadraticCurveTo(d,e,d+k,e);a.closePath();d=a.createRadialGradient(0,c-0.12*f-0.025*f+(0.12*f+0.045*f)/
2,f/10,0,c-0.12*f-0.025*f+(0.12*f+0.045*f)/2,f/5);d.addColorStop(0,"#888");d.addColorStop(1,"#666");a.strokeStyle=d;a.lineWidth=0.05*f;a.stroke();a.shadowBlur=0.012*f;a.shadowColor="rgba(0, 0, 0, 1)";a.fillStyle="#babab2";a.fill();a.restore();a.shadowOffsetX=0.004*f;a.shadowOffsetY=0.004*f;a.shadowBlur=0.012*f;a.shadowColor="rgba(0, 0, 0, 0.3)";a.fillStyle="#444";a.textAlign="center";a.fillText(b,-0,c);a.restore()}Gauge.Collection.push(this);this.config={renderTo:null,width:200,height:200,title:!1,
maxValue:100,minValue:0,majorTicks:[],minorTicks:10,strokeTicks:!0,units:!1,valueFormat:{"int":3,dec:2},majorTicksFormat:{"int":1,dec:0},glow:!0,animation:{delay:10,duration:250,fn:"cycle"},colors:{plate:"#fff",majorTicks:"#444",minorTicks:"#666",title:"#888",units:"#888",numbers:"#444",needle:{start:"rgba(240, 128, 128, 1)",end:"rgba(255, 160, 122, .9)"}},highlights:[{from:20,to:60,color:"#eee"},{from:60,to:80,color:"#ccc"},{from:80,to:100,color:"#999"}]};var y=0,E=this,n=0,I=0,H=!1;this.setValue=
function(a){n=b.animation?y:a;var d=(b.maxValue-b.minValue)/100;I=a>b.maxValue?b.maxValue+d:a<b.minValue?b.minValue-d:a;y=a;b.animation?k():this.draw();return this};this.setRawValue=function(a){n=y=a;this.draw();return this};this.clear=function(){y=n=I=this.config.minValue;this.draw();return this};this.getValue=function(){return y};this.onready=function(){};l(this.config,b);this.config.minValue=parseFloat(this.config.minValue);this.config.maxValue=parseFloat(this.config.maxValue);b=this.config;n=
y=b.minValue;if(!b.renderTo)throw Error("Canvas element was not specified when creating the Gauge object!");var z=b.renderTo.tagName?b.renderTo:document.getElementById(b.renderTo),a=z.getContext("2d"),A,C,D,t,u,f,B;q();this.updateConfig=function(a){l(this.config,a);q();this.draw();return this};var M={linear:function(a){return a},quad:function(a){return Math.pow(a,2)},quint:function(a){return Math.pow(a,5)},cycle:function(a){return 1-Math.sin(Math.acos(a))},bounce:function(a){a:{a=1-a;for(var b=0,
c=1;;b+=c,c/=2)if(a>=(7-4*b)/11){a=-Math.pow((11-6*b-11*a)/4,2)+Math.pow(c,2);break a}a=void 0}return 1-a},elastic:function(a){a=1-a;return 1-Math.pow(2,10*(a-1))*Math.cos(30*Math.PI/3*a)}},G=null;a.lineCap="round";this.draw=function(){if(!A.i8d){B.clearRect(-t,-u,C,D);B.save();var g={ctx:a};a=B;p();N();J();d();s();b.title&&(a.save(),a.font=24*(f/200)+"px Arial",a.fillStyle=b.colors.title,a.textAlign="center",a.fillText(b.title,0,-f/4.25),a.restore());b.units&&(a.save(),a.font=22*(f/200)+"px Arial",
a.fillStyle=b.colors.units,a.textAlign="center",a.fillText(b.units,0,f/3.25),a.restore());A.i8d=!0;a=g.ctx;delete g.ctx}a.clearRect(-t,-u,C,D);a.save();a.drawImage(A,-t,-u,C,D);if(Gauge.initialized)L(),K(),H||(E.onready&&E.onready(),H=!0);else var e=setInterval(function(){Gauge.initialized&&(clearInterval(e),L(),K(),H||(E.onready&&E.onready(),H=!0))},10);return this}};Gauge.initialized=!1;
(function(){var b=document,l=b.getElementsByTagName("head")[0],q=-1!=navigator.userAgent.toLocaleLowerCase().indexOf("msie"),v="@font-face {font-family: 'Led';src: url('fonts/digital-7-mono."+(q?"eot":"ttf")+"');}",k=b.createElement("style");k.type="text/css";if(q)l.appendChild(k),l=k.styleSheet,l.cssText=v;else{try{k.appendChild(b.createTextNode(v))}catch(e){k.cssText=v}l.appendChild(k);l=k.styleSheet?k.styleSheet:k.sheet||b.styleSheets[b.styleSheets.length-1]}var g=setInterval(function(){if(b.body){clearInterval(g);
var e=b.createElement("div");e.style.fontFamily="Led";e.style.position="absolute";e.style.height=e.style.width=0;e.style.overflow="hidden";e.innerHTML=".";b.body.appendChild(e);setTimeout(function(){Gauge.initialized=!0;e.parentNode.removeChild(e)},250)}},1)})();Gauge.Collection=[];
Gauge.Collection.get=function(b){if("string"==typeof b)for(var l=0,q=this.length;l<q;l++){if((this[l].config.renderTo.tagName?this[l].config.renderTo:document.getElementById(this[l].config.renderTo)).getAttribute("id")==b)return this[l]}else return"number"==typeof b?this[b]:null};function domReady(b){window.addEventListener?window.addEventListener("DOMContentLoaded",b,!1):window.attachEvent("onload",b)}
domReady(function(){function b(b){for(var e=b[0],d=1,g=b.length;d<g;d++)e+=b[d].substr(0,1).toUpperCase()+b[d].substr(1,b[d].length-1);return e}for(var l=document.getElementsByTagName("canvas"),q=0,v=l.length;q<v;q++)if("canv-gauge"==l[q].getAttribute("data-type")){var k=l[q],e={},g,p=parseInt(k.getAttribute("width"),10),w=parseInt(k.getAttribute("height"),10);e.renderTo=k;p&&(e.width=p);w&&(e.height=w);p=0;for(w=k.attributes.length;p<w;p++)if(g=k.attributes.item(p).nodeName,"data-type"!=g&&"data-"==
g.substr(0,5)){var d=g.substr(5,g.length-5).toLowerCase().split("-");if(g=k.getAttribute(g))switch(d[0]){case "colors":d[1]&&(e.colors||(e.colors={}),"needle"==d[1]?(d=g.split(/\s+/),e.colors.needle=d[0]&&d[1]?{start:d[0],end:d[1]}:g):(d.shift(),e.colors[b(d)]=g));break;case "highlights":e.highlights||(e.highlights=[]);g=g.match(/(?:(?:-?\d*\.)?(-?\d+){1,2} ){2}(?:(?:#|0x)?(?:[0-9A-F|a-f]){3,8}|rgba?\(.*?\))/g);for(var d=0,J=g.length;d<J;d++){var s=g[d].replace(/^\s+|\s+$/g,"").split(/\s+/),x={};
s[0]&&""!=s[0]&&(x.from=s[0]);s[1]&&""!=s[1]&&(x.to=s[1]);s[2]&&""!=s[2]&&(x.color=s[2]);e.highlights.push(x)}break;case "animation":d[1]&&(e.animation||(e.animation={}),"fn"==d[1]&&/^\s*function\s*\(/.test(g)&&(g=eval("("+g+")")),e.animation[d[1]]=g);break;default:d=b(d);if("onready"==d)continue;if("majorTicks"==d)g=g.split(/\s+/);else if("strokeTicks"==d||"glow"==d)g="true"==g?!0:!1;else if("valueFormat"==d)if(g=g.split("."),2==g.length)g={"int":parseInt(g[0],10),dec:parseInt(g[1],10)};else continue;
e[d]=g}}e=new Gauge(e);k.getAttribute("data-value")&&e.setRawValue(parseFloat(k.getAttribute("data-value")));k.getAttribute("data-onready")&&(e.onready=function(){eval(this.config.renderTo.getAttribute("data-onready"))});e.draw()}});window.Gauge=Gauge;
<!-- Gauge Code Ends -->
        

		
    </script>
	<script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <body onLoad="javascript:preloader()">

        <script language="javascript" type="text/javascript">
<!-- 
//Browser Support Code
            var graphloopcount = 20;
            var PastResponseText_Relays;

            var int = self.setInterval(function () {
                loop()
            }, 2000);
            function loop() {
                updateRaspberryPiTime();
                updateArduinoTime();
                updateSensorInfo();
                updateRelayInfo();
            }
            var buttonstate=0;
            function updateTank1(element)
                {
                  //buttonstate= 1 - buttonstate;
                  var blabel, bstyle, bcolor;
                  if($('#tank1ValueInput').val() === "1")
                  {
                    blabel="Tank 1 OK";
                    bstyle="green";
                    //bcolor="lightgreen";
                  }
                  else
                  {
                    blabel="Tank 1 Refill";
                    bstyle="red";
                    //bcolor="gray";
                  }
                  var child=element.firstChild;
                  child.style.background=bstyle;
                  //child.style.color=bcolor;
                  child.innerHTML=blabel;
                }
            function updateTank2(element)
                {
                  //buttonstate= 1 - buttonstate;
                  var blabel, bstyle, bcolor;
                  if($('#tank2ValueInput').val() === "1")
                  {
                    blabel="Tank 2 Overflow";
                    bstyle="red";
                    //bcolor="lightgreen";
                  }
                  else
                  {
                    blabel="Tank2 OK";
                    bstyle="green";
                    //bcolor="gray";
                  }
                  var child=element.firstChild;
                  child.style.background=bstyle;
                  //child.style.color=bcolor;
                  child.innerHTML=blabel;
                }
            function updateRaspberryPiTime() {
                var ajaxRequest;  // The variable that makes Ajax possible!

                try {
                    // Opera 8.0+, Firefox, Safari
                    ajaxRequest = new XMLHttpRequest();
                } catch (e) {
                    // Internet Explorer Browsers
                    try {
                        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                            // Something went wrong
                            alert("Your browser broke!");
                            return false;
                        }
                    }
                }
                // Create a function that will receive data sent from the server
                ajaxRequest.onreadystatechange = function () {
                    if (ajaxRequest.readyState == 4) {
                        if (ajaxRequest.responseText != "") {
                            document.getElementById("RaspberryPiTime").innerHTML = ajaxRequest.responseText;
                        }
                    }
                }
                ajaxRequest.open("GET", "updateRaspberryPiTime.php", true);
                ajaxRequest.send(null);

            }

            function updateArduinoTime() {
                var ajaxRequest;  // The variable that makes Ajax possible!

                try {
                    // Opera 8.0+, Firefox, Safari
                    ajaxRequest = new XMLHttpRequest();
                } catch (e) {
                    // Internet Explorer Browsers
                    try {
                        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                            // Something went wrong
                            alert("Your browser broke!");
                            return false;
                        }
                    }
                }
                // Create a function that will receive data sent from the server
                ajaxRequest.onreadystatechange = function () {
                    if (ajaxRequest.readyState == 4) {
                        if (ajaxRequest.responseText != "") {
                            document.getElementById("ArduinoTime").innerHTML = ajaxRequest.responseText;
                        }
                    }
                }
                ajaxRequest.open("GET", "updateArduinoTime.php", true);
                ajaxRequest.send(null);

            }

            function updateSensorInfo() {
                var ajaxRequest;  // The variable that makes Ajax possible!

                try {
                    // Opera 8.0+, Firefox, Safari
                    ajaxRequest = new XMLHttpRequest();
                } catch (e) {
                    // Internet Explorer Browsers
                    try {
                        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                            // Something went wrong
                            alert("Your browser broke!");
                            return false;
                        }
                    }
                }
                // Create a function that will receive data sent from the server
                ajaxRequest.onreadystatechange = function () {
                    if (ajaxRequest.readyState == 4) {
                        if (ajaxRequest.responseText != "") {
                            document.getElementById("sensorInfo").innerHTML = ajaxRequest.responseText;
                            airTempVal = parseFloat($('#tempValueInput').val());
                            waterTemp1TempVal = parseFloat($('#waterTemp1ValueInput').val());
                            ph1Val = parseFloat($('#ph1ValueInput').val());
                            rhVal = parseFloat($('#rhValueInput').val());
                            $( "#tank1Gauge" ).trigger( "click" );
                            $( "#tank2Gauge" ).trigger( "click" );
                        }
                    }
                }
                ajaxRequest.open("GET", "updateSensors.php", true);
                ajaxRequest.send(null);
            }

            function updateRelayInfo() {
                var ajaxRequest;  // The variable that makes Ajax possible!

                try {
                    // Opera 8.0+, Firefox, Safari
                    ajaxRequest = new XMLHttpRequest();
                } catch (e) {
                    // Internet Explorer Browsers
                    try {
                        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                            // Something went wrong
                            alert("Your browser broke!");
                            return false;
                        }
                    }
                }
                // Create a function that will receive data sent from the server
                ajaxRequest.onreadystatechange = function () {
                    if (ajaxRequest.readyState == 4) {
                        if (ajaxRequest.responseText != document.getElementById("relayInfo").innerHTML) {
                            document.getElementById("relayInfo").innerHTML = ajaxRequest.responseText;
                        }
                    }
                }
                ajaxRequest.open("GET", "updateRelays.php", true);
                ajaxRequest.send(null);
            }

            function TurnRelay(number, on_off) {
                var xmlhttp;
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "command.php?command=Relay" + number + " " + on_off, true);
                xmlhttp.send();
            }

            function TurnAuto(number, isAuto) {
                var xmlhttp;
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "command.php?command=Relay" + number + " isAuto " + isAuto, true);
                xmlhttp.send();
            }
//-->
</script>

            <table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="100" colspan="2" align="center" valign="bottom"><br />
                            <img src="img/banner.png" width="280" height="52" />
                            <color class="white">
                                <?php
                                include $_SERVER['DOCUMENT_ROOT'] . '/yieldbuddy2/www/version.php';
                                ?>
                            </color>
                        </td>
                    </tr>
                    <tr>
                        <td height="20" colspan="2" align="center" valign="top">

                            <table width="700" border="0">
                                <tr class="CenterPageTitles">
                                    <td width="104" height="34" align="left" valign="bottom">Overview</td>
                                    <td width="150" valign="bottom"><a href="timers.php">Timers</a></td>
                                    <td width="155" valign="bottom"><a href="graphs.php">Graphs</a></td>
                                    <td width="155" valign="bottom"><a href="graphs_2.php">Graphs2</a></td>
                                    <td width="193" valign="bottom"><a href="setpoints.php">Set Points</a></td>
                                    <td width="163" valign="bottom"><a href="alarms.php">Alarms</a></td>
                                    <td width="150" valign="bottom"><a href="system.php">System</a></td>
                                    <td width="99" align="right" valign="bottom"><a href="logout.php">Log Out</a></td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
    
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <td width="100%" align="center"><div class="cssbox">
                            <table width="100%" border="0" align="center">
                                <tr>
                                    <td width="50%" height="20" align="left" valign="top">
                                        <p id="RaspberryPiTime">  </p>
                                    </td>
                                    <td width="50%" height="20" align="right" valign="top">
                                        <p id="ArduinoTime">  </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="38" colspan="2"><table width="100%" height="44" border="0">
                                            <tr>
                                                <td height="40" align="left" style="text-align: center;vertical-align: middle" valign="top"><p><strong>Sensor Information</strong></p>
                                                    <p id="sensorInfo"></p>
                                                    <canvas id="an_gauge_1" data-title="Air Temp" data-units="Temp. &deg;C" width="150" height="150" data-major-ticks="0 5 10 15 20 25 30 35 40" data-type="canv-gauge" data-min-value="0" data-max-value="40" data-highlights="0 10 #4D89F2, 10 20 #25B8D9, 20 28 #0BB950, 28 35 #cc5, 35 40 #f33" data-onready="setInterval( function() { Gauge.Collection.get('an_gauge_1').setValue(airTempVal);}, 200);"></canvas>
                                                    <canvas id="an_gauge_2" data-title="Water Temp" data-units="Temp. &deg;C" width="150" height="150" data-major-ticks="0 5 10 15 20 25 30 35 40" data-type="canv-gauge" data-min-value="0" data-max-value="40" data-highlights="0 10 #4D89F2, 10 20 #25B8D9, 20 28 #0BB950, 28 35 #cc5, 35 40 #f33" data-onready="setInterval( function() { Gauge.Collection.get('an_gauge_2').setValue(waterTemp1Val);}, 200);"></canvas>
                                                    <canvas id="an_gauge_3" data-title="PH" width="150" height="150"  data-major-ticks="0 1 2 3 4 5 6 7 8 9 10 11 12 13 14" data-type="canv-gauge" data-min-value="0" data-max-value="14" data-highlights="1 4 #f33, 4 5 #cc5, 5 7 #0BB950, 7 8 #cc5, 8 14 #f33" data-onready="setInterval( function() { Gauge.Collection.get('an_gauge_3').setValue(ph1Val);}, 200);"></canvas>
                                                    <canvas id="an_gauge_4" data-title="Humidity" width="150" height="150"  data-major-ticks="0 10 20 30 40 50 60 70 80 90 100" data-type="canv-gauge" data-min-value="0" data-max-value="100" data-highlights="0 20 #f33, 20 30 #25B8D9, 30 60 #0BB950, 60 80 #cc5, 80 100 #f33" data-onready="setInterval( function() { Gauge.Collection.get('an_gauge_4').setValue(rhVal);}, 200);"></canvas>
                                                    <button id="tank1Gauge" class="onoff" onclick="updateTank1(this)"><div style="vertical-align: middle">Tank 1 Refill</div></button>
                                                    <button id="tank2Gauge" class="onoff" onclick="updateTank2(this)"><div style="vertical-align: middle">Tank 2 Overflow</div></button>

                                                </td>
                                                <td align="right" valign="top">        
                                                    <p align="right" id="relayInfo"></p>
                                                </td>
                                            </tr>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td height="2" colspan="2" align="center" valign="top">
                                        <?php
                                        include $_SERVER['DOCUMENT_ROOT'] . '/yieldbuddy2/www/sql/sql_camera_firstrow.php';

                                        if (session_status() == PHP_SESSION_NONE) {
                                            session_start();
                                        }
                                        $camera_address = trim($_SESSION['camera_address']);
                                        ?>
                                        <p><strong>Camera</strong></p>
                                        <iframe src="<?php echo $camera_address; ?>" 
                                                width="640" 
                                                height="360" 
                                                style="border:2px solid orange">
                                        </iframe>

                                    </td>
                                </tr>
                            </table>
                            </table>
                            </body>
                            </html>
