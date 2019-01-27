<?php

include 'Reader/ESMRReader.php'; 
include 'Parser/ESMRParser.php';

$parser = new ESMRParser();

$telegram = $parser->parse((new ESMRReader())->read('/dev/ttyUSB0'));

echo '<pre>' , var_dump($telegram) , '</pre>';

