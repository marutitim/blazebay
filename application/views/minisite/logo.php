<?php



			if (file_exists("assets/uploadedimages/".$busi_data[0]['company_logo']) && $busi_data[0]['company_logo']!='') {
                $minisite_logo ='https://www.blazebay.com/assets/uploadedimages/'.$busi_data[0]['company_logo'];
            }else {

                $minisite_logo = base_url().'assets/images/dummy-company.png';
            }
		?>

<a href="<?=$mvpath?>minisite">

    <img src="<?=$minisite_logo?>" alt="" style="width:200px;height:80px;display:block;margin-left:auto;margin-right:auto;">

</a>