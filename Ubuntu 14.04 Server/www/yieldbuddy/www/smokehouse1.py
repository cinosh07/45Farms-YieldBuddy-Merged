#!/usr/bin/env python

import sqlite3
import sys
import cgi
import cgitb


# global variables

dbname='/var/www/greenhouse/greenhouse_main.db'



# print the HTTP header
def printHTTPheader():
    print "Content-type: text/html\n\n"


# print the HTML head section
# arguments are the page title and the table for the chart
def printHTMLHead(title, table_temp, table_humidity, table_water, table_light):
    print "<head>"
    print "    <title>"
    print title
    print "    </title>"
    print_graph_script_temp(table_temp)
    print_graph_script_humidity(table_humidity)
    print_graph_script_water(table_water)
    print_graph_script_light(table_light)
    print "</head>"


# get data from the database
# if an interval is passed, 
# return a list of records from the database
def get_data_temp(interval):

    conn=sqlite3.connect(dbname)
    curs=conn.cursor()

    if interval == None:
        curs.execute("SELECT timestamp, temp0, tempDHT, tempDHT1 FROM readings")
    else:
        curs.execute("SELECT timestamp, temp0, tempDHT, tempDHT1 FROM readings WHERE timestamp>datetime('now','localtime','-%s hours')" % interval)

    rows=curs.fetchall()

    conn.close()

    return rows
   
def get_data_humidity(interval):

    conn=sqlite3.connect(dbname)
    curs=conn.cursor()

    if interval == None:
        curs.execute("SELECT timestamp, humidityDHT, humidityDHT1 FROM readings")
    else:
        curs.execute("SELECT timestamp, humidityDHT, humidityDHT1 FROM readings WHERE timestamp>datetime('now','localtime','-%s hours')" % interval)

    rows=curs.fetchall()

    conn.close()

    return rows   
    	
def get_data_water(interval):

    conn=sqlite3.connect(dbname)
    curs=conn.cursor()
	
    if interval == None:
	curs.execute("SELECT timestamp, echo0, echo1, echo2, echo3, total_water FROM readings")
    else:
        curs.execute("SELECT timestamp, echo0, echo1, echo2, echo3, total_water FROM readings WHERE timestamp>datetime('now','localtime','-%s hours')" % interval)

    rows=curs.fetchall()

    conn.close()

    return rows

def get_data_light(interval):

    conn=sqlite3.connect(dbname)
    curs=conn.cursor()

    if interval == None:
        curs.execute("SELECT timestamp, lightOUT FROM readings")
    else:
        curs.execute("SELECT timestamp, lightOUT FROM readings WHERE timestamp>datetime('now','localtime','-%s hours')" % interval)

    rows=curs.fetchall()

    conn.close()

    return rows

    
# convert rows from database into a javascript table		
def create_table_temp(rows):
    chart_table_temp=""

    for row in rows[:-1]:
        rowstr="['{0}', {1}, {2}, {3}],\n".format(str(row[0]),str(row[1]),str(row[2]),str(row[3]))
	chart_table_temp+=rowstr

    row=rows[-1]
    rowstr="['{0}', {1}, {2}, {3}]\n".format(str(row[0]),str(row[1]),str(row[2]),str(row[3]))
    chart_table_temp+=rowstr

    return chart_table_temp
 
def create_table_humidity(rows):
    chart_table_humidity=""

    for row in rows[:-1]:
        rowstr="['{0}', {1}, {2}],\n".format(str(row[0]),str(row[1]),str(row[2]))
	chart_table_humidity+=rowstr

    row=rows[-1]
    rowstr="['{0}', {1}, {2}]\n".format(str(row[0]),str(row[1]),str(row[2]))
    chart_table_humidity+=rowstr

    return chart_table_humidity    
 
