<?php 
    include 'header.php';
    if($_SESSION['usertype'] != "admin"){
        header("location:404.php");
    }
?>
<main class='main-content bgc-grey-100'>
    <div id='mainContent'>
    <div class="container-fluid">
        <h4 class="c-grey-900 mT-10 mB-30">Home > View All Complains</h4>
        <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">All Complians</h4>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Station Name</th>
                    <th>Title</th>
                    <th>Complain</th>
                    <th>Complain Time</th> 
                    <th>Mark as Archieve</th>                    
                    <th>Delete</th>                    
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>ID</th>
                    <th>Station Name</th>
                    <th>Title</th>
                    <th>Complain</th>
                    <th>Complain Time</th> 
                    <th>Mark as Archieve</th>                    
                    <th>Delete</th>                 
                    </tr>
                </tfoot>
                <tbody>
                <?php 
                    $viewComplainObj = new Admin();
                    echo $viewComplainObj->viewComplains();
                ?>
                </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    </div>
</main>
<script src="js/ajaxfunctions.js" type="text/javascript"></script>
<?php 
    include 'footer.php';
?>