<?php

namespace TicTacToe;

class Cell
{


    /**
     * The value {'X'|'0'|''} of the cell
     * @var string
     */
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