<?php

namespace App\Fusebox;

use App\Fusebox\Parser\ParserInterface;
use App\Fusebox\Reader\ReaderInterface;

class MessageCollector 
{
    private $parser;
    private $reader;

    public function __construct(ParserInterface $parser, ReaderInterface $reader)
    {
        $this->parser = $parser;
        $this->reader = $reader;
    }

    public function getSingleMessage(string $devicePath)
    {
        return $this->parser->parse($this->reader->read($devicePath));
    }
}