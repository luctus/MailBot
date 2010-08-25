<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$lenguage = 'es_ES.UTF-8';
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage);

$word_utf8 = "DETALLE DE LA PROGRAMACIÃ³N";
//$word_utf8 = "BÃ¡sico";
$word_utf8 = "ACUÃ‘A";
//$word_latin = iconv("UTF-8", "ISO-8859-1", $word_utf8);
//$word_encode = utf8_encode($word_utf8);
//$word_encode_latin = iconv("UTF-8", "ISO-8859-1", $word_encode);
$word_decode = utf8_decode($word_utf8);
$word_decode_latin = iconv("UTF-8", "ISO-8859-1", $word_decode);
//print $word_utf8;
//print " ";
//print $word_latin;
//print " ";
//print $word_encode;
//print " ";
//print $word_encode_latin;
//print " ";
//print $word_decode;
//print " ";
//print $word_decode_latin;

$word_latin = 'ACUÑA';
//$word_latin = "Programación";
//$word_latin = "PROGRAMACIÓN";
//$word_utf8 = iconv("ISO-8859-1", "UTF-8", $word_latin);
//$word_encode = utf8_encode($word_latin);
//$word_encode_utf8 = iconv("ISO-8859-1", "UTF-8", $word_encode);
//$word_decode = utf8_decode($word_latin);
//$word_decode_utf8 = iconv("ISO-8859-1", "UTF-8", $word_decode);
////
print $word_latin;
//print " ";
//print $word_utf8;
//print " ";
//print $word_encode;
//print " ";
//print $word_encode_utf8;
//print " ";
//print $word_decode;
//print " ";
//print $word_decode_utf8;
