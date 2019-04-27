<?php

namespace App\Fusebox\Reader;

class ESMRReader implements ReaderInterface
{
    const TELEGRAM_LINE_LENGTH = 24;

    private $baudrate;

    public function __construct(BaudrateInterface $baudrate)
    {
        $this->baudrate = $baudrate;
    }
    
    /**
     * Reads a single telegram from a device
     *
     * @param string $devicePath
     *
     * @return array
     */
    public function read(string $devicePath) : array
    {
        $this->baudrate->setValue($devicePath, 115200);

        $contents = [];
        $handle = fopen($devicePath, 'r');

        $i = 0;
        while ($i <= self::TELEGRAM_LINE_LENGTH && ($line = fgets($handle)) !== false) {
            // Skip blank lines
            if (empty(trim($line))) {
                continue;
            }

            $contents[] = $line;

            $i++;
        }

        fclose($handle);

        return $contents;
    }
}