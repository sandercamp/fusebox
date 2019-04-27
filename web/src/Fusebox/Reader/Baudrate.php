<?php

namespace App\Fusebox\Reader;

class Baudrate implements BaudrateInterface 
{
    public function getValue()
    {
        //(shell_exec('stty -F /dev/ttyUSB0'));
    }

    public function setValue(int $baudrate)
    {
        shell_exec(sprintf('stty -F /dev/ttyUSB0 %d', $baudrate));

        $this->getValue();
    }
}