<?php

namespace App\Fusebox\Parser;

use App\Fusebox\Data\P1Telegram;

class ESMRParser implements ParserInterface
{
    private $telegram;

    public function __construct()
    {
        $this->telegram = new P1Telegram();
    }
    
    /**
     * Parses raw ESMR telegram data
     *
     * @param array $data
     *
     * @return P1Telegram
     */
    public function parse(array $data) : P1Telegram
    {
        if (count($data) === 0) {
            // TODO: Implement specialized exception
            throw new Exception('There is no data to parse!');
        }

        // First line is always the header
        $this->telegram->setHeader($data[0]);
        // Last line is always the checksum
        $this->telegram->setCheckSum($data[count($data) - 1]);

        unset($data[count($data) - 1]);
        unset($data[0]);

        // Parse the rest of the raw data
        foreach ($data as $line) {
            $parsedLine = $this->parseLine($line);
    
            $this->telegram
                ->getValueByOBISReference($parsedLine['obisReference'])
                ->setValue($parsedLine['value']);
        }

        return $this->telegram;
    }

    /**
     * Parses a single line
     *
     * @param string $line
     *
     * @return array
     */
    private function parseLine(string $line) : array
    {
        return [
            'obisReference' => strstr($line, '(', true),
            'value' => strstr($line, '(')
        ];
    }
}