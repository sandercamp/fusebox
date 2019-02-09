<?php

namespace Fusebox\Reader;

class ESMRReader implements ReaderInterface
{
    const MESSAGE_LINES = 24;

    private $rawContents = [];


    public function read(string $filePath)
    {
        $handle = fopen($filePath, 'r');

        $i = 0;
        while ($i <= self::MESSAGE_LINES && ($line = fgets($handle)) !== false) {
            // Skip blank lines
            if (empty(trim($line))) {
                continue;
            }

            $this->rawContents[] = $line;

            $i++;
        }

        fclose($handle);

        return $this->rawContents;
    }
}