
<!-- Dashboard jQuery  -->
<script src="<?php echo base_url();?>assets2/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script>

<script src="<?php echo base_url();?>assets/js/echo.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.easing-1.3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/lightbox.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url();?>assets/js/scripts.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/noty/lib/noty.min.js"></script>
<script src="<?php echo base_url();?>assets/js/mo.min.js"></script>
<script>
    var resizefunc = [];
</script>


<script src="<?php echo base_url();?>assets2/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets2/js/detect.js"></script>
<script src="<?php echo base_url();?>assets2/js/fastclick.js"></script>
<script src="<?php echo base_url();?>assets2/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url();?>assets2/js/waves.js"></script>
<script src="<?php echo base_url();?>assets2/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url();?>assets2/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url();?>assets2/js/jquery.scrollTo.min.js"></script>


<script src="<?php echo base_url();?>assets2/plugins/jquery-knob/jquery.knob.js"></script>

<!--Morris Chart-->
<script src="<?php echo base_url();?>assets2/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url();?>assets2/plugins/raphael/raphael-min.js"></script>

<!-- Dashboard init -->
<script src="<?php echo base_url();?>assets2/pages/jquery.dashboard.js"></script>

<!-- App js -->
<script src="<?php echo base_url();?>assets2/js/jquery.core.js"></script>
<script src="<?php echo base_url();?>assets2/js/jquery.app.js"></script>
<?php include( APPPATH.'/views/layout/footer.php'); ?>

<script>
$(document).ready(function(e){
    var concept="";
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        concept = $(this).html();

        $('.search-panel span#search_concept').html(concept);
        $('.input-group #search_param').val(param);
    });

    $('#search-field').autocomplete({
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
            if(ui.item.selectedType=="company"){
                window.location="<?=base_url();?>company-details/"+ ui.item.value + "/"+ ui.item.uid;
            }else{
                window.location="<?=base_url();?>product-details/"+ ui.item.value + "/"+ $.trim(ui.item.selectedId)+"/"+ ui.item.uid;
            }

            return false;
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li />")
            .data("item.autocomplete", item)
            .append("<div style='width: 575px;'><a><img  class='img-thumbnail' style='max-height:50px;min-height:50px;max-width:50px;min-width:50px;' src='" +
            item.avatar + "' /><span class='search-title-results' >" + item.value.toLowerCase() + "</span></a></div>")
            .appendTo(ul);
    };
    myFunction();

} );

function myFunction() {
    var x = document.getElementById("myBlazenav");
    if (x.className === "blazenav") {
        x.className += " responsive";
    } else {
        x.className = "blazenav";
    }
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
                            timeout: 1000,
                            text     : 'Your account is not approved',
                            container: '.invalidLogin'
                        }).show();
                        //window.location.href=RedirectUrl;
                    }
                    else if (data==1||data==2||data==3||data==4){

                        new Noty({
                            type: 'success',
                            timeout: 10000,
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
    var searchText=$("#search-field").val();
    if(searchText!=""){
        location.replace('<?=base_url()?>all-products/'+searchText);
    }else{
        location.replace('<?=base_url()?>all-products');
    }

}

function buy(product_id,qty){
    var orderurl='<?=base_url(). "make-an-order/";?>'+product_id+"/"+qty;
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
        $('#nurucoin').show();
        $('#card').hide();

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


            $('.ContactSupplier').modal('show');

        }
        else{
            alert('no data')
        }
    },'json');
}

function removeWishlist(product){
    swal("Error", "something went wrong", "error")
}
function wishlist(product,user){

    $.ajax({
        type  : 'post',
        url   : '<?php echo base_url();?>product-add-to-wishlist',
        data  : {
            'user'       : user,
            'product'   : product
        },
        success: function (response) {
            swal("Success", "Product added to wishlist", "success")
        }
    });
}

function compare(){

    function wishlist(){
        swal("Success", "Product added to comparison", "success")
    }
}

</script>