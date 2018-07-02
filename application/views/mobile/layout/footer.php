<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.1.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/materialize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.slicknav.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.swipebox.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom.js"></script>
<script src="<?php echo base_url();?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/noty/lib/noty.min.js"></script>
<script src="<?php echo base_url();?>assets/js/mo.min.js"></script>
<script src="<?php echo base_url();?>assets2/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets2/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>

$(document).ready(function(e){

   // $('#loginp').modal({backdrop: 'static', keyboard: false})
    $('#search-field-mobile').autocomplete({
        source: function (request, response) {
            var selectedcategory= concept;
            $.ajax({
                url: "<?=base_url()?>search",
                method:"POST",
                data: { searchText: request.term, maxResults: 10,category:selectedcategory},
                dataType: "json",
                success: function (data) {

                    response($.map(data, function (item) {
                        return {
                            value:item.title,
                            avatar:"https://www.blazebay.com/assets/uploadedimages/"+item.image,
                            uid: item.uid,
                            selectedId:item.id,
                            selectedType:item.company

                        };
                    }))
                }
            })
        },
        select: function (event, ui) {
            var   term=ui.item.value;
            if(ui.item.selectedType=="company"){
                window.location="<?=base_url();?>company-details/"+ term.replace(/[^a-z0-9]+/g,'-') + "/"+ ui.item.uid;
            }else{
                window.location="<?=base_url();?>product-details/"+ term.replace(/[^a-z0-9]+/g,'-') + "/"+ ui.item.selectedId+"/"+ ui.item.uid;
            }

            return false;
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li />")
            .data("item.autocomplete", item)
            .append("<div style='width: 240px;'><a><img  class='img-thumbnail' style='max-height:50px;min-height:50px;max-width:50px;min-width:50px;' src='" +
            item.avatar + "' /><span class='search-title-results' >" + trimByWord(item.value.toLowerCase()) + "</span></a></div>")
            .appendTo(ul);

    };


    checkCountMsgs();
    $('#search-field-mobile').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            search()

        }
    });

    $('#data-table').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
    var concept="";

    $('.search-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        concept = $(this).html();

        $('.search-panel span#search_concept').html(concept);
        $('.input-group #search_param').val(param);
    });

    $('.language-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        concept = $(this).html();
        $('.language-panel span#language_concept').html("");
        $('.language-panel span#language_concept').html(concept);
        var selectedLanguage= $('.language-panel span#language_concept').text();
        if(selectedLanguage!=""){
            $.ajax({
                url: "<?=base_url()?>switchLanguage",
                method:"POST",
                data: {language:selectedLanguage},
                dataType: "json",
                success: function (data) {
                    window.location.reload();
                    location.reload();
                }
            })
        }

    });

    $('.search-panel2 .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        var concept = $(this).text();
        $('.search-panel2 span#search_concept2').text(concept);
        $('.input-group #search_param2').val(param);
        var category=$("#search_param2").val();
        var append='<?=$firstitem?>';

        if(category=='greather_than'||category=='less_than' ){
            $("#all-products-search_param").prop('type', 'number');
            if(append=='all-products' || append=='sale-offers' || append=='all') {
                $("#url-link").val('<?=$appendLink?>');
            }
            else{
                $("#url-link").val('wholesell/');
            }
        }else{
            $("#all-products-search_param").prop('type', 'text');
            if(append=='all-products' || append=='sale-offers' || append=='all' ) {
                $("#url-link").val('<?=$appendLink?>');
            }
            else{
                $("#url-link").val('wholesell/');
            }
        }
    });


    $('#all-products-search_param').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {

            search2()

        }
    });

    $('.cnt-block .list-unstyled').find('a').click(function(e) {
        e.preventDefault();

        var param = $(this).attr("href").replace("#","");
        concept = $(this).html();

        var selectedCurrency=concept;


        if(selectedCurrency==="USD"|| selectedCurrency==="KSH"|| selectedCurrency==="NURUCOIN" ||selectedCurrency==="NRCT"){
            $.ajax({
                url: "<?=base_url()?>currencyConvertion",
                method:"POST",
                data: { currency:selectedCurrency},
                dataType: "json",
                success: function (data) {
                    window.location.reload();
                    location.reload();
                }
            })
        }

        //  location.reload();
    });



} );


