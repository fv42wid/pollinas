<?php
//if user lands on page without submitting vote, load random image
$imageID = 1; //as a default safety


//get the number of images in the database
//
$query = "SELECT COUNT(id) FROM images";
include('dbconnect.php');
$row = mysqli_fetch_assoc($execute);

$max_pictures = $row['COUNT(id)'];

$last_selection = "You have not voted";

$last_percentage = "You have not voted";


if(!isset($_POST['imageID'])) {
	//get random number
	
	$imageID = rand(1, $max_pictures);
	$query = "SELECT image FROM images WHERE id='$imageID'";
	include('dbconnect.php');
	$row = mysqli_fetch_assoc($execute);
	$database_image = $row['image'];
}



//if user submits vote, tally vote and load new image
if(isset($_POST['imageID'])) {
	$imageID = $_POST['imageID'];
	$vote = $_POST['vote'];
	
	if($vote == 'pollina') {
		$other_option = 'nipple';
	}else {
		$other_option = 'pollina';
	}
	
	//update votes
	$query = "UPDATE images SET $vote = $vote + 1 WHERE id='$imageID'";
	include('dbconnect.php');
	
	//calculate stats for previous image
	$query = "SELECT * FROM images WHERE id='$imageID'";
	include('dbconnect.php');
	$row = mysqli_fetch_assoc($execute);
	$old_image = $row['image'];
	$vote_tally = $row[$vote];
	$other_option_tally = $row[$other_option];
	
	if($vote_tally + $other_option_tally == 0) {
		$percentage = 0;
	} else {
		$percentage = $vote_tally / ($vote_tally + $other_option_tally);
	}
	$percentage = round($percentage * 100);
		
	//get the new image
	if($imageID == $max_pictures) {
		$imageID = 1;
	} else {
		$imageID++;
	}
	$query = "SELECT image FROM images WHERE id='$imageID'";
	include('dbconnect.php');
	$row = mysqli_fetch_assoc($execute);
	$database_image = $row['image'];
	
	
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pollinas.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 20px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      #wrapper {
      	width: 600px;
      	margin-right: auto;
      	margin-left:auto;
      }
      #header_div {
      	width: 350px;
      	margin-right: auto;
      	margin-left: auto;
      }
      #top_cell {
      	vertical-align: top;
      }
      #right_cell {
      	text-align: right;
      }
      /* changed with from 300 to 225 to fit on screen */
      #main_image {
      	margin-top: 10px;
      	width: 225px;
      	margin-right: auto;
      	margin-left: auto;
      }
      #form_div {
      	width: 500px;
      	text-align: center;
      	margin-right: auto;
      	margin-left: auto;
      }
      #button_div {
      	width: 400px;
      	margin-left: auto;
      	margin-right: auto;
      }
      #button_table {
      	width: 100%;
      }
      .button_cell {
      	text-align: center;
      }
      #results {
      	width: 400;
      	margin-top: 5px;
      	margin-right: auto;
      	margin-left:auto;
      	text-align: center;
      }
      #last_image_div {
      	width: 70px;
      	height: 70px;
      	margin-left: auto;
      	margin-right: auto;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <!-- NOT USING THIS STUFF!!!
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  -->
  </head>

  <body>
	<!-- 
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php">Pollinas.com</a>
          <div class="nav-collapse collapse">
            <!-- NO NAVIGATION!!!
            <ul class="nav">
              <li><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
            -->
          </div><!--/.nav-collapse
        </div>
      </div>
    </div>
	-->
    <div class="container">
	<div id="wrapper">
		<div id="header_div">
      		<img src="collateral/Pollinaslogo.jpg" alt="Logo" width="500px">
      	</div>
      <table>
      <tr>
      	<th id="top_cell"><a href="http://www.urbandictionary.com/define.php?term=pollina" alt="Urban Dictionary">Pollinas:</a></th>
      	<td>
      	Term referring to the size of a man's nipples that can be described as 'circus freak'.
      	</td>
      </tr>
      <tr>
      	<td></td>
      	<td id="right_cell"><!-- <a href="http://www.urbandictionary.com/define.php?term=pollina" alt="">Urban Dictionary</a>--></td>
      </tr>
      
      </table>
      
      <div id="main_image">
      	<!-- <img src="http://placehold.it/450x450" alt="Rate this picture">-->
      	<img src="<?php echo "data:image/jpeg;base64," . base64_encode($database_image); ?>" alt="Rate this picture">
      	<br>
      </div>
      <div id="form_div">
      	<h4>Is the image above a "Pollina" or just a "Nipple"?</h4>
      </div>
      <div id="button_div">
      
      <!-- 
      Use two different forms, each with a hidden value to indicate
      which button is clicked.  The form handling at the top will
      decifer which button is clicked after submitting.
      
       -->
      
      	<table id="button_table">
      	<tr>
      	
      	<td class="button_cell">
      	<form method="post" action="index.php">
      	<input type="hidden" name="imageID" value="<?php echo $imageID; ?>">
      	<input type="hidden" name="vote" value="pollina">
      	<button class="btn btn-danger" name="submit" value="true">Pollina</button>
      	</form>
      	</td>
      	<td class="button_cell">OR</td>
      	<td class="button_cell">
      	<form method="post" action="index.php">
      	<input type="hidden" name="imageID" value="<?php echo $imageID; ?>">
      	<input type="hidden" name="vote" value="nipple">
      	<button class="btn btn-primary" name-"submit" value="true">Nipple</button>
      	</form>
      	</td class="button_cell">
      	
      	
      	</tr>
      	
      	</table>
      
      </div>
      
      <div id="results">
      	<!-- 
      	Paragraphs below are placeholders.  Actual data will
      	need to come from form processing.
      	
      	 -->
	      <p>
	      <?php 
	      if(isset($vote)) {
	      ?>
	      You said the last image was a <?php echo ucfirst($vote); 
	      } else {
	      	echo $last_selection;
	      }
	      ?>.
	      </p>
	      
	      <p>
	      
	      <?php 
	      if(isset($percentage)) {
	      echo $percentage; ?>% of people said the last image was a <?php echo ucfirst($vote); 
	      } else {
	      	echo $last_percentage;
	      }
	      ?>.
	      </p>
	      <?php 
	      if(isset($old_image)) {
	      ?>
	      <div id="last_image_div">
	      <img src="<?php echo "data:image/jpeg;base64," . base64_encode($old_image); ?>" src="Last Image" width="70px" height="70px">
	      <?php 
	      }
	      ?>
      	  </div>	
      <br><br>
      </div>
      
      
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
