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
					<li><a href="contest.php"  class="active"><span>Contests</span></a></li>
					<li><a href="reference.html"><span>References</span></a></li>
					<li><a href="tutorial.html"><span>Tutorials</span></a></li>
					<li><a href="register.php"><span>Register</span></a></li>
					<li><a href="login.php"><span>Login</span></a></li>
        </ul>
      </div>
      <div class="click">
        <p style='padding:0 20px'><?php session_start(); if(isset($_SESSION['uname'])) echo"Welcome ".$_SESSION['uname']."!!!<br/><a href='logout.php'>logout</a>"; else header("Location:login.php");?></p>
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
		<h3>Contests</h3>
		<div class="clr"></div>
		<div class="main_right" style='width:100%;'>
			<div class="clr"></div>
			<!--<div class="right_text">
				<p><strong>Latest News:</strong> October contest underway. <a href="#">Click here to participate.</a></p>
			</div>-->
			<div class="clr"></div>
			<?php
				include_once "config.php";
				include_once "headers.php";
				$conn=mysql_connect("$server_name","$mysql_username","$mysql_password") or die("unable to connect to SQL server".mysql_error());
				mysql_select_db("$database",$conn);
				$exec=mysql_query("SELECT * FROM $contest_table ORDER BY $cid  DESC",$conn) or die("unable to fetch from contest_table".mysql_error());
				$row=mysql_fetch_array($exec);
				$current_time=date_format(date_create(), 'Y-m-d H:i:s');
				//echo $current_time."  ".$row[$st];
				$flag=0;
				if($row[$st]>$current_time)
				{	
					$flag=1;
						echo "<h2>Upcoming Contest<br />
						<span>Keep Checking This Place for upcoming contests...</span> 
						</h2>";
						echo"<img src=\"images/contest-".$row[$cid].".jpg\" alt=\"contest-".$row[$cid]."\" width=\"168\" height=\"75\" class=\"floated\" />";
						echo"<p><a href=\"#\"><strong>".$row[$name]."</strong></a><br />".$row[$comment]."</p>";
						echo"<p><b>Timing :&nbsp; ".$row[$st]."&nbsp; &nbsp; to &nbsp;&nbsp;".$row[$ft]."</b></p>";
						while(($row=mysql_fetch_array($exec)) && ($row[$st]>$current_time))
						{
								echo"<div class=\"bg\"></div>
								<img src=\"images/contest-".$row[$cid].".jpg\" alt=\"contest-".$row[$cid]."\" width=\"168\" height=\"75\" class=\"floated\" />
								<p><a href=\"#\"><strong>".$row[$name]."</strong></a><br />".$row[$comment]."</p>";
								echo"<p><b>Timing :&nbsp; ".$row[$st]."&nbsp; &nbsp; to &nbsp;&nbsp;".$row[$ft]."</b></p>";
						}
				}
				
				if($flag==1)
				echo "<p>&nbsp;</p>";
				
				if($row && $row[$st]<$current_time && $current_time<$row[$ft])
				{
							$flag=2;
							echo "<h2>Current Contest<br />
							<span>Participate Now!!!</span> 
							</h2>";
							echo"<img src=\"images/contest-".$row[$cid].".jpg\" alt=\"contest-".$row[$cid]."\" width=\"168\" height=\"75\" class=\"floated\" />";
							echo"<p><a href=\"contest_prob.php?cid=".$row[$cid]."&name=".$row[$name]."&start=".$row[$start_pid]."&noq=".$row[$noq]."\"><strong>".$row[$name]."</strong></a><br />".$row[$comment]."</p>";
							echo"<p><b>Timing :&nbsp; ".$row[$st]."&nbsp; &nbsp; to &nbsp;&nbsp;".$row[$ft]."</b></p>";
							while(($row=mysql_fetch_array($exec)) && ($row[$st]>$current_time) && ($current_time<$row[$ft]))
							{
									echo"<div class=\"bg\"></div>
										<img src=\"images/contest-".$row[$cid].".jpg\" alt=\"contest-".$row[$cid]."\" width=\"168\" height=\"75\" class=\"floated\" />
										<p><a href=\"contest_prob.php?cid=".$row[$cid]."&name=".$row[$name]."&start=".$row[$start_pid]."&noq=".$row[$noq]."\"><strong>".$row[$name]."</strong></a><br />".$row[$comment]."</p>";
									echo"<p>Timing :&nbsp; ".$row[$st]."&nbsp; &nbsp; to &nbsp;&nbsp;".$row[$ft]."</p>";
							}
				}
				
				if($flag==2)
				echo"<p>&nbsp;</p>";
				
				if($row && $row[$st]<$current_time && $current_time>$row[$ft])
				{
							$flag=2;
							echo "<h2>Past Contests<br />
							<span>Have a look at the previous contests</span> 
							</h2>";
							echo"<img src=\"images/contest-".$row[$cid].".jpg\" alt=\"contest-".$row[$cid]."\" width=\"168\" height=\"75\" class=\"floated\" />";
							echo"<p><a href=\"contest_prob.php?cid=".$row[$cid]."&name=".$row[$name]."&start=".$row[$start_pid]."&noq=".$row[$noq]."\"><strong>".$row[$name]."</strong></a><br />".$row[$comment]."</p>";
							echo"<p><a href=\"#\">Editorial » </a> <a href=\"ranking.php?cid=".$row[$cid]."\" style=\"padding-left:5em\">Ranking »</a></p>";
							while(($row=mysql_fetch_array($exec)) && (($row[$st]<$current_time) && ($current_time>$row[$ft])))
							{
									echo"<div class=\"bg\"></div>
									<img src=\"images/contest-".$row[$cid].".jpg\" alt=\"contest-".$row[$cid]."\" width=\"168\" height=\"75\" class=\"floated\" />
									<p><a href=\"contest_prob.php?cid=".$row[$cid]."&name=".$row[$name]."&start=".$row[$start_pid]."&noq=".$row[$noq]."\"><strong>".$row[$name]."</strong></a><br />".$row[$comment]."</p>";
									echo"<p><a href=\"#\">Editorial » </a> <a href=\"ranking.php?cid=".$row[$cid]."\" style=\"padding-left:5em\">Ranking »</a></p>";

							}
				}
				
			
				//echo $row[$st]."  ".$current_time."  ".$row[$ft];
			?>
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
