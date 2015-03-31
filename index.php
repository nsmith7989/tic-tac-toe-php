<?php
spl_autoload_register();

use TicTacToe as TToe;

echo 'Welcome to Tic Tac Toe!' . "\n";

echo "Player 1 Name:";
$handle = fopen("php://stdin", "r");
$player1_name = fgets($handle);

$player1 = new TToe\Player(['name' => trim($player1_name), 'color' => 'X']);

echo "Player 2 Name:";
$handle = fopen("php://stdin", "r");
$player2_name = fgets($handle);

$player2 = new TToe\Player(['name' => trim($player2_name), 'color' => 'O']);

$game = new TToe\Game($player1, $player2);

$game->play();



