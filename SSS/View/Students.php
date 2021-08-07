<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<div class="text-right p-3">
   <div class="text-center text-success">
            <h3>Student Details</h3>
    </div>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addstudent">New</button>
    <a href="#" class="btn btn-primary" >Edit</a>
    <a href="#" class="btn btn-danger" >Delete</a>
    </div>
     <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SI.No</th>
                <th>Register Number</th>
                <th>Name</th>
                <th>Date Of Birth</th>
                <th>Course</th>
                <th>Branch</th>
                <th>Year</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($data)) {  $i=0;?>
                <?php foreach($data as $student) { ?>
                    <tr>
                        <td><?php echo $i+1 ?></td>
                        <td><?php echo $student['regno']; ?></td>
                        <td><?php echo $student['sname']; ?></td>
                        <td><?php echo $student['dob']; ?></td>
                        <td><?php echo decrypt(base64_decode( $student['course']),"UcEnSsS"); ?></td>
                        <td><?php echo $student['branch']; ?></td>
                        <td><?php echo $student['syear']; ?></td>
                        <td><input type="checkbox" class="form-checkbox-control" id="checkbox" style="height:30px; width:30px" value="<?php echo $student['ID']  ?>"></th>
                    </tr>
                <?php $i++; } ?>
            <?php } ?>
        </tbody>
    </table>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example thead tr').clone(true).appendTo( '#example thead' );
    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search(this.value )
                    .draw();
            }
        } );
    } ); 
    var table = $('#example').DataTable( {
        orderCellsTop: true,
        searching: true,
        "scrollX": true
    } );
} );
</script>
<!-- The Modal -->
<div class="modal fade" id="addstudent">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><h1 class="text-center">STUDENT STATIONERY SHOP</h1></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <div class="container-fluid">
    <form  name="regform" method="post" class="needs-validation row p-5" novalidate>
    <div class="col-md-4">
            <label class="form-label ">Enter Student</label>
            <input type="text" name="stuname" class="form-control" value="<?php  if($id) ?>" ng-model="stuname" autocomplete="off" required>
            <span class="invalid-feedback">Please Enter UserName</span>
    </div>
    <div class="col-md-4">
            <label class="form-label">Enter Register Number</label>
            <input type="text" name="registerno" class="form-control" ng-model="registerno"  autocomplete="off" required>
            <span class="invalid-feedback">Please Register Number</span>
    </div>
    <div class="col-md-4">
            <label class="form-label">Enter Date of Birth</label>
            <input type="date" name="dob" class="form-control" ng-model="dob"  autocomplete="off" required>
            <span class="invalid-feedback">Please Date of Birth</span>
    </div>
    <div class="col-md-4">
            <label class="form-label">Select Course</label>
            <select class="form-control" name="course" ng-model="course"  ng-options="course for course in courseDetails" required>
                  <option  value="">Please Select</option>
             </select>
            <span class="invalid-feedback">Please Select Course</span>
    </div>
    <div class="col-md-4" >
            <label class="form-label" >Select Branch</label>
            <select class="form-control" name="branch" ng-model="branch"  required>    
            <option value="">Please Select</option>
            <option ng-if="course=='Bachelor of Engineering'"  ng-repeat="branchs in BecourseDetails" value="{{branchs}}">{{branchs}}</option>
            <option ng-if="course=='Bachelor of Technology'"  ng-repeat="branchs in BtechcourseDetails" value="{{branchs}}">{{branchs}}</option>
             </select>
   </div>
    <div class="col-md-4">
            <label class="form-label">Select Acadamic Year</label>
            <select class="form-control" name="year" ng-model="year" ng-options="year for year in ayear"  required>
                  <option value="">Please Select</option>
             </select>
            <span class="invalid-feedback">Please Acadamic Year</span>
    </div>
    <div class="col-md-4">
            <label class="form-label">Enter Email ID</label>
            <input type="email" name="email" ng-model="email"  class="form-control" autocomplete="off" required>
            <span class="invalid-feedback">Please Email ID</span>
    </div>
    <div class="col-md-4">
            <label class="form-label">Enter Phone Number</label>
            <input type="number" name="phoneno" class="form-control" ng-model="phoneno" name="phoneno" ng-maxlength="10" autocomplete="off" required>
            <span class="invalid-feedback">Please Enter Phone Number</span>
    </div>
    <div class="col-md-4">
            <label class="form-label">Enter Account Balance</label>
            <input type="number" name="balance" class="form-control" ng-model="balance" name="balance" ng-maxlength="10" autocomplete="off" required>
            <span class="invalid-feedback">Please Enter Account Balance</span>
    </div>
    <div class="col-md-12">
            <label class="form-label">Enter Address</label>
            <textarea name="stu_address" id="" ng-model="stu_address" cols="10" class="form-control" rows="3" required></textarea>
            <span class="invalid-feedback">Please Enter Student Address</span>
    </div>
    <div class="col-md-12 p-4 text-center">
         <input  type="submit" class="btn btn-success" name="submit" ng-click="insert()" value="Submit">  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
     </div>
    </form>
    </div>
    </div>
    </div>
    </div>
  </div>
</div>