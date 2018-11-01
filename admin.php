<?php
include('dbconn.php');
include('Fixture.php');
if(empty($_SESSION['logIn']))
{
    header('location:login.php');
}
$fixtureExists=0;
$sql="SELECT match_id FROM matches";
$result=mysqli_query($conn,$sql);
$row=mysqli_num_rows($result);
if($row>0)
{
    $fixtureExists=1;
}
else
{
    $fixtureExists=0;
}
?>
<html>
<head>
<title>
Welcome Admin!
</title>
</head>
<body>
<form action="" method="post">

Register new team(Total No. should be even):<br/>
Name:<input type="text" name="teamName"/>
Home stadium:<input type="text" name="teamStadium"/>
Total no. of players:<input type="number" name="teamPlayers"/>
<input type="submit" name="newTeam" value="Register new Team"/>
<hr/>
<input type="submit" name="generateFixture" value="Generate fixtures!"/>
<hr/>
<input type="submit" name="removeFixture" value="Remove all Fixtures!"/>
<hr/>
<input type="submit" name="resetTable" value="Reset table"/>(if you have added new teams,please reset the table before you continue)
    <hr/>
<a href="index.php">Back to home</a>

    <hr/>
<?php
    if($fixtureExists==1)
    {   
        ?>
    <table border="1">
        <tr><td>Team1</td><td>Team2</td><td>Update Score</td></tr>
        <?php
        $sql="SELECT * FROM matches";
        $result=mysqli_query($conn,$sql);
        while($res=mysqli_fetch_array($result))
        {
        echo "<tr><td>$res[1]</td>"."<td>$res[2]</td><td><a href="."updateScores.php?id="."$res[0]".">Update</a></td></tr>";
        }
        ?>
    </table>
    <?php
    }
    if(!empty($_REQUEST['newTeam']))
    {   
        $name=$_REQUEST['teamName'];
        $stad=$_REQUEST['teamStadium'];
        $play=$_REQUEST['teamPlayers'];
        $var=0;
        $sql="INSERT INTO teams values('','$name','$stad','$play','$var','$var','$var','$var','$var')";
        if(mysqli_query($conn,$sql))
        {
            echo "Team $name added successfully!";
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
  
    if(!empty($_REQUEST['generateFixture']))
    {
        $sql="SELECT team_id FROM teams";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_num_rows($result);
        if($row%2==1)
        {
            echo "Cannot generate fixture with odd number of teams!";
        }
        else
        {
            if($fixtureExists==1)
            {
                echo "Fixture already Exists!";
            }
            else
            {
            $sql2="TRUNCATE table matches";
            mysqli_query($conn,$sql2);
            $sql="SELECT team_name FROM teams";
            $result=mysqli_query($conn,$sql);
            $teams=array();
                $c=0;
                while($res=mysqli_fetch_array($result))
                {
                    $teams[$c]=$res[0];
                    $c++;
                }
                $fixPair = new Fixture($teams);
                $schedule = $fixPair->getSchedule();
                //show the rounds
                $i = 1;
                $played=0;
            ?>
            <table border="1">
                        <tr><td>Team1</td><td>Team2</td><td>Update Score</td></tr>
                <?php
                foreach($schedule as $rounds){
                    //echo "<h3>Round {$i}</h3>";
                    foreach($rounds as $game){
                        //here
                        $sql="INSERT INTO matches values('','$game[0]','$game[1]','$played','$played','$played')";
                        mysqli_query($conn,$sql);
                        //echo "{$game[0]} vs {$game[1]}<br>";
                    }
                    echo "<br>";
                    $i++;
                }
                        $sql="SELECT * FROM matches";
                        $result=mysqli_query($conn,$sql);
                        while($res=mysqli_fetch_array($result))
                        {
                            echo "<tr><td>$res[1]</td>"."<td>$res[2]</td><td><a href="."updateScores.php?id="."$res[0]".">Update</a></td></tr>";
                        }

                            ?>
    </table>
    <hr/>
    <?php
            
        }
        }
    }
    if(!empty($_REQUEST['removeFixture']))
    {
        $sql="TRUNCATE table matches";
        mysqli_query($conn,$sql);
        echo "<meta http-equiv='refresh' content='0'>";
    }
    if(!empty($_REQUEST['resetTable']))
    {
        $sql="UPDATE teams SET played='0'";
        $sql2="UPDATE teams SET won=0";
        $sql3="UPDATE teams SET lost=0";
        $sql4="UPDATE teams SET tie=0";
        $sql5="UPDATE teams SET points=0";
        if(mysqli_query($conn,$sql) &&
        mysqli_query($conn,$sql2) &&
        mysqli_query($conn,$sql3) &&
        mysqli_query($conn,$sql4) &&
        mysqli_query($conn,$sql5))
        {
            echo "Scores Resetted Successfully!";
        }
    }
    
?>
</form>    
</body> 
</html>