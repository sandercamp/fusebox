<?php

include 'P1Value.php';

class P1Telegram
{
    private $header = '';
    private $values = [];
    private $checkSum;

    public function __construct()
    {
        $this->values = [
            new P1Value('Version information for P1 output','1-3:0.2.8'),
            new P1Value('Date-time stamp of the P1 message','0-0:1.0.0','YYMMDDhhmmssX'),
            new P1Value('Equipment identifier','0-0:96.1.1'),
            new P1Value('Meter Reading electricity delivered to client (Tariff 1) in 0,001 kWh', '1-0:1.8.1', 'kWh'),
            new P1Value('Meter Reading electricity delivered to client (Tariff 2) in 0,001 kWh', '1-0:1.8.2', 'kWh'),
            new P1Value('Meter Reading electricity delivered by client (Tariff 1) in 0,001 kWh', '1-0:2.8.1', 'kWh'),
            new P1Value('Meter Reading electricity delivered by client (Tariff 2) in 0,001 kWh', '1-0:2.8.2', 'kWh'),
            new P1Value('Tariff indicator electricity', '0-0:96.14.0', 'kWh'),
            new P1Value('Actual electricity power delivered (+P) in 1 Watt resolution', '1-0:1.7.0', 'kW'),
            new P1Value('Actual electricity power received (-P) in 1 Watt resolution', '1-0:2.7.0','kW'),
            new P1Value('Number of power failures in any phase','0-0:96.7.21'),
            new P1Value('Number of long power failures in any phase','0-0:96.7.9'),
            new P1Value('Power Failure Event Log (long power failures)','1-0:99.97.0', 'Timestamp (end of failure) –duration in seconds'),
            new P1Value('Number of voltage sags in phase L1','1-0:32.32.0'),
            new P1Value('Number of voltage swells in phase L1','1-0:32.36.0'),
            new P1Value('Text message max 1024 characters','0-0:96.13.0'),
            new P1Value('Instantaneous voltage L1 in V resolution','1-0:32.7.0', 'V'),
            new P1Value('Instantaneous current L1 in A resolution','1-0:31.7.0', 'A'),
            new P1Value('Instantaneous active power L1 (+P) in W resolution','1-0:21.7.0', 'kW'),
            new P1Value('Instantaneous active power L1 (-P) in W resolution','1-0:22.7.0', 'kW'),
            new P1Value('Device-Type', '0-1:24.1.0'),
            new P1Value('Equipment identifier (Gas)','0-1:96.1.0'),
            new P1Value('Last 5-minute value (temperature converted), gas delivered to client in m3, including decimal values and capture time','0-1:24.2.1'),
        ];
    }

    public function setHeader(string $header)
    {
        $this->header = $header;

        return $this;
    }

    public function setCheckSum(string $checkSum)
    {
        $this->checkSum = $checkSum;

        return $this;
    }

    public function getValueByOBISReference(string $obisReference)
    {
        foreach ($this->values as $value) {
            if ($value->getOBISReference() === $obisReference) {
                return $value;
            }
        }

        // Create an unkown value if the obis reference was not found in the existing list of values
        $this->values[] = $unknownValue = new P1Value('Unknown value', $obisReference);

        return $unknownValue;
    }
}