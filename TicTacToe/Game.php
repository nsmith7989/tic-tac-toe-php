<?php

namespace TicTacToe;

class Game
{

    private $players;
    private $board;
    private $current_player;
    private $other_player;

    /**
     * Game constructor.
     * @param Player $player1
     * @param Player $player2
     * @internal param Player $player
     * @internal param $players
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->players = [$player1, $player2];
        $this->board = new Board();
        shuffle($this->players);
        list($this->current_player, $this->other_player) = $this->players;
    }

    /**
     * Swap players
     */
    private function switchPlayers()
    {
        echo "Switching Players!! \n";
        list($this->current_player, $this->other_player) = [$this->other_player, $this->current_player];
    }

    /*
     * Ask the current player to make a move
     */
    private function solicitMove()
    {
        return $this->current_player->getName() . ' ' . $this->current_player->getColor() . " Enter a number between 1 and 9 to make your move: ";
    }

    /**
     * @return string
     */
    private function getMove()
    {
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        return $this->humanMoveToCoordinate(trim($line));
    }

    private function humanMoveToCoordinate($human_move)
    {
        $mapping = [
            '1' => [0, 0],
            '2' => [1, 0],
            '3' => [2, 0],
            '4' => [0, 1],
            '5' => [1, 1],
            '6' => [2, 1],
            '7' => [0, 2],
            '8' => [1, 2],
            '9' => [2, 2]
        ];
        return $mapping[$human_move];
    }

    /**
     * @return array
     */
    private function getValidMove()
    {
        while (true) {
            echo $this->solicitMove();
            list($x, $y) = $this->getMove();
            if ($this->board->getCell($x, $y)->getValue()) {
                echo "Invalid Move! \n";
            } else {
                return [$x, $y];
            }
        }
    }

    public function play()
    {
        echo $this->current_player->getName() . " has randomly been selected as the first player \n";
        while (true) {
            $this->board->formattedGrid();
            echo "\n";
            list($x, $y) = $this->getValidMove();
            $this->board->setCell($x, $y, $this->current_player->getColor());
            if ($this->board->gameOver()) {
                echo $this->gameOverMessage() . "\n";
                $this->board->formattedGrid();
                return;
            } else {
                $this->switchPlayers();
            }
        }
    }

    private function gameOverMessage()
    {
        if ($this->board->gameOver() == 'winner') {
            return $this->current_player->getName() . " won!!";
        } else {
            return "The game ended in a tie";
        }
    }

}