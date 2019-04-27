<?php

namespace App\Fusebox\Reader;

class Baudrate implements BaudrateInterface 
{
    public function getValue()
    {
        //(shell_exec('stty -F /dev/ttyUSB0'));
    }

    /**
     * Set the baudrate for a device
     */
    public function setValue(string $devicePath, int $baudrate)
    {
        shell_exec(sprintf('stty -F %s %d', $devicePath, $baudrate));
    }
}