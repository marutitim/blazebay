// JavaScript Document

var xmlhttp;

var temp1, temp2, temp3;

var folderName = 'ajax_pages/';



// 

function GetXmlHttpObject_Scriptgiant()

{

	var xmlHttp1=null;

	try {

		// Firefox, Opera 8.0+, Safari

		xmlHttp1 = new XMLHttpRequest();

	} catch (e) {

		//Internet Explorer

		try {

			xmlHttp1 = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			xmlHttp1 = new ActiveXObject("Microsoft.XMLHTTP");

		}

	}

	return xmlHttp1;

}



function show_div()

{

	document.getElementById("message").style.display = 'block';

}



function loadBasicAjax()

{

	document.getElementById("message").style.display = 'block';

	document.getElementById("message").innerHTML = '<img src="images/loading.gif" border="0" align="absmiddle" \/>';

}

function autoclose(divid,time_count,increment)

{

	div_id=divid;

	temp1=time_count;

	temp2=increment;

	timer_counter=0;

	popup("message");

	document.getElementById("blanket").style.display = 'none';

	window.setTimeout("timer()","400");

	

}

function timer()

{

	if(timer_counter <= temp1)

	{

		document.getElementById(div_id).style.opacity = 1 - (timer_counter/temp1).toFixed(2);

		timer_counter = timer_counter + temp2;

		window.setTimeout("timer()", "50");

	}

	else

	{

		document.getElementById(div_id).style.display = "none";

		document.getElementById(div_id).style.opacity = 1;

	}

}



// Front Page Tab

function showFrontPageTabInformation(tab_number,pageName)

{

  	temp1 = tab_number;

	xmlhttp=GetXmlHttpObject_Scriptgiant()

	if (xmlhttp==null)

	 {

		 alert ("Browser does not support HTTP Request")

		 return false;

	 }

	var url=folderName+pageName+'?tab_number='+temp1;

	xmlhttp.onreadystatechange=showFrontPageTabInformation_req

	xmlhttp.open("GET",url,true);

	xmlhttp.send(null)

}

function showFrontPageTabInformation_req() 

{ 

	if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")

	{

		if( temp1=='1' ) 

		{

		 document.getElementById('tab_1').className='tab_selected tab-text';

		 document.getElementById('tab_2').className='tab tab-text';

		 document.getElementById('tab_3').className='tab tab-text';

		 document.getElementById('tab_4').className='tab tab-text';

		}

		if( temp1=='2' ) 

		{

		 document.getElementById('tab_1').className='tab tab-text';

		 document.getElementById('tab_2').className='tab_selected tab-text';

		 document.getElementById('tab_3').className='tab tab-text';

		 document.getElementById('tab_4').className='tab tab-text';

		}

		if( temp1=='3' ) 

		{

		 document.getElementById('tab_1').className='tab tab-text';

		 document.getElementById('tab_2').className='tab tab-text';

		 document.getElementById('tab_3').className='tab_selected tab-text';

		 document.getElementById('tab_4').className='tab tab-text';

		}

		if( temp1=='4' ) 

		{

		 document.getElementById('tab_1').className='tab tab-text';

		 document.getElementById('tab_2').className='tab tab-text';

		 document.getElementById('tab_3').className='tab tab-text';

		 document.getElementById('tab_4').className='tab_selected tab-text';

		}

		document.getElementById("targetTabId").innerHTML=xmlhttp.responseText;

	}

}

// Project Details Tab

function showProjectDetailsTabInformation(pageUrl,tabId)

{

	temp1 = tabId;

	xmlhttp=GetXmlHttpObject_Scriptgiant()

	if (xmlhttp==null)

	 {

		 alert ("Browser does not support HTTP Request")

		 return false;

	 }

	var url=folderName+pageUrl;

	xmlhttp.onreadystatechange=showProjectDetailsTabInformation_req

	xmlhttp.open("GET",url,true);

	xmlhttp.send(null)

}

function showProjectDetailsTabInformation_req() 

{ 

	if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")

	{

		if( temp1=='desc' )

		{

		 document.getElementById('desc').className='inner_btn_des_selected';

		 document.getElementById('feat').className='inner_btn_features';

		 document.getElementById('shar').className='inner_btn_share';

		}

		if( temp1=='feat' )

		{

		 document.getElementById('desc').className='inner_btn_des';

		 document.getElementById('feat').className='inner_btn_features_selected';

		 document.getElementById('shar').className='inner_btn_share';

		}

		if( temp1=='share' )

		{

		 document.getElementById('desc').className='inner_btn_des';

		 document.getElementById('feat').className='inner_btn_features';

		 document.getElementById('shar').className='inner_btn_share_selected';

		}

		document.getElementById("targetProjDet").innerHTML=xmlhttp.responseText;

	}

}

