<?php

namespace Sudoku\Board;

class Board
{
    private $cells = [];

    const ERROR_BOARD_DIMENSIONS = 'Board must be a 9x9 multidimensional array of integers between 1 and 9';

    public function __construct(array $board)
    {
        for ($rowNumber = 0; $rowNumber < 9; $rowNumber++) {
            $row = [];

            if (!isset($board[$rowNumber])) {
                throw new \InvalidArgumentException(self::ERROR_BOARD_DIMENSIONS . " {$rowNumber}");
            }

            for ($columnNumber = 0; $columnNumber < 9; $columnNumber++) {

                $cell = new Cell($this, $rowNumber, $columnNumber);
                $cell->setValue($board[$rowNumber][$columnNumber]);

                $row[] = $cell;
            }

            $this->cells[] = $row;
        }
    }

    /**
     * @param $rowNumber
     * @param $columnNumber
     * @param $value
     */
    public function setCellValue($rowNumber, $columnNumber, $value)
    {
        $this->getCell($rowNumber, $columnNumber)->setValue($value);
    }

    /**
     * @param $rowNumber
     * @param $columnNumber
     * @return Cell
     */
    public function getCell($rowNumber, $columnNumber)
    {
        if (!isset($this->cells[$rowNumber][$columnNumber])) {
            throw new \OutOfBoundsException("Row: {$rowNumber}, Column: {$columnNumber}");
        }

        return $this->cells[$rowNumber][$columnNumber];
    }

    /**
     * @param $rowNumber
     * @return BoardSequence
     */
    public function getRow($rowNumber)
    {
        return new BoardSequence($this->cells[$rowNumber]);
    }

    /**
     * @param $columnNumber
     * @return BoardSequence
     */
    public function getColumn($columnNumber)
    {
        $columnValues = [];

        foreach ($this->cells as $row) {
            $columnValues[] = $row[$columnNumber];
        }

        return new BoardSequence($columnValues);
    }

    /**
     * @param Cell $cell
     * @return BoardSequence
     */
    public function getSector(Cell $cell)
    {
        $sectorRow = intval($cell->getRowNumber() / 3);
        $sectorColumn = intval($cell->getColumnNumber() / 3);

        $sectorCells = [];

        $sectorRowStart = 3 * $sectorRow;
        $sectorColumnStart = 3 * $sectorColumn;

        for ($sectorCellRow = $sectorRowStart; $sectorCellRow < $sectorRowStart + 3; $sectorCellRow++) {
            for ($sectorCellColumn = $sectorColumnStart; $sectorCellColumn < $sectorColumnStart + 3; $sectorCellColumn++) {
                $sectorCells[] = $this->getCell($sectorCellRow, $sectorCellColumn);
            }
        }

        return new BoardSequence($sectorCells);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [];

        foreach ($this->cells as $cellRow) {
            $arrayRow = [];
            foreach ($cellRow as $cell) {
                $arrayRow[] = $cell->getValue();
            }

            $array[] = $arrayRow;
        }

        return $array;
    }

    public function __clone()
    {
        $newCellRows = [];

        foreach ($this->cells as $cellRow) {
            $newCellRow = [];

            foreach ($cellRow as $cell) {
                $newCellRow[] = clone $cell;
            }

            $newCellRows[] = $newCellRow;
        }

        $this->cells = $newCellRows;
    }
}