def create_table_water(rows):
    chart_table_water=""
	
    for row in rows[:-1]:

	rowstr="['{0}', {1}, {2}, {3}, {4}, {5}],\n".format(str(row[0]),str(row[1]),str(row[2]),str(row[3]),str(row[4]),str(row[5]))
   	chart_table_water+=rowstr

    row=rows[-1]
    rowstr="['{0}', {1}, {2}, {3}, {4}, {5}]\n".format(str(row[0]),str(row[1]),str(row[2]),str(row[3]),str(row[4]),str(row[5]))
    chart_table_water+=rowstr

    return chart_table_water
	 
def create_table_light(rows):
    chart_table_light=""

    for row in rows[:-1]:
        rowstr="['{0}', {1}],\n".format(str(row[0]),str(row[1]))
        chart_table_light+=rowstr

    row=rows[-1]
    rowstr="['{0}', {1}]\n".format(str(row[0]),str(row[1]))
    chart_table_light+=rowstr

    return chart_table_light

    
# print the javascript to generate the chart
# pass the table generated from the database info   
    
def print_graph_script_temp(table_temp):

    # google chart snippet
    chart_code="""
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time','Inside','Outside','Smoker'],
%s
        ]);

         var options = {
           title: 'Temperature',
	   colors: ["#6633FF", "#FF5353", "#66FF00"],
	   curveType: 'function',
	   backgroundColor: '#DEB19E',
	 };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div_temp'));
        chart.draw(data, options);
      }
    </script>"""

    print chart_code % (table_temp)
  
def print_graph_script_humidity(table_humidity):

    # google chart snippet
    chart_code="""
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time','Outside','Smoker'],
%s
        ]);

         var options = {
           title: 'Humidity',
	   colors: ["#FF5353", "#66FF00"],
	   curveType: 'function',
	   backgroundColor: '#DEB19E',
	 };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div_humidity'));
        chart.draw(data, options);
      }
    </script>"""

    print chart_code % (table_humidity)
  
def print_graph_script_water(table_water):

    # google chart snippet
    chart_code="""
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time','Tank 1','Tank 2','Tank 3','Tank 4','Total (L)'],
%s
        ]);

        var options = {
          title: 'Water Logs',
	  curveType: 'function',
	  backgroundColor: '#DEB19E',
	  colors: ["red", "#36F200", "black","#CCFF00","blue"],
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div_water'));
        chart.draw(data, options);
      }
    </script>"""

    print chart_code % (table_water)
	
def print_graph_script_light(table_light):

    # google chart snippet
    chart_code="""
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time','Outside'],
%s
        ]);

        var options = {
          title: 'Light Intensity Logs (Lux)',
	  curveType: 'function',
	  backgroundColor: '#DEB19E',
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div_light'));
        chart.draw(data, options);
      }
    </script>"""

    print chart_code % (table_light)

# print the div that contains the graph
    
def show_graph_temp():
    print "<h2>Temperature</h2>"
    print '<div id="chart_div_temp" style="width: 1350px; height: 500px;"></div>'	
  
def show_graph_humidity():
    print "<h2>Humidity</h2>"
    print '<div id="chart_div_humidity" style="width: 1350px; height: 500px;"></div>'  
   
def show_graph_water():
    print "<h2>Water Collection Logs</h2>"
    print '<div id="chart_div_water" style="width: 1350px; height: 500px;"></div>'	
  
def show_graph_light():
    print "<h2>Light Intensity Logs</h2>"
    print '<div id="chart_div_light" style="width: 1350px; height: 500px;"></div>'

# connect to the db and show some stats
# argument option is the number of hours
def show_stats(option):

    conn=sqlite3.connect(dbname)
    curs=conn.cursor()

    if option is None:
        option = str(24)

    curs.execute("SELECT timestamp,max(temp0) FROM readings WHERE timestamp>datetime('now','localtime','-%s hour') AND timestamp<=datetime('now','localtime')" % option)
