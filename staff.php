<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Wish Portal | All Staff</title>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
    <style>
    td{
        max-width: 160px;
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
                        <a class="nav-link " href="students.php">All Students</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link active" href="staff.php">All Staff</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="logout.php" >Logout</a>
                     </li>
                  </ul>
               </div>
              </div>

              <div class="mt-1 p-5">
            <table id="stafftable" class="table table-sm table-responsive table-bordered table-hover text-center">
            <div class="p-3">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addstaffmodal" class="btn btn-primary btn-sm">Add Staff</a>
        </div>
               <thead class="bg-light">
                  <tr>
                    <th scope="col">ID</th>
                     <th scope="col">Staff Name</th>
                     <th scope="col">Staff Number</th>
                     <th scope="col">Birth Date</th>
                     <th scope="col">Anni_Date</th>
                     <th scope="col">Staff Photo Url</th>
                     <th scope="col">Anniversary Photo Url</th>
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
      $('#stafftable').DataTable({
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
          'url': 'fetch_staff_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [7]
          },

        ]
      });
    });



    $(document).on('submit', '#addstaff', function(e) {
      e.preventDefault();
      var sname = $('#sname').val();
      var snumber = $('#swpnumber').val();
      var sbdate = $('#sdateofbirth').val();
      var sandate = $('#sdateofanii').val();
      var surl = $('#sphotourl').val();
      var saurl = $('#saphotourl').val();
      if (sname != '' && snumber != '' && snumber != '' && sbdate != '') {
        $.ajax({
          url: "add_staff.php",
          type: "post",
          data: {
            sname: sname,
            snumber: snumber,
            sbdate: sbdate,
            sandate: sandate,
            surl: surl,
            saurl: saurl
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              mytable = $('#stafftable').DataTable();
              mytable.draw();
              $('#addstaffmodal').modal('hide');
             $('#addstaffmodal').modal('hide');$('body').removeClass('modal-open');$('.modal-backdrop').remove();
             $('#addstaffmodal').on('hidden.bs.modal', function () { $(this).find('form').trigger('reset'); });
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
      var table = $('#stafftable').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Are you sure want to delete this Staff ? ")) {
        $.ajax({
          url: "delete_staff.php",
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


    $(document).on('submit', '#updatestaff', function(e) {
      e.preventDefault();
      var trid = $('#trid').val();
      var sname = $('#updatesname').val();
      var snumber = $('#updateswpnumber').val();
      var sbdate = $('#updatesdateofbirth').val();
      var sandate = $('#updatesdateofanii').val();
      var surl = $('#updatesphotourl').val();
      var saurl = $('#updatesaphotourl').val();
      var id = $('#id').val();
      if (sname != '' && snumber != '' && snumber != '' && sbdate != '') {
        $.ajax({
          url: "update_staff.php",
          type: "post",
          data: {
            sname: sname,
            snumber: snumber,
            sbdate: sbdate,
            sandate: sandate,
            surl: surl,
            saurl: saurl,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#stafftable').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, sname, snumber, sbdate, sandate,surl,saurl, button]);
              $('#updatestaffmodal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });


    
    $('#stafftable').on('click', '.editbtn ', function(event) {
      var table = $('#stafftable').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#updatestaffmodal').modal('show');

      $.ajax({
        url: "get_single_staff_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#updatesname').val(json.Staff_Name);
          $('#updateswpnumber').val(json.Phone_Number);
          $('#updatesdateofbirth').val(json.Birthdate);
          $('#updatesdateofanii').val(json.staff_AniiDate);
          $('#updatesphotourl').val(json.Photo_URL);
          $('#updatesaphotourl').val(json.AnniPhoto_URL);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    }); 





    </script>
<!--add staff modal-->
<div class="modal fade" id="addstaffmodal" tabindex="-1" aria-labelledby="addstaffmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addstaffmodalLabel">Add New Staff</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> 
        <div class="alert alert-warning d-none"></div>

      <!--form-->
  <form id ="addstaff" class="row g-3">
      <div class="col-md-6">
        <label for="sname" class="form-label">Staff Name</label>
        <input type="text" class="form-control" id="sname" placeholder="Enter Staff Name">
      </div>
      <div class="col-md-6">
        <label for="swpnumber" class="form-label">Whatsapp Number</label>
        <input type="text" class="form-control" id="swpnumber" placeholder="10 digit whatsapp Number">
      </div>
      <div class="col-md-6">
        <label for="sphotourl" class="form-label">Staff Photo URL</label>
        <input type="text" class="form-control" id="sphotourl" placeholder="public google photo url">
      </div>
      <div class="col-md-6">
        <label for="sdateofbirth" class="form-label">Date Of Birth</label>
        <input type="date" class="form-control" id="sdateofbirth">
      </div>
      <div class="col-md-6">
        <label for="sphotourl" class="form-label">Anniversary Photo URL</label>
        <input type="text" class="form-control" id="saphotourl" placeholder="public google photo url">
      </div>
      <div class="col-md-6">
        <label for="sdateofanii" class="form-label">Date Of Anniversary</label>
        <input type="date" class="form-control" id="sdateofanii">
      </div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Staff</button>
      </div>
    </form> 
    </div>
  </div>
</div>

<!--update modal-->
<div class="modal fade" id="updatestaffmodal" tabindex="-1" aria-labelledby="updatestaffmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatestaffmodalLabel">Update Staff</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> 
        <div class="alert alert-warning d-none"></div>

      <!--form-->
      <form id ="updatestaff" class="row g-3">
      <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
      <div class="col-md-6">
        <label for="updatesname" class="form-label">Staff Name</label>
        <input type="text" class="form-control" id="updatesname" placeholder="Enter Staff Name">
      </div>
      <div class="col-md-6">
        <label for="updateswpnumber" class="form-label">Whatsapp Number</label>
        <input type="text" class="form-control" id="updateswpnumber" placeholder="10 digit whatsapp Number">
      </div>
      <div class="col-md-6">
        <label for="updatesphotourl" class="form-label">Staff Photo URL</label>
        <input type="text" class="form-control" id="updatesphotourl" placeholder="public google photo url">
      </div>
      <div class="col-md-6">
        <label for="updatesdateofbirth" class="form-label">Date Of Birth</label>
        <input type="date" class="form-control" id="updatesdateofbirth">
      </div>
      <div class="col-md-6">
        <label for="updatesphotourl" class="form-label">Anniversary Photo URL</label>
        <input type="text" class="form-control" id="updatesaphotourl" placeholder="public google photo url">
      </div>
      <div class="col-md-6">
        <label for="updatesdateofanii" class="form-label">Date Of Anniversary</label>
        <input type="date" class="form-control" id="updatesdateofanii">
      </div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Staff</button>
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