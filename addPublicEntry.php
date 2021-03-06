<?php
//variables for mysql
session_start();
if (!isset($_SESSION['AUTH']))
{
    session_destroy();
    header('Location: signIn.html');
}
function clean_data($input) {
    $input = trim(htmlentities(strip_tags($input,",")));
 
    if (get_magic_quotes_gpc())
        $input = stripslashes($input);
 
    $input = mysql_real_escape_string($input);
 
    return $input;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $BLOCK = clean_data($_POST["inputBlock"]);
      $LOT = clean_data($_POST["inputLot"]);
      $WARD = clean_data($_POST["inputWard"]);
      $ADDRNUM = clean_data($_POST["AddrNum"]);
      $STREET = clean_data($_POST["inputStreet"]);
      $ZIP = clean_data($_POST["inputZip"]);
      $BOARDED= clean_data($_POST["inputBoarded"]);
      $SPOST = clean_data($_POST["inputSign"]);
      $PDESC = clean_data($_POST["inputDescription"]);
      $LCOMMENT = clean_data($_POST["inputComments"]);


      //goes to edit page and keeps the back button from resubmitting
      header("Location: editEntry.php");
      exit;
}


	$SIGNSEL = "<select class='form-control' name='inputSign'><option value='1' ";
	if ( $SPOST == 1)
	{
		$SIGNSEL .= " selected";
	}
	$SIGNSEL .= ">Yes</option>";
	$SIGNSEL .= "<option value='2' ";
	if ( $SPOST == 2)
	{
		$SIGNSEL .= " selected";
	}
	$SIGNSEL .= ">No</option></select>";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Spot The Lot - City of Paterson</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/bootstrap-switch.css" rel="stylesheet">
  </head>

  <body>

    <div class="navbar navbar-default navbar" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="splash.php">Spot The Lot - City of Paterson</a>
        </div>
      </div>
    </div><!--/.navbar-collapse -->

    


    <!-- Main  -->
    

    <div class="container">
      <div class="row">
        <br>
        <a href="splashPublic.php">Go back... </a>  
      </div>  



      <div class="row">
          <form action="upload.php" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

           
            
              <div class="form-group">
                <label for="inputBlock" class="col-sm-2 control-label">Block</label>
                <div class="col-sm-6">
                  <input  class="form-control" id="inputBlock" name="inputBlock" type="text" placeholder="Block">
                </div>
              </div>

              <div class="form-group">
                <label for="inputLot" class="col-sm-2 control-label">Lot</label>
                <div class="col-sm-6">
                    <input  class="form-control" id="inputLot" name="inputLot" placeholder="Lot">
                  </div>
              </div>

              <div class="form-group">
                <label for="inputWard" class="col-sm-2 control-label">Ward</label>
                <div class="col-sm-6">
                  <input class="form-control" id="inputWard" name="inputWard" placeholder="Ward">
                </div>
              </div>
				
              <div class="form-group">
                <label for="inputAddrNum" class="col-sm-2 control-label">Address Number</label>
                <div class="col-sm-6">
                  <input class="form-control" id="inputAddrNum" name="inputAddrNum" placeholder="Address Number">
                </div>
              </div>
              
              <div class="form-group">
                <label for="inputStreet" class="col-sm-2 control-label">Street</label>
                <div class="col-sm-6">
                  <input class="form-control" id="inputStreet" name="inputStreet" placeholder="Street">
                </div>
              </div>

              <div class="form-group">
                <label for="inputZip" class="col-xs-2 control-label">Zip code</label>
                <div class="col-xs-3">
                  <input  class="form-control" id="inputZip" name="inputZip" placeholder="Zip Code">
                </div>
              </div>

              <div class="form-group">
                <label for="inputBoarded" class="col-xs-2 control-label">Boarded</label>
                <div class="col-xs-2">
					<select class='form-control' name='inputBoarded'>
						<option value='1'>Yes</option>;
						<option value='2'>No</option>
					</select>
                </div>
              </div>

              <div class="form-group">
                <label for="inputSign" class="col-xs-2 control-label">Sign</label>
                <div class="col-xs-2">
					<select class='form-control' name='inputSign'>
						<option value='1'>Yes</option>;
						<option value='2'>No</option>
					</select>
                </div>
              </div>
                
              <div class="form-group">
                <label for="inputDescription" class="col-sm-2 control-label">Property Description</label>
                <div class="col-sm-6">
                  <textarea rows='7' cols='60' class='form-control' id='inputDescription' name='inputDescription' placeholder='Property Description'><?php echo "$PDESC" ?></textarea>
                </div>
              </div>

                <div class="form-group">
                <label for="inputComments" class="col-sm-2 control-label">Comments</label>
                <div class="col-sm-6">
                  <textarea rows='7' cols='60' class='form-control' id='inputComments' name='inputComments' placeholder='Comments'><?php echo "$LCOMMENT" ?></textarea>				
                </div>
              </div>
                   <p>File <input type="file" multiple name="image[]"><p>
                   <input TYPE="submit" name="upload" title="Add data to the Database" value="submit"/>           
            </div>
          </form><!--form collapse-->
      </div>    
    </div> 





      <hr>

      <footer>
        <p>&copy; 2014</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-switch.js"></script>

    
  </body>
</html>
