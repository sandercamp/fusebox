<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Fusebox\MessageCollector;

class MessageController extends Controller
{
    private $messageCollector;

    public function __construct(MessageCollector $messageCollector)
    {
        $this->messageCollector = $messageCollector;
    }

    public function index()
    {
        return $this->render('message/index.html.twig');
    }

    public function message()
    {
        return JsonResponse::fromJsonString(
            json_encode($this->messageCollector->getSingleMessage('/dev/ttyUSB0'))
        );
    }
}