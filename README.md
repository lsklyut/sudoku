# Sudoku Puzzle Solver

This is my first pass at building a Sudoku puzzle solver. Notes about the code - 
* the board representation is a 9x9 multi-dimensional array of Cell objects
* A Board Sequence is either a row, column, or sector. It is an array of 9 Cell objects
* A Sector is one of 9 3x3 sections of the Sudoku board
