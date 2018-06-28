<?php

$playerOneWin = false;
$playerTwoWin = false;
$playerOneCount = 0;
$playerTwoCount = 0;
$playerOneDeck = array();
$playerTwoDeck = array();

$deck = array("Ace ♠","Ace ♦","Ace ♣","Ace ♥","2 ♠", "3 ♠", "4 ♠", "5 ♠", "6 ♠", "7 ♠", "8 ♠", "9 ♠", "10 ♠", "J ♠", "Q ♠", "K ♠", "2 ♦", "3 ♦", "4 ♦", "5 ♦", "6 ♦", "7 ♦", "8 ♦", "9 ♦", "10 ♦", "J ♦", "Q ♦", "K ♦", "2 ♣", "3 ♣", "4 ♣", "5 ♣", "6 ♣", "7 ♣", "8 ♣", "9 ♣", "10 ♣", "J ♣", "Q ♣", "K ♣", "2 ♥", "3 ♥", "4 ♥", "5 ♥", "6 ♥", "7 ♥", "8 ♥", "9 ♥", "10 ♥", "J ♥", "Q ♥", "K ♥");

shuffle($deck);

print_r ($deck);

function newGame() {
    $playerOneWin = true;
    $playerTwoWin = false;
};

function deal() {
    $deck;
    
    //get the array from the deck of cards deal the cards between the two
};








echo "<h1>Snap</h1><h3>A two player game of snap!</h3>";
echo "There are " . count ($deck) . " cards remaining";
echo "<br>Works";

print_r ($deck);

if($playerOneWin == true ) {
    echo "<h1>Player One Wins!<h1>";
} elseif ($playerTwoWin == true) {
    echo "<h1>Player Two Wins!</h1>";
} else {
    //game 
};


?>