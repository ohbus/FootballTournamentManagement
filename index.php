<?php
include('dbconn.php');

?>
<html>
<head>
<title>
Welcome to Kolkata Premiere League!
</title>
</head>
<body>
<form method="post">
<h1 align="center">WELCOME TO KOLKATA PREMIERE LEAGUE!</h1>
<h2 align="center">League Table</h2>
<h4 align="left"><a href="admin.php">Admin Login</a></h4>
<table align="center" border="1">
    <tr align="center"><td>Team Name</td><td>Played</td><td>Won</td><td>Tie</td><td>Lost</td><td>Points</td></tr>
    <?php
    $sql="SELECT * FROM teams ORDER BY points DESC";
    $result=mysqli_query($conn,$sql);
    while($res=mysqli_fetch_array($result))
    {
        echo "<tr align="."center"."><td>$res[1]</td><td>$res[4]</td><td>$res[5]</td><td>$res[7]</td><td>$res[6]</td><td>$res[8]</td></tr>";
    }
    ?>
    </table>
    <hr/>

</form>    
</body>
    
</html>