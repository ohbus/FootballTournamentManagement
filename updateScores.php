<?php
include('dbconn.php');
$match_id=$_REQUEST['id'];


?>
<html>
<head>
<title>
Update Scores Here Admin!
</title>
</head>
<body>
<form method="post">
<input type="hidden" name="id" value="<?php echo $match_id ?>"/> 
<?php
$sql="SELECT * FROM matches where match_id='$match_id'";
$result=mysqli_query($conn,$sql);
$res=mysqli_fetch_array($result);
echo $res[1];
?>
    <input type="number" name="score1"/><input type="number" name="score2"/>
    <?php echo $res[2]; ?>
    <input type="submit" name="updateScore" value="UpdateScore"/>
    <br/>
    <a href="admin.php">Back to admin page!</a>
    
<?php
if(!empty($_REQUEST['updateScore']))
{
$score1=$_REQUEST['score1'];
$score2=$_REQUEST['score2'];
$sql="UPDATE matches SET score1='$score1' WHERE match_id='$match_id'";   
if(mysqli_query($conn,$sql))
{
    $update1=1;
}
else
    {
        $update1=0;
    }
$sql2="UPDATE matches SET score2='$score2' WHERE match_id='$match_id'";   
if(mysqli_query($conn,$sql2))
{
    $update2=1;
}
else
{
    $update2=0;
}
if($update1==1 && $update2==1)
{
    echo "Scores Updated Successfully!";
    $sql="UPDATE matches SET played='1' WHERE match_id='$match_id'";
    mysqli_query($conn,$sql);
    if($score1>$score2)
    {
        $sql="UPDATE teams SET played=played+1 where team_name='$res[1]'";
        $sql2="UPDATE teams SET played=played+1 where team_name='$res[2]'";
        $sql3="UPDATE teams SET won=won+1 where team_name='$res[1]'";
        $sql4="UPDATE teams SET points=points+3 where team_name='$res[1]'";
        $sql5="UPDATE teams SET lost=lost+1 where team_name='$res[2]'";
        mysqli_query($conn,$sql);
        mysqli_query($conn,$sql2);
        mysqli_query($conn,$sql3);
        mysqli_query($conn,$sql4);
        mysqli_query($conn,$sql5);
    }
    else if($score1<$score2)
    {
        $sql="UPDATE teams SET played=played+1 where team_name='$res[1]'";
        $sql2="UPDATE teams SET played=played+1 where team_name='$res[2]'";
        $sql3="UPDATE teams SET won=won+1 where team_name='$res[2]'";"UPDATE teams SET tie=tie+1 where team_name='$res[1]'";
        $sql4="UPDATE teams SET points=points+3 where team_name='$res[2]'";
        $sql5="UPDATE teams SET lost=lost+1 where team_name='$res[1]'";
        mysqli_query($conn,$sql);
        mysqli_query($conn,$sql2);
        mysqli_query($conn,$sql3);
        mysqli_query($conn,$sql4);
        mysqli_query($conn,$sql5);
    }
    else if($score1==$score2)
    {
        $sql="UPDATE teams SET played=played+1 where team_name='$res[1]'";
        $sql2="UPDATE teams SET played=played+1 where team_name='$res[2]'";
        $sql3="UPDATE teams SET tie=tie+1 where team_name='$res[2]'";
        $sql4="UPDATE teams SET tie=tie+1 where team_name='$res[1]'";
        $sql5="UPDATE teams SET points=points+1 where team_name='$res[2]'";
        $sql6="UPDATE teams SET points=points+1 where team_name='$res[1]'";
        mysqli_query($conn,$sql);
        mysqli_query($conn,$sql2);
        mysqli_query($conn,$sql3);
        mysqli_query($conn,$sql4);
        mysqli_query($conn,$sql5);
        mysqli_query($conn,$sql6);
    }
}
else
{
    echo "Updation Problem! Please Check DB!";
}
}
?>
</form>    
</body>
    
</html>