<?php

$kasutaja='Mark21';//Mark21 / d113377_markul
$server='localhost';//localhost / d113377.mysql.zonevs.eu
$andmebaas='mark_andmed';//mark_andmed / d113377_baasmark
$salasyna='12345';//12345 / sieugfh0912
$baas=new mysqli($server,$kasutaja,$salasyna,$andmebaas);
$baas->set_charset('UTF8');
//CREATE TABLE lilled(
//    id int PRIMARY KEY AUTO_INCREMENT,
//	nimi varchar(30),
//    hind float,
//    varv varchar(30)
//)
?>