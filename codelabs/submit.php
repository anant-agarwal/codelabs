<?php
	session_start();
	 if(isset($_SESSION['uname'])) 
	 $_COOKIE['user']=$_SESSION['uname'];
	else header("Location:login.php");
	include_once "config.php";
	include_once "headers.php";
/* ------------manipulations ------------------------------------------*/	
	//echo "hi there";
/*	$_POST['code']="
	using namespace std;
	int main()
	{
		int a,b;
		cin>>a>>b;
		cout<<a*b;
	}";
*/	//$_POST['code']=escapeshellcmd($_POST['code']);
	//$_POST['code']=$header_files_cpp.$_POST['code'];
	//echo $_POST['code'];	
	//$_POST['pid']="1";
	//$_COOKIE['user']="new1";
	//$_POST['lang']="cpp";
/*---- ------------manipulations -------------------------------------*/	
	$tmp="#include";
	$tmp1=$_POST['code'];
	$chk_header=strpos($tmp1,$tmp);
	//echo"<br/>".$_POST['code']."</br>";
	//echo $chk_header;
	$bad=0;
	if($chk_header!==false)
	{
		//echo"<br/>i cam here<br/>";
		$bad=1;
		header("Location:trial.php?me=1");
	}	
	if(!isset($_POST[pid]))
	{
		$bad=1;
		header("Location:trial.php?me=2");
	}
	$_POST['code']=$header_files_cpp.$_POST['code'];
	$conn=mysql_connect("$server_name","$mysql_username","$mysql_password") or die("unable to connect to SQL server".mysql_error());
	mysql_select_db("$database",$conn);

	$exec=mysql_query("INSERT INTO $status_table ($user,$pid,$lang,$user_code) VALUES ('$_COOKIE[user]','$_POST[pid]','$_POST[lang]','$_POST[code]')",$conn) or die("unable to submit code".mysql_error());
	$exec=mysql_query("SELECT $sno FROM $status_table WHERE $user='$_COOKIE[user]' AND $pid='$_POST[pid]' ORDER BY submission_time DESC LIMIT 1",$conn) or die("unable to fetch sno from status_table".mysql_error());
	$row=mysql_fetch_array($exec);
	$serial_number=$row[$sno];
	echo $serial_number;
	//$user_folder="/var/www/code/u/".$_COOKIE['user']."/";
	$user_folder=$install_directory."u/".$_COOKIE['user']."/";	
	$code_file=$_POST['pid'].".".$_POST['lang'];
	echo $user_folder.$code_file;
	
	//touch("/var/www/code/u/ans/")
	//touch($user_folder.$code_file);
	$exec=mysql_query("SELECT * FROM ranking WHERE user='$_COOKIE[user]'",$conn) or die(mysql_error());
	if(!$res=mysql_fetch_array($exec))
	{
			echo"user data does not exist in Ranking Table so creating user folder";
			exec("mkdir ".$user_folder,$output,$return);
	}
	if($return!=0)
	{
		echo "<br/>unable to execute mkdir<br/>";
		die();
	}
	$fp=fopen($user_folder.$code_file,'w');
	if(!$fp)
	{
		die("fatal error user code file not generated contact admin now!!!");
	}
	fwrite($fp,$_POST['code']) or die("unable to write user code to the file");
	fclose($fp);
	$compile_usercode="g++ ".$user_folder.$code_file." -o ".$user_folder.$_POST['pid'];

	//echo "<br/>"."g++ ".$user_folder.$code_file." -o ".$user_folder.$_POST['pid'];
	echo "<br/>".$compile_usercode;
	$exec=mysql_query("SELECT * FROM $questions_table WHERE pid='$_POST[pid]'",$conn) or die(mysql_error());
			if(!$res=mysql_fetch_array($exec))
			{
				echo "unable to fetch timelimit--Database error contact admin Now!!!";	
			}
			else
			{
				$tl=$res[$timelimit];
				$comp_id=$res['cid'];
			}
	exec($compile_usercode,$output,$return);
	//echo "it cam here\n";
	//echo $return."<br/>";
	$flag;
	if($return==1)
	{echo "<br/>compilation error<br/>"; $flag=3;}
	
 	else
	{
		//foreach($output as $val)
		//{echo $val."\n";}
		//$generate_input="/var/www/code/q/".$_POST['pid']."/g > ".$user_folder."in1.txt";
		$generate_input=$install_directory."q/".$_POST['pid']."/g > ".$user_folder."in1.txt";
		//$gen_correct_output="/var/www/code/q/".$_POST['pid']."/s < ".$user_folder."in1.txt > ".$user_folder."soln.txt";
		$gen_correct_output=$install_directory."q/".$_POST['pid']."/s < ".$user_folder."in1.txt > ".$user_folder."soln.txt";
		//echo "<br/>".$gen_correct_ouput."<br/>/var/www/code/q/1/s < /var/www/code/u/ana/in1.txt > /var/www/code/u/ana/soln.txt<br/>";
		//$gen_user_output=$user_folder.$_POST['pid']." < ".$user_folder."in1.txt > ".$user_folder."usoln.txt";	
		$compare_usoln_soln="diff ".$user_folder."usoln.txt ".$user_folder."soln.txt";
		//$flag=0;
	
		
			//echo "<br/><br/>comp_id:".$comp_id."<br/>";
			
			//$tl=2;
			$i=1;
		for(;$i<=10;$i++)
		{
			//exec("/var/www/code/q/1/g > /var/www/code/u/ana/in1.txt",$output,$return);
			/*exec($generate_input,$output,$return);
			if($return ==1)
			{
				echo "returned 1 in ".$i." th iteration <br/>could not generate the input file\n";
				$flag=1;			
				break;
			}*/
			//exec("/var/www/code/q/1/s < /var/www/code/u/ana/in1.txt > /var/www/code/u/ana/soln.txt",$output,$return);
			/*exec($gen_correct_output,$output,$return);		
			if($return ==1)
			{
				echo "returned 1 in ".$i." th iteration <br/> could run s file and was unable to generate the output";
				$flag=1;			
				break;
			}*/
			//$st=
			//exec("/var/www/code/u/ana/1 < /var/www/code/u/ana/in1.txt > /var/www/code/u/ana/usoln.txt",$output,$return);
			$input_file_loc=$install_directory."q/".$_POST['pid']."/i".$i;
			$output_file_loc=$install_directory."q/".$_POST['pid']."/o".$i;
			
			$gen_user_output=$user_folder.$_POST['pid']." < ".$input_file_loc.".txt > ".$user_folder."usoln.txt";
			$st=microtime();		
			//echo "<br/>".$gen_user_output."</br>";
			exec("timeout --signal=SIGKILL ".$tl."s ".$gen_user_output,$output,$return);
			//echo "timeout -signal=SIGKILL ".$tl."s ".$gen_user_output;
			$ft=microtime();
			$sum_of_time=$sum_of_time+$ft-$st;
			
			if($return!=0)
			{
				echo "time limit exceeded";
				$flag=2;
				break;
			}
			if($return ==1)
			{
				die( "returned 1 in ".$i." th iteration <br/> could not run user object code");
				$flag=1;			
				break;
			}
			//exec("diff /var/www/code/u/ana/usoln.txt /var/www/code/u/ana/soln.txt",$output,$return);
			$compare_usoln_soln="diff ".$user_folder."usoln.txt ".$output_file_loc.".txt";
			exec($compare_usoln_soln,$output,$return);
			if($return ==1)
			{
				echo "wrong answer";
				$flag=1;
				break;
			}
		}
		$sum_of_time=$sum_of_time/$i;
		$sum_of_time=round($sum_of_time/1000,2);
		echo $sum_of_time;
	}
	$final_status;
	$exec=mysql_query("SELECT * FROM $questions_table WHERE pid='$_POST[pid]'",$conn) or die("unable to fetch users solved".mysql_error());
	$row=mysql_fetch_array($exec);
	$u_solved=$row[$users_solved];
	$nos=$row['total_submission']+1;
	$prob_code=$row[$code];
	$exec=mysql_query("UPDATE $questions_table SET total_submission='$nos' WHERE $pid='$_POST[pid]'",$conn)or die("final status in Questions Table not updated".mysql_error());	
	$exec2=mysql_query("SELECT * FROM $contest_table WHERE $cid='$comp_id' ",$conn)or die("Unable to read start and end time from Contest Table".mysql_error());
	echo $comp_id;
	if(!$cont_row=mysql_fetch_array($exec2))
	{
		echo $cont_row['start_time'];
		die("contest start end time not fetched");
	}
	$current_t=date_format(date_create(), 'Y-m-d H:i:s');
	
	$exec=mysql_query("SELECT * FROM ranking WHERE cid='$comp_id' AND user='$_COOKIE[user]'",$conn)or die("Unable to read from Ranking Table".mysql_error());	
	
	//echo "(!".$rank."=mysql_fetch_array(".$exec.")) && ((".$cont_row['start_time']."<".$current_t.") && (".$current_t."<".$cont_row['end_time']."))";
	if((!$rank=mysql_fetch_array($exec)) && (($cont_row['start_time']<$current_t) && ($current_t<$cont_row['end_time'])))
	{
			$exec=mysql_query("INSERT INTO ranking (user,cid,points) VALUES ('$_COOKIE[user]','$comp_id','0')",$conn)or die("unable to insert new user in Ranking Table ".mysql_error());
	}
	else
	$user_points=$rank['points'];
	if($flag ==0)
	{	
		$final_status="AC";
		$u_solved=$u_solved+1;
		echo "<br/>Accepted<br/>";
		$exec=mysql_query("UPDATE $questions_table SET $users_solved='$u_solved' WHERE $pid='$_POST[pid]'",$conn)or die("final status in Questions Table not updated".mysql_error());
		$user_points=$user_points+1;
		$exec=mysql_query("SELECT * FROM $status_table WHERE $pid='$_POST[pid]' AND $user='$_COOKIE[user]' AND $status='AC' ",$conn)or die("Unable to read from Status Table".mysql_error());
		
		
		if((!$temp_row=mysql_fetch_array($exec)) && ($cont_row['start_time']<$current_t) && ($current_t<$cont_row['end_time']))
		$exec=mysql_query("UPDATE ranking SET points='$user_points' WHERE user='$_COOKIE[user]' AND cid='$comp_id'",$conn)or die("Unable to increase user points in ranking Table ".mysql_error());
	} 	
	else if($flag==1)
	{
			$final_status="WA";
	}
	else if($flag==2)
	{
			$final_status="TLE";
	}
	else if($flag==3)
		$final_status="Compile Error";
	
	$exec=mysql_query("UPDATE $status_table SET status='$final_status',code='$prob_code',time='$sum_of_time' WHERE $sno='$serial_number'",$conn)or die("final status not updated".mysql_error());
	mysql_close($conn);
	if(!$bad)
	header("Location:status.php");
?>
