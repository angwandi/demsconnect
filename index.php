<?php // index.php
session_start();
require_once 'header.php';

echo "<div class='center'>";

if ($loggedin) echo " $user, you are logged in";
else           echo ' Please sign up or log in';

echo <<<_END
      </div><br>
    </div>
    <div data-role="footer">
      <h4>Web App Development <i><a href='https://2ms-apps.business.site/'
      target='_blank' style="color: #1d20e9">2msApps</a></i></h4>
    </div>
  </body>
</html>
_END;
?>
