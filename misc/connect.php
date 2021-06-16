<?php
$url='localhost';
$username='root';
$password='';
$db_name="spotifyClone";
$conn=mysqli_connect($url,$username,$password,$db_name);

if(!$conn)
$conn = mysqli_connect($host, $username, $password, $db_name);
if (!$conn) {
    die('Could not Connect My Sql:' . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8');
?>