<?php

namespace App\Fusebox\Data;

class P1Value implements \JsonSerializable
{
    private $description = '';
    private $obisReference = '';
    private $unit = '';
    private $value = '';

    public function __construct(
        string $description, 
        string $obisReference, 
        string $unit = ''
    ) {
        $this->description = $description;
        $this->obisReference = $obisReference;
        $this->unit = $unit;
    }

    public function getOBISReference()
    {
        return $this->obisReference;
    }

    public function setValue(string $value)
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'description' => $this->description,
            'obisReference' => $this->obisReference,
            'unit' => $this->unit,
            'value' => $this->value
        ];
    }
}