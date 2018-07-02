<!--add -->



<!--add end-->

<!--companies -->

<div id="companies">

<!--companies_left -->

<div id="companies_left">

<!--companies_top -->

<div id="companies_top">

<!--companies_top_lft -->

<div id="companies_top_lft"></div>

<!--companies_top_lft emd-->

<!--companies_top_mid -->

<div class="companies_top_mid">

<h1><b>New Companies</b></h1>

</div>

<!--companies_top_mid emd-->

<!--companies_top_right -->

<div id="companies_top_right"></div>

<!--companies_top_right emd-->

</div>

<!--companies_top end-->

<!--companies_body -->

<div class="companies_body">

<!--companies_body_txt -->

<? 

$quer=mysql_query("select * from ".$prev."business where status='Y'  order by id desc limit 0,20");



?>

<div class="companies_body_txt">
<?

$j=0;

while($rs=mysql_fetch_array($quer))

{

	 $company_name_la=rtrim($rs['company_name']);

	 $company_name_la=str_replace(" ","-",$company_name_la);

	 $company_name_la=str_replace("&","and",$company_name_la);

	 $company_name_la=str_replace(".","",$company_name_la);

	 $company_name_la=str_replace("(","",$company_name_la);

	 $company_name_la=str_replace(")","",$company_name_la);

?>

<h1><a href="<?=$rs[id]?>-<?=$company_name_la;?>"><? echo $rs['company_name']; ?></a></h1>

<p><? echo $rs['services']; ?></p><br />

<!--<h1>NATUROGENIC ORGANIC FOOD</h1>

<p>organic food, mustard seeds, watermelon seeds, organic 

wheat, rice, soybeans, pesticides, bio fungicides, agriculture 

bio products, organic ...</p>-->

<?

   $j+=1;

   if($j=='2')

   {

    echo '</div>';

    echo '<div id="clear"></div>';

	echo '</li><div class="companies_body_txt">';

    }

 

}

?>

</div>

<!--companies_body_txt end-->



</div>
<div id="main">
    <ul id="holder">	
<li>asldihsakdfh</li>

<li>asldihsakdfh</li>

<li>asldihsakdfhaaaaaaaaaaaaaaaaa</li>

<li>asldihsakdfhasdasd</li>
<li>asldihsakdfh</li>

<li>asldihsakdfh</li>

<li>asldihsakdfhaaaaaaaaaaaaaaaaa</li>

<li>asldihsakdfhasdasd</li>
<li>asldihsakdfh</li>

<li>asldihsakdfh</li>

<li>asldihsakdfhaaaaaaaaaaaaaaaaa</li>

<li>asldihsakdfhasdasd</li><li>asldihsakdfh</li>

<li>asldihsakdfh</li>

<li>asldihsakdfhaaaaaaaaaaaaaaaaa</li>

<li>asldihsakdfhasdasd</li><li>asldihsakdfh</li>

<li>asldihsakdfh</li>

<li>asldihsakdfhaaaaaaaaaaaaaaaaa</li>

<li>asldihsakdfhasdasd</li><li>asldihsakdfh</li>

<li>asldihsakdfh</li>

<li>asldihsakdfhaaaaaaaaaaaaaaaaa</li>

<li>asldihsakdfhasdasd</li><li>asldihsakdfh</li>

<li>asldihsakdfh</li>

<li>asldihsakdfhaaaaaaaaaaaaaaaaa</li>

<li>asldihsakdfhasdasd</li><li>asldihsakdfh</li>

<li>asldihsakdfh</li>

<li>asldihsakdfhaaaaaaaaaaaaaaaaa</li>

<li>asldihsakdfhasdasd</li><li>asldihsakdfh</li>

<li>asldihsakdfh</li>

<li>asldihsakdfhaaaaaaaaaaaaaaaaa</li>

<li>asldihsakdfhasdasd</li>
</ul>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script1.js"></script>
<!--companies_body end-->

<!--companies_btm -->

<div id="companies_btm">

</div>

<!--companies_btm end-->

</div>

<!--companies_left end-->

<!--companies_add -->

<div id="companies_add">

</div>

<!--companies_add end-->

</div>

<!--companies end-->
<?

$sql1=mysql_fetch_array(mysql_query("select * from ".$prev."ads where id='40'"));

$sql2=mysql_fetch_array(mysql_query("select * from ".$prev."ads where id='41'"));

$sql3=mysql_fetch_array(mysql_query("select * from ".$prev."ads where id='42'"));

?>

<div id="add">

<div id="add_left"><a href="<?=$sql1['url']?>"><img src="<?php echo $vpath; ?><?=$sql1['img']?>"  width="189" height="100" alt=""/>  </a></div>
<div id="add_mid"><a href="<?=$sql2['url']?>"><img src="<?php echo $vpath; ?><?=$sql2['img']?>"  width="513" height="100" alt=""/> </a></div>
<div id="add_right"><a href="<?=$sql3['url']?>"><img src="<?php echo $vpath; ?><?=$sql3['img']?>"  width="189" height="100" alt=""/> </a></div>

</div>

