<?php
$present_time=date("H: i : s- m/d/y");
$expiry=60*24*60*60+time();
setcookie("Lastvisit",$present_time,$expiry);
if(isset($_COOKIE["Lastvisit"]))
{
	echo "<h1>Cookie <br/>";
	echo"Present time is";
	echo $present_time;
	echo "<br/>Last visited time and date is ";
	echo $_COOKIE["Lastvisit"];
	echo "</h1>";
}
else{
	echo "Old cookies";
}
