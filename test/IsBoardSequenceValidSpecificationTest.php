<?php

namespace SudokuTest;

use PHPUnit\Framework\TestCase;
use Sudoku\Board\Board;
use Sudoku\Board\BoardSequence;
use Sudoku\Board\Cell;
use Sudoku\IsBoardSequenceValidSpecification;

class IsBoardSequenceValidSpecificationTest extends TestCase
{
    /**
     * @dataProvider sequenceDataProvider
     *
     * @param $values
     * @param $expected
     */
    public function testSequence($values, $expected)
    {
        $cells = [];

        foreach ($values as $value) {
            $cells[] = $this->createCell($value);
        }

        $sequence = new BoardSequence($cells);

        $sut = new IsBoardSequenceValidSpecification();

        $this->assertEquals($expected, $sut->isSatisfiedBy($sequence));
    }

    private function createCell($value)
    {
        $cell = new Cell(new Board(), 1, 1);
        $cell->setValue($value);

        return $cell;
    }

    public function sequenceDataProvider()
    {
        return [
            ['values' => [1, 2, 3, 4, 5, 6, 7, 8, 9], 'expected' => true],
            ['values' => [1, 8, 3, 4, null, 6, 7, null, 9], 'expected' => true],
            ['values' => [1, 8, 3, 8, null, 6, 7, null, 9], 'expected' => false],
        ];
    }
}