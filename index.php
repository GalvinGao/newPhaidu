<?php

error_reporting(E_ALL);

include_once("config.php");

// // Country Optimized CDN // //

// / Get country code from client IP / //

function ip_info($ip = NULL, $deep_detect = TRUE) {
    if ($ip == NULL || !filter_var($ip, FILTER_VALIDATE_IP)) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)){
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)){
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
    }

    $ch = curl_init("http://ip-api.com/json/".$ip);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, true);

    if($result['status'] == "fail"){
        $result = FALSE; /* If an Error has come back, you can use $result['message'] to get why. */
    } 
    else { $result =  $result['countryCode']; } // If Sucess
    return $result;
}

if (ip_info() == "CN") {
    $china = true;
} else {
    $china = false;
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>
  <!-- CSS  -->
<?php if ($china): ?>
  <link rel="stylesheet" href="https://cdn.bootcss.com/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha384-7BsxsfeWMf+6PLS9uv6nG/A21nVX1jiRjZ+0D/Zz6lHOd5X4cIQJR1AnIhj4DD4B" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.bootcss.com/materialize/0.100.2/css/materialize.min.css" integrity="sha384-gGIdbE3rejhnmhbMZyasqhmdgF/Wza7NbuLq2eAVP92BbPF/ziwfO1LtP7E/ai36" crossorigin="anonymous">
  <link href="<?php echo $cdnprefix ?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<?php else: ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha384-7BsxsfeWMf+6PLS9uv6nG/A21nVX1jiRjZ+0D/Zz6lHOd5X4cIQJR1AnIhj4DD4B" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" integrity="sha384-gGIdbE3rejhnmhbMZyasqhmdgF/Wza7NbuLq2eAVP92BbPF/ziwfO1LtP7E/ai36" crossorigin="anonymous">
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<?php endif?>

</head>
<body>
  <nav class="light-blue lighten-1" role="navigation" class="navbar">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Starter Template</h1>
      <div class="row center">
        <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
      </div>
      <div class="row center">
        <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
      </div>
      <br><br>

    </div>
  </div>

    <!-- Padding -->

  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Speeds up development</h5>

            <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Experience Focused</h5>

            <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>
  </div>

  <footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
<?php if ($china): ?>
  <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
  <script src="https://cdn.bootcss.com/materialize/0.100.2/js/materialize.min.js" integrity="sha384-C5yXM3HiWa6a8kI2Jd4LuuwmOGAVgJw0YSmuRXN+PLT5Jln26ddUnPQxkInM/w2x" crossorigin="anonymous"></script>
<?php else: ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js" integrity="sha384-C5yXM3HiWa6a8kI2Jd4LuuwmOGAVgJw0YSmuRXN+PLT5Jln26ddUnPQxkInM/w2x" crossorigin="anonymous"></script>
<?php endif?>
  </body>
</html>
