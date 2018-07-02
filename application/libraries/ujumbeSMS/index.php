<?php
require_once('UjumbeSMS_Gateway.php');
/**
 * 
 */
$sms = new UjumbeSMS_Gateway("NjI4YmY5ZjcxNzMwYzFkODMwY2Y4ZWQ3MWY0YmU0", "muthui@churchblaze.com");

//$sms->send("0723890575,0723890575", "Dear investor, we wish to invite you to our AGM at Thika High Chapel on 24th Nov 2017 @8:00am", "YOUR_SENDER_ID");

$sms->send("0723890575", "Dear investor, we wish to invite you to our AGM at Thika High Chapel on 24th Nov 2017 @8:00am", "YOUR_SENDER_ID");

if($sms)
{
	print_r("Sms sent successfully! 1");
}

else
{
	print_r("Error: Something went wrong!");
}
