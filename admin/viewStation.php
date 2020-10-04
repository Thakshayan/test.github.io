<?php 
    include 'header.php';
    if($_SESSION['usertype'] != "admin"){
        header("location:404.php");
    }
?>
<main class='main-content bgc-grey-100'>
    <div id='mainContent'>
    <div class="container-fluid">
        <h4 class="c-grey-900 mT-10 mB-30">Home > View All Stations</h4>
        <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">All Stations</h4>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>Account Name</th>
                    <th>Station Name</th>
                    <th>Lattitude</th>
                    <th>Longitude</th>
                    <th>Edit</th>                    
                    <th>Delete</th>                    
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>Account Name</th>
                    <th>Station Name</th>
                    <th>Lattitude</th>
                    <th>Longitude</th>
                    <th>Edit</th>                   
                    <th>Delete</th>                   
                    </tr>
                </tfoot>
                <tbody>
                <?php 
                    $viewStaion = new Admin();
                    echo $viewStaion->viewStations();
                ?>
                </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    </div>
</main>
<script>
    function deleteStation(idx){
        if(confirm("Are You sure want to delete ??")){
            $.ajax({
                type : "POST",
                url : "delete.php",
                data : {identity : idx, category: "station"},
                cache:false,
                success:function(hlo){
                    window.location.href.substr(0, window.location.href.indexOf('#'))
                    location.reload();
                }   
            });
        }
    }
</script>
<?php 
    include 'footer.php';
?>