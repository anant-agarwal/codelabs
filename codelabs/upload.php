
<?php
	
	if(isset($_POST['submit']))
	{
		
		include_once "config.php";
		include_once "headers.php"; 
		$conn=mysql_connect("$server_name","$mysql_username","$mysql_password") or die("unable to connect to SQL server".mysql_error());
		mysql_select_db("$database",$conn);
		if($_POST['timelimit']==0)
		$_POST['timelimit']=$default_tl;
		$exec=mysql_query("INSERT INTO $questions_table ($code,$question,$timelimit,$cid) VALUES ('$_POST[prob_code]','$_POST[question]','$_POST[timelimit]','$_POST[cid]')",$conn);
		if(!$exec)
		{
			echo " problem code already exists try again with some more creative code";
		}
		$exec=mysql_query("SELECT $pid FROM $questions_table ORDER BY $pid DESC LIMIT 1",$conn) or die(mysql_error());
		if(!$res=mysql_fetch_array($exec))
		{
			echo "fetched nothing--Database error contact admin Now!!!";	
		}
		else
		$prob_no=$res[$pid];
		//$prob_no=14;
		$code_file=$prob_no.".".$_POST['lang'];
		$filename=$install_directory."q/".$prob_no."/";
		echo "mkdir ".$filename;
		exec("mkdir ".$filename,$output,$return);
		if($return==1)
		die("unable to make directory for question!!");
		$fp=fopen($filename.$code_file,'w');
		if(!$fp)
		{
			die("fatal error  solution file could not be generated contact admin now!!!");
		}
		if($_POST['lang']=="cpp")
		{
			$_POST['soln']=$header_files_cpp.$_POST['soln'];
		}
		fwrite($fp,$_POST['soln']) or die("unable to write user code to the file");
		fclose($fp);
		if($_POST['lang']=="cpp")
		{
			exec("g++ ".$filename.$code_file." -o ".$filename."s",$output,$return);
			if($return ==1)
			die("compilation error in uploaded soln");
		}
		if($_FILES["test_cases"]["type"]=="application/zip" && $_FILES["test_cases"]["size"]<1000000)
		{	
			if ($_FILES["test_cases"]["error"] > 0)
			  {
			 	 echo "Error: " . $_FILES["test_cases"]["error"] . "<br />";
			  }
			/*else
			  {
				  echo "Upload: " . $_FILES["test_cases"]["name"] . "<br />";
				  echo "Type: " . $_FILES["test_cases"]["type"] . "<br />";
				  echo "Size: " . ($_FILES["test_cases"]["size"] / 1024) . " Kb<br />";
				  echo "Stored in: " . $_FILES["test_cases"]["tmp_name"];
			  }*/
			if(move_uploaded_file($_FILES["test_cases"]["tmp_name"],$filename."input.zip") )
			{
				$target_path=$filename."input.zip";
				$zip = new ZipArchive();
				$x = $zip->open($target_path);
				if ($x === true)
				 {
					$zip->extractTo($filename); // change this to the correct site path
					$zip->close();
	 
					unlink($target_path);
				}

			}
		}
		else
		{
			die("invalid file type/size");	
		}
		$gen_actual_output=$filename."s < i";
		for($i=1;$i<=10;$i++)
		{
			exec($filename."s < ".$filename."i".$i.".txt > ".$filename."o".$i.".txt",$output,$return);
			if($return ==1)
			{
				die("something bad happenend while executing the input cases");
			}
		}
		echo"program uploaded successfully";
		mysql_close($conn);
	}
?>
<!--<html>
<head>
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
		<div  style="width:700px; margin:auto; text-align:center">
			<form name="uploader" action="upload.php" method="post" enctype="multipart/form-data">
				problem code:<br/>
				<input type="text" name="prob_code"/>
				<br/>
				Problem Statement:<br/>
				<textarea name="question" rows="20" cols="80">
				
				</textarea>
				<br/>
				Solution:
				<br/>
				<textarea name="soln" rows="20" cols="80" id="textarea_1">
				</textarea>
				<br/>	
				Language of Soln:
				<select name="lang">
					<option value="cpp">C++</option>
					<option value="c">C</options>
					<option value="java">Java</options>
				</select><br/>
				Timelimit(in seconds):<br/><input type="text" name="timelimit"/>
				<br/>
				<!--<div style="text-align:left">	
					Input Ranges:
					<br/>
					Number of test cases(if required to be mentioned in the start of input file):
					<br/>
					<input type="text" name="repeater"/>
					<br/>
					<BR/>
					enter a sample test case:
					<br/>			
					<textarea name="input_spec">
					</textarea>	
					<br/>
					<br/>
					Special ending character(if any):<br/>
					<input type="text" name="end"/><br/>
				</div>--<br/>
				<label for="file">Test case(ZIP):</label>
				<input type="file" name="test_cases" id="file" />
				<br/>
				<input type="submit" name="submit" value="upload"/>
			
			</form>
		</div>
	</body>
</html>-->
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
<?php if(isset($_GET['c']))
	echo"<script type='text/javascript'>alert('Contest id is:".$_GET['c']."')</script>'";?>
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
		<h3>Upload</h3>
		<div class="clr"></div>
		<div class="main_right" style="width:100%;">
			<div class="clr"></div>
			<!--<div class="right_text">
				<p><strong>Latest News:</strong> October contest underway. <a href="#">Click here to participate.</a></p>
			</div>-->
			<div class="clr"></div>
			<p style='text-align:center;'>
				<div  style="width:700px; margin:auto; text-align:center">
			<form name="uploader" action="upload.php" method="post" enctype="multipart/form-data">
				problem code:<br/>
				<input type="text" name="prob_code"/>
				<br/>
				Contest Id:<br/>
				<input type="text" name="cid"/>
				<br/>
				Problem Statement:<br/>
				<textarea name="question" rows="20" cols="80">
				
				</textarea>
				<br/>
				Solution:
				<br/>
				<textarea name="soln" rows="20" cols="80" id="textarea_1">
				</textarea>
				<br/>	
				Language of Soln:
				<select name="lang">
					<option value="cpp">C++</option>
					<option value="c">C</options>
					<option value="java">Java</options>
				</select><br/><br/>
				Timelimit(in seconds):<br/><input type="text" name="timelimit"/>
				<br/>
				<!--<div style="text-align:left">	
					Input Ranges:
					<br/>
					Number of test cases(if required to be mentioned in the start of input file):
					<br/>
					<input type="text" name="repeater"/>
					<br/>
					<BR/>
					enter a sample test case:
					<br/>			
					<textarea name="input_spec">
					</textarea>	
					<br/>
					<br/>
					Special ending character(if any):<br/>
					<input type="text" name="end"/><br/>
				</div>--><br/>
				<label for="file">Test case(ZIP):</label>
				<input type="file" name="test_cases" id="file" />
				<br/><br/>
				<input type="submit" name="submit" value="upload"/>
			
			</form>
		</div>

			<br/><br/><br/></p>
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
