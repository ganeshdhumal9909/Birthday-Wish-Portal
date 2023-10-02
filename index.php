<?php
   session_start();
   ?>
<?php
   include_once 'database.php';
   date_default_timezone_set("Asia/Calcutta");
   $date = date("y-m-d"); //Today date
   $tomorrow = date("Y-m-d", strtotime("+1 day"));
   $tostudentbday = mysqli_query($conn,"SELECT * FROM birthday where  DATE_FORMAT(Birth_Date, '%m-%d') = DATE_FORMAT('$tomorrow', '%m-%d')");//Select the birthday list
   $studentbday = mysqli_query($conn,"SELECT * FROM birthday where  DATE_FORMAT(Birth_Date, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   $fathersbday = mysqli_query($conn,"SELECT * FROM birthday where  DATE_FORMAT(Father_Bdate, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   $mothersbday = mysqli_query($conn,"SELECT * FROM birthday where  DATE_FORMAT(Mother_Bdate, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   $parentanii = mysqli_query($conn,"SELECT * FROM birthday where  DATE_FORMAT(Parrent_AniiDate, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   $staffbday = mysqli_query($conn,"SELECT * FROM staff where  DATE_FORMAT(Birthdate, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   $staffanii = mysqli_query($conn,"SELECT * FROM staff where  DATE_FORMAT(staff_AniiDate, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   ?>
<!doctype html>
<html lang="en">
   <head>
      <title>Wish Portal | Dashboard</title>
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
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="week.php">Current Week Bday</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="students.php">All Students</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="staff.php">All Staff</a>
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
                  <h5>Today's Students Birthday <?php echo $date ?> </h5>
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
                     $i=0;
                     while($row = mysqli_fetch_array($studentbday)) {
                     ?>
                  <tr id="<?php echo $row["id"].$row["First_Name"];?>">
                     <td ><?php echo $row["First_Name"];?></td>
                     <td><?php echo $row["Last_Name"]; ?></td>
                     <td class="row-data"><?php echo $row["Mobile_Number"]; ?></td>
                     <td><?php echo $row["Birth_Date"]; ?></td>
                     <td class="row-data text-truncate" style="max-width: 100px;"><?php echo "Hi ".$row["First_Name"]."%0a Wish you a very happy birthday. May all your dreams come true.%0aFrom 1729 acharya Academy,%0aBaramati"; ?></td>
                     <td><img src="<?php $baseur="https://drive.google.com/uc?export=view&id=";
                     if (strpos($row["Photo_URL"], 'https://drive.google.com') !== false) {
                      echo $baseur.substr($row["Photo_URL"], strpos($row["Photo_URL"], "=") + 1); 
                    }
                    else{
                      echo $row["Photo_URL"];
                    }
                      ?>" 
                      alt="No Pic" style="width: 50px; height: 40px" class="rounded-circle img-thumbnail"/></td>
                     <td ><input type="button" value="Send Wish" onclick="sendmsg()" /></td>
                  </tr>
                  <?php 
                     $i++;
                     }
                     ?>	
               </tbody>
            </table>
           </div>
          
           <div class="mt-2 p-3">
            <table class="table table-sm table-responsive table-bordered table-hover text-center">
               <thead class="bg-light">
                  <h5>Tomorrow's Students Birthday <?php echo date("d-m-y", strtotime("+1 day")); ?></h5>
                  <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col">Wish SMS</th>
                    <th scope="col">Student Photo</th>
                    <th scope="col">Ask Photo</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $i=0;
                     while($row = mysqli_fetch_array($tostudentbday)) {
                     ?>
                  <tr id="<?php echo $row["id"].$row["Mobile_Number"];?>">
                        <td ><?php echo $row["First_Name"];?></td>
                        <td><?php echo $row["Last_Name"]; ?></td>
                        <td class="row-data"><?php echo $row["Mobile_Number"]; ?></td>
                        <td><?php echo $row["Birth_Date"]; ?></td>
                     <td class="row-data text-truncate" style="max-width: 100px;"><?php echo "Hi ".$row["First_Name"]."%0aI am from the design team of Acharya academy.%0aSince it is your birthday tomorrow, I need a student photo to make a birthday design. Please send your photo here.%0aI will share birthday wish design once done%0a%0aRegards%0aDesign Team Acharya Academy"; ?></td>
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
                     $i++;
                     }
                     ?>	
               </tbody>
            </table>
           </div>
           
           <div class="mt-2 p-3">
            <table class="table table-sm table-responsive table-bordered table-hover text-center">
               <thead class="bg-light">
                  <h5>Today's Fathers Birthday <?php echo $date ?></h5>
                  <tr>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Mobile Number</th>
                  <th scope="col">Fathers Birth Date</th>
                  <th colspan=2 scope="col">Wish SMS</th>
                  <th scope="col">Send Wish</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $i=0;
                     while($row = mysqli_fetch_array($fathersbday)) {
                     ?>
                  <tr id="<?php echo $row["id"].$row["Father_Bdate"].$row["First_Name"];?>">
                        <td ><?php echo $row["First_Name"];?></td>
                        <td><?php echo $row["Last_Name"]; ?></td>
                        <td class="row-data"><?php echo $row["Mobile_Number"]; ?></td>
                        <td><?php echo $row["Father_Bdate"]; ?></td>
                     <td colspan=2 class="row-data text-truncate" style="max-width: 100px;"><?php echo "Respected ".$row["Last_Name"]." sir,%0aOn your birthday we wish you success and endless happiness!. Wishing you a happy birthday! %0aFrom Acharya Academy %0aBaramati"; ?></td>
                     <td ><input type="button" value="Send Wish" onclick="sendmsg()" /></td>
                  </tr>
                  <?php 
                     $i++;
                     }
                     ?>	
               </tbody>
            </table>
           </div>
            
           <div class="mt-2 p-3">
            <table class="table table-sm table-responsive table-bordered table-hover text-center">
               <thead class="bg-light">
                  <h5>Today's Mothers Birthday <?php echo $date ?> </h5>
                  <tr>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Mobile Number</th>
                  <th scope="col">Mothers Birth Date</th>
                  <th colspan=2 scope="col">Wish SMS</th>
                  <th scope="col">Send Wish</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $i=0;
                     while($row = mysqli_fetch_array($mothersbday)) {
                     ?>
                  <tr id="<?php echo $row["id"].$row["Mother_Bdate"].$row["Last_Name"];?>">
                        <td ><?php echo $row["First_Name"];?></td>
                        <td><?php echo $row["Last_Name"]; ?></td>
                        <td class="row-data"><?php echo $row["Mobile_Number"]; ?></td>
                        <td><?php echo $row["Mother_Bdate"]; ?></td>
                     <td colspan=2 class="row-data text-truncate" style="max-width: 100px;"><?php echo "Respected ".$row["Last_Name"]." Maam,%0aOn your birthday we wish you success and endless happiness!. Wishing you a happy birthday! %0aFrom Acharya Academy %0aBaramati"; ?></td>
                     <td ><input type="button" value="Send Wish" onclick="sendmsg()" /></td>
                  </tr>
                  <?php 
                     $i++;
                     }
                     ?>	
               </tbody>
            </table>
           </div>
             
           <div class="mt-2 p-3">
            <table class="table table-sm table-responsive table-bordered table-hover text-center">
               <thead class="bg-light">
                  <h5>Today's Parrents Anniversary <?php echo $date ?> </h5>
                  <tr>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Mobile Number</th>
                  <th scope="col">Parrents Anniversary Date</th>
                  <th colspan=2 scope="col">Wish SMS</th>
                  <th scope="col">Send Wish</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $i=0;
                     while($row = mysqli_fetch_array($parentanii)) {
                     ?>
                  <tr id="<?php echo $row["id"].$row["Parrent_AniiDate"];?>">
                        <td ><?php echo $row["First_Name"];?></td>
                        <td><?php echo $row["Last_Name"]; ?></td>
                        <td class="row-data"><?php echo $row["Mobile_Number"]; ?></td>
                        <td><?php echo $row["Parrent_AniiDate"]; ?></td>
                     <td colspan=2 class="row-data text-truncate" style="max-width: 100px;"><?php echo "Respected ".$row["Last_Name"]." sir and maam, %0aWishing a perfect pair a perfectly happy day.Happy Anniversary %0aFrom Acharya Academy %0aBaramati"; ?></td>
                     <td ><input type="button" value="Send Wish" onclick="sendmsg()" /></td>
                  </tr>
                  <?php 
                     $i++;
                     }
                     ?>	
               </tbody>
            </table>
           </div>
          
           <div class="mt-2 p-3">
            <table class="table table-sm table-responsive table-bordered table-hover text-center">
               <thead class="bg-light">
                  <h5>Today's Staff Birthday <?php echo $date ?>  </h5>
                  <tr>
                    <th scope="col">Staff Name</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Staff Birth Date</th>
                    <th scope="col">Wish SMS</th>
                    <th colspan=2 scope="col">Staff Photo</th>
                    <th scope="col">Send Wish</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $i=0;
                     while($row = mysqli_fetch_array($staffbday)) {
                     ?>
                  <tr id="<?php echo $row["id"].$row["Staff_Name"];?>">
                      <td ><?php echo $row["Staff_Name"];?></td>
                      <td class="row-data"><?php echo $row["Phone_Number"]; ?></td>
                      <td><?php echo $row["Birthdate"]; ?></td>
                      <td colspan=2 class="row-data text-truncate" style="max-width: 100px;"><?php echo "Respected ".$row["Staff_Name"]." sir/maam, %0aOn your birthday we wish you success and endless happiness!. Wishing you a happy birthday! %0aFrom Acharya Academy %0aBaramati"; ?></td>
                      <td><img src="<?php $baseur="https://drive.google.com/uc?export=view&id=";
                     if (strpos($row["Photo_URL"], 'https://drive.google.com') !== false) {
                      echo $baseur.substr($row["Photo_URL"], strpos($row["Photo_URL"], "=") + 1); 
                    }
                    else{
                      echo $row["Photo_URL"];
                    }
                      ?>" 
                      alt="No Pic" style="width: 50px; height: 40px" class="rounded-circle img-thumbnail"/></td>
                      <td ><input type="button" value="Send Wish" onclick="sendmsg()" /></td>
                  </tr>
                  <?php 
                     $i++;
                     }
                     ?>	
               </tbody>
            </table>
           </div>

           <div class="mt-2 p-3">
            <table class="table table-sm table-responsive table-bordered table-hover text-center">
               <thead class="bg-light">
                  <h5>Today's Staff Anniversary <?php echo $date ?></h5>
                  <tr>
                    <th scope="col">Staff Name</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Staff Anniversary Date</th>
                    <th scope="col">Wish SMS</th>
                    <th colspan=2 scope="col">Staff Photo</th>
                    <th scope="col">Send Wish</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $i=0;
                     while($row = mysqli_fetch_array($staffanii)) {
                     ?>
                  <tr id="<?php echo $row["id"].$row["Phone_Number"];?>">
                      <td ><?php echo $row["Staff_Name"];?></td>
                      <td class="row-data"><?php echo $row["Phone_Number"]; ?></td>
                      <td><?php echo $row["staff_AniiDate"]; ?></td>
                      <td colspan=2 class="row-data text-truncate" style="max-width: 100px;"><?php echo "Respected ".$row["Staff_Name"]." sir and maam, %0aWishing a perfect pair a perfectly happy day.Happy Anniversary %0aFrom Acharya Academy %0aBaramati"; ?></td>
                      <td><img src="<?php $baseur="https://drive.google.com/uc?export=view&id=";
                     if (strpos($row["AnniPhoto_URL"], 'https://drive.google.com') !== false) {
                      echo $baseur.substr($row["AnniPhoto_URL"], strpos($row["AnniPhoto_URL"], "=") + 1); 
                    }
                    else{
                      echo $row["AnniPhoto_URL"];
                    }
                      ?>" 
                      alt="No Pic" style="width: 50px; height: 40px" class="rounded-circle img-thumbnail"/></td>
                      <td ><input type="button" value="Send Wish" onclick="sendmsg()" /></td>
                  </tr>
                  <?php 
                     $i++;
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