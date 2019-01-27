<?php

class P1Value
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
}