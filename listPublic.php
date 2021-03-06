<?php 
session_start();


if (!isset($_SESSION['AUTH']))
{
    session_destroy();
    header('Location: signIn.html');
}

ini_set('display_errors',1);
        error_reporting(E_ALL);

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
          
          <a class="navbar-brand" href="index.html">Spot The Lot - City of Paterson</a>
        </div>
          
        <div class="navbar-collapse pull-right">
          <form class="navbar-form" role="form">
            
            <div class="button-group">
             
                <div class="dropdown-menu pull-right">
              
            </div>
                </div>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class='panel-heading'><h2><b>Properties you have entered</b></h2>

        <form class='navbar-form navbar-right' role='form'>
            <div class='form-group'>
                &nbsp;
                <a class="btn btn-success" href="splash.php">Return to full List</a>
            </div>
        </form>
        <form class='navbar-form navbar-left' role='form'>
            <div class='form-group'>
                &nbsp;
                <a class="btn btn-success" href="addPublicEntry.php">Add more</a>
            </div>
        </form>

    </div>
  
    <br><br><br>

    
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>property Listing</title>
</head>
<body>
<table>
<?php
        //header("Content-Type: text/html");

        ini_set('display_errors',1);
        error_reporting(E_ALL);

        

        //project db
        $sql=mysqli_connect("web178.webfaction.com","pytools","patersonDB","paterson");
       
        if(mysqli_connect_errno($sql))
        {
            print("<tr>
                        <td>Failed to connect to MySQL: " . mysqli_connect_error() . ";</td>
                        
                    </tr>");
        }
        else
        {
           // find all entries for user
            $query=mysqli_query($sql, "SELECT * 
                FROM PROPERTY WHERE LUSERID='$_SESSION[USERID]'
                ORDER BY `STREET` ASC 
            ");
            $rowtot = 0;
            while($row=mysqli_fetch_assoc($query)){
                $result[]=$row;
                $rowtot++;
            }

            if ( $rowtot > 0)
            { 
                ?>
                   <div class="table-responsive">
                        <table class="table">
                               <tr> <td></td>
                                    <td>Block</td>
                                    <td>Lot</td>
                                    <td>Ward</td>
                                    <td>Address</td>
                                    <td>Street</td>
                                    <td>Zip Code</td>
                                    <td>Boarded</td>
                                    <td>Sign Posted</td>
                                    <td>Descriptions</td>
                                    <td>Comments</td>
                                    <td>Photo</td>
                                </tr>
                
                    <?php
                    echo '<tr>';
                    foreach($result as $key=>$value){
                        if($_SESSION['USERID'] = $value["LUSERID"]){
                            $property_id = $value["PROPID"];
                            print("&nbsp;");
                        
                            echo '<tr>';
                            print("<td><a href='editEntry.php?property_id=".$value["PROPID"]."'>Edit</a>");

                            echo  '<td>',$value["BLOCK"],' </td>  <td>', $value["LOT"],'</td><td>',$value["WARD"],' </td>  <td>', $value["ADDRNUM"],'</td> <td>',$value["STREET"],'</td> <td>',$value["ZIP"],' </td>  <td>', $value["BOARDED"];
                            echo '</td><td>',$value["SPOST"],' </td>  <td>', $value["PDESC"],'</td>  <td>', $value["LCOMMENT"],'</td>';
                              
                                //----load image if available and modal----
                                if(!empty($value["PHOTOLOC"]) ){ 
                                    $string =array();
                                    $filePath=$value["PHOTOLOC"];  
                                    $dir = opendir($filePath);
                                    while ($file = readdir($dir)) { 
                                       if (preg_match("/.png/",$file) || preg_match("/.jpg/",$file) || preg_match("/.gif/",$file) || preg_match("/.bmp/",$file) || preg_match("/.jpeg/",$file)) { 
                                            $string[] = $file;
                                       }
                                    }
                                    while (sizeof($string) != 0){
                                      $img = array_pop($string);

                                    ?>


                                        <html>
                                        <div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Image</button>
                                                    
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><img src="<?php echo $filePath.$img; ?>"  width="400" height="200"></p>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                       
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                           
                                           
                                          <td><a data-toggle="modal" href="#imgModal"><img src="<?php echo $filePath.$img; ?>" width="30" height="30" ></a></td>
                                        </html>
                                    <?php
                                    }
                                    
                                } //---end image processing----------   
                                else{
                                   echo '<td></td>';
                                }
                            echo '<tr>';   
                        }
                    }
            }
            else
            {
                echo '<tr>
                        <td> No Records found</td>
                        </tr>';
            }
        }
    ?>
</table>
</body>

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
    <script>
      $(document).ready(function(){
           $('img').on('click',function(){
                var src = $(this).attr('src');
                var img = '<img src="' + src + '" class="img-responsive"/>';
                $('#imgModal').modal();
                $('#imgModal').on('shown.bs.modal', function(){
                    $('#imgModal .modal-body').html(img);
                });
                $('#mimgModal').on('hidden.bs.modal', function(){
                    $('#imgModal .modal-body').html('');
                });
           });  
        })</script>
    
  </body>
</html>