// Send email to the admin on 'Get a free logo quote'

function submitQuickLogoQuote(val1,val2,val3,val4)

{

	var alertTxt = ''; 

	if( val1=='' ) { 

	  alertTxt += "Name cannot be blank.\n";

	} 

	if( val2=='' ) {

	  alertTxt += 'Email cannot be blank.\n';

	} 

	if( val2!='' ) {

	        if(echeck(val2)==false) {

				alertTxt += "Please enter a valid confirm email.\n";

			}

	} 

	if( val3=='' ) {

	  alertTxt += 'Contact number cannot be blank.\n';

	}

	if( val4=='' ) {

	  alertTxt += 'Enquiry cannot be blank.';

	}

	if(alertTxt!="")   {

	  alert("Hey guest, following fields are mandatory :\n\n"+alertTxt);

	  return false;

	}

	var pageUrl = "submit_quick_quote.php?name="+val1+"&email="+val2+"&phone="+val3+"&enquiry="+val4;

	xmlhttp=GetXmlHttpObject_Scriptgiant()

	if (xmlhttp==null)

	 {

		 alert ("Browser does not support HTTP Request")

		 return false;

	 }

	var url=folderName+pageUrl;

	xmlhttp.onreadystatechange=submitQuickLogoQuote_req

	xmlhttp.open("GET",url,true);

	xmlhttp.send(null)

}

function submitQuickLogoQuote_req() 

{ 

	if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")

	{

		document.getElementById("quick_quote_id").innerHTML=xmlhttp.responseText;

			document.getElementById("f_1").value='';

			document.getElementById("f_2").value='';

			document.getElementById("f_3").value='';

			document.getElementById("f_4").value='';

	}

}

// Send email to the admin on 'Get a product quote'

function submitQuickQuote(val1,val2,val3,val4,val5)

{

	temp1 = val5;

	var alertTxt = ''; 

	if( val1=='' ) { 

	  alertTxt += "Name cannot be blank.\n";

	} 

	if( val2=='' ) {

	  alertTxt += 'Email cannot be blank.\n';

	} 

	if( val2!='' ) {

	        if(echeck(val2)==false) {

				alertTxt += "Please enter a valid confirm email.\n";

			}

	} 

	if( val3=='' ) {

	  alertTxt += 'Enquiry cannot be blank.';

	}

	if(alertTxt!="")   {

	  alert("Hey guest, following fields are mandatory :\n\n"+alertTxt);

	  return false;

	}

	var pageUrl = "submit_quick_quote_product.php?name="+val1+"&email="+val2+"&enquiry="+val3+"&prod_pack_name="+val4+"&mode="+val5;

	xmlhttp=GetXmlHttpObject_Scriptgiant()

	if (xmlhttp==null)

	 {

		 alert ("Browser does not support HTTP Request")

		 return false;

	 }

	var url=folderName+pageUrl;

	xmlhttp.onreadystatechange=submitQuickQuote_req

	xmlhttp.open("GET",url,true);

	xmlhttp.send(null)

}

function submitQuickQuote_req() 

{ 

	if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")

	{

		if( temp1=='product' )

		{

  		  document.getElementById("quick_quote_product_id").innerHTML=xmlhttp.responseText;

		  document.getElementById("p_1").value='';

		  document.getElementById("p_2").value='';

		  document.getElementById("p_3").value='';

		}

		else

		{

		  document.getElementById("quick_quote_pack_id").innerHTML=xmlhttp.responseText;

		  document.getElementById("pack_1").value='';

		  document.getElementById("pack_2").value='';

		  document.getElementById("pack_3").value='';

		}

	}

}

// Pagination logo

function displayLogoDiv(page_mode,counter,num_of_logo)

{

	temp1 = num_of_logo;

	if( page_mode ) {

  	    if( page_mode=='next' ) {

		 document.getElementById("pageNextPrev").value=parseInt(document.getElementById("pageNextPrev").value)+parseInt(5);

	     counter = document.getElementById("pageNextPrev").value;

		}  

		if( page_mode=='prev' ) {

			 document.getElementById("pageNextPrev").value=parseInt(document.getElementById("pageNextPrev").value)-parseInt(5);

			 counter =document.getElementById("pageNextPrev").value;

		} 

		if( parseInt(document.getElementById("pageNextPrev").value)==0 ) {

			document.getElementById("arrow_prev").src='';

		} else {

			document.getElementById("arrow_prev").src='images/arrow-prevous.jpg';

		}

	} 

	var pageUrl = "display_logo.php?page_mode="+page_mode+"&counter="+counter;

	xmlhttp=GetXmlHttpObject_Scriptgiant()

	if (xmlhttp==null)

	 {

		 alert ("Browser does not support HTTP Request")

		 return false;

	 }

	var url=folderName+pageUrl;

	xmlhttp.onreadystatechange=displayLogoDiv_req

	xmlhttp.open("GET",url,true);

	xmlhttp.send(null)

}

