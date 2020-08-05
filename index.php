<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hangman</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body>



	

<div class="container-fluid">

<!-- header starts -->

<div class="row">

<div class="col-md-12 bg-light">
	<?php
	include("header.php");
	?>

</div>
</div>
<!-- header end -->
<div class="row">
	
<!-- menu start here -->
<div class="col-md-5 bg-danger">
	
</div>
	<div class="col-md-7 bg-danger">
<?php
		include ('config.php');
    include ('functions.php');
    if (isset($_POST['newWord'])) unset($_SESSION['answer']);
    if (!isset($_SESSION['answer']))
    {
        $_SESSION['attempts'] = 0;
        $answer = fetchWordArray($WORDLISTFILE);
        $_SESSION['answer'] = $answer;
        $_SESSION['hidden'] = hideCharacters($answer);
        echo 'Attempts remaining: '.($MAX_ATTEMPTS - $_SESSION['attempts']).'<br>';
    }else
    {
        if (isset ($_POST['userInput']))
        {
            $userInput = $_POST['userInput'];
            $_SESSION['hidden'] = checkAndReplace(strtolower($userInput), $_SESSION['hidden'], $_SESSION['answer']);
            checkGameOver($MAX_ATTEMPTS,$_SESSION['attempts'], $_SESSION['answer'],$_SESSION['hidden']);
        }
        ?>
          <div class="text-body">
                <h4><b>Attempts Remaining: <?php  $_SESSION['attempts'] = $_SESSION['attempts'] + 1;
        echo "<h4><b>".($MAX_ATTEMPTS - $_SESSION['attempts'])."</h4>";?></b></h4>


          </div>
<?php
    }
    $hidden = $_SESSION['hidden'];
    foreach ($hidden as $char) echo $char."  ";
?>
<script type="application/javascript">
    function validateInput()
    {
    var x=document.forms["inputForm"]["userInput"].value;
    if (x=="" || x==" ")
      {

          alert("Please enter a character.");
          return false;
      }
    if (!isNaN(x))
    {
        alert("Please enter a character.");
        return false;
    }
}
</script>

<form method="post" name="inputForm" action="">  
  <div class="form-group">
    <label for="email">Your Guess: </label>
    <input name = "userInput" type = "text" size="1" maxlength="1"  />
</div>
 <input type="submit" value="Check" onclick="return validateInput()" style="
    
    border width: initial;
    background: #d9dde0;
    text color: unset;
    text-color: #dc3545;
    border-block-end-width: turquoise;
    font-size: 20px;
    font-weight: bold;
    border-radius: 15px;
">
<input type="submit" name="newWord" value="Try another Word" style="
    background-color: #dee2e2;
    font-size: 20px;
    font-weight: bold;
    border-radius: 15px;
">
  </div>
 
	</div>
</div>


<div class="row" >

<div class="col-md-12 bg-light mt-2">
<?php  include("footer.php");?>
</div>
</div>
</div>
</body>
</html>


