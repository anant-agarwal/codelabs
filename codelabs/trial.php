<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CodeLabs</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<style type='text/CSS'>
label
{
		font:normal 16px Arial, Helvetica, sans-serif;
		color:#2A2A2A;
}
</style>
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
<script language="javascript" type="text/javascript" src="editarea_0_8_2/edit_area/edit_area_full.js"></script>
<script language="javascript" type="text/javascript">
editAreaLoader.init({
	id : "textarea_1"		// textarea id
	,toolbar: "search, go_to_line, fullscreen, |, undo, redo, |, select_font, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, word_wrap, |, help"
	,syntax: "cpp"			// syntax to be uses for highgliting
	,start_highlight: true		// to display with highlight mode on start-up
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
					<li><a href="contest.php"  class="active"><span>Contests</span></a></li>
					<li><a href="reference.html"><span>References</span></a></li>
					<li><a href="tutorial.html"><span>Tutorials</span></a></li>
					<li><a href="register.php"><span>Register</span></a></li>
					<li><a href="login.php"><span>Login</span></a></li>
        </ul>
      </div>
      <div class="click">
        <p style='padding:0 20px'><?php session_start(); if(isset($_SESSION['uname'])) echo"Welcome ".$_SESSION['uname']."!!!<br/><a href='logout.php'>logout</a>";else header("Location:login.php");?></p>
      </div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
<!--
		<div class="slider_main">
			<div id="slider">
		
				<div id="slideshow">
					<div class="slider-item"><a href="#"><img src="images/simple_img_1.jpg" alt="icon" width="648" height="303" border="0" /></a></div>
					<div class="slider-item"><a href="#"><img src="images/simple_img_2.jpg" alt="icon" width="648" height="303" border="0" /></a></div>
					<div class="slider-item"><a href="#"><img src="images/simple_img_3.jpg" alt="icon" width="648" height="303" border="0" /></a></div>
				</div>
        
				<div class="controls-center">
					<h2>October contest is underway.</h2>
					<p><a href="contests/current_contest.php">Click here to participate in the contest</a></p>
				</div>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
-->
		<div class="clr"></div>
		<div class="main_right" style="width:100%;float:none;">
			<div class="clr"></div>
			<!--<div class="right_text">
				<p><strong>Latest News:</strong> October contest underway. <a href="#">Click here to participate.</a></p>
			</div>
			<div class="clr"></div>-->
			<div width="100%" align="center">
	<div  style=" margin:auto">
		<?php 
			if($_GET['me']==1)
			echo "<script language='javascript' type='text/javascript'> 
	alert('header files not required, submit without using header files');
</script>";
			else if($_GET['me']==2)
			echo "<script language='javascript' type='text/javascript'> 
	alert('sorry for inconvenince :( please submit again');
</script>";
		?>
		<div style="margin:auto;width:75%;text-align:center"> 	
		<h2>Welcome to AGNI (the Code-Checker)!!!</br>
		Submit your code</h2>
		<form name="trial" action="submit.php" method="post">
			<textarea id="textarea_1" name="code" rows="30"  cols="83" style="width=100%">
			</textarea><br/>
			<div style="float:left;font:normal 16px Arial, Helvetica, sans-serif;color:#2A2A2A;">
				Language:
				<select name="lang" style='font:normal 14px Arial, Helvetica, sans-serif;color:#2A2A2A;border:2px solid;background-color:white;border-radius:3px;-moz-border-radius:4px;'>
					<option value="cpp">C++</option>
					<option value="c">C</options>
					<option value="java">Java</options>
				</select>
			</div>
			<div style="float:right;font:normal 16px Arial, Helvetica, sans-serif;color:#2A2A2A;">
				Problem Code:		
				<select name="pid" style='font:normal 14px Arial, Helvetica, sans-serif;color:#2A2A2A;border:2px solid;background-color:white;border-radius:3px;-moz-border-radius:4px;'>
				<?php
					include_once "config.php";
					$conn=mysql_connect("$server_name","$mysql_username","$mysql_password") or die("unable to connect to SQL server".mysql_error());
					mysql_select_db("$database",$conn);
					$exec=mysql_query("SELECT $pid,$code FROM $questions_table ",$conn) or die("unable to select the code list from database ");						
					while($row=mysql_fetch_array($exec))
					{
						if($row[$pid]==$_GET[pid])
						echo"<option value='".$row[$pid]."'selected='selected'>".$row[$code]."</option>";
						else
						echo "<option value='".$row[$pid]."'>".$row[$code]."</option>";
					}
	 				mysql_close($conn);
				?>
				<!--<option value="1">MULT</option>
				<option value="2">ADD</options>
				<option value="21">SUB</options>
				-->
				</select>
			</div>
			<br/><br/>
			<input type="submit" name="submit" value="submit" style='font:normal 14px Arial, Helvetica, sans-serif;color:#2A2A2A;border:2px solid;background-color:white;border-radius:3px;-moz-border-radius:3px;'>
		</form>
		</div>
	</div>
</div>

			<!--<h2>Upcoming Contest<br />
				<span>Keep Checking This Place for upcoming contests...</span> 
			</h2>-->
			<!--<p>The October contest is underway. Participate in it right away.</p>
			<img src="images/img_1.jpg" alt="picture" width="168" height="75" class="floated" />
			<p><a href="#"><strong>September 2011</strong></a><br />
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis 
			</p>-->
			<!--<p>&nbsp;</p>
			<h2>Current Contest<br />
				<span>Participate Now!!!</span> 
			</h2>-->
			<!--<p>The October contest is underway. Participate in it right away.</p>-->
			<!--<img src="images/img_1.jpg" alt="picture" width="168" height="75" class="floated" />
			<p><a href="#"><strong>September 2011</strong></a><br />
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis 
			</p>
			<!--<p><a href="#">Editorial » </a> <a href="#" style="padding-left:5em">Post-Mortem »</a></p>	-->

			<!--<p>&nbsp;</p>--
			<h2>Past contests<br />
				<span>Have a look at the previous contests</span> 
			</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip exea</p>
			
			<img src="images/img_1.jpg" alt="picture" width="168" height="75" class="floated" />
			<p><a href="#"><strong>September 2011</strong></a><br />
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis 
			</p>
			<p><a href="#">Editorial » </a> <a href="#" style="padding-left:5em">Post-Mortem »</a></p>	
			<div class="bg"></div>
			<img src="images/img_2.jpg" alt="picture" width="168" height="75" class="floated" />
			<p><a href="#"><strong>Optimal Design</strong></a><br />
				Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
			</p>
			<p><a href="#">Read More »</a></p>
			<div class="bg"></div>
			<img src="images/img_3.jpg" alt="picture" width="168" height="75" class="floated" />
			<p><a href="#"><strong>Power Design</strong></a><br />
				Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. 
			</p>
			<p><a href="#">Read More »</a></p>-->
			<p>&nbsp;</p>
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
