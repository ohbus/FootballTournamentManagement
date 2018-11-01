<?php
/**
 * Description of Fixture (Version 1.0)
 * 
 * This class implements the creation of a role play according to the number
 * of teams received to be instantiated. It can generate a schedule for any sports
 * league. 
 * 
 * @author: David Hernandez Jimenez <darientech@gmail.com>
 * @version: 1.0 Initial version
 * 
 */
class Fixture {
    /**
     * Auxiliar array
     * @var array 
     */
    private $aux = array();
    
    /**
     * Array to pairs rounds
     * @var Array
     */
    private $pair = array();
    
    /**
     * Array to odds rounds
     * @var Array  
     */
    private $odd = array();
    
    /**
     * Counter or number of games
     * @var int 
     */
    private $countGames = 0;
    
    /**
     * Counter of number of teams
     * @var int
     */
    private $countTeams = 0;
    
    /**
     * Construct
     * 
     * @param Array $teams Array with the teams names
     * @return boolean
     */
    public function __construct(array $teams) {
        if(is_array($teams)){
            shuffle($teams);
            $this->countTeams = count($teams);
            if($this->countTeams % 2 == 1){
                $this->countTeams++;
                $teams[] = "free this round";
            }
            $this->countGames = floor($this->countTeams/2);
            for($i = 0; $i < $this->countTeams; $i++){
                $this->aux[] = $teams[$i];
            }
        }else{
            return false;
        }
    }
    
    /**
     * It make the starting round
     * @return Array Array with the matches of te round one or pair round
     */
    private function init(){
        for($x = 0; $x < $this->countGames; $x++){
            $this->pair[$x][0] = $this->aux[$x];
            $this->pair[$x][1] = $this->aux[($this->countTeams - 1) - $x];
        }
        return $this->pair;
    }

    /**
     * Returns the schedule generated
     * @return Array Array with the full matches created
     */
    public function getSchedule(){
        $rol = array();
        $rol[] = $this->init();
        for($y = 1; $y < $this->countTeams-1; $y++){
            if($y % 2 == 0){
                $rol[] = $this->getPairRound();
            }else{
                $rol[] = $this->getOddRound();
            }
        }
        return $rol;
    }
    
    /**
     * Create the matches of a pair round
     * @return Array Array with the matches created
     */
    private function getPairRound(){
        for($z = 0; $z < $this->countGames; $z++){
            if($z == 0){
                $this->pair[$z][0] = $this->odd[$z][0];
                $this->pair[$z][1] = $this->odd[$z + 1][0];
            }elseif($z == $this->countGames-1){
                $this->pair[$z][0] = $this->odd[0][1];
                $this->pair[$z][1] = $this->odd[$z][1];
            }else{
                $this->pair[$z][0] = $this->odd[$z][1];
                $this->pair[$z][1] = $this->odd[$z + 1][0];
            }
        }
        return $this->pair;
    }
    
    /**
     * Create the matches of a odd round
     * @return Array Array with the matches created
     */
    private function getOddRound(){
        for($j = 0; $j < $this->countGames; $j++){
            if($j == 0){
                $this->odd[$j][0] = $this->pair[$j][1];
                $this->odd[$j][1] = $this->pair[$this->countGames - 1][0]; //Pivot
            }else{
                $this->odd[$j][0] = $this->pair[$j][1];
                $this->odd[$j][1] = $this->pair[$j - 1][0];
            }
        }
        return $this->odd;
    }
}