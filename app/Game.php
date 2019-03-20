<?php

class Game
{
    public $tiles;
    public $players;
    public $board;
    public $winner;

    public function __construct($playerOneName = "Alice", $playerTwoName = "Bob")
    {
        $playerOne = new Player($playerOneName);
        $playerTwo = new Player($playerTwoName);
        $this->players[] = $playerOne;
        $this->players[] = $playerTwo;

        $this->initTiles();
    }


    /**
     * Start the game by initializing the board and dealing the tiles
     *
     * @return void
     */
    public function startGame()
    {
        $this->board = new Board(array_pop($this->tiles));

        foreach ($this->players as $player) {
            for ($i = 0; $i < 7; $i++) {
                $player->tiles[] = array_pop($this->tiles);
            }
        }

        print("Game starting with first tile: " . (string)$this->board->tiles[0] . PHP_EOL);
    }

    /**
     * Initialize all the tiles required for the game
     *
     * @return void
     */
    private function initTiles()
    {
        for ($i = 0; $i < 7; $i++) {
            for ($j = 0; $j <= $i; $j++) {
                $tile = new Tile($j, $i);
                $this->tiles[] = $tile;
            }
        }

        shuffle($this->tiles);
    }

    /**
     * Print the tiles that are not dealt or played
     *
     * @return void
     */
    private function printAvailableTiles()
    {
        printf("Available Tiles are: ");
        foreach ($this->tiles as $tile) {
            $tile->print();
        }
        print PHP_EOL;
    }

    /**
     * Perform a turn, for each players
     *
     * @return void
     */
    public function playTurn()
    {
        foreach ($this->players as $player) {
            $this->tiles = $player->play($this->board, $this->tiles);
        }
    }

    /**
     * Checker whether the game is over and store the winner player
     *
     * @return boolean
     */
    public function isOver(): bool
    {
        foreach ($this->players as $player) {
            if ($player->isWinner()) {
                $this->winner = $player;
                print("Player " . $player->name . " hsa won! \n");
                return true;
            }
        }

        return false;
    }
}
