<?php
    include_once 'autoloader.php'
?>
<footer class="footer">
    <div class="background_image" style="background-image:url(images/Footer.jpg);"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter">
                    <div class="newsletter_title_container text-center">
                        <div class="newsletter_title">Suggestion Box : give your ideas to improve...</div>
                        <div class="newsletter_subtitle">Suggest NOW!</div>
                    </div>
                    <div class="newsletter_form_container">
                        <form action="#" class="newsletter_form d-flex flex-md-row flex-column align-items-start justify-content-between" id="newsletter_form" method='POST'>
                            <div class="d-flex flex-md-row flex-column align-items-start justify-content-between">
                                <div><input type="text" class="newsletter_input newsletter_input_title inpt" id="newsletter_input_title" placeholder="Title" name='Title' required="required"><div class="input_border"></div></div>
                                <div><input type="text" class="newsletter_input newsletter_input_suggestion inpt" id="newsletter_input_suggestion" name='Suggestion' placeholder="Suggestion" required="required"><div class="input_border"></div></div>
                            </div>
                            <div><button class="newsletter_button" name='sug_submit' type='submit'>Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col text-center">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by VSST
</div>
</footer>
<?php
    if(isset($_POST['sug_submit'])){
        $title = $_POST['Title'];
        $suggestion = $_POST['Suggestion'];
       
        $errmsg = Passenger::makeSuggestion($title, $suggestion);
        
        if($errmsg == "success"){
            header("location:success.php?msg=suggest");
        }
    }
?>