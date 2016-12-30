<!DOCTYPE html>
<html>
<head>

  <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>

</head>
<body>
  <div class = "container">

    <div class = "title">
      <h2> Tipl </h2>
    </div>

    <div class = "contents">

  <?php
    $subtotalErr = "";
    $error = false;
    if(!is_numeric($_POST["subtotal"]) && $_POST) {
      $subtotalErr = "*Bill must be a number";
      $error = true;
    }
   ?>


  <form action="action_page.php" method ="post">

    Bill:
    <input type="text" name="subtotal" value = <?php if($_POST["subtotal"]) {echo $_POST["subtotal"];} else {echo 0;}; ?> >
    <span class="error"> <?php echo $subtotalErr;?></span>
    <br><br>
    Tip Percent:
    <br><br>

    <div class ="row">
      <div class="col s3"></div>

    <?php
      for ($x = 0.1; $x <= 0.20; $x += 0.05) {
        $xpercent = $x * 100;
        $word = "test" + (string)$x;
        echo "<div class='col s1'><input type='radio' name='tip' value='$x' id='$word'";
        if (!$_POST && $x == 0.1) {
          echo "checked";
        }
        $tip = number_format($_POST["tip"], 2);
         if(abs($_POST["tip"] - $x) < .01)
         {
           echo "checked";
           echo "><label for='$word'>$xpercent%</label>";
         }
         else {
           echo "><label for='$word'>$xpercent%</label>";
         }
         echo "</div>";
         echo "<div class = 'col s1'></div>";
      }
     ?>
   </div>


   <br><br>

   <button class="btn waves-effect waves-light" type="submit" name="action">Submit
 </button>
  </form>


<br><br>


<?php
 if (!$error && $_POST) {
   $subtotal = $_POST["subtotal"];
   $percent = $_POST["tip"];
   $tip = $subtotal * $percent;
   $total = $subtotal + $tip;
   echo "<div id = 'output'>";

     echo "<div class='row'>";

       echo "<div class='col s6'>";
       echo "Tip: $";
       echo $tip;
       echo "</div>";

       echo "<div class='col s6'>";
       echo "Total: $";
       echo $total;
       echo "</div>";


     echo "</div>";

   echo "</div>";
 } else if ($_POST) {
   echo "<span class = 'error'> One or more errors occured inputting form </span>" ;
 }
?>

    </div>

  </div>
</body>
</html>
