<?php
require_once './Fixture.php';
//Example with a pair number of teams
$teams = array("Germany", "England", "France", "Brasil", "Mexico", "Japan", "Nigeria", "Spain");
$fixPair = new Fixture($teams);
$schedule = $fixPair->getSchedule();
//show the rounds
$i = 1;
foreach($schedule as $rounds){
    echo "<h3>Round {$i}</h3>";
    foreach($rounds as $game){
        echo "{$game[0]} vs {$game[1]}<br>";
    }
    echo "<br>";
    $i++;
}
echo "<hr>";


//Example with a odd number of teams
$otherTeams = array("Portugal", "Argentina", "South Korea", "Australia", "Egypt");
$fixOdd = new Fixture($otherTeams);
$games = $fixOdd->getSchedule();
$i = 1;
foreach($games as $rounds){
    $free = "";
    echo "<h3>Round {$i}</h3>";
    foreach($rounds as $match){
        if($match[0] == "free this round"){
            $free = "<span style='color:red;'>{$match[1]} is {$match[0]}</span><br>";
        }elseif($match[1] == "free this round"){
            $free = "<span style='color:red;'>{$match[0]} is {$match[1]}</span><br>";
        }else{
            echo "{$match[0]} vs {$match[1]}<br>";
        }
    }
    echo $free;
    echo "<br>";
    $i++;
}       