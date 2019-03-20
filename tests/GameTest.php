<?php

use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class GameTest extends TestCase
{
    public function testItInstantiatesAllTiles()
    {
        $game = new Game;
    
        $this->assertEquals(28, count($game->tiles));
        $this->assertEquals(2, count($game->players));
    }


    public function testItStartsTheGameCorrectly()
    {
        $game = new Game;

        $game->startGame();

        $this->assertEquals(13, count($game->tiles));

        $this->assertEquals(1, count($game->board->tiles));

        $this->expectOutputString("Game starting with first tile: " . (string) $game->board->tiles[0] . PHP_EOL);
    }

    public function testItStoresPlayerNames()
    {
        $playerOne = "Test 1";
        $playerTwo = "Test 2";
        $game = new Game($playerOne, $playerTwo);

        $this->assertEquals(2, count($game->players));

        $this->assertEquals($playerOne, $game->players[0]->name);
        $this->assertEquals($playerTwo, $game->players[1]->name);
    }

    public function testItDealsSevenCardsToEachPlayer()
    {
        $playerOne = "Test 1";
        $playerTwo = "Test 2";
        $game = new Game($playerOne, $playerTwo);

        $this->assertEquals(2, count($game->players));
        $game->startGame();

        foreach ($game->players as $player) {
            $this->assertEquals(7, count($player->tiles));
        }
    }
}
