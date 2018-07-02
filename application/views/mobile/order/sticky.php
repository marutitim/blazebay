<?php
if(!empty($details)){
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>sticky</title>
		<style>

#notes li {
    position: relative;
    width: 300px;
    min-height: 100px;
    margin: 25px auto;
    padding: 60px 15px 15px 15px;
    -webkit-box-shadow: 0 2px 12px rgba(0,0,0,.5);
    -moz-box-shadow: 0 2px 12px rgba(0,0,0,.5);
    box-shadow: 0 1px 2px #000;
    -webkit-transform: rotate(-.5deg);
    -moz-transform: rotate(-.5deg);
    -o-transform: rotate(-.5deg);
}

#notes li:nth-child(even) {
    -webkit-transform: rotate(.5deg);
    -moz-transform: rotate(.5deg);
    -o-transform: rotate(.5deg);
}

#notes li.kiln
{
    background-image: url(https://rob.kilnhg.com/Content/Images/kiln_focus.gif);
}

#notes li p {
    text-align: center;
    font: normal normal normal 20px/20px 'Reenie Beanie', Helvetica, Arial, sans-serif;
    color: #000;
    text-shadow: white 1px 1px 0px;
    overflow:hidden;
}

#notes li::before {
    content: ' ';
    display: block;
    position: absolute;
    left: 115px;
    top: -15px;
    width: 75px;
    height: 25px;
    z-index: 2;
    background-color: rgba(243,245,228,0.5);
    border: 2px solid rgba(255,255,255,0.5);
    -webkit-box-shadow: 0 0 5px #888;
    -moz-box-shadow: 0 0 5px #888;
    box-shadow: 2px 2px 2px #000;
    -webkit-transform: rotate(-6deg);
    -moz-transform: rotate(-6deg);
    -o-transform: rotate(-6deg);
}

#notes li:nth-child(even)::before {
    -webkit-transform: rotate(6deg);
    -moz-transform: rotate(6deg);
    -o-transform: rotate(6deg);
}
		</style>
		</head>
    <body class="cnt-home">
	<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie&amp;subset=latin' rel='stylesheet' type='text/css'>

<ul id="notes">
    <li>
        <p><div id="customer-extras"><div id="extra-details-customer"> <?=$details?></div></div></p>
    </li>
</ul>
	</body>
</html>
<?php } else{  echo 0;}?>