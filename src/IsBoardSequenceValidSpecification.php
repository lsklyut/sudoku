<?php

namespace Sudoku;

use Sudoku\Board\BoardSequence;

class IsBoardSequenceValidSpecification
{
    public function isSatisfiedBy(BoardSequence $boardSequence)
    {
        $remainingSequence = [1, 2, 3, 4, 5, 6, 7, 8, 9];

        foreach ($boardSequence->cells as $cell) {
            $cellValue = $cell->getValue();
            if (!in_array($cellValue, $remainingSequence) && !is_null($cellValue)) {
                return false;
            }

            $remainingSequence = array_filter(
                $remainingSequence,
                function ($remainingValue) use ($cell) {
                    return $remainingValue != $cell->getValue();
                }
            );
        }

        return true;
    }
}