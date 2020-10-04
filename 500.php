<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="admin/css/style.css" rel="stylesheet" type="text/css">
    <link href="admin/css/main.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/logo_title.png">
    
    <title>Oops.. | Srilanka Railway </title>
  </head>
  <body class="app">
    <div class='pos-a t-0 l-0 bgc-white w-100 h-100 d-f fxd-r fxw-w ai-c jc-c pos-r p-30'>
      <div class='mR-60'>
        <img alt='#' src='admin/assets/static/images/500.png' />
      </div>

      <div class='d-f jc-c fxd-c'>
        <h1 class='mB-30 fw-900 lh-1 c-red-500' style="font-size: 60px;">500</h1>
        <h3 class='mB-10 fsz-lg c-grey-900 tt-c'>Need Attention.</h3>
        <p class='mB-30 fsz-def c-grey-700'><?php
            switch ($_GET["msg"]) {
              case '1123':
                # code...
                echo "Missing Stations to make schedule";
                break;
              case '1124':
                # code...
                echo "Station station not same as end Station";
                break;
              case '1127':
                # code...
                echo "First! You must select train and date.";
                break;
              case '1128':
                # code...
                echo "Oops Missing Page datas.";
                break;
              default:
                # code...
                header("location:404.php");
                break;
            }
        ?>.</p>
        <div>
          <a href="index.php" type='primary' class='btn btn-primary'>Go to Home</a>
        </div>
      </div>
    </div>
  </body>
</html>
