<?php
require 'vendor/autoload.php';

use Fusebox\Parser\ESMRParser;
use Fusebox\Reader\ESMRReader;

$parser = new ESMRParser();

$telegram = $parser->parse((new ESMRReader())->read('/dev/ttyUSB0'));

echo '<pre>' , var_dump($telegram) , '</pre>';

