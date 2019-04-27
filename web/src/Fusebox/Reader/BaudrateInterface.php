<?php

namespace App\Fusebox\Reader;

interface BaudrateInterface 
{

    public function getValue();

    public function setValue(string $devicePath, int $baudrate);
}