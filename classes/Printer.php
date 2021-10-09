<?php

namespace Classes;

class Printer
{
    /**
     * @var string
     */
    private $memory;

    /**
     * @param string $memory
     */
    public function __construct($memory)
    {
        $this->memory = $memory;
    }

    /**
     * @param string $meno
     * @param string $number
     */
    public function printName($meno, $number)
    {
        for ($i = 1; $i <= $number; $i++) {
            $tmpOutput = "Vypisujem meno " . $meno . " uz " . $i . " krat <br>";
            $this->memory .= $tmpOutput;
            print $tmpOutput;
        }
    }

    /**
     * @return mixed
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @param mixed $memory
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;
    }
}