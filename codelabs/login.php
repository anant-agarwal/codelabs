<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CodeLabs</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#slideshow').cycle({
        fx:     'fade',
        speed:  'slow',
        timeout: 3000,
        pager:  '#slider_nav',
        pagerAnchorBuilder: function(idx, slide) {
            // return sel string for existing anchor
            return '#slider_nav li:eq(' + (idx) + ') a';
        }
    });
});
</script>
</head>
<body>
<?php 
			if(isset($_POST['submit']))
			{
				include_once "config.php";
				include_once "headers.php";
				$conn=mysql_connect("$server_name","$mysql_username","$mysql_password") or die("unable to connect to SQL server".mysql_error());
				mysql_select_db("$database",$conn);
				$exec=mysql_query("SELECT * FROM users WHERE username='$_POST[uname]'",$conn) or die("unable to fetch from Users_table".mysql_error());
				$row=mysql_fetch_array($exec);
				if($row['password']==md5($_POST['passwd']))
				{
						//echo" welcome ".$row['username'];
						session_start();
						$_SESSION['uname']=$_POST['uname'];
						header("Location:../main/");
				}
			}
?>
<div class="main">
	<div class="main_resize">
		<div class="header">
			<div class="logo">
				<a href="index.html">
					<img src="images/codelabs.png" width="232" height="74" border="0" alt="logo" />
				</a>
			</div>
			<div class="clr">
			</div>
			<div class="menu">
        <ul>
					<li><a href="../main/" ><span>Home</span></a></li>
					<li><a href="contest.php" ><span>Contests</span></a></li>
					<li><a href="reference.html"><span>References</span></a></li>
					<li><a href="tutorial.html"><span>Tutorials</span></a></li>
					<li><a href="register.php"><span>Register</span></a></li>
					<li><a href="login.php"  class="active"><span>Login</span></a></li>
        </ul>
      </div>
      <div class="click">
        <p style='padding:0 20px'><?php session_start(); if(isset($_SESSION['uname'])) echo"Welcome ".$_SESSION['uname']."!!!<br/><a href='logout.php'>logout</a>";?></p>
      </div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
<!--
		<div class="slider_main">
			<div id="slider">
				<div class="controls-center">
					<h2>October contest is underway.</h2>
					<p><a href="contests/current_contest.php">Click here to participate in the contest</a></p>
				</div>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
-->
		<h3>Login</h3>
		<div class="clr"></div>
		<div class="main_right" style="width:100%;">
			<div class="clr"></div>
			<!--<div class="right_text">
				<p><strong>Latest News:</strong> October contest underway. <a href="#">Click here to participate.</a></p>
			</div>-->
			<div class="clr"></div>
			<p style='text-align:center;'><br/><br/><br/>
				<form name="login" action="login.php" method="post" align="center" >
					<div style="width:30%;margin:auto;font:normal 16px Arial, Helvetica, sans-serif;color:#2A2A2A;">
					<div style='float:left;width:30%;text-align:left;'>
					Name:
					</div>
					<div style='float:left;width:70%'>
					<input type='text' name='uname' style="font:normal 14px Arial, Helvetica, sans-serif;color:#2A2A2A;border:1px solid;background-color:white;border-radius:3px;-moz-border-radius:3px;"/><br/>
					</div>
					<div style='float:left;width:30%;text-align:left;'>
					Password:
					</div>
					<div style="float:left;width:70%">
					<input type='password' name='passwd' style="font:normal 14px Arial, Helvetica, sans-serif;color:#2A2A2A;border:1px solid;background-color:white;border-radius:3px;-moz-border-radius:3px;"/>
					</div>
					<br/>
					<input type='submit' name='submit' value='login' style="font:normal 14px Arial, Helvetica, sans-serif;color:#2A2A2A;border:1px solid;background-color:white;border-radius:3px;-moz-border-radius:3px;"/>
					</div>
				</form>
			<br/><br/><br/><br/><br/><br/></p>
			<!--<h2>Popular Refernces<br />
				<span>Just for your help!!!</span> 
			</h2>
			<p>Due to the wide variety of available functions,STL libraries,etc. no one can remember exact syntax of each function, so if you forget any then check them out here. We are placing the mirrors of sites used by us, you can choose your favourite out of these.</p>
			<img src="refernces/images/img_1.jpg" alt="picture" width="168" height="75" class="floated" />
			<p><a href="references/cppreference/"><strong>Cpprefernce.com</strong></a><br />
							</p>
			
			<div class="bg"></div>
			
			<p>&nbsp;</p>-->
		</div>
		<div class="clr"></div>
	</div>
	<div class="footer">
		<div class="footer_resize">
			<p class="leftt">© Copyright Codelabs. All Rights Reserved. </p>
			<p class="right"><a href="../main/"> Home</a> | <a href="contact.html">Contact</a> | <a href="credits.html">Credits </a></p>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>
</div>
</body>
</html>
