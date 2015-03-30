<?php

namespace TicTacToe;

class Cell
{


    private $value;

    /**
     * Cell constructor.
     * @param string $value
     */
    public function __construct($value = '')
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}