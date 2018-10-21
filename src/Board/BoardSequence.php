<?php

namespace Sudoku\Board;

use InvalidArgumentException;

class BoardSequence
{
    /** @var Cell[] */
    public $cells;

    public function __construct(array $values)
    {
        if (count($values) != 9) {
            throw new InvalidArgumentException('Board sequences must be 9 values');
        }

        $this->cells = $values;
    }
}