#    curs.execute("SELECT timestamp,max(temp) FROM temps WHERE timestamp>datetime('2013-09-19 21:30:02','-%s hour') AND timestamp<=datetime('2013-09-19 21:31:02')" % option)
    rowmax=curs.fetchone()
    rowstrmax="{0}&nbsp&nbsp&nbsp{1}C".format(str(rowmax[0]),str(rowmax[1]))

    curs.execute("SELECT timestamp,min(temp0) FROM readings WHERE timestamp>datetime('now','localtime','-%s hour') AND timestamp<=datetime('now','localtime')" % option)
#    curs.execute("SELECT timestamp,min(temp) FROM temps WHERE timestamp>datetime('2013-09-19 21:30:02','-%s hour') AND timestamp<=datetime('2013-09-19 21:31:02')" % option)
    rowmin=curs.fetchone()
    rowstrmin="{0}&nbsp&nbsp&nbsp{1}C".format(str(rowmin[0]),str(rowmin[1]))

    curs.execute("SELECT avg(temp0) FROM readings WHERE timestamp>datetime('now','localtime','-%s hour') AND timestamp<=datetime('now','localtime')" % option)
#    curs.execute("SELECT avg(temp) FROM temps WHERE timestamp>datetime('2013-09-19 21:30:02','-%s hour') AND timestamp<=datetime('2013-09-19 21:31:02')" % option)
    rowavg=curs.fetchone()


    print "<hr>"


    print "<h2>Min Temp&nbsp</h2>"
    print rowstrmin
    print "<h2>Max Temp</h2>"
    print rowstrmax
    print "<h2>Avg Temp</h2>"
    print "%.3f" % rowavg+"C"

    print "<hr>"

    print "<h2>In the last hour:</h2>"
    print "<table>"
    print "<tr><td><strong>Date/Time</strong></td><td><strong>Temperature</strong></td></tr>"

    rows=curs.execute("SELECT timestamp,temp0,echo0,echo1,echo2,tempDHT,humidityDHT,echo3,lightOUT FROM readings WHERE timestamp>datetime('now','localtime','-1 hour') AND timestamp<=datetime('now','localtime')")
#    rows=curs.execute("SELECT * FROM temps WHERE timestamp>datetime('2013-09-19 21:30:02','-1 hour') AND timestamp<=datetime('2013-09-19 21:31:02')")
    for row in rows:
        rowstr="<tr><td>{0}&emsp;&emsp;</td><td>{1}C</td></tr>".format(str(row[0]),str(row[1]))
        print rowstr
    print "</table>"

    print "<hr>"

    conn.close()

