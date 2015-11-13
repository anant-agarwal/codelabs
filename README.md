####REQUIREMENTS
------------

First you must have the base environment for CodeLabs.
Read the following sections to create a base environment and Install CodeLabs


####SERVER CONFIGURATION
--------------------

You should have a LAMP(Linux+Apache+MySql+Php) server running on your system 

Apache	-> http://www.apache.org
MySQL	-> http://www.mysql.com
PHP	-> http://www.php.net

To set up a LAMP server execute these commands in the linux shell:

apt-get install apache2 php5 libapache2-mod-php5 
apt-get install mysql-server mysql-client php5-mysql
apt-get install phpmyadmin

If you get any errors try searching online.

Go to localhost/phpmyadmin and put your username as "root" and for password try "root" or ""
checkout which one works and remember it. 

####INSTALLATION
------------

1. COPY CodeLabs
	Copy the folder named Codelabs into a directory within your web server's document
	root or your public HTML directory e.g.
	 
	$ cp Codelabs /var/www/ -R

	Grant Read Write Execute Permissions to Codelabs e.g.

	$ chmod 777 -R /var/www/Codelabs


2. CREATE THE CodeLabs! DATABASE

	CodeLabs! uses MySQL for Database support.You will have to create
	the codelabs database. Open the Codelabs directory and find a codelabs.sql
	file.Open phpmyadmin and create a database named spicode.Open this Databse 
	and you will find a Import option on Top right hand side.
	Click import and choose codelabs.sql file and click Go.  

3. CONFIGURE CodeLabs
	In the directory Codelabs find a file named config.php,open that file
	and change 
	$server_name to your website name
	$mysql_username to your mysql username
	$mysql_password to your mysql password
	$install_directory to the address where you have copied the Codelabs directory.
	
	Others variables need not be changed but are provided for flexibility.
	
	Congratulations!! CodeLabs is now installed and you host and organise contests.
	 
	You can now launch your browser and point it to your CodeLabs! site e.g.

	http://www.mysite.com/Codelabs



####CodeLabs! ADMINISTRATION
----------------------

To create a new contest go to create_contest.php
fill in the details required 
a unique contest id will be generated use this contest id 
while uploading the problems upload the test cases in zip file 
name the input test files as i1.txt,i2.txt,....i10.txt.
 
To add more tutorials go to Codelabs/main/tutorials and copy 
the mirror there and corresponding image in images directory
also update its link in tutorial.html

To add more References perform same as above in referneces folder.
