<?php

namespace SudokuTest;

use PHPUnit\Framework\TestCase;
use Sudoku\Board\Board;
use Sudoku\BoardSolverService;

class BoardSolverServiceTest extends TestCase
{
    /**
     * @dataProvider boardDataProvider
     *
     * @param $board
     * @param $expected
     */
    public function testSolver($board, $expected)
    {
        $sut = new BoardSolverService();

        $board = new Board($board);

        $solvedBoard = $sut->solve($board);

        $this->assertEquals($expected, $solvedBoard->toArray());
    }

    public function boardDataProvider()
    {
        return [
            'easy1' => [
                'board' => [
                    [null, 2, 5, 8, 6, null, null, null, null],
                    [3, null, null, null, 1, null, 5, null, 9],
                    [4, null, 7, 5, 3, null, 2, null, null],

                    [7, null, 1, 6, null, null, null, null, null],
                    [5, 9, null, null, null, null, null, 7, 2],
                    [null, null, null, null, null, 3, 6, null, 1],

                    [null, null, 9, null, 4, 8, 7, null, 3],
                    [8, null, 3, null, 5, null, null, null, 4],
                    [null, null, null, null, 9, 7, 8, 1, null]
                ],
                'expected' => [
                    [9, 2, 5, 8, 6, 4, 1, 3, 7],
                    [3, 6, 8, 7, 1, 2, 5, 4, 9],
                    [4, 1, 7, 5, 3, 9, 2, 8, 6],
                    [7, 3, 1, 6, 2, 5, 4, 9, 8],
                    [5, 9, 6, 4, 8, 1, 3, 7, 2],
                    [2, 8, 4, 9, 7, 3, 6, 5, 1],
                    [1, 5, 9, 2, 4, 8, 7, 6, 3],
                    [8, 7, 3, 1, 5, 6, 9, 2, 4],
                    [6, 4, 2, 3, 9, 7, 8, 1, 5],
                ]
            ],
            'easy2' => [
                'board' => [
                    [3, 5, null, null, 2, 4, null, 6, null],
                    [null, 1, null, null, 7, 3, 8, null, null],
                    [null, null, null, null, null, 9, 3, 2, null],
                    [null, 2, 3, null, null, 1, 7, null, 9],
                    [1, null, null, 5, null, null, null, null, null],
                    [null, 8, null, null, 9, 2, null, 4, 1],
                    [null, 3, 5, 2, null, 6, 4, null, null],
                    [null, 6, 8, null, null, 5, null, 1, null],
                    [null, 4, null, null, null, null, 9, 5, null],
                ],
                'expected' => [
                    [3, 5, 9, 8, 2, 4, 1, 6, 7],
                    [4, 1, 2, 6, 7, 3, 8, 9, 5],
                    [8, 7, 6, 1, 5, 9, 3, 2, 4],
                    [5, 2, 3, 4, 6, 1, 7, 8, 9],
                    [1, 9, 4, 5, 8, 7, 6, 3, 2],
                    [6, 8, 7, 3, 9, 2, 5, 4, 1],
                    [9, 3, 5, 2, 1, 6, 4, 7, 8],
                    [7, 6, 8, 9, 4, 5, 2, 1, 3],
                    [2, 4, 1, 7, 3, 8, 9, 5, 6],
                ]
            ],
            'difficult' => [
                'board' => [
                    [null, null, null, null, null, null, 1, 4, 7],
                    [null, 3, null, null, null, null, 5, 9, null],
                    [null, null, 1, 5, null, null, null, null, 8],

                    [null, null, 2, 1, 7, null, null, null, 6],
                    [null, null, null, 9, null, 2, null, null, null],
                    [9, null, null, null, 3, 6, 2, null, null],

                    [6, null, null, null, null, 4, 7, null, null],
                    [null, 9, 3, null, null, null, null, 1, null],
                    [7, 2, 8, null, null, null, null, null, null]
                ],
                'expected' => [
                    [5, 6, 9, 2, 8, 3, 1, 4, 7],
                    [8, 3, 4, 7, 6, 1, 5, 9, 2],
                    [2, 7, 1, 5, 4, 9, 6, 3, 8],
                    [3, 4, 2, 1, 7, 8, 9, 5, 6],
                    [1, 8, 6, 9, 5, 2, 3, 7, 4],
                    [9, 5, 7, 4, 3, 6, 2, 8, 1],
                    [6, 1, 5, 8, 9, 4, 7, 2, 3],
                    [4, 9, 3, 6, 2, 7, 8, 1, 5],
                    [7, 2, 8, 3, 1, 5, 4, 6, 9],
                ]
            ],
            '"world\'s most difficult sudoku"' => [
                'board' => [
                    [8, null, null, null, null, null, null, null, null],
                    [null, null, 3, 6, null, null, null, null, null],
                    [null, 7, null, null, 9, null, 2, null, null],

                    [null, 5, null, null, null, 7, null, null, null],
                    [null, null, null, null, 4, 5, 7, null, null],
                    [null, null, null, 1, null, null, null, 3, null],

                    [null, null, 1, null, null, null, null, 6, 8],
                    [null, null, 8, 5, null, null, null, 1, null],
                    [null, 9, null, null, null, null, 4, null, null]
                ],
                'expected' => [
                    [8, 1, 2, 7, 5, 3, 6, 4, 9],
                    [9, 4, 3, 6, 8, 2, 1, 7, 5],
                    [6, 7, 5, 4, 9, 1, 2, 8, 3],
                    [1, 5, 4, 2, 3, 7, 8, 9, 6],
                    [3, 6, 9, 8, 4, 5, 7, 2, 1],
                    [2, 8, 7, 1, 6, 9, 5, 3, 4],
                    [5, 2, 1, 9, 7, 4, 3, 6, 8],
                    [4, 3, 8, 5, 2, 6, 9, 1, 7],
                    [7, 9, 6, 3, 1, 8, 4, 5, 2],
                ]
            ]
        ];
    }
}