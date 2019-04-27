<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Fusebox\Parser\ESMRParser;
use App\Fusebox\Reader\ESMRReader;
use App\Fusebox\Reader\Baudrate;

class MessageController extends Controller
{
    public function index()
    {
        $parser = new ESMRParser();
        $telegram = $parser->parse((new ESMRReader(new Baudrate()))->read('/dev/ttyUSB0'));

        return $this->render('message/index.html.twig');
    }

    public function message()
    {
        $parser = new ESMRParser();
        $telegram = $parser->parse((new ESMRReader(new Baudrate()))->read('/dev/ttyUSB0'));

        return JsonResponse::fromJsonString(json_encode($telegram));
    }
}