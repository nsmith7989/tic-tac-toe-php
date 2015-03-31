<?php

namespace TicTacToe;

class Player
{

    private $name;
    private $color;
    /**
     * Player constructor.
     */
    public function __construct($input)
    {
        $this->name = $input['name'];
        $this->color = $input['color'];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

}