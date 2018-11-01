<?php
include('dbconn.php');
$team_id=$_REQUEST['id'];
?>
<html>
<head>
<title>
Team Details
</title>
</head>
<body>
<form method="post">
<h1 align="center" style="color:blue;">
<?php
    $sql="SELECT team_name FROM teams WHERE team_id='$team_id'";
    $result=mysqli_query($conn,$sql);
    $res=mysqli_fetch_array($result);
    echo "Welcome to Player Details of $res[0]";
?>
</h1>
    <br/>
<table border="1" align="center">
<tr align="center" style="font-size:18pt;"><td>Player Name</td><td>Player Position</td></tr>
    <?php
    $sql="SELECT team_name,player_no FROM teams WHERE team_id='$team_id'";
    $result=mysqli_query($conn,$sql);
    $res=mysqli_fetch_array($result);
    echo "<h2 align="."center".">Total no. of players in the team: $res[1]"."</h2>";
    $sql="SELECT * FROM players WHERE player_team='$res[0]'";
    $result=mysqli_query($conn,$sql);
    while($res=mysqli_fetch_array($result))
    {
        echo "<tr align="."center"." style="."font-size:15pt;"."><td>$res[1]</td><td>$res[3]</td></tr>";
    }
    ?>
</table>
<input type="hidden" name="id" value="<?php echo $team_id ?>"/> 
</form>    
</body>
    
</html>