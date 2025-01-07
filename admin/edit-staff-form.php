<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Mao System Admin</title>
<link rel="icon" type="image/png" href="../img/Mabini-Logo.ico" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/fullcalendar.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html"></a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->

<!--sidebar-menu-->
<?php $page='staff-management'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "gymnsb";
 
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 
 // Check connection
 if ($conn->connect_error) {
     echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
     exit;
 }
$id=$_GET['id'];
$qry= "select * from staffs where user_id='$id'";
$result=mysqli_query($conn,$qry);
while($row=mysqli_fetch_array($result)){
?> 

<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="index.php" title="Go to Home" class="tip-bottom">
        <i class="fas fa-home"></i> Home
      </a>
      <a href="staffs.php" class="tip-bottom">Staffs</a>
      <a href="edit-staff-form.php" class="current">Edit Staff Records</a>
    </div>
    <h1 class="text-center">Update Staff's Detail <i class="fas fa-briefcase"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid justify-content-center">
      <div class="col-md-8">
        <div class="widget-box modern-widget-box">
          <div class="widget-title">
            <h5>Staff Details</h5>
          </div>
          <div class="widget-content">
            <form action="edit-staff-req.php" method="POST" class="form-horizontal">
              <!-- Full Name -->
              <div class="form-group">
                <label for="fullname" class="form-label">Full Name:</label>
                <input type="text" class="form-input" name="fullname" id="fullname" value='<?php echo $row['fullname']; ?>' />
              </div>

              <!-- Username -->
              <div class="form-group">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-input" name="username" id="username" value='<?php echo $row['username']; ?>' />
              </div>

              <!-- Password -->
              <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-input" name="password" id="password" disabled="" placeholder="**********" />
                <small class="help-text">Note: Only members can change their password unless it's an emergency.</small>
              </div>

              <!-- Gender -->
              <div class="form-group">
                <label for="gender" class="form-label">Gender:</label>
                <input type="text" class="form-input" name="gender" id="gender" value='<?php echo $row['gender']; ?>' />
              </div>

              <!-- Hidden ID -->
              <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>">

              <!-- Submit Button -->
              <div class="form-actions text-center">
                <button type="submit" class="btn btn-modern">Update Staff Details</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add the following CSS styles for modern UI -->
<style>
  /* Center the form */
  .row-fluid {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  /* Form container box */
  .modern-widget-box {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background: #fff;
    padding: 20px;
  }

  .widget-title h5 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
  }

  /* Input styles */
  .form-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box;
    margin-bottom: 15px;
    transition: border-color 0.3s ease;
  }

  .form-input:focus {
    border-color: #4caf50;
    outline: none;
  }

  .form-label {
    font-weight: 600;
    margin-bottom: 8px;
  }

  .help-text {
    font-size: 14px;
    color: #666;
    margin-top: 5px;
  }

  /* Button styles */
  .btn-modern {
    background-color: #4caf50;
    color: white;
    padding: 12px 30px;
    font-size: 16px;
    border-radius: 50px;
    border: none;
    transition: background-color 0.3s ease;
  }

  .btn-modern:hover {
    background-color: #45a049;
    cursor: pointer;
  }

  .form-actions {
    margin-top: 20px;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .col-md-8 {
      width: 100%;
      padding: 0 15px;
    }
  }
</style>


  

  
<?php
}
?>

  
  <div class="row-fluid">
   
  </div>
</div>




<style>
#footer {
  color: white;
}
</style>
<!--end-Footer-part-->

<script src="../js/excanvas.min.js"></script> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.flot.min.js"></script> 
<script src="../js/jquery.flot.resize.min.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/fullcalendar.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/jquery.gritter.min.js"></script> 
<script src="../js/matrix.chat.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/matrix.form_validation.js"></script> 
<script src="../js/jquery.wizard.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.popover.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>