function displayLogoDiv_req() 

{ 

	if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")

	{

		//alert(temp1);

		document.getElementById("logo_page_id").innerHTML=xmlhttp.responseText;

	}

	if( parseInt(document.getElementById("pageNextPrev").value)==0 ) {

			document.getElementById("arrow_prev").src='images/x.gif';

		} else {

			document.getElementById("arrow_prev").src='images/arrow-prevous.jpg';

		}

	if( parseInt(document.getElementById("pageNextPrev").value)>temp1 ){

	 	document.getElementById("arrow_next").src='images/x.gif';

	} else {

	 	document.getElementById("arrow_next").src='images/arrow-next.jpg';

	}

}

// Contact us div

function contactUs()

{

	popup("message");

	xmlhttp=GetXmlHttpObject_Scriptgiant()

	if (xmlhttp==null)

	 {

		 alert ("Browser does not support HTTP Request")

		 return false;

	 }

	var pageUrl = "contact-us-back.php";

	var url=folderName+pageUrl;

	xmlhttp.onreadystatechange=contactUs_req

	xmlhttp.open("GET",url,true);

	xmlhttp.send(null)

}

function contactUs_req() 

{ 

	if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")

	{

		document.getElementById("message_body").innerHTML=xmlhttp.responseText;

	

		

		PMA_focusInput("contact_name");

		setTimeout('PMA_focusInput("contact_name")', 500);

	}

	else

	{

		

	}

}

// 

function send_contact_us_mail(name,companyName,email,confirmEmail,message)

{

	show_div();

	var alertTxt = ''; 

	if( name=='' ) { 

	  alertTxt += "Name cannot be blank.\n";

	} 

	if( companyName=='' ) {

	  alertTxt += 'Company cannot be blank.\n';

	}

	if( email=='' ) {

	  alertTxt += 'Email cannot be blank.\n';

	}

	if( email!='' ) {

	        if(echeck(email)==false) {

				alertTxt += "Please enter a valid email.\n";

			}

	} 

	if( confirmEmail=='' ) {

	  alertTxt += 'Confirm email cannot be blank.\n';

	}

	if( confirmEmail!='' ) {

	        if(echeck(confirmEmail)==false) {

				alertTxt += "Please enter a valid confirm email.\n";

			}

	} 

	if( email!=confirmEmail ) {

	  alertTxt += 'Email cannot be blank.\n';

	}

	if( message=='' ) {

	  alertTxt += 'Message cannot be blank.\n';

	}

	if(alertTxt!="")   {

	  alert("Hey guest, following fields are mandatory :\n\n"+alertTxt);

	  return false;

	}

	xmlhttp=GetXmlHttpObject_Scriptgiant()

	if (xmlhttp==null)

	 {

		 alert ("Browser does not support HTTP Request")

		 return false;

	 }

	var pageUrl = "thank-you-contact-us-back.php?fullName="+name+"&email="+email+"&companyName="+companyName+"&message="+message;

	var url=folderName+pageUrl;

	xmlhttp.onreadystatechange=send_contact_us_mail_req

	xmlhttp.open("GET",url,true);

	xmlhttp.send(null)

}

function send_contact_us_mail_req() 

{ 

	if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")

	{

		document.getElementById("message_body").innerHTML=xmlhttp.responseText;

	}

	else

	{

		

	}

}



// Quick SMS div

function sendQuickSMS(n)

{

	//show_div();

	popup("message");

    

	

	xmlhttp = GetXmlHttpObject_Scriptgiant();

	if (xmlhttp == null)

	{

		alert ("Browser does not support HTTP Request");

		return false;

	}

	var pageUrl = "send-sms-back.php?id="+n;

	var url = folderName + pageUrl;

	xmlhttp.onreadystatechange = sendQuickSMS_req;

	xmlhttp.open("GET", url, true);

	xmlhttp.send(null);

}

function sendQuickSMS_req() { 

	if (xmlhttp.readyState == 4 || xmlhttp.readyState == "complete")

	{

		document.getElementById("message_body").innerHTML = xmlhttp.responseText;

		

		PMA_focusInput("sms_name");

		setTimeout('PMA_focusInput("sms_name")', 500);



		

	}

}



