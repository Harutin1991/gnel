<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>404</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href='https://fonts.googleapis.com/css?family=Metal+Mania' rel='stylesheet' type='text/css'>
<style type="text/css">
body{
    font-family: 'Metal Mania', cursive;
    background: #2FACED /* skyblue */;
}	
.wrap{
    margin:0 auto;
    width:1000px;
}
.logo h1{
    font-size:200px;
    color:white;
    text-align:center;
    margin-bottom:1px;
    text-shadow:1px 1px 6px #555;
}	
.logo p{
    color:white;
    font-size:35px;
    margin-top:1px;
    text-align:center;
}	
.logo p span{
    color:lightgreen;
}	
.sub a{
    color:white;
    text-decoration:none;
    padding:5px;
    font-size:20px;
    font-family: arial, serif;
    font-weight:bold;
}
.sub a:hover{
    color: yellow;
}
.footer{
    color:white;
    position:absolute;
    right:10px;
    bottom:10px;
}	
.footer a{
    color: white;
}	
</style>
</head>

<body>
    <div class="wrap">
        <div class="logo">
            <h1>404</h1>
            <p><?php echo $this->lang->line('Page not Found'); ?></p>
            <div class="sub">
                <p><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('Go Back to Home'); ?></a></p>
            </div>
        </div>
    </div>
</body>