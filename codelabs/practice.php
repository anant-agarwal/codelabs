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
					<li><a href="login.php"><span>Login</span></a></li>
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
		<h3>Practice Problems</h3>
		<div class="clr"></div>
		<div class="main_right" style="width:100%;">
			<div class="clr"></div>
			<!--<div class="right_text">
				<p><strong>Latest News:</strong> October contest underway. <a href="#">Click here to participate.</a></p>
			</div>-->
			<div class="clr"></div>
			<p style='text-align:center;'><br/><br/><br/>these section is under construction and will be up soon!!!<br/><br/><br/><br/><br/><br/></p>
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
