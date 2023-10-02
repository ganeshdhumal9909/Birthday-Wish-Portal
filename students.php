<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Wish Portal | All Students</title>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
    <style>
    
    td
{
 max-width: 150px;
 overflow: hidden;
 text-overflow: ellipsis;
 white-space: nowrap;
}

    </style>




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
                        <a class="nav-link " href="week.php">Current Week Bday</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link active" href="students.php">All Students</a>
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

              <div class="mt-1 p-2">
            <table id="studenttable" class="table table-sm table-responsive table-bordered table-hover text-center">
            <div class="p-3">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addstudentmodal" class="btn btn-primary btn-sm">Add Student</a>
        </div>
               <thead class="bg-light">
                  <tr>
                    <th scope="col">ID</th>
                     <th scope="col">First Name</th>
                     <th scope="col">Last Name</th>
                     <th scope="col">Number</th>
                     <th scope="col">Birth Date</th>
                     <th scope="col">Father B_Date</th>
                     <th scope="col">Mother B_Date</th>
                     <th scope="col">Anni_Date</th>
                     <th scope="col">Photo Url</th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody> 
               </tbody>
            </table>
           </div>


        </div>

  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#studenttable').DataTable({
        scrollY:        true,
        scrollX:        true,
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [9]
          },

        ]
      });
    });



    $(document).on('submit', '#addstudent', function(e) {
      e.preventDefault();
      var fname = $('#fname').val();
      var lname = $('#lname').val();
      var mobile = $('#wpnumber').val();
      var bdate = $('#dateofbirth').val();
      var fbdate = $('#fdateofbirth').val();
      var mbdate = $('#mdateofbirth').val();
      var andate = $('#annidate').val();
      var purl = $('#photourl').val();
      if (fname != '' && lname != '' && mobile != '' && bdate != '') {
        $.ajax({
          url: "add_student.php",
          type: "post",
          data: {
            fname: fname,
            lname: lname,
            mobile: mobile,
            bdate: bdate,
            fbdate: fbdate,
            mbdate: mbdate,
            andate: andate,
            purl: purl
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              mytable = $('#studenttable').DataTable();
              mytable.draw();
              $('#addstudentmodal').modal('hide');
             $('#addstudentmodal').modal('hide');$('body').removeClass('modal-open');$('.modal-backdrop').remove();
             $('#addstudentmodal').on('hidden.bs.modal', function () { $(this).find('form').trigger('reset'); });
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });

    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#studenttable').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Are you sure want to delete this Student ? ")) {
        $.ajax({
          url: "delete_student.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              $("#" + id).closest('tr').remove();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    });


    $(document).on('submit', '#updatestudent', function(e) {
      e.preventDefault();
      var trid = $('#trid').val();
      var fname = $('#updatefname').val();
      var lname = $('#updatelname').val();
      var mobile = $('#updatewpnumber').val();
      var bdate = $('#updatedateofbirth').val();
      var fbdate = $('#updatefdateofbirth').val();
      var mbdate = $('#updatemdateofbirth').val();
      var andate = $('#updateannidate').val();
      var purl = $('#updatephotourl').val();
      var id = $('#id').val();
      if (fname != '' && lname != '' && mobile != '' && bdate != '') {
        $.ajax({
          url: "update_student.php",
          type: "post",
          data: {
            fname: fname,
            lname: lname,
            mobile: mobile,
            bdate: bdate,
            fbdate: fbdate,
            mbdate: mbdate,
            andate: andate,
            purl: purl,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#studenttable').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, fname, lname, mobile, bdate,fbdate,mbdate,andate,purl, button]);
              $('#updatestudentmodal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });


    
    $('#studenttable').on('click', '.editbtn ', function(event) {
      var table = $('#studenttable').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#updatestudentmodal').modal('show');

      $.ajax({
        url: "get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#updatefname').val(json.First_Name);
          $('#updatelname').val(json.Last_Name);
          $('#updatewpnumber').val(json.Mobile_Number);
          $('#updatedateofbirth').val(json.Birth_Date);
          $('#updatefdateofbirth').val(json.Father_Bdate);
          $('#updatemdateofbirth').val(json.Mother_Bdate);
          $('#updateannidate').val(json.Parrent_AniiDate);
          $('#updatephotourl').val(json.Photo_URL);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    }); 






    </script>
<!--add student modal-->
<div class="modal fade" id="addstudentmodal" tabindex="-1" aria-labelledby="addstudentmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addstudentmodalLabel">Add New Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> 
        <div class="alert alert-warning d-none"></div>

      <!--form-->
  <form id ="addstudent" class="row g-3">
      <div class="col-md-6">
        <label for="fname" class="form-label">First Name</label>
        <input type="text" class="form-control" id="fname" placeholder="Enter First Name">
      </div>
      <div class="col-md-6">
        <label for="lname" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name">
      </div>
      <div class="col-md-6">
        <label for="wpnumber" class="form-label">Whatsapp Number</label>
        <input type="text" class="form-control" id="wpnumber" placeholder="10 digit whatsapp Number">
      </div>
      <div class="col-md-6">
        <label for="photourl" class="form-label">Photo URL</label>
        <input type="text" class="form-control" id="photourl" placeholder="public google photo url">
      </div>
      <div class="col-md-6">
        <label for="dateofbirth" class="form-label">Date Of Birth</label>
        <input type="date" class="form-control" id="dateofbirth">
      </div>
      <div class="col-md-6">
        <label for="fdateofbirth" class="form-label">Father Date Of Birth</label>
        <input type="date" class="form-control" id="fdateofbirth">
      </div>
      <div class="col-md-6">
        <label for="mdateofbirth" class="form-label">Mother Date Of Birth</label>
        <input type="date" class="form-control" id="mdateofbirth">
      </div>
      <div class="col-md-6">
        <label for="annidate" class="form-label">Parent Anniversary Date</label>
        <input type="date" class="form-control" id="annidate">
      </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Student</button>
      </div>
    </form> 
    </div>
  </div>
</div>

<!--update modal-->
<div class="modal fade" id="updatestudentmodal" tabindex="-1" aria-labelledby="updatestudentmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatestudentmodalLabel">Update Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> 
        <div class="alert alert-warning d-none"></div>

      <!--form-->
  <form id ="updatestudent" class="row g-3">
  <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
      <div class="col-md-6">
        <label for="updatefname" class="form-label">First Name</label>
        <input type="text" class="form-control" id="updatefname" placeholder="Enter First Name">
      </div>
      <div class="col-md-6">
        <label for="updatelname" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="updatelname" placeholder="Enter Last Name">
      </div>
      <div class="col-md-6">
        <label for="updatewpnumber" class="form-label">Whatsapp Number</label>
        <input type="text" class="form-control" id="updatewpnumber" placeholder="10 digit whatsapp Number">
      </div>
      <div class="col-md-6">
        <label for="updatephotourl" class="form-label">Photo URL</label>
        <input type="text" class="form-control" id="updatephotourl" placeholder="public google photo url">
      </div>
      <div class="col-md-6">
        <label for="updatedateofbirth" class="form-label">Date Of Birth</label>
        <input type="date" class="form-control" id="updatedateofbirth">
      </div>
      <div class="col-md-6">
        <label for="updatefdateofbirth" class="form-label">Father Date Of Birth</label>
        <input type="date" class="form-control" id="updatefdateofbirth">
      </div>
      <div class="col-md-6">
        <label for="updatemdateofbirth" class="form-label">Mother Date Of Birth</label>
        <input type="date" class="form-control" id="updatemdateofbirth">
      </div>
      <div class="col-md-6">
        <label for="updateannidate" class="form-label">Parent Anniversary Date</label>
        <input type="date" class="form-control" id="updateannidate">
      </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Student</button>
      </div>
    </form> 
    </div>
  </div>
</div>





    <?php
}else {header("Location:login.php");}
?>
  </body>
</html>