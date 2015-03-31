<?php
namespace TicTacToe;

class Board
{

    private $grid;

    /**
     * Board constructor.
     */
    public function __construct()
    {
        $this->grid = $this->defaultGrid();
    }

    /**
     * @return array
     */
    private function defaultGrid()
    {
        // array of arrays with grid in it
        return [
            [new Cell(), new Cell(), new Cell()],
            [new Cell(), new Cell(), new Cell()],
            [new Cell(), new Cell(), new Cell()]
        ];
    }

    /**
     * @param $x
     * @param $y
     * @return mixed
     */
    public function getCell($x, $y)
    {
        return $this->grid[$y][$x];
    }

    /**
     * @param $x
     * @param $y
     * @param $value
     */
    public function setCell($x, $y, $value)
    {
        $this->getCell($x, $y)->setValue($value);
    }

    public function formattedGrid()
    {
        $count = 0;
        foreach($this->grid as $row) {
            $formatted_row = array_map(function(Cell $cell) use (&$count) {
                $count++;
                if ($cell->getValue()) {
                    return $cell->getValue();
                } else {
                    return $count;
                }
            }, $row);
            echo implode(' ', $formatted_row) . "\n";
        }
    }

    public function gameOver()
    {
        if ($this->winner()) {
            return 'winner';
        } elseif ($this->draw()) {
            return 'draw';
        } else {
            return false;
        }
    }

    /**
     * Check if there is a winner
     * Loop over all possible winning positions
     *
     * First make sure that a given winning position doesn't have values that are the same, but all empty
     * Then check if that winning position has values that are all the same and return true.
     * @return bool
     */
    private function winner()
    {
        foreach($this->winningPositions() as $winning_position) {

            if ($this->allAreEmpty($this->winningPositionValues($winning_position))) {
                continue;
            } elseif ($this->allSame($this->winningPositionValues($winning_position))) {
                return true;
            }

        }

        // otherwise no winner was found
        return false;
    }

    /**
     * Loop over everything in the array and check if all values are falsy
     * @param $array
     * @return bool
     */
    private function allAreEmpty($array)
    {
        return count(array_unique($array)) == 1 && end($array) === '';
    }

    /**
     * Check that all values in a given array are the same
     * @param $array
     * @return bool
     */
    private function allSame($array)
    {
        return count(array_unique($array)) === 1;

    }

    private function winningPositionValues($winning_position)
    {
        return array_map(function(Cell $cell) {
            return $cell->getValue();
        }, $winning_position);
    }

    /**
     * @return array
     */
    private function winningPositions()
    {
        return array_merge(
            $this->grid,
            $this->transpose($this->grid),
            $this->diagonals()
        );
    }





    private function diagonals()
    {
        return [
            [$this->getCell(0,0), $this->getCell(1,1), $this->getCell(2,2)],
            [$this->getCell(0,2), $this->getCell(1,1), $this->getCell(2,0)]
        ];
    }


    /**
     * @return bool
     */
    private function draw()
    {
        return count(array_filter($this->flatten($this->grid), function(Cell $item) {
            return !$item->getValue();
        })) === 0;

    }

    /**
     * @param $array
     * @return array
     */
    private function flatten($array)
    {
        $return = array();
        foreach($array as $row) {
            foreach($row as $cell) {
                $return[] = $cell;
            }
        }
        return $return;
    }

    /*
     * http://stackoverflow.com/questions/797251/transposing-multidimensional-arrays-in-php
     */
    private function transpose($array)
    {
        array_unshift($array, null);
        return call_user_func_array('array_map', $array);
    }

}