function modallogin(){


    var username= $("#modal-homeusername").val();
    var password=$("#modal-homepassword").val();

    if(username==""){

        new Noty({
            type: 'error',
            timeout: 6000,
            text     : 'Please enter your username or email',
            container: '.homemodal-username-invalidLogin'
        }).show();

    }
    else if(password==""){

        new Noty({
            type: 'error',
            timeout: 6000,
            text     : 'Please enter your password',
            container: '.homemodal-password-invalidLogin'
        }).show();

    }else{

  var base="<?php echo base_url()?>";
        var ctrlUrl =  "<?php echo base_url().'processlogin' ;?>";
        var RedirectUrl="<?php echo base_url().'login' ;?>";
        var userUrl="<?php echo base_url().'dashboard' ;?>";

        $.ajax({
            type: "POST",
            url: ctrlUrl,
            data:({
                username: username,
                password: password
            }),
            cache
                :
                false,
            success
                :
                function (data) {

                    //alert(data);
                    if (data ==10) {
                        new Noty({
                            type: 'warning',
                            timeout: 60000,
                            text     : 'Your account is not approved',
                            container: '.homemodal-invalidLogin'
                        }).show();
                        window.location.href=RedirectUrl;
                    }
                    else if (data==1||data==2||data==3||data==4){
                        new Noty({
                            type: 'success',
                            timeout: 100,
                            text     : 'Success',
                            container: '.homemodal-invalidLogin'
                        }).show();
                        $('#loginp').modal('toggle');
                        location.reload();
                    }
                    else{
                        new Noty({
                            type: 'error',
                            timeout: 60000,
                            text     : 'Oops!.Invalid Credentials',
                            container: '.homemodal-invalidLogin'
                        }).show();

                      //  window.location.reload;
                    }
                }
        });
    }
}
function postInquiry(){
    var base_url="<?php echo base_url();?>";
    var user='<?php echo $user_id?>';
    if (user=='' || user== null) {
        $('#loginp').modal('show');
    }else{

        var data =$('#post_enquiry_form').serialize()
        jQuery.ajax({
            url: base_url+"postInquiry",
            data:data,
            type: "POST",
            success:function(data){
                $(".postreqments").hide();
                document.body.scrollTop = document.documentElement.scrollTop = 0;

                swal("Success", "Your request send successfully", "success")
            },
            error:function (){}
        });



    }



}
function checkCountMsgs() {

    var base_url =  "<?php echo base_url()?>";
    $.ajax({
        url:base_url+"getCountMessage",
        type:"POST",
        success:function(data){
            $(".countMgs").html(data);
            setTimeout(function(){ return checkCountMsgs(); },2000);
        }
    });
}

function modalcancel(){
    $('#loginp').modal('toggle');
}

function getquote(category){

     var base_url="<?php echo base_url();?>";
     var user='<?php echo $user_id?>';
     if (user=='' || user== null) {
         $('#loginp').modal('show');
     }else {
         var userUrl = "<?php echo base_url().'getQuotes' ;?>";
         $.ajax({
             type: "POST",
             url: userUrl,
             data: ({category: category}),
             cache: false,
             success: function (data) {
                 if (data == 1) {
                     swal({
                         type: 'success',
                         html: 'your request has been sent to the suppliers'
                     })
                 } else {
                     swal({
                         type: 'error',
                         html: 'please enter your name and a valid email'
                     })
                 }

             }


         });
     }
 }
function trimByWord(sentence) {
    var result = sentence;
    var resultArray = result.split("");
    if(resultArray.length > 20){
        resultArray = resultArray.slice(0, 20);
        result = resultArray.join("");
    }
    return result;
}

