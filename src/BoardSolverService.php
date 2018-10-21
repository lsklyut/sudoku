<?php

namespace Sudoku;

use Sudoku\Board\Board;
use Sudoku\Board\Cell;

class BoardSolverService
{
    /**
     * @param Board $board
     * @return Board|false
     */
    public function solve(Board $board)
    {
        for ($rowNumber = 0; $rowNumber < 9; $rowNumber++) {
            for ($columnNumber = 0; $columnNumber < 9; $columnNumber++) {
                $cell = $board->getCell($rowNumber, $columnNumber);

                if (!$cell->isEmpty()) {
                    continue;
                }

                $possibleValues = $this->calculatePossibleCellValues($board, $cell);

                $numberOfPossibleValues = count($possibleValues);

                if ($numberOfPossibleValues == 0) {
                    // this board is invalid
                    return false;
                }

                if ($numberOfPossibleValues == 1) {
                    $cell->setValue($possibleValues[0]);
                    continue;
                }

                foreach ($possibleValues as $possibleValue) {
                    $clonedBoard = clone $board;
                    $clonedCell = $clonedBoard->getCell($cell->getRowNumber(), $cell->getColumnNumber());
                    $clonedCell->setValue($possibleValue);

                    $result = $this->solve($clonedBoard);

                    if ($result !== false) {
                        return $result;
                    }

                }

                return false;
            }
        }

        return $board;
    }

    /**
     * @param Board $board
     * @param Cell $cell
     * @return array
     */
    public function calculatePossibleCellValues(Board $board, Cell $cell)
    {
        if (!$cell->isEmpty()) {
            return [$cell->getValue()];
        }

        $possibleValues = [];

        $isSequenceValidSpecification = new IsBoardSequenceValidSpecification();

        $allPossibleValues = [1, 2, 3, 4, 5, 6, 7, 8, 9];

        $row = $board->getRow($cell->getRowNumber());
        $column = $board->getColumn($cell->getColumnNumber());
        $sector = $board->getSector($cell);

        foreach ($allPossibleValues as $possibleValue) {
            $cell->setValue($possibleValue);

            if (!$isSequenceValidSpecification->isSatisfiedBy($row)) {
                continue;
            }

            if (!$isSequenceValidSpecification->isSatisfiedBy($column)) {
                continue;
            }

            if (!$isSequenceValidSpecification->isSatisfiedBy($sector)) {
                continue;
            }

            $possibleValues[] = $possibleValue;
        }

        $cell->setValue(null);

        return $possibleValues;
    }
}