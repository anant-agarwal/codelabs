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
      <div class="logo"><a href="index.html"><img src="images/codelabs.png" width="232" height="74" border="0" alt="logo" /></a></div>
      <div class="clr"></div>
      <div class="menu">
        <ul>
					<li><a href="../main/" class="active"><span>Home</span></a></li>
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
    <div class="slider_main">
      <div class="leftt">
      <h2>Dive into programming.</h2>
          <p>Start coding right away!</p>
          <p><a href="contest.php" border="0">Contest Section</a></p>
<!--        <a href="#"><img src="images/view_port.gif" alt="picture" width="136" height="33" border="0" /></a>-->
            </div>
      <div id="slider">
        <!-- start slideshow -->
        <div id="slideshow">
          <div class="slider-item"><a href="#"><img src="images/simple_img_1.jpg" alt="icon" width="648" height="303" border="0" /></a></div>
          <div class="slider-item"><a href="#"><img src="images/simple_img_2.jpg" alt="icon" width="648" height="303" border="0" /></a></div>
          <div class="slider-item"><a href="#"><img src="images/simple_img_3.jpg" alt="icon" width="648" height="303" border="0" /></a></div>
        </div>
        <!-- end #slideshow -->
        <div class="controls-center">
          <h2 style="padding:15px 0px 0px 40px">Welcome to CodeLabs !!!</h2>
          <!--<p><a href="contests/current_contest.php">Click here to participate in the contest</a></p>-->
          <div id="slider_controls">
            <ul id="slider_nav">
              <li><a href="#"></a></li>
              <!-- Slide 1 -->
              <li><a href="#"></a></li>
              <!-- Slide 2 -->
              <li><a href="#"></a></li>
              <!-- Slide 3 -->
            </ul>
          </div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <!--<div class="main_left">
      <div class="search">
        <form id="form1" name="form1" method="post" action="">
          <p>Search: </p><label>
            <span>
            <input name="q" type="text" class="keywords" id="textfield" maxlength="50" value="" />
            </span>
            <input name="b" type="image" src="images/search.gif" class="button" />
          </label>
        </form>
        <div class="clr"></div>
      </div>
      <h2>News and Events<br />
        <span> Lorem ipsum dolor sit amet, consectetur </span> </h2>
      <p><span>12 Dec 2015 | <a href="#">0 comments</a></span><br />
        <strong>Duis nec porttitor lorem</strong><br />
        Mauris et nisi urna nonfaucibus lacus magna. </p>
      <p><span>18 Dec 2015 | <a href="#">5 comments</a></span><br />
        <strong>Aenean interdum</strong><br />
        Vestibulum ante ipsum primis into faucibus orci luctus ultrices antene posuere.</p>
      <p><span>4 Jan 2015 | <a href="#">2 comments</a></span><br />
        <strong>Integer vitae nisl</strong><br />
        Duis volutpat ligula laoreet orci lectus placerat <br />
        Curabitur lectus malesuada pulvinar.</p>
      <p><a href="#">More News »</a><br />
      </p>
      <h2>&nbsp;</h2>
      <h2>What They Say<br />
        <span>Lorem ipsum dolor sit amet, consectetur</span> </h2>
      <img src="images/test.gif" alt="picture" width="18" height="17" class="floated" />
      <p>&quot;Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse voluptas nulla pariatur?&quot;</p>
      <p><em><strong>by: John S., webdesigner</strong></em></p>
    </div>
    --><div class="main_right" style="width:100%">
      <div class="clr"></div>
      <div class="right_text">
        <p><strong>Features</strong></p>
      </div>
      <div class="clr"></div>
      <h2>Compete<br />
        <span> Compete with people all over the world and see where you stand </span> </h2>
      <p>We host a lot of contests thoroughout the year and provide you an opportunity to participate and compete with people all over the world. You can also see the problems of past contests and try solving them just for practice. All the contests will appear in Contests Tab. As soon as we fix a date for a contest it will appear in the Upcoming Contests so you can plan in advance and make sure that you are able to participate.  </p>
     <div class="bg"></div>
      <h2>Organize Contests<br />
        <span>Host Contests</span> </h2>
      <p>Looking forward to organize a contest?? we will be pleased to help you out .Just send us a mail or give us a call, you will be required to provide the problems and if there is no contest in the upcoming contests list on the date you want then we can have it on the date of your choice. </p>
      <div class="bg"></div>
      <h2>Algorithm Tutorials<br />
        <span>Just for you</span> </h2>
      <p>We have collected a good set of tutorials written by professional coders, the bookish knowledge not really helps much in coding and algorithm books are huge in size , so we offer you a set of chosen tutorials which can replace those books you have.</p>
		<div class="bg"></div>
	<h2>References<br />
        <span>At your Help</span> </h2>
      <p>Due to the wide variety of available functions,STL libraries,etc. no one can remember exact syntax of each function, so if you forget any then check them out here. We are placing the mirrors of sites used by us, you can choose your favourite out of these. </p>
     <div class="bg"></div>
     <!-- <img src="images/img_2.jpg" alt="picture" width="168" height="75" class="floated" />
      <p><a href="#"><strong>Optimal Design</strong></a><br />
        Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
      <p><a href="#">Read More »</a></p>-
      <div class="bg"></div>
      <img src="images/img_3.jpg" alt="picture" width="168" height="75" class="floated" />
      <p><a href="#"><strong>Power Design</strong></a><br />
        Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
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
