<?php
header( 'Content-type: text/html; charset=utf-8' );
// Start a session for error reporting
session_start();
if (!isset($_SESSION['AUTH']))
{
    session_destroy();
    header('Location: signIn.html');
}

//Connection to project website
$sql=mysqli_connect("web178.webfaction.com","pytools","patersonDB","paterson");



// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


date_default_timezone_set('America/New_York');
$date = date("Y-m-d");

//check al least address was entered
if (($_POST['inputStreet'] && $_POST['inputAddrNum'] )!= "") {
//insert 
$insert="INSERT INTO PROPERTY (BLOCK, LOT, WARD, ADDRNUM, STREET, ZIP, BOARDED, SPOST, PDESC, LCOMMENT, LDATE, LUSERID) VALUES ('$_POST[inputBlock]', '$_POST[inputLot]', '$_POST[inputWard]', '$_POST[inputAddrNum]' , '$_POST[inputStreet]','$_POST[inputZip]','$_POST[inputBoarded]','$_POST[inputSign]','$_POST[inputDescription]','$_POST[inputComments]','$date', '$_SESSION[USERID]')";
}
else
{
    $_SESSION['error'] = "You must enter address and street";
    header("Location: addPublicEntry.php");
}

if (!mysqli_query($sql,$insert))
  {
  die('Error: ' . mysqli_error($sql));
  }

imageUpload();


function imageUpload(){
   //---------------image handling--------------------------------------------

    // Get our POSTed variables
   //$image = $_FILES['image']['name'];
   
   //----------file handling-----------
    //check if there is a image
    if ($_FILES['image']['size']['0'] != "0" ){
     //Connection to project website
      $sql=mysqli_connect("web178.webfaction.com","pytools","patersonDB","paterson");
      //takes multiple files
      for($i=0; $i<count($_FILES['image']['name']); $i++){
        //get property id for folder name;
        $result = mysqli_query($sql, "SELECT * FROM PROPERTY WHERE  LUSERID='$_SESSION[USERID]' AND ADDRNUM='$_POST[inputAddrNum]' AND STREET='$_POST[inputStreet]'");
        $row = mysqli_fetch_array($result);
        $FOLDER = $row['PROPID'];
        
        // This variable is the path to the image folder where all the images are going to be stored
        // Note that there is a trailing forward slash
        $TARGET_PATH = "images/".$FOLDER."/";
        $FOLDER_PATH = $TARGET_PATH;
        
        // If path doesn't exist make directory
        if(!is_dir($TARGET_PATH)) 
        {
          mkdir($TARGET_PATH);
        }
        
        

          // Build our target path full string.  This is where the file will be moved do
          $TARGET_PATH .= $_FILES['image']['name'][$i];
          
          

          // Check to make sure that our file is actually an image
          // You check the file type instead of the extension because the extension can easily be faked
          if (($_FILES['image']['type'][$i] != 'image/gif')
              && ($_FILES['image']['type'][$i]  != 'image/jpeg')
              && ($_FILES['image']['type'][$i]  != 'image/jpg')
              && ($_FILES['image']['type'][$i]  != "image/bmp")
              && ($_FILES['image']['type'][$i]  != "image/png"))
          {
              $_SESSION['error'] = "Only jpeg, gif, png or bmp alre allowed";
              echo $_FILES['image']['name'][$i];
              echo "not valid type";
             // header("Location: editEntry.php");
              exit;
          }

          // Check to see if a file with that name already exists
          // You could get past filename problems by appending a timestamp to the filename and then continuing
          if (file_exists($TARGET_PATH))
          {
              $_SESSION['error'] = "A file with that name already exists";
            //header("Location: editEntry.php");
              echo "name already exists";
              exit;
          }

          // Lets attempt to move the file from its temporary directory to its new home
          if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $TARGET_PATH))
          {
            // We are *not* putting the image into the database; we are putting a reference to the file's location on the server
            $insertImage = "UPDATE PROPERTY SET PHOTOLOC='$FOLDER_PATH' WHERE  LUSERID='$_SESSION[USERID]' AND ADDRNUM='$_POST[inputAddrNum]' AND STREET='$_POST[inputStreet]'";
            
            if (!mysqli_query($sql,$insertImage))
              {
              die('Error: ' . mysqli_error($sql));
              }
          }
          else
          {
              // A common cause of file moving failures is because of bad permissions on the directory attempting to be written to
              // Make sure you chmod the directory to be writeable
              $_SESSION['error'] = "Could not upload file.  Check read/write persmissions on the directory";

              //header("Location: editEntry.php");
              exit;
          }
      }//end of for loop multiple images
      header("Location: splashPublic.php");
      exit;
    }//end file handling
    else
    {
       
        header("Location: splashPublic.php");
    }
}
// Just a short function that prints out the contents of an array in a manner that's easy to read
    // I used this function during debugging but it serves no purpose at run time for this example
    function showContents($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    
//clearcache so we check multiple times
    clearstatcache();
//-----------------end image handling----------------------------------

/* close connection */
mysqli_close($sql);
?>