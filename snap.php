<h1 style="text-align: center;">SNAP!</h1>
<h2 style="text-align: center;">A simple game of snap for two players</h2>
<p style="text-align: center"><br>Rules<br>There are 52 cards in the main deck. First person to get all 52 cards wins the game!<br><br></p>

<form method="post">
    <input type="submit" name="newGame" id="newGame" value="NEW GAME" /><br/>
</form>


<form method="post">
    <input type="submit" name="deal" id="deal" value="DEAL CARDS" /><br/>
</form>

<?php
//ran out of time to do an automatic comparison between the last two elements in the array and run the "p1Win/p2Win" functions

//saving the states of the arrays, no AJAX needed
session_start();

//winning variables
$playerOneWin = false;
$playerTwoWin = false;

// unshuffled deck
$deck = array("Ace ♠","Ace ♦","Ace ♣","Ace ♥","2 ♠", "3 ♠", "4 ♠", "5 ♠", "6 ♠", "7 ♠", "8 ♠", "9 ♠", "10 ♠", "J ♠", "Q ♠", "K ♠", "2 ♦", "3 ♦", "4 ♦", "5 ♦", "6 ♦", "7 ♦", "8 ♦", "9 ♦", "10 ♦", "J ♦", "Q ♦", "K ♦", "2 ♣", "3 ♣", "4 ♣", "5 ♣", "6 ♣", "7 ♣", "8 ♣", "9 ♣", "10 ♣", "J ♣", "Q ♣", "K ♣", "2 ♥", "3 ♥", "4 ♥", "5 ♥", "6 ♥", "7 ♥", "8 ♥", "9 ♥", "10 ♥", "J ♥", "Q ♥", "K ♥");

function echoStates() {
    echo "<p><br>Player one has " . count ($_SESSION['playerOneDeck']) .  " cards in their deck</p>";
    echo "<p><br>Player two has " . count ($_SESSION['playerTwoDeck']) .  " cards in their deck</p>";
};


// Setting the game back to a fresh state
function newGame() {
    //global $playerOneWin, $playerTwoWin, $playerOneDeck, $playerTwoDeck, $playingDeck, $deck;

    $_SESSION['playerOneDeck'] = array();
    $_SESSION['playerTwoDeck'] = array();
    $_SESSION['playingDeck'] = array();
    $_SESSION['sDeck'] = array();
    echo "Game cleansed";
};

if(array_key_exists('newGame',$_POST)){
    newGame();
}


function dealF() {
    if (empty($_SESSION['playerOneDeck'] && $_SESSION['playerTwoDeck'])) {
        global $deck, $playerOneDeck, $playerTwoDeck;

        shuffle($deck); //shuffling the deck

        $_SESSION['sDeck'] = $deck; //assigning the new deck with a SESSION deck

        $temp = count($deck); // value for halving

        $num1 = 0;
        foreach($_SESSION['sDeck'] as $key => $val){
            if(++$num1 > 26) break; // Havling the deck with 26
            $_SESSION['playerOneDeck'][$key] = $val; // Copy the key and value from the first deck/array to the second deck
            unset($_SESSION['sDeck'][$key]); // removing the keys and values from the first array/deck
        }
        
        $num2 = 0;
        foreach($_SESSION['sDeck'] as $key => $val){
            if(++$num2 > 26) break; 
            $_SESSION['playerTwoDeck'][$key] = $val;
            unset($_SESSION['sDeck'][$key]); 
        }
        
       
        


    } else {
        echo "The cards have already been dealt!<br><br>";
    };
};

if(array_key_exists('deal',$_POST)){
    dealF();
}

//*************************** playing a hand area

//player one button and function
echo "<form method='post'>
                    <input type='submit' name='place1' id='place1' value='P1 PLACE CARD' /><br/>
                </form>";

function place1() {
    if (empty($_SESSION['playerOneDeck'])){
        echo "Please deal a hand first!";
    } else {
        
        $num = 0;
        foreach($_SESSION['playerOneDeck'] as $key => $val){
            if(++$num > 1) break; //breaking so only one card is moved
            $_SESSION['playingDeck'][$key] = $val;
            unset($_SESSION['playerOneDeck'][$key]); 
        }
    }
};

if(array_key_exists('place1',$_POST)){
    place1();
}

//player two button and function
echo "<form method='post'>
                    <input type='submit' name='place2' id='place2' value='P2 PLACE CARD' /><br/>
                </form>";

function place2() {
    if (empty($_SESSION['playerTwoDeck'])){
        echo "Please deal a hand first!";
    } else {
        
        $num = 0;
        foreach($_SESSION['playerTwoDeck'] as $key => $val){
            if(++$num > 1) break;
            $_SESSION['playingDeck'][$key] = $val;
            unset($_SESSION['playerTwoDeck'][$key]);
        }
    }
};

if(array_key_exists('place2',$_POST)){
    place2();
}

//**************************** winning hand buttons and functions

//button for grabbing player ones win
echo "<form method='post'>
                    <input type='submit' name='p1Win' id='p1Win' value='PLAYER 1 HAND' /><br/>
                </form>";

function p1Win() {
    if (empty($_SESSION['playingDeck'])){
        echo "Please deal a hand first!";
    } else {
        foreach($_SESSION['playingDeck'] as $key => $val){
            $_SESSION['playerOneDeck'][$key] = $val; 
            unset($_SESSION['playingDeck'][$key]); 
        }
    }
};

if(array_key_exists('p1Win',$_POST)){
    p1Win();
}

//button and function for grabbing player two win

echo "<form method='post'>
                    <input type='submit' name='p2Win' id='p2Win' value='PLAYER 2 HAND' /><br/>
                </form>";

function p2Win() {
    if (empty($_SESSION['playingDeck'])){
        echo "Please deal a hand first!";
    } else {
        foreach($_SESSION['playingDeck'] as $key => $val){
            $_SESSION['playerTwoDeck'][$key] = $val; 
            unset($_SESSION['playingDeck'][$key]); 
        }
    }
};

if(array_key_exists('p2Win',$_POST)){
    p2Win();
}


echoStates();


//giving out live data of the playing deck
echo "<pre>"; 
 print_r ($_SESSION['playingDeck']);
echo "/<pre>"; 


//winning function
if(count($_SESSION['playerOneDeck']) == 52 ) {
    echo "<h1>Player One Wins!<h1>";
} elseif (count($_SESSION['playerTwoDeck']) == 52) {
    echo "<h1>Player Two Wins!</h1>";
};


?>