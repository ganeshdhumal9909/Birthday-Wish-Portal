<?php
session_start();
?>
<?php
include_once 'database.php';
date_default_timezone_set("Asia/Calcutta");
$date = date("y-m-d"); //Today date
$tdate = date("d-m-y"); //Today date
$tomorrow = date("Y-m-d", strtotime("+1 day"));
?>
<?php
$date = date("y-m-d"); 
// parse about any English textual datetime description into a Unix timestamp 
$ts = strtotime($date);
// find the year (ISO-8601 year number) and the current week
$year = date('o', $ts);
$week = date('W', $ts);
// print week for the current date

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Wish Portal | Current Week Bday</title>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  </head>
  </head>
  <body>
  <?php
if($_SESSION["name"]) {
?>
 <div class="container mt-3 bg-light">
            <div class="p-3 text-center">
              <div class="h2">Welcome to Wish Portal</div>
               <div class="container mt-3">
                  <ul class="nav justify-content-center nav-pills">
                     <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link active" href="week.php">Current Week Bday</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="students.php">All Students</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="staff.php">All Staff</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="logout.php" >Logout</a>
                     </li>
                  </ul>
               </div>
              </div>

              <div class="m-1 p-3">
            <table class="table table-sm table-responsive table-bordered table-hover text-center">
               <thead class="bg-light">
                  <h5>Current Week Students Birthday <?php echo $date ?> </h5>
                  <tr>
                     <th scope="col">First Name</th>
                     <th scope="col">Last Name</th>
                     <th scope="col">Mobile Number</th>
                     <th scope="col">Birth Date</th>
                     <th scope="col">Wish SMS</th>
                     <th scope="col">Student Photo</th>
                     <th scope="col">Send Wish</th>
                  </tr>
               </thead>
               <tbody>
               <?php
    		        for($i = 1; $i <= 7; $i++) {
                     // timestamp from ISO week date format
                     $ts = strtotime($year.'W'.$week.$i);
                    $dt = date("y-m-d", $ts);
                    $studentbday = mysqli_query($conn,"SELECT * FROM birthday where  DATE_FORMAT(Birth_Date, '%m-%d') = DATE_FORMAT('$dt', '%m-%d')");
    				$a=0;
    				while($row = mysqli_fetch_array($studentbday)) {
    				?>
                  <tr id="<?php echo $row["id"].$row["First_Name"];?>">
                     <td ><?php echo $row["First_Name"];?></td>
                     <td><?php echo $row["Last_Name"]; ?></td>
                     <td class="row-data"><?php echo $row["Mobile_Number"]; ?></td>
                     <td><?php echo $row["Birth_Date"]; ?></td>
                     <td class="row-data text-truncate" style="max-width: 100px;"><?php echo "Hi ".$row["First_Name"]."%0aI am from the design team of Acharya academy.%0aSince it is your birthday this week, I need a student photo to make a birthday design. Please send your photo here.%0aI will share birthday wish design once done%0a%0aRegards%0aDesign Team Acharya Academy"; ?></td>
                     <td><img src="<?php $baseur="https://drive.google.com/uc?export=view&id=";
                     if (strpos($row["Photo_URL"], 'https://drive.google.com') !== false) {
                      echo $baseur.substr($row["Photo_URL"], strpos($row["Photo_URL"], "=") + 1); 
                    }
                    else{
                      echo $row["Photo_URL"];
                    }
                      ?>" 
                      alt="No Pic" style="width: 50px; height: 40px" class="rounded-circle img-thumbnail"/></td>
                     <td ><input type="button" value="Ask Photo" onclick="sendmsg()" /></td>
                  </tr>
                  <?php 
                     $a++;
                     }
                    }
                     ?>	
               </tbody>
            </table>
           </div>

        </div>

        <script>
         function sendmsg() {
         	var rowId =
         		event.target.parentNode.parentNode.id;
         	var data = document.getElementById(rowId).querySelectorAll(".row-data");
         	var number = data[0].innerHTML;
         	var massage = data[1].innerHTML;
              window.open("https://wa.me/91"+number+"?text="+massage, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
         
            
         }
      </script>
   <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>


    <?php
}else {header("Location:login.php");}
?>
  </body>
</html>