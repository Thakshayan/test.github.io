<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/logo_title.png">
    
    <title>Srilanka Railway </title>
      <link href="admin/css/style.css" rel="stylesheet" type="text/css">
    <link href="admin/css/main.css" rel="stylesheet" type="text/css">
  </head>
  <body class="app">
    <div class='pos-a t-0 l-0 bgc-white w-100 h-100 d-f fxd-r fxw-w ai-c jc-c pos-r p-30'>
      <div class='mR-60'>
        <img alt='#' src='admin/assets/static/images/Tick_Mark_Dark-512.png' />
      </div>

      <div class='d-f jc-c fxd-c'>
        <h1 class='mB-30 fw-900 lh-1 c-green-500' style="font-size: 60px;">Success</h1>
        <h3 class='mB-10 fsz-lg c-grey-900 tt-c'><?php
            switch ($_GET["msg"]) {
              case 'complain':
                # code...
                echo "We received your Complain";
                break;
              case 'suggest':
                # code...
                echo "We received your Suggestion";
                break;
              default:
                # code...
                header("location:404.html");
                break;
            }
        ?>.</h3>
        <p class='mB-30 fsz-def c-grey-700'>We will take action soon.</p>
        <div>
          <a href="index.php" type='primary' class='btn btn-primary'>Go to Home</a>
        </div>
      </div>
    </div>
  </body>
</html>