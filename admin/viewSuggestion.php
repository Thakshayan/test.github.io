<?php 
    include 'header.php';
    if($_SESSION['usertype'] != "admin"){
        header("location:404.php");
    }
?>
<main class='main-content bgc-grey-100'>
    <div id='mainContent'>
    <div class="container-fluid">
        <h4 class="c-grey-900 mT-10 mB-30">Home > View All Suggestions</h4>
        <div class="row">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">All Suggestions</h4>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Suggestion</th>
                    <th>Sugested D&T</th>          
                    <th>Delete</th>                    
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Suggestion</th>
                    <th>Sugested D&T</th>                  
                    <th>Delete</th>                   
                    </tr>
                </tfoot>
                <tbody>
                <?php 
                    $viewComplainObj = new Admin();
                    echo $viewComplainObj->viewSuggestion();
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