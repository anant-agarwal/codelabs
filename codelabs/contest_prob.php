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
<style type='text/css'>
li
{
	
	padding:2px;
	}
</style>
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

		<div class="slider_main">
			<div id="slider">
		
				<div id="slideshow">
					<!--<div class="slider-item"><a href="#"><img src="images/simple_img_1.jpg" alt="icon" width="648" height="303" border="0" /></a></div>
					<div class="slider-item"><a href="#"><img src="images/simple_img_2.jpg" alt="icon" width="648" height="303" border="0" /></a></div>-->
					<?php
					include_once "config.php";
					include_once "headers.php"; 
					$conn=mysql_connect("$server_name","$mysql_username","$mysql_password") or die("unable to connect to SQL server".mysql_error());
					mysql_select_db("$database",$conn);
					$exec=mysql_query("SELECT * FROM $contest_table WHERE $cid='$_GET[cid]' LIMIT 15",$conn) or die("unable to fetch from contest_table".mysql_error());
					$row=mysql_fetch_array($exec); 
					echo"<div class=\"slider-item\"><a href=\"#\"><img src=\"images/simple_contest-".$_GET['cid'].".jpg\" alt=\"".$_GET['cid']."\" width=\"648\" height=\"303\" border=\"0\" /></a></div>";
					
				echo"</div>
        
				<div class=\"controls-center\">
					<h2>".$row[$name]."</h2> ";
				//	<!--<p><a href="contests/current_contest.php">Click here to participate in the contest</a></p>-->
				echo"</div>
				<div class=\"clr\"></div>
			</div>
			<div class=\"clr\"></div>
		</div>

		<div class=\"clr\"></div>";
		echo"<div class='main_left'>
			<h2>Current Rankings</h2>";
			$exec1=mysql_query("SELECT * FROM ranking WHERE $cid='$_GET[cid]' ",$conn) or die("unable to fetch from status_table".mysql_error());
			$left_row=mysql_fetch_array($exec1);
			echo"<div style='border:5px solid #858585; padding:5px;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;font:normal 12px Arial, Helvetica, sans-serif;color:#606060'>";
			if(!$left_row)
			echo "No activity yet";
			else
			{
				echo"<div style='float:left;width:15%;text-align:center;'><b>Sno.</b></div>
				<div style='float:left;width:50%;text-align:center;'><b>User</b></div>
				<div style='float:left:width:15%;text-align:center;'><b>Points</b></div>";
				$r=1;
				do
				{
				echo"<div class='bg'></div><div style='float:left;width:15%;text-align:center;'>".$r."</div>
				<div style='float:left;width:50%;text-align:center;'>".$left_row['user']."</div>
				<div style='float:left:width:15%;text-align:center;'>".$left_row['points']."</div>";
					$r++;
				}while($left_row=mysql_fetch_array($exec1));
				
			}
		echo"</div></div>";
		echo "<div class=\"main_right\">
			<div class=\"clr\"></div>
			<div class=\"right_text\">";
				 
				$current_time=date_format(date_create(), 'Y-m-d H:i:s');
				echo"
				<p><strong>Announcement:</strong> ";
				if(($row[$st]<$current_time) && ($current_time<$row[$ft]))
				echo"Contest is underway...All the best!!!";
				else if($current_time>$row[$ft])
				echo"Contest is over....But you can still check your code!!!";
			echo"</p>
			</div>
			<div class=\"clr\"></div>";
			echo "<h2>Problems<br />
						
						</h2>";
				$exec=mysql_query("SELECT * FROM $questions_table WHERE $cid='$_GET[cid]' ",$conn) or die("unable to fetch from contest_table".mysql_error());
				echo"
					<div style='margin-left:30px;'>
						<div style='float:left;width:25%;'><p><b>Problem Code</b></p></div>
						<div style='width:75%;float:right;'>
							<div style='float:left;width:30%;text-align:center'><p><b>Users Solved</b></p></div>
							<div style='width:70%; flaot:right;'>
								<div style='float:left; width:30%;text-align:center'><p><b>Submissions</b></p></div>
								<div style='text-align:center;width:27%;float:right;'><p><b>Accuracy</b></p></div>
							</div>
						</div>
					</div>
					";
				while($row=mysql_fetch_array($exec))
				{
						$prob_name=$row[$code];
						$u_solved=$row[$users_solved];
						$tot=$row['total_submission'];
						$acc=0;
						if($tot>0)
						$acc=round($u_solved/$tot,2);
						
						echo"<div class='bg'></div>
					<div style='margin-left:30px;'>
						<div style='float:left;width:25%;'><p><a href='problem.php?pid=".$row[$pid]."'>".$prob_name."</a></p></div>
						<div style='width:75%;float:right;'>
							<div style='float:left;width:30%;text-align:center'><p>".$u_solved."</p></div>
							<div style='width:70%; flaot:right;'>
								<div style='float:left; width:30%;text-align:center'><p>".$tot."</p></div>
								<div style='text-align:center;width:27%;float:right;'><p>".$acc."</p></div>
							</div>
						</div>
					</div>
					";
				
				}
				
				/*if($row[$st]>$current_time)
				{	
					$flag=1;
						
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
							echo"<p><a href=\"#\"><strong>".$row[$name]."</strong></a><br />".$row[$comment]."</p>";
							echo"<p><b>Timing :&nbsp; ".$row[$st]."&nbsp; &nbsp; to &nbsp;&nbsp;".$row[$ft]."</b></p>";
							while(($row=mysql_fetch_array($exec)) && ($row[$st]>$current_time) && ($current_time<$row[$ft]))
							{
									echo"<div class=\"bg\"></div>
										<img src=\"images/contest-".$row[$cid].".jpg\" alt=\"contest-".$row[$cid]."\" width=\"168\" height=\"75\" class=\"floated\" />
										<p><a href=\"#\"><strong>".$row[$name]."</strong></a><br />".$row[$comment]."</p>";
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
							echo"<p><a href=\"#\"><strong>".$row[$name]."</strong></a><br />".$row[$comment]."</p>";
							echo"<p><a href=\"#\">Editorial » </a> <a href=\"#\" style=\"padding-left:5em\">Post-Mortem »</a></p>";
							while(($row=mysql_fetch_array($exec)) && (($row[$st]<$current_time) && ($current_time>$row[$ft])))
							{
									echo"<div class=\"bg\"></div>
									<img src=\"images/contest-".$row[$cid].".jpg\" alt=\"contest-".$row[$cid]."\" width=\"168\" height=\"75\" class=\"floated\" />
									<p><a href=\"#\"><strong>".$row[$name]."</strong></a><br />".$row[$comment]."</p>";
									echo"<p><a href=\"#\">Editorial » </a> <a href=\"#\" style=\"padding-left:5em\">Post-Mortem »</a></p>";

							}
				}
				
			
				//echo $row[$st]."  ".$current_time."  ".$row[$ft];*/
			?>
			<!--<h2>Instructions<br />
				<span>Keep Checking This Place for upcoming contests...</span> 
			</h2>-->
			<!--<p>The October contest is underway. Participate in it right away.</p>
			<img src="images/img_1.jpg" alt="picture" width="168" height="75" class="floated" />
			<p><a href="#"><strong>September 2011</strong></a><br />
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis 
			</p>-->
			<div class='bg'></div>
			<p>&nbsp;</p>
			<h2>Instructions			 
			</h2>
			<!--<p>The October contest is underway. Participate in it right away.</p>-->
			<!--<img src="images/img_1.jpg" alt="picture" width="168" height="75" class="floated" />-->
			
				<ul style='color:#606060; margin-top:0px;font:normal 12px Arial, Helvetica, sans-serif'>
					<li >	
						You are required to have your Octa id to participate in this Contest.
					</li>
					<li>
						You will receive one point for solving a problem (passing all test cases - no partial credit),
						regardless of the level of difficulty of that problem.
					</li>
					<li>
						Users are ranked according to the most problems solved. 
						Ties will be broken by the total time for each user in ascending order of time.
					</li>
					<li>
						The total time is the the time from the start of the contest till the last problem solved.
						There is no penalty for incorrect submissions but please dont abuse the system.
					</li>		
			
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
