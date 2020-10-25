<?php

/* Odje definisiemo sve vazne pojmove pomocu funkcije define pojmove vezane za bazu podataka dakle njeno ime,sifru,host,user
ovo se radi da ako bi kasnije zeljeli promijeniti neki pojam samo to uradimo na jedno mjesto i to upravo odje 
definisemo i korijen aplikacije jer nam mozda tokom izrade sajta bude potreban kao i urlroot tj korijen url preko kojeg cemo 
lakse dostupati do nekih djelova sajta ( ne moramo stalno da kucamo putanju do njih) sad idemo u Core 
*/

    //Podaci o bazi podataka
    define('DB_HOST', 'localhost'); 
    define('DB_USER', 'root'); 
    define('DB_PASS', '');
    define('DB_NAME', 'mvcinternetdatabase');

    //Korijen aplikacije
    define('APPROOT', dirname(dirname(__FILE__)));

    //url korijen
    define('URLROOT', 'http://localhost/mvcinternet');
    

    //ime sajta
    define('SITENAME', 'MVC Project ');