function getDirection(n)

{

	//show_div();

	popup("message");

    

	

	xmlhttp = GetXmlHttpObject_Scriptgiant();

	if (xmlhttp == null)

	{

		alert ("Browser does not support HTTP Request");

		return false;

	}

	var pageUrl = "popcontact.php?id="+n;

	//var url = folderName + pageUrl;

	xmlhttp.onreadystatechange = getDirection_req;

	xmlhttp.open("GET", pageUrl, true);

	xmlhttp.send(null);

}

function getDirection_req() { 

	if (xmlhttp.readyState == 4 || xmlhttp.readyState == "complete")

	{

		document.getElementById("message_body").innerHTML = xmlhttp.responseText;

		

	//	PMA_focusInput("sms_name");

	//	setTimeout('PMA_focusInput("sms_name")', 500);

	}

}




function sendQuickSMSMobile(name, mobile, message, code, btn_id,id) {

	show_div();

	//loadBasicAjax();

	

	var alertTxt = '';

	xmlhttp = GetXmlHttpObject_Scriptgiant();

	

	if (xmlhttp == null)

	{

		alert ("Browser does not support HTTP Request");

		return false;

	}

	

	if( name == '' ) {

		alertTxt += "Please provide your Name.\n";

	}

	

	if( mobile == '' ) {

		alertTxt += "Please provide your Mobile Number.\n";

	}

	else if( mobile != '' && isNaN( parseInt( mobile ) ) ) {

		alertTxt += "Please provide a valid Mobile Number.\n";

	}

	else if( mobile != '' && mobile.length != 10 ) {

		alertTxt += "Please provide a valid 10 digit Mobile Number.\n";

	}

	

	if( message == '' ) {

		alertTxt += "Please provide your SMS Message.\n";

	}

	

	if( code == '' ) {

		alertTxt += "Please provide the Security Code.\n";

	}

	

	if(alertTxt != "") {

		alert("Hey guest, following fields are mandatory :\n\n" + alertTxt);

		return false;

	}

	else {

		document.getElementById(btn_id).disabled = true;

		document.getElementById(btn_id).value = "Sending...";

	}

	

	var pageUrl = "send-sms-back.php?name=" + name + "&mobile=" + mobile + "&message=" + message + "&code=" + code +"&id=" + id;


	var url = folderName + pageUrl;

	xmlhttp.onreadystatechange = sendQuickSMSMobile_req;

	xmlhttp.open("GET", url, true);

	xmlhttp.send(null);

}



function sendQuickSMSMobile2(id,vcode, btn_id) {

	show_div();

	//loadBasicAjax();

	

	var alertTxt = '';

	xmlhttp = GetXmlHttpObject_Scriptgiant();

	

	if (xmlhttp == null)

	{

		alert ("Browser does not support HTTP Request");

		return false;

	}

	

	if( vcode == '' ) {

		alertTxt += "Please provide verification code.\n";

	}

	

	if(alertTxt != "") 

	{

		alert("Hey guest, following fields are mandatory :\n\n" + alertTxt);

		return false;

	}

	else {

		document.getElementById(btn_id).disabled = true;

		document.getElementById(btn_id).value = "Sending...";

	}

	

	var pageUrl = "send-sms-back.php?id=" + id + "&vcode=" + vcode;

	var url = folderName + pageUrl;

	xmlhttp.onreadystatechange = sendQuickSMSMobile_req;

	xmlhttp.open("GET", url, true);

	xmlhttp.send(null);

}



function sendQuickSMSMobile_req() {

	//alert(xmlhttp.readyState);

	if (xmlhttp.readyState == 4 || xmlhttp.readyState == "complete")

	{

		//alert(xmlhttp.responseText);

		document.getElementById("message_body").innerHTML = xmlhttp.responseText;

	}

	else

	{

		document.getElementById("message_body").innerHTML = "Please wait....";

	}

}



//

function refresh_feedback()

{

	xmlhttp=GetXmlHttpObject_Scriptgiant();

	if (xmlhttp==null)

	 {

		 alert ("Browser does not support HTTP Request")

		 return false;

	 }

	var pageUrl = "refresh_feedback.php";

	var url=folderName+pageUrl;

	//alert(url);

	xmlhttp.onreadystatechange=refresh_feedback_req

	xmlhttp.open("GET",url,true);

	xmlhttp.send(null)

}

function refresh_feedback_req() 

{ 

	if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")

	{

		document.getElementById("welcome").innerHTML=xmlhttp.responseText;

	}

	else

	{

		

	}

}

//