def print_time_selector(option):

    print """<form action="/cgi-bin/smokehouse1.py" method="POST">
        Show the Parameter logs for  
        <select name="timeinterval">"""


    if option is not None:

	if option == "0.5":
            print "<option value=\"0.5\" selected=\"selected\">the last 30 minutes</option>"
        else:
            print "<option value=\"0.5\">the last 30 minutes</option>"       

	if option == "1":
            print "<option value=\"1\" selected=\"selected\">the last 1 hours</option>"
        else:
            print "<option value=\"1\">the last 1 hours</option>"

	if option == "2":
	    print "<option value=\"2\" selected=\"selected\">the last 2 hours</option>"
	else:
	    print "<option value=\"2\">the last 2 hours</option>"

	if option == "4":
            print "<option value=\"4\" selected=\"selected\">the last 4 hours</option>"
        else:
            print "<option value=\"4\">the last 4 hours</option>"

        if option == "6":
            print "<option value=\"6\" selected=\"selected\">the last 6 hours</option>"
        else:
            print "<option value=\"6\">the last 6 hours</option>"
       
	if option == "8":
            print "<option value=\"8\" selected=\"selected\">the last 8 hours</option>"
        else:
            print "<option value=\"8\">the last 8 hours</option>"

        if option == "12":
            print "<option value=\"12\" selected=\"selected\">the last 12 hours</option>"
        else:
            print "<option value=\"12\">the last 12 hours</option>"

        if option == "24":
            print "<option value=\"24\" selected=\"selected\">the last 24 hours</option>"
        else:
            print "<option value=\"24\">the last 24 hours</option>"

	if option == "48":
            print "<option value=\"48\" selected=\"selected\">the last 48 hours</option>"
        else:
            print "<option value=\"48\">the last 48 hours</option>"

	if option == "72":
            print "<option value=\"72\" selected=\"selected\">the last 3 days</option>"
        else:
            print "<option value=\"72\">the last 3 days</option>"

	if option == "168":
            print "<option value=\"168\" selected=\"selected\">the last 7 days</option>"
        else:
            print "<option value=\"168\">the last 7 days</option>"

	if option == "336":
            print "<option value=\"336\" selected=\"selected\">the last 14 days</option>"
        else:
            print "<option value=\"336\">the last 14 days</option>"

	if option == "720":
            print "<option value=\"720\" selected=\"selected\">the last 30 days</option>"
        else:
            print "<option value=\"720\">the last 30 days</option>"
	
	if option == "8760":
            print "<option value=\"8760\" selected=\"selected\">the last 365 days</option>"
        else:
            print "<option value=\"8760\">the last 365 days</option>"


    else:
        print """<option value="0.5">the last 30 minutes</option>
		<option value="1">the last 1 hours</option>
		<option value="2">the last 2 hours</option>
		<option value="4">the last 4 hours</option>
		<option value="6">the last 6 hours</option>
                <option value="8">the last 8 hours</option>
		<option value="12">the last 12 hours</option>
		<option value="24">the last 24 hours</option>
		<option value="48">the last 48 hours</option>
		<option value="72">the last 3 days</option>
		<option value="168">the last 7 days</option>
		<option value="336">the last 14 days</option>
		<option value="720">the last 30 days</option>		
		 <option value="8760" selected="selected">the last 365 days</option>"""
    print """        </select>
        <input type="submit" value="Display">
    </form>"""

# check that the option is valid
# and not an SQL injection
def validate_input(option_str):
    # check that the option string represents a number
    if option_str.isalnum():
        # check that the option is within a specific range
        if int(option_str) >= 0.5 and int(option_str) <= 8760:
            return option_str
        else:
            return None
    else: 
        return None

#return the option passed to the script
def get_option():
    form=cgi.FieldStorage()
    if "timeinterval" in form:
        option = form["timeinterval"].value
        return validate_input (option)
    else:
        return None




# main function
# This is where the program starts 
def main():

    cgitb.enable()

    # get options that may have been passed to this script
    option=get_option()

    if option is None:
        option = str(24)

    # get data from the database

    records_temp=get_data_temp(option)
    records_humidity=get_data_humidity(option)
    records_water=get_data_water(option)
    records_light=get_data_light(option)

    # print the HTTP header
    printHTTPheader()

    if len(records_temp) != 0:
        # convert the data into a table
        table_temp=create_table_temp(records_temp)
    else:
        print "No data found"
        return
        
    if len(records_humidity) != 0:
        # convert the data into a table
        table_humidity=create_table_humidity(records_humidity)
    else:
        print "No data found"
        return   
		
    if len(records_water) != 0:
 	# convert the water data into table_water
	table_water=create_table_water(records_water)
    else:
	print "No WATER DATA found"
	return

    if len(records_light) != 0:
        # convert the water data into table_water
        table_light=create_table_light(records_light)
    else:
        print "No LIGHT DATA found"
        return

		
		
    # start printing the page
    print "<html>"
    # print the head section including the table
    # used by the javascript for the chart
    printHTMLHead("Meat Smoker Log", table_temp, table_humidity, table_water, table_light)

    # print the page body
    print "<body>"
    print "<h1>Meat Smoker Log</h1>"
    print "<hr>"
    print_time_selector(option)
    show_graph_temp()
    show_graph_humidity()
    show_graph_water()
    show_graph_light()
   # show_stats(option)
    print "</body>"
    print "</html>"

    sys.stdout.flush()

if __name__=="__main__":
    main()




