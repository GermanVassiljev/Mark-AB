<?php

$kasutaja='Mark21';//Mark21
$server='localhost';//d113377.mysql.zonevs.eu
$andmebaas='Mark_andmed';//d113377_markul
$salasyna='12345';//sieugfh0912
$baas=new mysqli($server,$kasutaja,$salasyna,$andmebaas);
$baas->set_charset('UTF8');
//CREATE TABLE lilled(
//    id int PRIMARY KEY AUTO_INCREMENT,
//	nimi varchar(30),
//    hind float,
//    varv varchar(30)
//)
?>