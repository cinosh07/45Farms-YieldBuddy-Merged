<?php
/**
* Web based SQLite management
* @package SQLiteManager
* @version $Id: croatian.inc.php,v 1.30 2006/04/14 15:16:52 freddy78 Exp $ $Revision: 1.30 $
*/
$charset = 'win-1250';//or iso-8859-2
$langSuffix = 'en';
/**
* Fichier d'internationnalisation
*/
$itemTranslated = array(	"Table"		=> "Tablica", 
							"View"		=> "Pogled",
							"Trigger"	=> "Okida�",
							"Function"	=> "Funkcija");

$langueTranslated = array(	1=>"French", 2=>"English", 3=>"Polish", 
							4=>"German", 5=>"Japanese", 6=>"Italian", 
							7=>"Croatian", 8=>"Brazilian portuguese", 9=>"Netherlands", 
							10=>"Spanish", 11=>"Danish", 12=>"Chinese traditional", 
              				13=>"Chinese simplified");

$themeTranslated = array("default"=>"Default",  "PMA"=>"PMA", "jall"=>"JALL", "green"=>"Green");

$TEXT[1]	=	"Po�etak";
$TEXT[2]	=	"Dobrodo�li u <a href=\"http://www.sqlitemanager.org\" target=\"_blank\">SQLiteManager</a> ina�ice";
$TEXT[3]	=	"SQLite ina�ica";
$TEXT[4]	=	"SQLite dokumentacija";
$TEXT[5]	=	"SQL jezik";
$TEXT[6]	=	"SQLite ekstenzija se ne mo�e u�itati.";
$TEXT[7]	=	"Nije mogu�e otvoriti konfiguracijsku bazu SQLitea.<br />Error message";
$TEXT[8]	=	"Konfiguracijsku bazu nije mogu�e mijenjati (nema prava pisanja)!";
$TEXT[9]	=	"Gre�ka";
$TEXT[10]	=	"Funkcija";
$TEXT[11]	=	"Agregacija";
$TEXT[12]	=	"Kona�na funkcija";
$TEXT[13]	=	"Nb argumenti";
$TEXT[14]	=	"Promijeni";
$TEXT[15]	=	"Obri�i";
$TEXT[16]	=	"Svojstva nove funkcije";
$TEXT[17]	=	"Svojstva funkcije";
$TEXT[18]	=	"Gre�ka : Sva polja moraju biti ispunjena.";
$TEXT[19]	=	"Ime";
$TEXT[20]	=	"Tip";
$TEXT[21]	=	"Svojstva koraka";
$TEXT[22]	=	"Kona�na svojstva";
$TEXT[23]	=	"Br. argumenata";
$TEXT[24]	=	"Dodaj ovu funkciju svim bazama.";
$TEXT[25]	=	"Svojstva nove tablice";
$TEXT[26]	=	"Svojstva tablice";
$TEXT[27]	=	"Polje";
$TEXT[28]	=	"Tip";
$TEXT[29]	=	"Duljina";
$TEXT[30]	=	"Null";
$TEXT[31]	=	"Default";
$TEXT[32]	=	"Primarni";
$TEXT[33]	=	"Akcija";
$TEXT[34]	=	"Ozna�i sve";
$TEXT[35]	=	"Odzna�i sve";
$TEXT[36]	=	"Za odabir";
$TEXT[37]	=	"Jeste li sigurni da �elite obrisati ovo polje/ova polja?";
$TEXT[38]	=	"Upravljanje indeksima";
$TEXT[39]	=	"Jeste li sigurni da �elite obrisati ovo polje?";
$TEXT[40]	=	"Da";
$TEXT[41]	=	"Ne";
$TEXT[42]	=	"Primarni";
$TEXT[43]	=	"Dodaj";
$TEXT[44]	=	"polje/a";
$TEXT[45]	=	"Na kraju tablice";
$TEXT[46]	=	"Na po�etku tablice";
$TEXT[47]	=	"Poslije";
$TEXT[48]	=	"Unesite novi zapis";
$TEXT[49]	=	"Promijeni zapis";
$TEXT[50]	=	"Vrijednost";
$TEXT[51]	=	"Snimi";
$TEXT[52]	=	"Unesite podatke iz datoteke.";
$TEXT[53]	=	"Okida�";
$TEXT[54]	=	"Svojstva novog okida�a";
$TEXT[55]	=	"Svojstva okida�a";
$TEXT[56]	=	"Trenutak";
$TEXT[57]	=	"Doga�aj";
$TEXT[58]	=	"Na";
$TEXT[59]	=	"Uvjet";
$TEXT[60]	=	"Korak";
$TEXT[61]	=	"Svojstva";
$TEXT[62]	=	"Svojstva novog pogleda";
$TEXT[63]	=	"Svojstva pogleda";
$TEXT[64]	=	"Upit nije izvr�en!";
$TEXT[65]	=	"Resurs kod spajanja nije ispravan!";
$TEXT[66]	=	"Izvr�i jedan ili vi�e <strong>zahtjeva</strong>!";
$TEXT[67]	=	"<em>Ili</em> iz sql datoteke";
$TEXT[68]	=	"Format upita: Standard (sqlite)";
$TEXT[69]	=	"Izvr�i";
$TEXT[70]	=	"Upit je izvr�en.";
$TEXT[71]	=	"Red je promijenjen.";
$TEXT[72]	=	"Struktura";
$TEXT[73]	=	"Prikaz";
$TEXT[74]	=	"SQL";
$TEXT[75]	=	"Unesi";
$TEXT[76]	=	"Izvezi";
$TEXT[77]	=	"Isprazni";
$TEXT[78]	=	"Da li stvarno �elite eliminirati ovu funkciju?";
$TEXT[79]	=	"Da li stvarno �elite isprazniti ovu tablicu?";
$TEXT[80]	=	"Da li stvarno �elite obrisati ovu tablicu?";
$TEXT[81]	=	"Dodaj";
$TEXT[82]	=	"Da li stvarno �elite obrisati ovaj pogled?";
$TEXT[83]	=	"Da li stvarno �elite obrisati ovaj okida�?";
$TEXT[84]	=	"Opcije";
$TEXT[85]	=	"Jeste li sigurni da �elite obrisati ovu bazu? Ovo nije brisanje u pravom smislu jer �e baza biti ukinuta, ali ne i uni�tena.";
$TEXT[86]	=	"Obri�i";
$TEXT[87]	=	"Dodaj novi pogled";
$TEXT[88]	=	"Dodaj novi okida�";
$TEXT[89]	=	"Dodaj novu funkciju";
$TEXT[90]	=	"SQL upit";
$TEXT[91]	=	"Ime klju�a";
$TEXT[92]	=	"Da li stvarno �elite obrisati ovaj indeks?";
$TEXT[93]	=	"Dodaj indeks na ";
$TEXT[94]	=	"stupac/stupce";
$TEXT[95]	=	"Zanemari";
$TEXT[96]	=	"Dodaj na klju�";
$TEXT[97]	=	"Stvori pogled s imenom ";
$TEXT[98]	=	"iz ovog upita.";
$TEXT[99]	=	"Retci s gre�kom";
$TEXT[100]	=	"Zacijelo je problem u nemogu�nosti promjene konfiguracijske baze (nema prava pisanja)";
$TEXT[101]	=	"Nije mogu�e stvoriti ili �itati ovu bazu!";
$TEXT[102]	=	"Sva polja moraju biti popunjena!";
$TEXT[103]	=	"Dodaj novu bazu";
$TEXT[104]	=	"Putanja";
$TEXT[105]	=	"<em>Array</em> s podacima nema stalni broj elemenata.";
$TEXT[106]	=	"Parametar konstruktora klase 'Grid' mora biti <em>array</em>";
$TEXT[107]	=	"<em>Array</em> za poravnanje stupaca ne sadr�i potreban broj elemenata.";
$TEXT[108]	=	"Poravnanje �elija mora biti: 'left', 'right' ili 'center'";
$TEXT[109]	=	"Parametar za poravnanje stupaca mora biti <em>array</em>.";
$TEXT[110]	=	"Parametar za format stupaca mora biti <em>array</em>.";
$TEXT[111]	=	"<em>Array</em> za sortiranje stupaca nema potreban broj elemenata.";
$TEXT[112]	=	"Parametar za sortiranje mora biti 0=ne sortiraj, ili 1=sortiraj.";
$TEXT[113]	=	"Parametar za sortiranje stupaca mora biti <em>array</em>.";
$TEXT[114]	=	"Niz za formatiranje stupca izra�una je prazan.";
$TEXT[115]	=	"Naslov je obavezan za stupac izra�una.";
$TEXT[116]	=	"Parametar konstruktora klase 'ArrayToGrid' mora biti <em>array</em>.";
$TEXT[117]	=	"Nije mogu�e prebrojiti broj zapisa";
$TEXT[118]	=	"Br. zapisa";
$TEXT[119]	=	"Unesi";
$TEXT[120]	=	"Jeste li sigurni da �elite obrisati";
$TEXT[121]	=	"";
$TEXT[122]	=	"";
$TEXT[123]	=	"Jeste li sigurni da �elite isprazniti ovu tablicu";
$TEXT[124]	=	"Samo struktura";
$TEXT[125]	=	"Struktura i podaci";
$TEXT[126]	=	"Samo podaci";
$TEXT[127]	=	"Potpuni unosi";
$TEXT[128]	=	"Po�alji";
$TEXT[129]	=	"Server";
$TEXT[130]	=	"Kreirano";
$TEXT[131]	=	"Baza";
$TEXT[132]	=	"Struktura tablice za tablicu ";
$TEXT[133]	=	"Istovar podataka za tablicu ";
$TEXT[134]	=	"Struktura pogleda za pogled ";
$TEXT[135]	=	"Svojstva korisni�ki definiranih funkcija";
$TEXT[136]	=	"Zapisi";
$TEXT[137]	=	"Datoteka";
$TEXT[138]	=	"Zamijeni sadr�aj";
$TEXT[139]	=	"Separator";
$TEXT[140]	=	"Unos podataka iz tekstualne datoteke";
$TEXT[141]	=	"Jezik";
$TEXT[142]	=	"Tema";
$TEXT[143]	=	"Upload baze";
$TEXT[144]	=	"Mapa za upload nije dostupna.<br />(Promijenite konstantu 'DEFAULT_DB_PATH' u datoteci 'include/user_defined.inc.php')";
$TEXT[145]	=	"Objasni SQL";
$TEXT[146]	=	"Upravljanje bazama";
$TEXT[147]	=	"You are not allowed to acces here.You must enter valid login and password.";
$TEXT[148]	=	"This login is not valid.";
$TEXT[149]	=	"This password don't correspond with thie login.";
$TEXT[150]	=	"PHP ina�ica";
$TEXT[151] = 	"After save";
$TEXT[152] = 	"Go back to previous page";
$TEXT[153] = 	"Insert another new row";
$TEXT[154] = 	"The configuration database is in read only.<br>Some feature of SQLiteManager can't work correctly.";
$TEXT[155] = 	"This database is in read only.";
$TEXT[156] = 	"Privileges"; 
$TEXT[157] = 	"Change password"; 
$TEXT[158] = 	"Logoff"; 
$TEXT[159] = 	"Add user"; 
$TEXT[160] = 	"Add groupe"; 
$TEXT[161] = 	"User overview"; 
$TEXT[162] = 	"Groupes overview"; 
$TEXT[163] = 	"Name"; 
$TEXT[164] = 	"Login"; 
$TEXT[165] = 	"Groupe"; 
$TEXT[166] = 	"execSQL"; 
$TEXT[167] = 	"data"; 
$TEXT[168] = 	"export"; 
$TEXT[169] = 	"empty"; 
$TEXT[170] = 	"del"; 
$TEXT[171] = 	"Incorrect old password."; 
$TEXT[172] = 	"Password and confirmation are differente."; 
$TEXT[173] = 	"The password have been changed"; 
$TEXT[174] = 	"Clic here for re-logon"; 
$TEXT[175] = 	"Old :"; 
$TEXT[176] = 	"New :"; 
$TEXT[177] = 	"Confirm :"; 
$TEXT[178] = 	"Information"; 
$TEXT[179] = 	"Location :"; 
$TEXT[180] = 	"Size :"; 
$TEXT[181] = 	"Rights :"; 
$TEXT[182] = 	"Last modified :"; 
$TEXT[183] = 	"Integrity Check"; 
$TEXT[184] = 	"Vacuum"; 
$TEXT[185] = 	"Default synchronous :"; 
$TEXT[186] = 	"Default cache_size :"; 
$TEXT[187] = 	"OFF "; 
$TEXT[188] = 	"NORMAL "; 
$TEXT[189] = 	"FULL "; 
$TEXT[190]	= 	"Access control management"; 
$TEXT[191]	= 	"Yes"; 
$TEXT[192]	= 	"No"; 
$TEXT[193]	= 	"Default Temporary Storage"; 
$TEXT[194]	= 	"DEFAULT"; 
$TEXT[195]	= 	"MEMORY"; 
$TEXT[196]	= 	"FILE"; 
$TEXT[197]	= 	"Unique"; 
$TEXT[198]	= 	"Indeks"; 
$TEXT[199]	= 	"Data";
$TEXT[200]	= 	"Apply";
$TEXT[201]	=	"Selection";
$TEXT[202]	=	"Operator";
$TEXT[203]	=	"additional condition :";
$TEXT[204]	=	"AND";
$TEXT[205]	=	"OR";
$TEXT[206]	=	"Select";
$TEXT[207]	=	"Search";
$TEXT[208]	=	"Rename";
$TEXT[209]	=	"Move";
$TEXT[210]	=	"Copy";
$TEXT[211]	=	"Plugins";
$TEXT[212]	=	"Maintenance";
$TEXT[213]	=	"Query time :";
$TEXT[214]	=	"msec.";
$TEXT[215]	=	"Rename table to :";
$TEXT[216]	=	"Move table to (database.table) :";
$TEXT[217]	=	"Copy table to (database.table) :";
$TEXT[218]	=	"Add DROP TABLE";
$TEXT[219]	=	"Save as New Row";
$TEXT[220]	=	"Save";
$TEXT[221]	=	"Save Type";
$TEXT[222]  =   "Operation";
$TEXT[223]  =   "Update";
$TEXT[224]  =   "Tip : You can use internal PHP functions in your queries !";
$TEXT[225]  =   "Truncated text";
$TEXT[226]  =   "Full text";
$TEXT[227]  =   "-- select --";
$TEXT[228]  =   "(s)";
$TEXT[229]  =   "Version";
$TEXT[230]  =   "(new database)";
$TEXT[231]  =   "Official SQliteManager Homepage";
$TEXT[232]  =   "The database can't be attain";
$TEXT[233]  =   "Trigger structure";
?>