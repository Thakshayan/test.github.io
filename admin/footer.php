 <!-- ### $App Screen Footer ### -->
        <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
          <span>Copyright © 2020 Designed by CSE Mora. All rights reserved.</span>
            
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="0302f9e5c864f5de1eb577a7-text/javascript"></script>
<script type="0302f9e5c864f5de1eb577a7-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
</footer></div></div><script type="0302f9e5c864f5de1eb577a7-text/javascript" src="js/vendor.js"></script>
<script type="0302f9e5c864f5de1eb577a7-text/javascript" src="js/bundle.js"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="0302f9e5c864f5de1eb577a7-|49" defer=""></script>
<?php
  if ($ntfyCnt > 0 && !@$_SESSION['ntfyPlayed']) {
    echo '<script type="text/javascript"> playNotification('.$ntfyCnt.'); </script>';
    $_SESSION['ntfyPlayed'] = true;
    # code...
  }
?>
</body></html>
