<?php

namespace Sudoku\Board;

class Cell
{
    /** @var integer */
    private $rowNumber;

    /** @var integer */
    private $columnNumber;

    /** @var integer */
    private $value;

    /** @var Board */
    private $board;

    /**
     * @param Board $board
     * @param int $row
     * @param int $column
     */
    public function __construct(Board $board, $row, $column)
    {
        $this->rowNumber = $row;
        $this->columnNumber = $column;
        $this->board = $board;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return is_null($this->value);
    }

    /**
     * @return int
     */
    public function getRowNumber()
    {
        return $this->rowNumber;
    }

    /**
     * @return int
     */
    public function getColumnNumber()
    {
        return $this->columnNumber;
    }
}