function userLogin() {

    var username= $("#username").val();
    var password=$("#password").val();

    if(username==""){
        new Noty({
            type: 'error',
            timeout: 500,
            text     : 'Please enter your username or email',
            container: '.usernameerror'
        }).show();

    }
    else if(password==""){
        new Noty({
            type: 'error',
            timeout: 500,
            text     : 'Please enter your password',
            container: '.passworderr'
        }).show();

    }else{


        var ctrlUrl =  "<?php echo base_url().'processlogin' ;?>";
        var RedirectUrl="<?php echo base_url().'login' ;?>";
        var userUrl="<?php echo base_url().'dashboard' ;?>";
        $.ajax({
            type: "POST",
            url: ctrlUrl,
            data:({
                username: username,
                password: password
            }),
            cache
                :
                false,
            success
                :
                function (data) {

                    //alert(data);
                    if (data ==10) {
                        new Noty({
                            type: 'warning',
                            timeout: 3000,
                            text     : 'Your account is not activated',
                            container: '.invalidLogin'
                        }).show();
                        //window.location.href=RedirectUrl;
                    }
                    else if (data==1||data==2||data==3||data==4){

                        new Noty({
                            type: 'info',
                            timeout:3000,
                            text     : 'Success',
                            container: '.invalidLogin'
                        }).show();

                        window.location=userUrl;
                    }
                    else{
                        new Noty({
                            type: 'error',
                            timeout: 30000,
                            text     : 'Oops!.Invalid Credentials',
                            container: '.invalidLogin'
                        }).show();

                        window.location.reload;
                    }
                }
        });
    }
}
function search(){
    var searchText=$("#search-field-mobile").val();
    if(searchText!=""){
        var item=searchText.replace(/[^a-z0-9]+/g,'-');
        location.replace('<?=base_url()?>all-products/'+item);
    }else{
        location.replace('<?=base_url()?>all/products');
    }

}


function search2(){
    var searchText=$("#all-products-search_param").val();
    var append='<?=$firstitem?>';



    if(append=='all-products' || append=='sale-offers' || append=='all' ) {
        $("#url-link").val('<?=$appendLink?>');
    }
    var url=$("#url-link").val();
    var category=$("#search_param2").val();
    if(category=="greather_than"){
        if (searchText != "") {
            var item = searchText;
            location.replace('<?=base_url()?>' + url + 'price-greater-than/' + item);
        } else {
            location.replace('<?=base_url()?>' + url + '');
        }
    } else if(category=="less_than"  ){
        if (searchText != "") {
            var item = searchText;
            location.replace('<?=base_url()?>' + url + 'price-less-than/' + item);
        } else {
            location.replace('<?=base_url()?>' + url + '');
        }
    } else {
        if (searchText != "") {
            var item = searchText;

            location.replace('<?=base_url()?>'+ url +''+ item);

        } else {
            location.replace('<?=base_url()?>' + url + '');
        }
    }
}
function buy(product_id,qty){
    var orderurl='<?=base_url(). "make-an-order/";?>'+product_id+"/"+qty;
    location.replace(orderurl);
}
function buy_trade_security(product_id,qty){
    var orderurl='<?=base_url(). "order/";?>'+product_id+"/"+qty;
    location.replace(orderurl);
}
function makeOrder(product_id){
    var size=$("#size option:selected").text();
    var color=$("#color option:selected").text()
    var qty=$("#itemp_qty").val();
    if(color!="" &&  size!="" && qty!=""){
        var orderurl='<?=base_url()."make-an-order/";?>'+product_id+"/"+qty+"/"+color+"/"+size;
    }else{
        var orderurl='<?=base_url(). "make-an-order/";?>'+product_id+"/"+qty;
    }
    location.replace(orderurl);
}
function setcheked(id){
    var baseurl='<?php echo base_url();?>';
    if(id=='1'){
        $('#mpesa').show();
        $('#paypal').hide();
        $('#nurucoin').hide();
        $('#card').hide();

    }else if(id=='2'){
        $('#mpesa').hide();
        $('#paypal').show();
        $('#nurucoin').hide();
        $('#card').hide();

    }else if(id=='3'){
        $('#mpesa').hide();
        $('#paypal').hide();
//            $('#nurucoin').show();
        $('#card').hide();
        $('#nurucoinModal').modal('show');

    }
    else if(id=='4'){
        $('#mpesa').hide();
        $('#paypal').hide();
        $('#nurucoin').show();
        $('#card').show();


    }



}

