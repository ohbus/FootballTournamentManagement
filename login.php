<?php
include('dbconn.php');
$admin=0;
if(!empty($_SESSION['logIn']))
{
    header('location:admin.php');
}
if(!empty($_REQUEST['adminLogin']))
{
    $userName=$_REQUEST['userName'];
    $passWord=$_REQUEST['passWord'];
    if($userName=="admin" && $passWord=="admin")
    {
        $_SESSION['logIn']=1;
        $admin=1;
    }
}


?>
<html>
<head>
<title>
Please Login
</title>
</head>
<body>
<form method="post">
    
<table align="center" valign="center">
<tr>
<td>
    <h2>Username: <input type="text" name="userName" style="font-size:15pt;"/></h2>
    </td>
    </tr>
    <tr>
    <td>
        <h2>Password: <input type="password" name="passWord" style="font-size:15pt;"/></h2>
    </td>
    </tr>
    <tr>
    <td>
    <input type="submit" name="adminLogin" value="Login" style="font-size:15pt;"/>
    </td>
</tr>    
</table>
    
<?php
if(!empty($_REQUEST['adminLogin']))
{
    if($admin==1)
    {
        header('location:admin.php');
    }
    else if($admin==0)
    {
        echo "<h3 align="."center".">Unauthorised Access!</h3>";
    }   
}
?>
    
</form>    
</body>
    
</html>