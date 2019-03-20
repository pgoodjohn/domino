<?php

class Board
{
    public $tiles;
    public $rightMostValue;
    public $leftMostValue;
    protected $leftMostTile;
    protected $rightMostTile;

    public function __construct(Tile $initialTile)
    {
        $this->tiles[] = $initialTile;
        $this->rightMostValue = $initialTile->getRight();
        $this->leftMostValue = $initialTile->getLeft();
        $this->leftMostTile = $initialTile;
        $this->rightMostTile = $initialTile;
    }

    /**
     * Print status of the board
     *
     * @return void
     */
    public function printBoard()
    {
        printf("Board is now: ");
        foreach ($this->tiles as $tile) {
            $tile->print();
        }
        print PHP_EOL;
    }

    /**
     * Place the leftmost tile on the board
     *
     * @param Tile $tile Thw tile to be placed
     * @param string $playerName The name of the player placing the tile
     *
     * @return bool
     */
    public function placeLeftMostTile(Tile $tile, string $playerName): bool
    {
        if ($tile->getRight() != $this->leftMostValue) {
            throw new Exception("Unable to place tile!");
        }

        print($playerName . " plays " . (string)$tile . " to connect to tile " . (string)$this->leftMostTile . " on the board\n");

        array_unshift($this->tiles, $tile);
        $this->leftMostValue = $tile->getLeft();
        $this->leftMostTile = $tile;
        $this->printBoard();

        return true;
    }

    /**
     * Place the rightmost tile on the board
     *
     * @param Tile $tile Thw tile to be placed
     * @param string $playerName The name of the player placing the tile
     *
     * @return bool
     */
    public function placeRightMostTile(Tile $tile, string $playerName): bool
    {
        if ($tile->getLeft() != $this->rightMostValue) {
            throw new Exception("Unable to place tile!");
        }
        
        print($playerName . " plays " . (string)$tile . " to connect to tile " . (string)$this->rightMostTile . " on the board\n");

        array_push($this->tiles, $tile);
        $this->rightMostValue = $tile->getRight();
        $this->rightMostTile = $tile;
        $this->printBoard();

        return true;
    }
}