function contactSupplier(supplier_id){



    var base_url='<?php echo base_url()?>';
    $.get(base_url+"get/supplier/Details/"+supplier_id,function(res){

        if(res){
            $(".ContactSupplier #suppliername").html(res.data['company_name']);
            $(".ContactSupplier #address").html(res.data['address']);
            $(".ContactSupplier #phone").html(res.data['phone']);
            $(".ContactSupplier #country").html(res.data['street']);
            $(".ContactSupplier #street").html(res.data['street']);
            $(".ContactSupplier #contact").html(res.data['firstname'] +' '+res.data['lastname'] );
            $(".ContactSupplier #supplier_id").val(res.data['user_id']);
            $(".ContactSupplier #supplier_fname").val(res.data['firstname']);
            $(".ContactSupplier #supplier_lname").val(res.data['lastname']);
            $(".ContactSupplier #company_name").val(res.data['company_name']);
            $(".ContactSupplier #supplier_email").val(res.data['email']);
            $(".ContactSupplier #product_id").val(res.data['id']);
            $(".ContactSupplier #product_name").val(res.data['title']);
            $(".ContactSupplier #product_image").val(res.data['image']);
            $(".ContactSupplier #minisiteurl").val('https://'+ res.data['minisite_prefix'].toLowerCase() +'.blazebay.com');
            //}

            $(".ContactSupplier #productimage").html('<img src="https://www.blazebay.com/assets/uploadedimages/'+res.data['image']+'"  id="image" name="image"  width="75px" height="75px" />');

            location.replace(base_url+"contact-supplier/"+res.data['company_name'].replace(/[^a-z0-9]+/g,'-')+"/"+res.data['id'])
            //  $('.ContactSupplier').modal('show');

        }
        else{
            alert('no data')
        }
    },'json');
}
function viewMinisite(){
    var url=$('#minisiteurl').val();
    window.open(url,'_blank');
}


function submitsupplierContact(){

    var base_url="<?php echo base_url();?>";
    var user_id="<?php echo $this->session->userdata['logged_in']['user_id'];?>";
    if(user_id=='' || user_id==null){
        swal({
            title: "One more step!",
            text: "Please login first to contact the supplier",
            type: "info"
        }, function() {
            $('#loginp').modal('show');
        });

    }else{

        var formData = new FormData($('.Contact_Supplier_Frm')[0]);
        var contactmessage=tinyMCE.get('contact-message').getContent();
        var contactname=$('#contact-name').val();
        var contactemail=$('#contact-email').val();
        var supplierId=$('#contact-supplier-id').val();
        var productId=$('#contact-product-id').val();

        if(contactname==" "){
            new Noty({
                type: 'info',
                timeout: 1000,
                text     : 'Oops!.Please enter your Name',
                container: '.ErrorMessage'
            }).show();
        }
        else if(contactemail==" "){
            new Noty({
                type: 'info',
                timeout: 1000,
                text     : 'Oops!.Please enter your Email',
                container: '.ErrorMessage'
            }).show();
        }
        else if(contactmessage=== undefined || contactmessage.length == 0){
            new Noty({
                type: 'info',
                timeout: 1000,
                text     : 'Oops!.Please enter message',
                container: '.ErrorMessage'
            }).show();
        }
        else {
            $.ajax({
                url: base_url + "contactSupplier",
                type: "POST",
                data: {name:contactname,email:contactemail,message:contactmessage,supplierId:supplierId,productId:productId},
                dataType: "json",
                success: function (msg) {
                    if (msg == 1) {
                        new Noty({
                            type: 'info',
                            timeout: 30000,
                            text     : 'Success! your enquiry has reached the supplier.The supplier is processing it.',
                            container: '.displayMessage'
                        }).show();
                      //  $("html, body").animate({ scrollTop: 0 }, "slow");

                        window.location.href =base_url+"success/"+productId;
                    } else {
                        new Noty({
                            type: 'error',
                            timeout: 30000,
                            text     : 'Error! something went wrong,we are resolving it shortly',
                            container: '.displayMessage'
                        }).show();
                    }
                }

            });


        }
    }
}


function removeWishlist(product){
    $.ajax({
        type  : 'post',
        url   : '<?php echo base_url();?>wishlist-remove',
        data  : {
            'product'   : product
        },
        success: function (response) {
            swal("Success", "Product removed from wishlist", "success");
            location.reload();
        }
    });
}
function wishlist(product,user){
    var user='<?=$this->session->userdata['logged_in']['user_id'];?>';
    if (user=='' || user== null) {
        $('#loginp').modal('show');
    }else {

        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>product-add-to-wishlist',
            data: {
                'user': user,
                'product': product,
                'type': 'wishlist'
            },
            success: function (response) {
                swal("Success", "Product added to wishlist", "success")
            }
        });
    }
}

function compareProducts(product,user){
    var user='<?=$this->session->userdata['logged_in']['user_id'];?>';
    if (user=='' || user== null) {
        $('#loginp').modal('show');
    }else {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>product-add-to-wishlist',
            data: {
                'user': user,
                'product': product,
                'type': 'compare'
            },
            success: function (response) {
                swal("Success", "Product added to comparison list", "success")
            }
        });
    }
}

</script>
