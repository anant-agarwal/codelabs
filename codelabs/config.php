<?php
$server_name="localhost"; // apache server
$mysql_username="root";
$mysql_password="root";
$install_directory="/var/www/final/main/";
/***config of database****/
$database="spicode";

/***duration of login***/
$limit=30*60;			// i.e. 0.5 hour
/****config of user information table*****/
$user_info_table="users";	//table containing username,password,points
$username="username";		//field storing username
$pass="password";		//field storing password

/****config of Questions table *****/
$questions_table="question";	//table containing questions
$pid="pid";			//field having problem id
$code="code";			
$question="question";		//field having problem statement
$users_solved="users_solved";	//no. of users solved
$timelimit="timelimit";		//max time limit
$default_tl=3;			//default time limit

/***config of status table****/
$status_table="status";
$sno="sno";
$pid="pid";
$user="user";
//$code="code";
$status="status";
$lang="lang";
$user_code="user_code";

/****config of contest table ****/
$contest_table="contests";
$st="start_time";
$ft="end_time";
$name="name";
$comment="comment";
$cid="cid";
$start_pid="start_pid";
$noq="noq";

?>