function refresh_logo()

{

	xmlhttp=GetXmlHttpObject_Scriptgiant();

	if (xmlhttp==null)

	 {

		 alert ("Browser does not support HTTP Request")

		 return false;

	 }

	var pageUrl = "refresh_recentwork_logo.php?mode=logo";

	var url=folderName+pageUrl;

	xmlhttp.onreadystatechange=refresh_logo_req

	xmlhttp.open("GET",url,true);

	xmlhttp.send(null)

}

function refresh_logo_req() 

{ 

	if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")

	{

		document.getElementById('logo_div').innerHTML=xmlhttp.responseText;

	}

	else

	{

		

	}

}

//

function reFresh_Recent_Work()

{

	xmlhttp=GetXmlHttpObject_Scriptgiant();

	if (xmlhttp==null)

	 {

		 alert ("Browser does not support HTTP Request")

		 return false;

	 }

	var pageUrl = "refresh_recentwork_logo.php";

	var url=folderName+pageUrl;

	xmlhttp.onreadystatechange=reFresh_Recent_Work_req

	xmlhttp.open("GET",url,true);

	xmlhttp.send(null)

}

function reFresh_Recent_Work_req() 

{ 

	if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")

	{

		document.getElementById('recent_work_div').innerHTML=xmlhttp.responseText;

	}

	else

	{

		

	}

}



// View Contact Details div

function viewContactDetails()

{

	popup("message");

	

	xmlhttp = GetXmlHttpObject_Scriptgiant();

	if (xmlhttp == null)

	{

		alert ("Browser does not support HTTP Request");

		return false;

	}

	var pageUrl = "view-contact-details-back.php";

	var url = folderName + pageUrl;

	xmlhttp.onreadystatechange = viewContactDetails_req;

	xmlhttp.open("GET", url, true);

	xmlhttp.send(null);

}

function viewContactDetails_req() 

{ 

	if (xmlhttp.readyState == 4 || xmlhttp.readyState == "complete")

	{

		document.getElementById("message_body").innerHTML = xmlhttp.responseText;

	}

}





function toggle_palash(div_id) {

	var el = document.getElementById(div_id);

	if ( el.style.display == 'none' ) {	el.style.display = 'block';}

	/*else {el.style.display = 'none';}*/

}

function blanket_size(popUpDivVar) {

	if (typeof window.innerWidth != 'undefined') {

		viewportheight = window.innerHeight;

	} else {

		viewportheight = document.documentElement.clientHeight;

	}

	if ((viewportheight > document.body.parentNode.scrollHeight) && (viewportheight > document.body.parentNode.clientHeight)) {

		blanket_height = viewportheight;

	} else {

		if (document.body.parentNode.clientHeight > document.body.parentNode.scrollHeight) {

			blanket_height = document.body.parentNode.clientHeight;

		} else {

			blanket_height = document.body.parentNode.scrollHeight;

		}

	}

	var blanket = document.getElementById('blanket');

	blanket.style.height = blanket_height + 'px';

	var popUpDiv = document.getElementById(popUpDivVar);

	if (typeof document.body.style.maxHeight == "undefined")

	{

		popUpDiv_height=(blanket_height/2)+150;

	}

	else

	{

		popUpDiv_height=(blanket_height/2)-150; 

	}

	

	//150 is half popup's height

	popUpDiv.style.top = popUpDiv_height + 'px';

}

function window_pos(popUpDivVar) {

	if (typeof window.innerWidth != 'undefined') {

		viewportwidth = window.innerHeight;

	} else {

		viewportwidth = document.documentElement.clientHeight;

	}

	if ((viewportwidth > document.body.parentNode.scrollWidth) && (viewportwidth > document.body.parentNode.clientWidth)) {

		window_width = viewportwidth;

	} else {

		if (document.body.parentNode.clientWidth > document.body.parentNode.scrollWidth) {

			window_width = document.body.parentNode.clientWidth;

		} else {

			window_width = document.body.parentNode.scrollWidth;

		}

	}

	var popUpDiv = document.getElementById(popUpDivVar);

	

	if (typeof document.body.style.maxHeight == "undefined")

	{

		window_width=(window_width/2);

	}

	else

	{

		window_width=(window_width/2)-300;

	}

	//150 is half popup's width

	popUpDiv.style.left = window_width + 'px';

}

function popup(windowname) {

	blanket_size(windowname);

	window_pos(windowname);

	toggle_palash('blanket');

	toggle_palash(windowname);		

}



function PMA_focusInput(id)

{

	var input_focus = document.getElementById(id);

	if (input_focus.value == '') {

        input_focus.focus();

	}



}