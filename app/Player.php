<?php

class Player
{
    public $name;
    public $tiles;
    public $stuckTurns;

    public function __construct($name)
    {
        $this->name = $name;
        $this->stuckTurns = 0;
    }

    public function isWinner()
    {
        return count($this->tiles) === 0;
    }

    /**
     * Perform a turn
     *
     * @param Board $board The current board
     * @param array $availableTiles The tiles to which it is possible to draw
     * @return void
     */
    public function play(Board $board, array $availableTiles)
    {
        try {
            $this->placeTile($board);
        } catch (Exception $e) {
            return $availableTiles;
        }

        $availableTiles = $this->drawTile($availableTiles);

        return $availableTiles;
    }

    /**
     * Check whether or not is possible to place a tile on the board
     * For each tile check both extremes of the board with one side of the tile, then with the other
     *
     * @param Board $board
     * @return void
     */
    public function placeTile(Board $board)
    {
        foreach ($this->tiles as $tile) {
            if ($this->checkLeftMostTile($tile, $board)) {
                throw new Exception("Played");
            }
            if ($this->checkRightMostTile($tile, $board)) {
                throw new Exception("Played");
            }
            $tile->invert();
            if ($this->checkLeftMostTile($tile, $board)) {
                throw new Exception("Played");
            }
            if ($this->checkRightMostTile($tile, $board)) {
                throw new Exception("Played");
            }
        }
    }

    /**
     * Draw a tile from the remaining available
     *
     * @param array $availableTiles
     * @return void
     */
    public function drawTile(array $availableTiles)
    {
        $newTile = null;
        if (count($availableTiles) == 0) {
            return;
        }

        $newTile = array_pop($availableTiles);
        $this->tiles[] = $newTile;
        print($this->name . " can't play, drawing tile " . (string)$newTile . ",\n");

        return $availableTiles;
    }

    /**
     * Check whether or not the tile can be connected to the leftmost tile of the board
     *
     * @param Tile $tile
     * @param Board $board
     * @return bool
     */
    public function checkLeftMostTile(Tile $tile, Board $board): bool
    {
        if ($tile->getRight() == $board->leftMostValue) {
            $board->placeLeftMostTile($tile, $this->name);
            unset($this->tiles[array_search($tile, $this->tiles)]);

            return true;
        }

        return false;
    }

    /**
     * Check whether or not the tile can be connected to the rightmost tile of the board
     *
     * @param Tile $tile
     * @param Board $board
     * @return bool
     */
    public function checkRightMostTile(Tile $tile, Board $board): bool
    {
        if ($tile->getLeft() == $board->rightMostValue) {
            $board->placeRightMostTile($tile, $this->name);
            unset($this->tiles[array_search($tile, $this->tiles)]);
            return true;
        }

        return false;
    }


    /**
     * Print the contents of the player's hand
     *
     * @return void
     */
    public function printHand()
    {
        printf($this->name . " hand is now: ");
        foreach ($this->tiles as $tile) {
            $tile->print();
        }
        print PHP_EOL;
    }
}
