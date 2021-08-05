<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<div class="text-right">
<a href="#" class="btn btn-success" >New</a>
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
                        <td><?php echo $student['course']; ?></td>
                        <td><?php echo $student['branch']; ?></td>
                        <td><?php echo $student['syear']; ?></td>
                        <td><input type="checkbox" class="form-checkbox-control" id="checkbox" height="40px" width="40px" value="<?php echo $student['ID']  ?>"></th>
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
        fixedHeader: true,
        searching: false
    } );
} );
</script>