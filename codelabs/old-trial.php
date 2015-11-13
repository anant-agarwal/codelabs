<html>
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
<body width="100%" align="center">
	<div  style="width:60%; margin:auto">
		<?php 
			if($_GET['me']==1)
			echo "<script language='javascript' type='text/javascript'> 
	alert('header files not required, submit without using header files');
</script>";
		?>
		<div style="margin:auto;width:75%;text-align:center"> 	
		Welcome to the Code-Checker!!!</br>
		Check your code<br/>
		<form name="trial" action="submit.php" method="post">
			<textarea id="textarea_1" name="code" rows="30"  cols="83" style="width=100%">
			</textarea><br/>
			<div style="float:left">
				Language:
				<select name="lang">
					<option value="cpp">C++</option>
					<option value="c">C</options>
					<option value="java">Java</options>
				</select>
			</div>
			<div style="float:right">
				Problem Code:			
				<select name="pid">
				<?php
					include_once "config.php";
					$conn=mysql_connect("$server_name","$mysql_username","$mysql_password") or die("unable to connect to SQL server".mysql_error());
					mysql_select_db("$database",$conn);
					$exec=mysql_query("SELECT $pid,$code FROM $questions_table ",$conn) or die("unable to select the code list from database ");						
					while($row=mysql_fetch_array($exec))
					{
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
			<input type="submit" name="submit" value="send ur code">
		</form>
		</div>
	</div>
</body>
</html>
