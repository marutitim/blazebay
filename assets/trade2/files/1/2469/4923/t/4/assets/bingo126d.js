function replaceUrlParam(e,r,a){var n=new RegExp("("+r+"=).*?(&|$)"),c=e;return c=e.search(n)>=0?e.replace(n,"$1"+a+"$2"):c+(c.indexOf("?")>0?"&":"?")+r+"="+a};
if ((typeof Shopify) === 'undefined') { Shopify = {}; }
if (!Shopify.formatMoney) {
    Shopify.formatMoney = function(cents, format) {
        var value = '',
            placeholderRegex = /\{\{\s*(\w+)\s*\}\}/,
            formatString = (format || this.money_format);
        if (typeof cents == 'string') {
            cents = cents.replace('.','');
        }
        function defaultOption(opt, def) {
            return (typeof opt == 'undefined' ? def : opt);
        }
        function formatWithDelimiters(number, precision, thousands, decimal) {
            precision = defaultOption(precision, 2);
            thousands = defaultOption(thousands, ',');
            decimal   = defaultOption(decimal, '.');
            if (isNaN(number) || number == null) {
                return 0;
            }
            number = (number/100.0).toFixed(precision);
            var parts   = number.split('.'),
                dollars = parts[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1' + thousands),
                cents   = parts[1] ? (decimal + parts[1]) : '';
            return dollars + cents;
        }
        switch(formatString.match(placeholderRegex)[1]) {
            case 'amount':
                value = formatWithDelimiters(cents, 2);
                break;
            case 'amount_no_decimals':
                value = formatWithDelimiters(cents, 0);
                break;
            case 'amount_with_comma_separator':
                value = formatWithDelimiters(cents, 2, '.', ',');
                break;
            case 'amount_no_decimals_with_comma_separator':
                value = formatWithDelimiters(cents, 0, '.', ',');
                break;
        }
        return formatString.replace(placeholderRegex, value);
    };
}
Shopify.optionsMap = {};
Shopify.updateOptionsInSelector = function(selectorIndex) {
    switch (selectorIndex) {
        case 0:
            var key = 'root';
            var selector = jQuery('.single-option-selector:eq(0)');
            break;
        case 1:
            var key = jQuery('.single-option-selector:eq(0)').val();
            var selector = jQuery('.single-option-selector:eq(1)');
            break;
        case 2:
            var key = jQuery('.single-option-selector:eq(0)').val();
            key += ' / ' + jQuery('.single-option-selector:eq(1)').val();
            var selector = jQuery('.single-option-selector:eq(2)');
    }
    var initialValue = selector.val();
    selector.empty();
    var availableOptions = Shopify.optionsMap[key];
    for (var i=0; i<availableOptions.length; i++) {
        var option = availableOptions[i];
        var newOption = jQuery('<option></option>').val(option).html(option);
        selector.append(newOption);
    }
    jQuery('.swatch[data-option-index="' + selectorIndex + '"] .swatch-element').each(function() {
        if (jQuery.inArray($(this).attr('data-value'), availableOptions) !== -1) {
            $(this).removeClass('soldout').show().find(':radio').removeAttr('disabled','disabled').removeAttr('checked');
        }
        else {
            $(this).addClass('soldout').hide().find(':radio').removeAttr('checked').attr('disabled','disabled');
        }
    });
    if (jQuery.inArray(initialValue, availableOptions) !== -1) {
        selector.val(initialValue);
    }
    selector.trigger('change');
};
Shopify.linkOptionSelectors = function(product) {
    // Building our mapping object.
    for (var i=0; i<product.variants.length; i++) {
        var variant = product.variants[i];
        if (variant.available) {
            // Gathering values for the 1st drop-down.
            Shopify.optionsMap['root'] = Shopify.optionsMap['root'] || [];
            Shopify.optionsMap['root'].push(variant.option1);
            Shopify.optionsMap['root'] = Shopify.uniq(Shopify.optionsMap['root']);
            // Gathering values for the 2nd drop-down.
            if (product.options.length > 1) {
                var key = variant.option1;
                Shopify.optionsMap[key] = Shopify.optionsMap[key] || [];
                Shopify.optionsMap[key].push(variant.option2);
                Shopify.optionsMap[key] = Shopify.uniq(Shopify.optionsMap[key]);
            }
            // Gathering values for the 3rd drop-down.
            if (product.options.length === 3) {
                var key = variant.option1 + ' / ' + variant.option2;
                Shopify.optionsMap[key] = Shopify.optionsMap[key] || [];
                Shopify.optionsMap[key].push(variant.option3);
                Shopify.optionsMap[key] = Shopify.uniq(Shopify.optionsMap[key]);
            }
        }
    }
    // Update options right away.
    Shopify.updateOptionsInSelector(0);
    if (product.options.length > 1) Shopify.updateOptionsInSelector(1);
    if (product.options.length === 3) Shopify.updateOptionsInSelector(2);
    // When there is an update in the first dropdown.
    jQuery(".single-option-selector:eq(0)").change(function() {
        Shopify.updateOptionsInSelector(1);
        if (product.options.length === 3) Shopify.updateOptionsInSelector(2);
        return true;
    });
    // When there is an update in the second dropdown.
    jQuery(".single-option-selector:eq(1)").change(function() {
        if (product.options.length === 3) Shopify.updateOptionsInSelector(2);
        return true;
    });
};
window.bingo = window.bingo || {};
bingo.cacheSelectors = function () {
    bingo.cache = {
        $html                    : $('html'),
        $body                    : $('body'),
        $recoverPasswordLink     : $('#RecoverPassword'),
        $hideRecoverPasswordLink : $('#HideRecoverPasswordLink'),
        $recoverPasswordForm     : $('#RecoverPasswordForm'),
        $customerLoginForm       : $('#CustomerLoginForm'),
        $passwordResetSuccess    : $('#ResetSuccess'),
        $bingoProductImage       : $('#ProductPhotoImg'),
        $bingoNewletterModal         : $('#bingoNewsletterModal')
    };
};
bingo.init = function () {
    FastClick.attach(document.body);
    bingo.cacheSelectors();
    bingo.startTheme();
    bingo.drawersInit();
    bingo.responsiveVideos();
    bingo.loginForms();
    bingo.productThumbImage();
    bingo.accordion();
    bingo.wishlist();
    bingo.quickview();
    bingo.ajaxFilter();
    bingo.floatHeader();
    bingo.productCountdown();
    bingo.goToTop();
    bingo.filterByPrice();
    bingo.slickCarousel();
    bingo.owlOneCarousel();
    bingo.instagram();
    bingo.bingoConfigSection();
    bingo.menuMobile();
    bingo.menuCategoty();
    // bingo.owlTwoCarousel();
    
        ajaxCart.load();
    
};
bingo.drawersInit = function () {
    //bingo.LeftDrawer = new bingo.Drawers('menuDrawer', 'Left', false);
    bingo.RightDrawer = new bingo.Drawers('cartDrawer', 'Right', true, {});
};
bingo.getHash = function () {
    return window.location.hash;
};
bingo.startTheme = function () {
    $(".swatch :radio").change(function() {
        var t = $(this).closest(".swatch").attr("data-option-index");
        var n = $(this).val();
        $(this).closest("form").find(".single-option-selector").eq(t).val(n).trigger("change")
    });
    $('.headerCartModal .overlayCart, .headerCartModal .closeCartModal').on('click', function(){
        $('.headerCartModal').removeClass('active');
    });
};
bingo.productPage = function (options) {
    var moneyFormat = options.money_format,
        variant = options.variant,
        selector = options.selector;
    var $addToCart = $('#AddToCart'),
        $productPrice = $('#ProductPrice'),
        $comparePrice = $('#ComparePrice'),
        $quantityElements = $('.qtySelector, label + .bingoJsQty'),
        $addToCartText = $('#AddToCartText');
    if (variant) {
        if (variant.available) {
            $addToCart.removeClass('disabled').prop('disabled', false);
            $addToCartText.html("Add to Cart");
            $quantityElements.show();
        } else {
            $addToCart.addClass('disabled').prop('disabled', true);
            $addToCartText.html("Sold Out");
            $quantityElements.hide();
        }
        $productPrice.html( Shopify.formatMoney(variant.price, moneyFormat) );
        if (variant.compare_at_price > variant.price) {
            $comparePrice
            .html(Shopify.formatMoney(variant.compare_at_price, moneyFormat))
            .show();
        } else {
            $comparePrice.hide();
        }
        if (window.swatch_enable) {
            var form = $('#' + selector.domIdPrefix).closest('form');
            for (var i=0,length=variant.options.length; i<length; i++) {
                var radioButton = form.find('.swatch[data-option-index="' + i + '"] :radio[value="' + variant.options[i] +'"]');
                if (radioButton.size()) {
                    radioButton.get(0).checked = true;
                }
            }
        }
      	$('.productSKU')
            .html('<label>' + "SKU" + '</label>: ' + variant.sku);
        if (variant.available) {
            $('.productAvailability').removeClass('outstock');
            $('.productAvailability').addClass('instock');
            $('.productAvailability')
            .html('<label>' + "Availability" + '</label>: ' + "In stock");
        } else{
            $('.productAvailability').removeClass('instock');
            $('.productAvailability').addClass('outstock');
            $('.productAvailability').html('<label>' + "Availability" + '</label>: ' + "Unavailable");
        }
    } else {
        $addToCart.addClass('disabled').prop('disabled', true);
        $addToCartText.html("Unavailable");
        $quantityElements.hide();
    }
    if (variant && variant.featured_image) {
        var originalImage = $(".proFeaturedImage img");
        var newImage = variant.featured_image;
        var element = originalImage[0];
        Shopify.Image.switchImage(newImage, element, function (newImageSizedSrc, newImage, element) {
            $('#productThumbs img').each(function() {
                var parentThumbImg = $(this).parent();
                var idProductImage = $(this).parent().data("imageid");
                if (idProductImage == newImage.id) {
                    $(this).parent().trigger('click');
                    return false;
                }
            });
        });
    }
};
bingo.responsiveVideos = function () {
    var $iframeVideo = $('iframe[src*="youtube.com/embed"], iframe[src*="player.vimeo"]');
    var $iframeReset = $iframeVideo.add('iframe#admin_bar_iframe');
    $iframeVideo.each(function () {
        $(this).wrap('<div class="videoContainer"></div>');
    });
    $iframeReset.each(function () {
        this.src = this.src;
    });
};
bingo.productCountdown = function() {
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime(window.countdown_format));
        });
    });
};
bingo.goToTop = function() {
    $(window).scroll(function() {
        if ($(window).scrollTop() >= 200) {
            $('#goToTop').fadeIn();
        } else {
            $('#goToTop').fadeOut();
        }
    });
    $("#goToTop").click(function(){
        $("body,html").animate({scrollTop:0 },"normal");
        $("#pageContainer").animate({scrollTop:0 },"normal");
            return!1
    });
}
bingo.loginForms = function() {
    function showRecoverPasswordForm() {
        bingo.cache.$recoverPasswordForm.show();
        bingo.cache.$customerLoginForm.hide();
    }
    function hideRecoverPasswordForm() {
        bingo.cache.$recoverPasswordForm.hide();
        bingo.cache.$customerLoginForm.show();
    }
    bingo.cache.$recoverPasswordLink.on('click', function(evt) {
        evt.preventDefault();
        showRecoverPasswordForm();
    });
    bingo.cache.$hideRecoverPasswordLink.on('click', function(evt) {
        evt.preventDefault();
        hideRecoverPasswordForm();
    });
    if (bingo.getHash() == '#recover') {
        showRecoverPasswordForm();
    }
};
bingo.resetPasswordSuccess = function() {
    bingo.cache.$passwordResetSuccess.show();
};
bingo.productImage = function(){
    if (bingo.cache.$bingoProductImage.length > 0) {
        if (($(window).width()) >= 992){
            //DESKTOP
            var zoomYN = bingo.cache.$bingoProductImage.data('zoom-enable');
            bingo.cache.$bingoProductImage.elevateZoom({
                zoomEnabled: zoomYN,
                zoomWindowWidth: 500,
                zoomWindowHeight: 500,
                gallery: 'productThumbs',
                cursor: 'pointer',
                galleryActiveClass: 'active',
                imageCrossfade: zoomYN,
                scrollZoom: zoomYN,
                onImageSwapComplete: function() {

                },
                //loadingIcon: window.loading_url
            });

            console.log(bingo.cache.$bingoProductImage.data('zoom-enable')); // mystic add
            bingo.cache.$bingoProductImage.bind("click", function(e) {
                var ez = bingo.cache.$bingoProductImage.data('elevateZoom');
                $.fancybox(ez.getGalleryList());
                return false;
            });
        }
        else if (($(window).width()) <= 991){
            //TABLET, MOBILE
            bingo.cache.$bingoProductImage.elevateZoom({
                zoomEnabled: false,
                gallery: 'productThumbs',
                cursor: 'pointer',
                galleryActiveClass: 'active',
                imageCrossfade: false,
                scrollZoom: false,
                onImageSwapComplete: function() {

                },
                //loadingIcon: window.loading_url
            });
            bingo.cache.$bingoProductImage.bind("click", function(e) {
                return false;
            });
        }
    }
};
bingo.floatHeader = function(){
    function doFloatHeader(status){
        if(status){
            $('#bingoHeader').addClass('headerFixed');
            $('#pageContainer').css('padding-top', $('#bingoHeader').height());
            var hideheight =  $('#bingoHeader').height() + 120;
            var pos = $(window).scrollTop();
            if( pos >= hideheight ){
                $('#bingoHeader').addClass('bingoHeaderFixed');
            }else {
                $('#bingoHeader').removeClass('bingoHeaderFixed');
            }
        }
        else{
            $('#bingoHeader').removeClass('headerFixed');
            $('#pageContainer').css('padding-top', '');
            $('#bingoHeader').removeClass('bingoHeaderFixed');
        }
    }
    function bingoFloatHeader(){
        if (window.float_header){
            if (($(window).width()) >= 992){
                doFloatHeader(true);
            }
            else if (($(window).width()) <= 991){
                doFloatHeader(false)
            }
        }
    }
    function bingoFloatHeaderChange(){
        if (window.float_header){
            if (($(window).width()) >= 992){
                var hideheight =  $('#bingoHeader').height() + 120;
                var pos = $(window).scrollTop();
                if( pos >= hideheight ){
                    $('#bingoHeader').addClass('bingoHeaderFixed');
                }else {
                    $('#bingoHeader').removeClass('bingoHeaderFixed');
                }
            }
            else if (($(window).width()) <= 991){
                $('#bingoHeader').removeClass('bingoHeaderFixed');
            }
        }
    }
    bingoFloatHeader();
    $(window).resize(bingoFloatHeader);
    $(window).scroll(bingoFloatHeaderChange);
};
bingo.productThumbImage = function(){
    if ($("#productThumbs").length > 0) {
        $('.owl-thumblist .owl-carousel').owlCarousel({
            navigation: true,
            items: 5,
            itemsDesktop: [1199, 5],
            itemsDesktopSmall: [979, 4],
            itemsTablet: [767, 4],
            itemsTabletSmall: [540, 4],
            itemsMobile: [360, 4]
        });
        $('.slick-thumblist .slick-carousel').slick({
            vertical: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            swipeToSlide: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
};
bingo.accordion = function(){
    function accordionSidebar(){
        if ( $(window).width() <= 767){
            if(!$('.bingoSidebar').hasClass('accordion')){
                $('.bingoSidebar .titleSidebar').on('click', function(e){
                    $(this).toggleClass('active').parent().find('.bingoContent').stop().slideToggle('medium');
                    e.preventDefault();
                });
                $('.bingoSidebar').addClass('accordion').find('.bingoContent').slideUp('fast');
            }
        }
        else {
            $('.bingoSidebar .titleSidebar').removeClass('active').off().parent().find('.bingoContent').removeAttr('style').slideDown('fast');
            $('.bingoSidebar').removeClass('accordion');
        }
    }
    function accordionFooter(){
        if ( $(window).width() <= 767){
            if(!$('.bingoFooter').hasClass('accordion')){
                $('.bingoFooter .bingoFooterTitle').on('click', function(e){
                    $(this).toggleClass('active').parent().find('.bingoContent').stop().slideToggle('medium');
                    e.preventDefault();
                });
                $('.bingoFooter').addClass('accordion').find('.bingoContent').slideUp('fast');
            }
        }
        else {
            $('.bingoFooter .bingoFooterTitle').removeClass('active').off().parent().find('.bingoContent').removeAttr('style').slideDown('fast');
            $('.bingoFooter').removeClass('accordion');
        }
    }
    accordionSidebar();
    accordionFooter();
    $(window).resize(accordionSidebar);
    $(window).resize(accordionFooter);
};
bingo.ajaxFilter = function(){
    var isAjaxFilterClick =  false;
    if ($(".template-collection")) {
        History.Adapter.bind(window, 'statechange', function() {
            var State = History.getState();
            if (!isAjaxFilterClick) {
                ajaxFilterParams();
                var newurl = ajaxFilterCreateUrl();
                ajaxFilterGetContent(newurl);
                reActivateSidebar();
            }
            bingo.isSidebarAjaxClick = false;
        });
    }
    ajaxFilterParams = function () {
        Shopify.queryParams = {};
        if (location.search.length) {
            for (var aKeyValue, i = 0, aCouples = location.search.substr(1).split('&'); i < aCouples.length; i++) {
                aKeyValue = aCouples[i].split('=');
                if (aKeyValue.length > 1) {
                    Shopify.queryParams[decodeURIComponent(aKeyValue[0])] = decodeURIComponent(aKeyValue[1]);
                }
            }
        }
    }
    ajaxFilterCreateUrl = function(baseLink) {
        var newQuery = $.param(Shopify.queryParams).replace(/%2B/g, '+');
        if (baseLink) {
            if (newQuery != "")
                return baseLink + "?" + newQuery;
            else
                return baseLink;
        }
        return location.pathname + "?" + newQuery;
    }
    ajaxFilterClick = function(baseLink) {
        delete Shopify.queryParams.page;
        var newurl = ajaxFilterCreateUrl(baseLink);
        isAjaxFilterClick = true;
        History.pushState({
            param: Shopify.queryParams
        }, newurl, newurl);
        ajaxFilterGetContent(newurl);
    }
    ajaxFilterSortby = function() {
        if (Shopify.queryParams.sort_by) {
            var sortby = Shopify.queryParams.sort_by;
            $("#SortBy").val(sortby);
        }
        $("#SortBy").change(function(event){
            Shopify.queryParams.sort_by = $(this).val();
            ajaxFilterClick();
        });
    }
    ajaxFilterView = function() {
        $(".changeView").click(function(event) {
            event.preventDefault();
            if (!$(this).hasClass("changeViewActive")) {
                if ($(this).data('view') == 'list' ) {
                    Shopify.queryParams.view = "list";
                } else {
                    Shopify.queryParams.view = "grid";
                }
                $(".changeView").removeClass('changeViewActive');
                $(this).addClass('changeViewActive');
                ajaxFilterClick();
            }
        });
    }
    ajaxFilterTags = function(){
        $('.ajaxFilter li > a').click(function(event) {
            event.preventDefault();
            var currentTags = [];
            if (Shopify.queryParams.constraint) {
                currentTags = Shopify.queryParams.constraint.split('+');
            }
            if (!window.sidebar_multichoise && !$(this).parent().hasClass("active")) {
                var otherTag = $(this).parents('.listFilter').find("li.active");
                if (otherTag.length > 0) {
                    var tagName = otherTag.data("filter");
                    if (tagName) {
                        var tagPos = currentTags.indexOf(tagName);
                        if (tagPos >= 0) {
                            currentTags.splice(tagPos, 1);
                        }
                    }
                }
            }
            var dataHandle = $(this).parent().data("filter");
            if (dataHandle) {
                var tagPos = currentTags.indexOf(dataHandle);
                if (tagPos >= 0) {
                    currentTags.splice(tagPos, 1);
                } else {
                    currentTags.push(dataHandle);
                }
            }
            if (currentTags.length) {
                Shopify.queryParams.constraint = currentTags.join('+');
            } else {
                delete Shopify.queryParams.constraint;
            }
            ajaxFilterClick();
        });
    }
    ajaxFilterPaging = function() {
        $('#collPagination .pagination a').click(function(event){
            event.preventDefault();
            var linkPage = $(this).attr("href").match(/page=\d+/g);
            if (linkPage) {
                Shopify.queryParams.page = parseInt(linkPage[0].match(/\d+/g));
                if (Shopify.queryParams.page) {
                    var newurl = ajaxFilterCreateUrl();
                    isAjaxFilterClick = true;
                    History.pushState({
                        param: Shopify.queryParams
                    }, newurl, newurl);
                    ajaxFilterGetContent(newurl);
                    $('body,html').animate({
                        scrollTop: 400
                    }, 600);
                }
            }
        });
    }
    ajaxFilterReview = function() {
        if (window.review){
            if ($(".shopify-product-reviews-badge").length > 0) {
                return window.SPR.registerCallbacks(), window.SPR.initRatingHandler(), window.SPR.initDomEls(), window.SPR.loadProducts(), window.SPR.loadBadges();
            };
        }
    }
    ajaxFilterClear = function() {
        $(".ajaxFilter").each(function() {
            var sidebarTag = $(this);
            if (sidebarTag.find(".listFilter > li.active").length > 0) {
                sidebarTag.find(".bingoClear").show().click(function(e) {
                    var currentTags = [];
                    if (Shopify.queryParams.constraint) {
                        currentTags = Shopify.queryParams.constraint.split('+');
                    }
                    sidebarTag.find(".listFilter > li.active").each(function() {
                        var selectedTag = $(this);
                        var tagName = selectedTag.data("filter");
                        if (tagName) {
                            var tagPos = currentTags.indexOf(tagName);
                            if (tagPos >= 0) {
                                currentTags.splice(tagPos, 1);
                            }
                        }
                    });
                    if (currentTags.length) {
                        Shopify.queryParams.constraint = currentTags.join('+');
                    } else {
                        delete Shopify.queryParams.constraint;
                    }
                    ajaxFilterClick();
                    e.preventDefault();
                });
            }
        });
    }
    ajaxFilterClearAll = function() {
        $('.bingoFilter a.bingoClearAll').click(function(e) {
            delete Shopify.queryParams.constraint;
            delete Shopify.queryParams.q;
            ajaxFilterClick();
            e.preventDefault();
        });
    }
    ajaxFilterAddToCart = function(){
        if (window.ajaxcart_type != "page"){
            ajaxCart.init({
                formSelector: '.formAddToCart',
                cartContainer: '#cartContainer',
                addToCartSelector: '.btnAddToCart',
                cartCountSelector: '#CartCount',
                cartCostSelector: '#CartCost',
                moneyFormat: null
            });
        }
    }
    ajaxAccordionMobile = function(){
        if($('.bingoSidebar').hasClass('accordion')){
            $('#sidebarAjaxFilter .titleSidebar').on('click', function(e){
                $(this).toggleClass('active').parent().find('.bingoContent').stop().slideToggle('medium');
                e.preventDefault();
            });
        }
    }
    ajaxFilterData = function(data){
        var currentList = $("#proListCollection .proList");
        var dataList = $(data).find("#proListCollection .proList");
        currentList.replaceWith(dataList);
        if ($("#collPagination").length > 0) {
            $("#collPagination").replaceWith($(data).find("#collPagination"));
        } else {
            $("#proListCollection").append($(data).find("#collPagination"));
        }
        var currentSidebarFilter = $("#sidebarAjaxFilter");
        var dataSidebarFilter = $(data).find("#sidebarAjaxFilter");
        currentSidebarFilter.replaceWith(dataSidebarFilter);
    }
    ajaxFilterGetContent = function(newurl) {
        $.ajax({
            type: 'get',
            url: newurl,
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
              	var newTitle = $(data).filter('title').text();
                document.title = newTitle;
                ajaxFilterData(data);
                ajaxFilterSortby();
                ajaxFilterView();
                ajaxFilterTags();
                ajaxFilterPaging();
                ajaxFilterReview();
                ajaxFilterClear();
                ajaxFilterClearAll();

                $('#loading').hide();
                ajaxFilterAddToCart();
                bingo.wishlist();
                bingo.quickview();
                ajaxAccordionMobile();
            },
            error: function(xhr, text) {
                $('#loading').hide();

            }
        });
    }
    ajaxFilterParams();
    ajaxFilterSortby();
    ajaxFilterView();
    ajaxFilterTags();
    ajaxFilterPaging();
    ajaxFilterClear();
    ajaxFilterClearAll();
};
bingo.wishlist = function(){
    function postToWishlist() {
        $(".wishlistForm").submit(function(e) {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            var d = $(this).parent();
            e.preventDefault();
            $.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                beforeSend: function() {
                    $('#loading').show();
                },
                success:function(data, textStatus) {
                    $('#loading').hide();
                    d.empty().html('<a class="btn btnProduct btnWishlistAdded added" href="' + window.wishlist_url + '"><i class="fa fa-heart"></i><span>Added to wishlist</span></a>');
                    btnWishlist();
                    if (!!$.prototype.fancybox)
                        $.fancybox.open([{
                            type: 'inline',
                            autoScale: true,
                            minHeight: 30,
                            content: '<div class="wishlistAlert"><div class="alert alert-success">' + 'Added to your wishlist.' + '<a href="' + window.wishlist_url + '">Go To Wishlist</a>' + '</div></div>'
                        }], {
                            padding: 0
                        });
                    else
                        alert('Added to your wishlist.');
                },
                error: function() {
                    $('#loading').hide();
                    if (!!$.prototype.fancybox)
                        $.fancybox.open([{
                            type: 'inline',
                            autoScale: true,
                            minHeight: 30,
                            content: '<p class="fancybox-error">I`m afraid that did not work</p>'
                        }], {
                            padding: 0
                        });
                    else
                        alert('I`m afraid that did not work');
                }
            });
        });
    }
    function removeFromWishlist($this) {
        var $elem = $this.closest("tr");
        var tagID = $elem.attr("id");
        var $form = $("#removeWishlist");
        $("#remove-value").attr("value", tagID);
        var postData = $form.serializeArray();
        var formURL = $form.attr("action");
        $.ajax({
            url : formURL,
            type: "POST",
            data : postData,
            beforeSend: function() {
                $('#loading').show();
            },
            success:function(data, textStatus) {
                $('#loading').hide();
                $elem.remove();
                if($(".wishlist-product tbody tr").length == 0) {
                    $("#wishlist-email-link").empty().html("<p>Your wish list is currently empty.</p>");
                } else {
                    updateEmailList();
                }
            },
            error: function() {
                $('#loading').hide();
                if (!!$.prototype.fancybox)
                    $.fancybox.open([{
                        type: 'inline',
                        autoScale: true,
                        minHeight: 30,
                        content: '<p class="fancybox-error">I`m afraid that did not work</p>'
                    }], {
                        padding: 0
                    });
                else
                    alert('I`m afraid that did not work');
            }
        });
    }
    function updateEmailList() {
        var currentURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
        $.ajax({
            url : currentURL,
            type: "GET",
            success:function(data, textStatus) {
                var newEmailLink = $(data).find("#wishlist-email-link a");
                $("#wishlist-email-link").html(newEmailLink);
            }
        });
    }
    function btnWishlist(){
        //$('.btnRemoveWishlist').on('click', function(e) {
        //    e.preventDefault();
        //    removeFromWishlist($(this));
        //});
        $('.btnWishlistNoLog').on('click', function(e){
            e.preventDefault();
            if (!!$.prototype.fancybox)
                $.fancybox.open([{
                    type: 'inline',
                    autoScale: true,
                    minHeight: 30,
                    content: '<div class="wishlistAlert"><div class="alert alert-info">' + 'You must be logged in to manage your wishlist. <a href="/account">Login here.</a>' + '</div></div>'
                }], {
                    padding: 0
                });
            else
              alert('You must be logged in to manage your wishlist. <a href="/account">Login here.</a>');
        });
        //$('.btnWishlistAdded').on('click', function(e){
        //    e.preventDefault();
        //    if (!!$.prototype.fancybox)
        //        $.fancybox.open([{
        //            type: 'inline',
        //            autoScale: true,
        //            minHeight: 30,
        //            content: '<div class="wishlistAlert"><div class="alert alert-success">' + 'Added to your wishlist.' + '<a href="' + window.wishlist_url + '">Go To Wishlist</a>' + '</div></div>'
        //        }], {
        //            padding: 0
        //        });
        //    else
        //      alert('Added to your wishlist.');
        //});
    }
    //postToWishlist();
    btnWishlist();
};
bingo.quickview = function(){
    var product = {};
    var option1 = '';
    var option2 = '';
    Shopify.doNotTriggerClickOnThumb = false;
    selectCallbackQuickView = function(variant, selector) {
        var productItem = jQuery('.jsQuickview .proBoxInfo'),
            addToCart = productItem.find('.btnAddToCart'),
            productPrice = productItem.find('.pricePrimary'),
            comparePrice = productItem.find('.priceCompare');
        if (variant) {
          	productItem.find(".quickViewSKU").html("<label>SKU</label>: " + variant.sku);
            if (variant.available) {
                addToCart.removeClass('disabled').removeAttr('disabled');
                $(addToCart).find("span").text("Add to Cart");
            } else {
                addToCart.addClass('disabled').attr('disabled', 'disabled');
                $(addToCart).find("span").text("Sold Out");
            }
            productPrice.html(Shopify.formatMoney(variant.price, window.money));
            if ( variant.compare_at_price > variant.price ) {
                comparePrice
                    .html(Shopify.formatMoney(variant.compare_at_price, window.money)).show();
            } else {
                comparePrice.hide();
            }
            if (window.swatch_enable) {
                productItem.find(".selector-wrapper").addClass("hiddenVariant");
                var form = jQuery('#' + selector.domIdPrefix).closest('form');
                for (var i=0,length=variant.options.length; i<length; i++) {
                    var radioButton = form.find('.swatch[data-option-index="' + i + '"] :radio[value="' + variant.options[i] +'"]');
                    if (radioButton.size()) {
                        radioButton.get(0).checked = true;
                    }
                }
            }
            if (variant && variant.featured_image) {
                var originalImage = $(".proImageQuickview");
                var newImage = variant.featured_image;
                var element = originalImage[0];
                Shopify.Image.switchImage(newImage, element, function (newImageSizedSrc, newImage, element) {
                    $('.proThumbnails img').each(function() {
                        var parentThumbImg = $(this).parent();
                        var productImage = $(this).parent().data("image");
                        if (newImageSizedSrc.includes(productImage)) {
                            $(this).parent().trigger('click');
                            return false;
                        }
                    });
                });
            }
        } else {
            addToCart.addClass('disabled').attr('disabled', 'disabled');
            $(addToCart).find("span").text("Sold Out");
        }
    }
    changeImageQuickView = function (img, selector) {
        var src = $(img).attr("src");
        src = src.replace("_compact", "");
        $(selector).attr("src", src);
    }
    bingoUpdateOptionsInSelector = function (t) {
        switch (t) {
        case 0:
            var n = "root";
            var r = $(".jsQuickview .single-option-selector:eq(0)");
            break;
        case 1:
            var n = $(".jsQuickview .single-option-selector:eq(0)").val();
            var r = $(".jsQuickview .single-option-selector:eq(1)");
            break;
        case 2:
            var n = $(".jsQuickview .single-option-selector:eq(0)").val();
            n += " / " + $(".jsQuickview .single-option-selector:eq(1)").val();
            var r = $(".jsQuickview .single-option-selector:eq(2)")
        }
        var i = r.val();
        r.empty();
        var s = Shopify.optionsMapQuickview[n];
        if(typeof s != "undefined"){
            for (var o = 0; o < s.length; o++) {
                var u = s[o];
                var a = $("<option></option>").val(u).html(u);
                r.append(a)
            }
        }
        $('.jsQuickview .swatch[data-option-index="' + t + '"] .swatch-element').each(function() {
            if ($.inArray($(this).attr("data-value"), s) !== -1) {
                $(this).removeClass("soldout").show().find(":radio").removeAttr("disabled", "disabled");
            } else {
                //$(this).addClass("soldout").hide().find(":radio").removeAttr("checked").attr("disabled", "disabled")
            }
        });
        if ($.inArray(i, s) !== -1) {
            r.val(i)
        }
        r.trigger("change")
    }
    bingoLinkOptionSelectors = function (t) {
        for (var n = 0; n < t.variants.length; n++) {
            var r = t.variants[n];
            if (r.available) {
                Shopify.optionsMapQuickview["root"] = Shopify.optionsMapQuickview["root"] || [];
                Shopify.optionsMapQuickview["root"].push(r.option1);
                Shopify.optionsMapQuickview["root"] = Shopify.uniq(Shopify.optionsMapQuickview["root"]);
                if (t.options.length > 1) {
                    var i = r.option1;
                    Shopify.optionsMapQuickview[i] = Shopify.optionsMapQuickview[i] || [];
                    Shopify.optionsMapQuickview[i].push(r.option2);
                    Shopify.optionsMapQuickview[i] = Shopify.uniq(Shopify.optionsMapQuickview[i])
                }
                if (t.options.length === 3) {
                    var i = r.option1 + " / " + r.option2;
                    Shopify.optionsMapQuickview[i] = Shopify.optionsMapQuickview[i] || [];
                    Shopify.optionsMapQuickview[i].push(r.option3);
                    Shopify.optionsMapQuickview[i] = Shopify.uniq(Shopify.optionsMapQuickview[i])
                }
            }
        }
        bingoUpdateOptionsInSelector(0);
        if (t.options.length > 1)
            bingoUpdateOptionsInSelector(1);
        if (t.options.length === 3)
            bingoUpdateOptionsInSelector(2);
        $(".single-option-selector:eq(0)").change(function() {
            bingoUpdateOptionsInSelector(1);
            if (t.options.length === 3)
                bingoUpdateOptionsInSelector(2);
            return true
        });
        $(".single-option-selector:eq(1)").change(function() {
            if (t.options.length === 3)
                bingoUpdateOptionsInSelector(2);
            return true
        });
    }
    loadQuickViewSlider = function (n, r) {
        var loadingImgQuickView = $('.loadingImage');
        var s = Shopify.resizeImage(n.featured_image, "grande");
        loadingImgQuickView.hide();
        if (n.images.length > 0) {
            var o = r.find(".proThumbnailsQuickview .owl-carousel");
            for (i in n.images) {
                var u = Shopify.resizeImage(n.images[i], "grande");
                var a = Shopify.resizeImage(n.images[i], "compact");
                var f = '<div class="thumbItem"><a href="javascript:void(0)" data-imageid="' + n.id + '" data-image="' + n.images[i] + '" data-zoom-image="' + u + '" ><img src="' + a + '" alt="Produc Image" /></a></div>';
                o.append(f)
            }
            o.find("a").click(function() {
                var t = r.find(".proImageQuickview");
                if (t.attr("src") != $(this).attr("data-image")) {
                    t.attr("src", $(this).attr("data-image"));
                    loadingImgQuickView.show();
                    t.load(function(t) {
                        $(this).unbind("load");
                        loadingImgQuickView.hide()
                    })
                }
            });
            o.owlCarousel({
                navigation: true,
                items: 4,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [979, 4],
                itemsTablet: [767, 4],
                itemsTabletSmall: [540, 4],
               itemsMobile: [360, 4]
            }).css("visibility", "visible")
        } else {
            r.find(".jsQuickview .proThumbnailsQuickview").remove();
        }
    }
    convertToSlug = function (e) {
        return e.toLowerCase().replace(/[^a-z0-9 -]/g, "").replace(/\s+/g, "-").replace(/-+/g, "-")
    }
    addCheckedSwatch = function (){
        $('.swatch .color label').on('click', function () {
            $('.swatch .color').each(function(){
                $(this).find('label').removeClass('checkedBox');
            });
            $(this).addClass('checkedBox');
        });
    }
    quickViewVariantsSwatch = function (t, quickview) {
        if (t.variants.length > 1) {
            for (var r = 0; r < t.variants.length; r++) {
                var i = t.variants[r];
                var s = '<option value="' + i.id + '">' + i.title + "</option>";
                quickview.find("form.formQuickview .proVariantsQuickview > select").append(s)
            }
            new Shopify.OptionSelectors( 'productSelectQuickview', {
                product: t,
                onVariantSelected: selectCallbackQuickView
            });
            if (t.options.length == 1) {
                $("form.formQuickview .selector-wrapper:eq(0)").prepend("<label>" + t.options[0].name + "</label>")
            }
            quickview.find("form.formQuickview .selector-wrapper label").each(function(n, r) {
                $(this).html(t.options[n].name)
            });
            if (window.swatch_enable) {
                quickview.find(".selector-wrapper").addClass("hiddenVariant");
                var o = window.file_url.substring(0, window.file_url.lastIndexOf("?"));
                var u = window.asset_url.substring(0, window.asset_url.lastIndexOf("?"));
                var a = "";
                for (var r = 0; r < t.options.length; r++) {
                    a += '<div class="swatch clearfix" data-option-index="' + r + '">';
                    a += '<div class="header">' + t.options[r].name + "</div>";
                    var f = false;
                    if (/Color|Colour/i.test(t.options[r].name)) { f = true }
                    var l = new Array;
                    for (var c = 0; c < t.variants.length; c++) {
                        var i = t.variants[c]; var h = i.options[r];
                        var p = this.convertToSlug(h);
                        var d = "quickview-swatch-" + r + "-" + p;
                        if (l.indexOf(h) < 0) {
                            a += '<div data-value="' + h + '" class="swatch-element ' + (f ? "color " : "") + p + (i.available ? " available " : " soldout ") + '">';
                            if (f) {
                                a += '<div class="tooltip">' + h + "</div>"
                            }
                            a += '<input id="' + d + '" type="radio" name="option-' + r + '" value="' + h + '" ' + (c == 0 ? " checked " : "") + (i.available ? "" : " disabled") + " />";
                            if (f) {
                                a += '<label class="'+ p +'" for="' + d + '" style="background-color: ' + p + "; background-image: url(" + o + p + '.png)"><img class="crossed-out" src="' + u + 'soldout.png" /><i></i></label>'
                            }
                            else {
                                a += '<label class="'+ p +'" for="' + d + '">' + h + '<img class="crossed-out" src="' + u + 'soldout.png" /></label>'
                            }
                            a += "</div>";
                            if (i.available) {
                                $('.jsQuickview .swatch[data-option-index="' + r + '"] .' + p).removeClass("soldout").addClass("available").find(":radio").removeAttr("disabled")
                            } l.push(h)
                        }
                    } a += "</div>"
                }
                quickview.find("form.formQuickview .proVariantsQuickview > select").after(a);
                quickview.find(".swatch :radio").change(function () {
                    var t = $(this).closest(".swatch").attr("data-option-index");
                    var q = $(this).val();
                    $(this).closest("form").find(".single-option-selector").eq(t).val(q).trigger("change");

                });
                addCheckedSwatch();
            }
            if (t.available) {
                Shopify.optionsMapQuickview = {};
                bingoLinkOptionSelectors(t);
            }
        }
        else {
            quickview.find("form.formQuickview .proVariantsQuickview > select").remove();
            var v = '<input type="hidden" name="id" value="' + t.variants[0].id + '">';
            quickview.find("form.formQuickview").append(v)
        }
    }
    validateQty = function (qty) {
        if((parseFloat(qty) == parseInt(qty)) && !isNaN(qty)) {

        } else {
            qty = 1;
        }
        return qty;
    };
	qvAddToCart = function(){
        if (window.ajaxcart_type != "page"){
            ajaxCart.init({
                formSelector: '.formQuickview',
                cartContainer: '#cartContainer',
                addToCartSelector: '.btnAddToCart',
                cartCountSelector: '#CartCount',
                cartCostSelector: '#CartCost',
                moneyFormat: null
            });
        }
    }
    $(document).on("click", ".proThumbnailsQuickview li", function() {
        changeImageQuickView($(this).find("img:first-child"), ".proImageQuickview");
    });
    $(document).on('click', '.quickviewClose, .quickviewOverlay', function(e){
        $("#bingoQuickView").fadeOut(500);
        $(".jsQuickview").html("");
        $(".jsQuickview").fadeOut(500);
    });
    $(document).on('click', '.btnProductQuickview', function(e){
        $('#loading').show();
        var producthandle = $(this).data("handle");
        Shopify.getProduct(producthandle,function(product) {
            var qvhtml = $("#quickviewModal").html();
            $(".jsQuickview").html(qvhtml);
            var quickview= $(".jsQuickview");
            var productdes = product.description.replace(/(<([^>]+)>)/ig,"");
            var featured_image = product.featured_image;
            productdes = productdes.split(" ").splice(0,30).join(" ")+"...";
            quickview.find(".proImageQuickview").attr("src",featured_image);
            quickview.find(".pricePrimary").html(Shopify.formatMoney(product.price, window.money));
            quickview.find(".proBoxInfo").attr("id", "product-" + product.id);
            quickview.find(".formQuickview").attr("id", "product-actions-" + product.id);
            quickview.find(".formQuickview select").attr("id", "productSelectQuickview");
            quickview.find(".proBoxInfo .quickviewName").text(product.title);
            quickview.find(".proBoxInfo .quickViewVendor").append("<label>Vendor</label>: " + product.vendor);
            quickview.find(".proBoxInfo .quickViewType").append("<label>Product type</label>: " + product.type);
            quickview.find(".proBoxInfo .quickViewSKU").append("<label>SKU</label>: " + product.variants[0].sku);
            if(product.available){
                quickview.find(".proBoxInfo .quickviewAvailability").append("<label>Availability</label>: In stock");
            }else{
                quickview.find(".proBoxInfo .quickviewAvailability").append("Availability</label>: Unavailable");
            }
            quickview.find(".proShortDescription").text(productdes);
            if (product.compare_at_price > product.price) {
                quickview.find(".priceCompare").html(Shopify.formatMoney(product.compare_at_price_max, window.money)).show();
            }
            else {
                quickview.find(".priceCompare").html("");
            }
            if (!product.available) {
                quickview.find("select, input, .dec, .inc").remove();
                quickview.find(".btnAddToCart").text("Sold Out").addClass("disabled").attr("disabled", "disabled");
                $(".proQuantity").css("display", "none");
            }
            else {
                quickViewVariantsSwatch(product, quickview);
            }
            loadQuickViewSlider(product, quickview);
            $('#bingoQuickView').fadeIn(500);
            $('.jsQuickview').fadeIn(500);
            $('#loading').hide();
            $('.bingoQtyAdjust').on('click', function() {
                var $el = $(this),
                    id = $el.data('id'),
                    $qtySelector = $el.siblings('.bingoQtyNum'),
                    qty = parseInt($qtySelector.val().replace(/\D/g, ''));
                var qty = validateQty(qty);
                if ($el.hasClass('bingoQtyAdjustPlus')) {
                    qty += 1;
                } else {
                    qty -= 1;
                    if (qty <= 1) qty = 1;
                }
                $qtySelector.val(qty);
            });
            qvAddToCart();
        });
        return false;
    });
};
bingo.Drawers = (function () {
    var Drawer = function (id, position, iscart, options) {
        var defaults = {
            close: '.jsDrawerClose',
            open: '.jsDrawerOpen' + position,
            openClass: 'jsDrawerOpen',
            dirOpenClass: 'jsDrawerOpen' + position
        };
        this.$nodes = {
            parent: $('body, html'),
            page: $('#pageContainer'),
            moved: $('.isMoved')
        };
        this.config = $.extend(defaults, options);
        this.position = position;
        this.iscart = iscart;
        this.$drawer = $('#' + id);
        if (!this.$drawer.length) {
            return false;
        }
        this.drawerIsOpen = false;
        this.init();
    };
    Drawer.prototype.init = function () {
        $(this.config.open).on('click', $.proxy(this.open, this));
        this.$drawer.find(this.config.close).on('click', $.proxy(this.close, this));
    };
    Drawer.prototype.open = function (evt) {
        if (this.iscart ) {
            var externalCall = false;
            if (evt) {
                evt.preventDefault();
            } else {
                externalCall = true;
            }
            if (evt && evt.stopPropagation) {
                evt.stopPropagation();
                this.$activeSource = $(evt.currentTarget);
            }
            if (this.drawerIsOpen && !externalCall) {
                return this.close();
            }
            this.$nodes.moved.addClass('is-transitioning');
            this.$drawer.prepareTransition();
            this.$nodes.parent.addClass(this.config.openClass + ' ' + this.config.dirOpenClass);
            this.drawerIsOpen = true;
            this.trapFocus(this.$drawer, 'drawer_focus');
            if (this.config.onDrawerOpen && typeof(this.config.onDrawerOpen) == 'function') {
                if (!externalCall) {
                    this.config.onDrawerOpen();
                }
            }
            if (this.$activeSource && this.$activeSource.attr('aria-expanded')) {
                this.$activeSource.attr('aria-expanded', 'true');
            }
            this.$nodes.page.on('touchmove.drawer', function () {
                return false;
            });
            this.$nodes.page.on('click.drawer', $.proxy(function () {
                this.close();
                return false;
            }, this));
        }
    };
    Drawer.prototype.close = function () {
        if (!this.drawerIsOpen) { // don't close a closed drawer
            return;
        }
        $(document.activeElement).trigger('blur');
        this.$nodes.moved.prepareTransition({ disableExisting: true });
        this.$drawer.prepareTransition({ disableExisting: true });
        this.$nodes.parent.removeClass(this.config.dirOpenClass + ' ' + this.config.openClass);
        this.drawerIsOpen = false;
        this.removeTrapFocus(this.$drawer, 'drawer_focus');
        this.$nodes.page.off('.drawer');
    };
    Drawer.prototype.trapFocus = function ($container, eventNamespace) {
        var eventName = eventNamespace ? 'focusin.' + eventNamespace : 'focusin';
        $container.attr('tabindex', '-1');
        $container.focus();
        $(document).on(eventName, function (evt) {
            if ($container[0] !== evt.target && !$container.has(evt.target).length) {
                $container.focus();
            }
        });
    };
    Drawer.prototype.removeTrapFocus = function ($container, eventNamespace) {
        var eventName = eventNamespace ? 'focusin.' + eventNamespace : 'focusin';
        $container.removeAttr('tabindex');
        $(document).off(eventName);
    };
    return Drawer;
})();
bingo.loadingSite = function(){
    $('#loadingSite').fadeOut();
};
bingo.filterByPrice = function(){
    var $range = $("#rangePrice");
    var $btnFilter = $(".btnFilterPrice");
    var minPrice = 0;
    var maxPrice = 0;
    function processFilterPrice(minPrice, maxPrice){
        $('#loading').show();
        $("#bingoProList .filerProductPrice").hide().filter(function() {
            var price = parseInt($(this).data("price"), 10);
            return price >= minPrice && price <= maxPrice;
        }).show();
        $('body,html').animate({
            scrollTop: 400
        }, 600);
        setTimeout( function() {
            $('#loading').hide();
        }, 200 );

    };
    $btnFilter.on("click", function () {
        minPrice = $range.data("from"),
        maxPrice = $range.data("to");
        processFilterPrice(minPrice,maxPrice);
    });
    $range.ionRangeSlider({
        onFinish: function (data) {
            //processFilterPrice(minPrice,maxPrice);
        }
    });
};
bingo.menuMobile = function(){
    $('#btnMenuMobile').on("click", function (e) {
        e.preventDefault();
        $('body').toggleClass("menuMobileActive");
    });
    $('.btnMenuClose').on("click", function (e) {
        e.preventDefault();
        $('body').removeClass("menuMobileActive");
    });
    $('.menuMobileOverlay').on("click", function (e) {
        e.preventDefault();
        $('body').removeClass("menuMobileActive");
    });
};
bingo.slickCarousel = function(){
    $(".slickCarousel").each(function(){
        var slickCarousel = $(this);
        var columnOne = slickCarousel.data("columnone"),
            columnTwo = slickCarousel.data("columntwo"),
            columnThree = slickCarousel.data("columnthree"),
            columnFour = slickCarousel.data("columnfour");
        var config = {
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: columnTwo
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: columnThree
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: columnFour
                    }
                },
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        };
        $(this).slick( config );
    });
};
bingo.owlOneCarousel = function(){
    $(".owlCarouselPlay .owl-carousel").each(function(){
        var owlCarousel = $(this);
        var nav = owlCarousel.data("nav"),
            autoplay = owlCarousel.data("autoplay"),
            autospeed = owlCarousel.data("autospeed"),
            speed = owlCarousel.data("speed"),
            columnOne = owlCarousel.data("columnone"),
            columnTwo = owlCarousel.data("columntwo"),
            columnThree = owlCarousel.data("columnthree"),
            columnFour = owlCarousel.data("columnfour"),
            columnFive = owlCarousel.data("columnfive");
        var config = {
            items: columnOne,
            itemsDesktop: [1199, columnTwo],
            itemsDesktopSmall: [991, columnThree],
            itemsTablet: [767, columnFour],
            itemsTabletSmall: [479, columnFive],
            itemsMobile: [359, 1],
            navigation: nav,
            slideSpeed: speed,
            addClassActive: true,
            afterInit: RemoveLoading
        };
        if (autoplay){
            config.autospeed = autospeed;
        }
        owlCarousel.owlCarousel( config );

        function RemoveLoading(el){
            el.parents('.proOwlCarousel').removeClass('proLoading');
        }
        function FirstLastActiveItem(el){
            el.find(".owl-item").removeClass("first");
            el.find(".owl-item.active").first().addClass("first");
            el.find(".owl-item").removeClass("last");
            el.find(".owl-item.active").last().addClass("last");
        }
    });
};
// bingo.owlTwoCarousel = function(){
//     $(".owlTwoPlay .owl-carousel").each(function(){
//         var owlCarousel = $(this);
//         var nav = owlCarousel.data("nav"),
//             autoplay = owlCarousel.data("autoplay"),
//             autospeed = owlCarousel.data("autospeed"),
//             speed = owlCarousel.data("speed"),
//             columnOne = owlCarousel.data("columnone"),
//             columnTwo = owlCarousel.data("columntwo"),
//             columnThree = owlCarousel.data("columnthree"),
//             columnFour = owlCarousel.data("columnfour"),
//             columnFive = owlCarousel.data("columnfive");
//         var config = {
//             items: columnOne,
//             itemsDesktop: [1499, columnTwo],
//             itemsDesktopSmall: [991, columnThree],
//             itemsTablet: [767, columnFour],
//             itemsTabletSmall: [479, columnFive],
//             itemsMobile: [359, 1],
//             navigation: nav,
//             slideSpeed: speed,
//             addClassActive: true,
//             afterInit: RemoveLoading
//         };
//         if (autoplay){
//             config.autospeed = autospeed;
//         }
//         owlCarousel.owlCarousel( config );

//         function RemoveLoading(el){
//             el.parents('.proOwlCarousel').removeClass('proLoading');
//         }
//         function FirstLastActiveItem(el){
//             el.find(".owl-item").removeClass("first");
//             el.find(".owl-item.active").first().addClass("first");
//             el.find(".owl-item").removeClass("last");
//             el.find(".owl-item.active").last().addClass("last");
//         }
//     });
// };
bingo.instagram = function(){
    $(".bingoInstagram .boxInstagram").each(function(){
        var instagramFeed = $(this);
        var insId = instagramFeed.data("id"),
            insUserId = instagramFeed.data("userid"),
            insAccessToken = instagramFeed.data("accesstoken"),
            insLimited = instagramFeed.data("limit"),
            insResolution = instagramFeed.data("resolution");
        var feed = new Instafeed({
            get: 'user',
            userId: insUserId,
            accessToken: insAccessToken,
            target: insId,
            limit: insLimited,
            resolution: insResolution,
            before: function() {},
            after: function() {
                instagramFeed.owlCarousel({
                    items : 6,
                    lazyLoad : true,
                    slideSpeed : 1000,
                    paginationSpeed : 800,
                    rewindSpeed : 1000,
                    autoPlay: 10000,
                    itemsDesktop: [1199, 5],
                    itemsDesktopSmall: [979, 4],
                    itemsTablet: [768, 3],
                    itemsTabletSmall: [480, 3],
                    itemsMobile: [360, 2],
                    navigation : false
                });
            },
            success: function() {},
            error: function() {}
        });
        feed.run();
    });
};
bingo.bingoConfigSection = function(){
    var element = $('#shopify-section-bingo-header');
    if(element[0].attributes.length == 3) {
        $('#bingoConfigSection').addClass('showBox');
    }
    else {
        $('#bingoConfigSection').empty();
    }
    $('.menuSsWrap .btnConfigSection').on('click', function() {
        $('.menuSsWrap').addClass('active');
    });
    $('.menuSsWrap .closeMenu').on('click', function() {
        $('.menuSsWrap').removeClass('active');
    });
};
/* ================ SHOPIFY DEBUT - bingo CUSTOMIZE ================ */
window.bingotheme = window.bingotheme || {};
bingotheme.Sections = function Sections() {
    this.constructors = {};
    this.instances = [];
    $(document)
        .on('shopify:section:load', this._onSectionLoad.bind(this))
        .on('shopify:section:unload', this._onSectionUnload.bind(this))
        .on('shopify:section:select', this._onSelect.bind(this))
        .on('shopify:section:deselect', this._onDeselect.bind(this))
        .on('shopify:block:select', this._onBlockSelect.bind(this))
        .on('shopify:block:deselect', this._onBlockDeselect.bind(this));
};
bingotheme.Sections.prototype = _.assignIn({}, bingotheme.Sections.prototype, {
    _createInstance: function(container, constructor) {
        var $container = $(container);
        var id = $container.attr('data-section-id');
        var type = $container.attr('data-section-type');
        constructor = constructor || this.constructors[type];
        if (_.isUndefined(constructor)) {
            return;
        }
        var instance = _.assignIn(new constructor(container), {
            id: id,
            type: type,
            container: container
        });
        this.instances.push(instance);
    },
    _onSectionLoad: function(evt) {
        var container = $('[data-section-id]', evt.target)[0];
        if (container) {
            this._createInstance(container);
        }
    },
    _onSectionUnload: function(evt) {
        this.instances = _.filter(this.instances, function(instance) {
            var isEventInstance = (instance.id === evt.detail.sectionId);
            if (isEventInstance) {
                if (_.isFunction(instance.onUnload)) {
                    instance.onUnload(evt);
                }
            }
            return !isEventInstance;
        });
    },
    _onSelect: function(evt) {
        // eslint-disable-next-line no-shadow
        var instance = _.find(this.instances, function(instance) {
            return instance.id === evt.detail.sectionId;
        });
        if (!_.isUndefined(instance) && _.isFunction(instance.onSelect)) {
            instance.onSelect(evt);
        }
    },
    _onDeselect: function(evt) {
        // eslint-disable-next-line no-shadow
        var instance = _.find(this.instances, function(instance) {
            return instance.id === evt.detail.sectionId;
        });
        if (!_.isUndefined(instance) && _.isFunction(instance.onDeselect)) {
            instance.onDeselect(evt);
        }
    },
    _onBlockSelect: function(evt) {
        // eslint-disable-next-line no-shadow
        var instance = _.find(this.instances, function(instance) {
            return instance.id === evt.detail.sectionId;
        });
        if (!_.isUndefined(instance) && _.isFunction(instance.onBlockSelect)) {
            instance.onBlockSelect(evt);
        }
    },
    _onBlockDeselect: function(evt) {
        // eslint-disable-next-line no-shadow
        var instance = _.find(this.instances, function(instance) {
            return instance.id === evt.detail.sectionId;
        });
        if (!_.isUndefined(instance) && _.isFunction(instance.onBlockDeselect)) {
            instance.onBlockDeselect(evt);
        }
    },
    register: function(type, constructor) {
        this.constructors[type] = constructor;
        $('[data-section-type=' + type + ']').each(function(index, container) {
            this._createInstance(container, constructor);
        }.bind(this));
    }
});
bingotheme.Slideshow = (function() {
    this.$slideshow = null;
    var classes = {
        wrapper: 'bingoSlideshowWrapper',
        slideshow: 'bingo--slideshow',
        currentSlide: 'slick-current',
        video: 'bingossVideo',
        videoBackground: 'bingossVideoBackground',
        closeVideoBtn: 'btnssVideoControlClose',
        pauseButton: 'btnssPause',
        isPaused: 'is-paused'
    };

    function slideshow(el) {
        this.$slideshow = $(el);
        this.$wrapper = this.$slideshow.closest('.' + classes.wrapper);
        this.$pause = this.$wrapper.find('.' + classes.pauseButton);
        this.settings = {
            accessibility: true,
            arrows: this.$slideshow.data('navigation'),
            dots: this.$slideshow.data('pagination'),
            fade: true,
            pauseOnHover: true,
            draggable: true,
            // touchThreshold: 20,
            autoplay: this.$slideshow.data('autoplay'),
            autoplaySpeed: this.$slideshow.data('speed')
        };
        this.$slideshow.on('beforeChange', beforeChange.bind(this));
        this.$slideshow.on('init', slideshowA11y.bind(this));
        this.$slideshow.slick(this.settings);
        this.$pause.on('click', this.togglePause.bind(this));
    }
    function slideshowA11y(event, obj) {
        var $slider = obj.$slider;
        var $list = obj.$list;
        var $wrapper = this.$wrapper;
        var autoplay = this.settings.autoplay;
        // Remove default Slick aria-live attr until slider is focused
      	$slider.removeClass('bingoSliderLoading');
        $list.removeAttr('aria-live');
        // When an element in the slider is focused
        // pause slideshow and set aria-live.
        $wrapper.on('focusin', function(evt) {
            if (!$wrapper.has(evt.target).length) {
                return;
            }
            $list.attr('aria-live', 'polite');
            if (autoplay) {
                $slider.slick('slickPause');
            }
        });
        //Resume autoplay
        $wrapper.on('focusout', function(evt) {
            if (!$wrapper.has(evt.target).length) {
                return;
            }
            $list.removeAttr('aria-live');
            if (autoplay) {
                // Manual check if the focused element was the video close button
                // to ensure autoplay does not resume when focus goes inside YouTube iframe
                if ($(evt.target).hasClass(classes.closeVideoBtn)) {
                  return;
                }
                $slider.slick('slickPlay');
            }
        });
        // Add arrow key support when focused
        if (obj.$dots) {
            obj.$dots.on('keydown', function(evt) {
                if (evt.which === 37) {
                    $slider.slick('slickPrev');
                }
                if (evt.which === 39) {
                    $slider.slick('slickNext');
                }
                // Update focus on newly selected tab
                if ((evt.which === 37) || (evt.which === 39)) {
                    obj.$dots.find('.slick-active button').focus();
                }
            });
        }
    };
    function beforeChange(event, slick, currentSlide, nextSlide) {
        var $slider = slick.$slider;
        var $currentSlide = $slider.find('.' + classes.currentSlide);
        var $nextSlide = $slider.find('.bingossSlide[data-slick-index="' + nextSlide + '"]');
        if (isVideoInSlide($currentSlide)) {
            var $currentVideo = $currentSlide.find('.' + classes.video);
            var currentVideoId = $currentVideo.attr('id');
            bingotheme.SlideshowVideo.pauseVideo(currentVideoId);
            $currentVideo.attr('tabindex', '-1');
        }
        if (isVideoInSlide($nextSlide)) {
            var $video = $nextSlide.find('.' + classes.video);
            var videoId = $video.attr('id');
            var isBackground = $video.hasClass(classes.videoBackground);
            if (isBackground) {
                bingotheme.SlideshowVideo.playVideo(videoId);
            } else {
                $video.attr('tabindex', '0');
            }
        }
    }
    function isVideoInSlide($slide) {
        return $slide.find('.' + classes.video).length;
    }
    slideshow.prototype.togglePause = function() {
        var slideshowSelector = getSlideshowId(this.$pause);
        if (this.$pause.hasClass(classes.isPaused)) {
            this.$pause.removeClass(classes.isPaused);
            $(slideshowSelector).slick('slickPlay');
        } else {
            this.$pause.addClass(classes.isPaused);
            $(slideshowSelector).slick('slickPause');
        }
    };
    function getSlideshowId($el) {
        return '#bingoSlideshows' + $el.data('id');
    }
    return slideshow;
})();
// Youtube API callback
// eslint-disable-next-line no-unused-vars
function onYouTubeIframeAPIReady() {
    bingotheme.SlideshowVideo.loadVideos();
}
bingotheme.SlideshowVideo = (function() {
    var autoplayCheckComplete = false;
    var autoplayAvailable = false;
    var playOnClickChecked = false;
    var playOnClick = false;
    var youtubeLoaded = false;
    var videos = {};
    var videoPlayers = [];
    var videoOptions = {
        ratio: 16 / 9,
        playerVars: {
            // eslint-disable-next-line camelcase
            iv_load_policy: 3,
            modestbranding: 1,
            autoplay: 0,
            controls: 0,
            showinfo: 0,
            wmode: 'opaque',
            branding: 0,
            autohide: 0,
            rel: 0
        },
        events: {
            onReady: onPlayerReady,
            onStateChange: onPlayerChange
        }
    };
    var classes = {
        playing: 'video-is-playing',
        paused: 'video-is-paused',
        loading: 'video-is-loading',
        loaded: 'video-is-loaded',
        slideshowWrapper: 'bingoSlideshowWrapper',
        slide: 'bingossSlide',
        slideBackgroundVideo: 'bingossSlideBackgroundVideo',
        slideDots: 'slick-dots',
        videoChrome: 'bingossVideo-chrome',
        videoBackground: 'bingossVideoBackground',
        playVideoBtn: 'btnssVideoControlPlay',
        closeVideoBtn: 'btnssVideoControlClose',
        currentSlide: 'slick-current',
        slickClone: 'slick-cloned',
        supportsAutoplay: 'autoplay',
        supportsNoAutoplay: 'no-autoplay'
    };
    function init($video) {
        if (!$video.length) {
            return;
        }

        videos[$video.attr('id')] = {
            id: $video.attr('id'),
            videoId: $video.data('id'),
            type: $video.data('type'),
            status: $video.data('type') === 'chrome' ? 'closed' : 'background', // closed, open, background
            videoSelector: $video.attr('id'),
            $parentSlide: $video.closest('.' + classes.slide),
            $parentSlideshowWrapper: $video.closest('.' + classes.slideshowWrapper),
            controls: $video.data('type') === 'background' ? 0 : 1,
            slideshow: $video.data('slideshow')
        };
        if (!youtubeLoaded) {
            // This code loads the IFrame Player API code asynchronously.
            var tag = document.createElement('script');
            tag.src = 'https://www.youtube.com/iframe_api';
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        }
    }
    function customPlayVideo(playerId) {
        if (!playOnClickChecked && !playOnClick) {
            return;
        }
        if (playerId && typeof videoPlayers[playerId].playVideo === 'function') {
            privatePlayVideo(playerId);
        }
    }
    function pauseVideo(playerId) {
        if (videoPlayers[playerId] && typeof videoPlayers[playerId].pauseVideo === 'function') {
            videoPlayers[playerId].pauseVideo();
        }
    }
    function loadVideos() {
        for (var key in videos) {
            if (videos.hasOwnProperty(key)) {
                var args = $.extend({}, videoOptions, videos[key]);
                args.playerVars.controls = args.controls;
                videoPlayers[key] = new YT.Player(key, args);
            }
        }
        initEvents();
        youtubeLoaded = true;
    }
    function loadVideo(key) {
        if (!youtubeLoaded) {
            return;
        }
        var args = $.extend({}, videoOptions, videos[key]);
        args.playerVars.controls = args.controls;
        videoPlayers[key] = new YT.Player(key, args);
        initEvents();
    }
    function privatePlayVideo(id, clicked) {
        var videoData = videos[id];
        var player = videoPlayers[id];
        var $slide = videos[id].$parentSlide;

        if (playOnClick) {
            // playOnClick means we are probably on mobile (no autoplay).
            // setAsPlaying will show the iframe, requiring another click
            // to play the video.
            setAsPlaying(videoData);
        } else if (clicked || (autoplayCheckComplete && autoplayAvailable)) {
            // Play if autoplay is available or clicked to play
            $slide.removeClass(classes.loading);
            setAsPlaying(videoData);
            player.playVideo();
            return;
        }
        // Check for autoplay if not already done
        if (!autoplayCheckComplete) {
            autoplayCheckFunction(player, $slide);
        }
    }
    function setAutoplaySupport(supported) {
        var supportClass = supported ? classes.supportsAutoplay : classes.supportsNoAutoplay;
        $(document.documentElement).addClass(supportClass);
        if (!supported) {
            playOnClick = true;
        }
        autoplayCheckComplete = true;
    }
    function autoplayCheckFunction(player, $slide) {
        // attempt to play video
        player.playVideo();
        autoplayTest(player)
            .then(function() {
                setAutoplaySupport(true);
            })
            .fail(function() {
                // No autoplay available (or took too long to start playing).
                // Show fallback image. Stop video for safety.
                setAutoplaySupport(false);
                player.stopVideo();
            })
            .always(function() {
                autoplayCheckComplete = true;
                $slide.removeClass(classes.loading);
            });
    }
    function autoplayTest(player) {
        var deferred = $.Deferred();
        var wait;
        var timeout;
        wait = setInterval(function() {
            if (player.getCurrentTime() <= 0) {
                return;
            }
            autoplayAvailable = true;
            clearInterval(wait);
            clearTimeout(timeout);
            deferred.resolve();
        }, 500);
        timeout = setTimeout(function() {
            clearInterval(wait);
            deferred.reject();
        }, 4000); // subjective. test up to 8 times over 4 seconds
        return deferred;
    }
    function playOnClickCheck() {
        // Bail early for a few instances:
        // - small screen
        // - device sniff mobile browser
        if (playOnClickChecked) {
            return;
        }
        if ($(window).width() < 750) {
            playOnClick = true;
        } else if (window.mobileCheck()) {
            playOnClick = true;
        }
        if (playOnClick) {
            // No need to also do the autoplay check
            setAutoplaySupport(false);
        }
        playOnClickChecked = true;
    }
    // The API will call this function when each video player is ready
    function onPlayerReady(evt) {
        evt.target.setPlaybackQuality('hd1080');
        var videoData = getVideoOptions(evt);
        playOnClickCheck();
        // Prevent tabbing through YouTube player controls until visible
        $('#' + videoData.id).attr('tabindex', '-1');
        sizeBackgroundVideos();
        // Customize based on options from the video ID
        switch (videoData.type) {
            case 'background-chrome':
            case 'background':
                evt.target.mute();
                // Only play the video if it is in the active slide
                if (videoData.$parentSlide.hasClass(classes.currentSlide)) {
                    privatePlayVideo(videoData.id);
                }
                break;
        }
        videoData.$parentSlide.addClass(classes.loaded);
    }
    function onPlayerChange(evt) {
        var videoData = getVideoOptions(evt);
        switch (evt.data) {
            case 0: // ended
                setAsFinished(videoData);
                break;
            case 1: // playing
                setAsPlaying(videoData);
                break;
            case 2: // paused
                setAsPaused(videoData);
                break;
        }
    }
    function setAsFinished(videoData) {
        switch (videoData.type) {
            case 'background':
                videoPlayers[videoData.id].seekTo(0);
                break;
            case 'background-chrome':
                videoPlayers[videoData.id].seekTo(0);
                closeVideo(videoData.id);
              break;
            case 'chrome':
                closeVideo(videoData.id);
                break;
        }
    }
    function setAsPlaying(videoData) {
        var $slideshow = videoData.$parentSlideshowWrapper;
        var $slide = videoData.$parentSlide;
        $slide.removeClass(classes.loading);
        // Do not change element visibility if it is a background video
        if (videoData.status === 'background') {
            return;
        }
        $('#' + videoData.id).attr('tabindex', '0');
            switch (videoData.type) {
                case 'chrome':
                case 'background-chrome':
                    $slideshow
                      .removeClass(classes.paused)
                      .addClass(classes.playing);
                    $slide
                      .removeClass(classes.paused)
                      .addClass(classes.playing);
                    break;
            }
            // Update focus to the close button so we stay within the slide
            $slide.find('.' + classes.closeVideoBtn).focus();
    }
    function setAsPaused(videoData) {
        var $slideshow = videoData.$parentSlideshowWrapper;
        var $slide = videoData.$parentSlide;
        if (videoData.type === 'background-chrome') {
            closeVideo(videoData.id);
            return;
        }
        // YT's events fire after our click event. This status flag ensures
        // we don't interact with a closed or background video.
        if (videoData.status !== 'closed' && videoData.type !== 'background') {
            $slideshow.addClass(classes.paused);
            $slide.addClass(classes.paused);
        }
        if (videoData.type === 'chrome' && videoData.status === 'closed') {
            $slideshow.removeClass(classes.paused);
            $slide.removeClass(classes.paused);
        }
        $slideshow.removeClass(classes.playing);
        $slide.removeClass(classes.playing);
    }
    function closeVideo(playerId) {
        var videoData = videos[playerId];
        var $slideshow = videoData.$parentSlideshowWrapper;
        var $slide = videoData.$parentSlide;
        var classesToRemove = [classes.pause, classes.playing].join(' ');
        $('#' + videoData.id).attr('tabindex', '-1');
        videoData.status = 'closed';
        switch (videoData.type) {
            case 'background-chrome':
                videoPlayers[playerId].mute();
                setBackgroundVideo(playerId);
                break;
            case 'chrome':
                videoPlayers[playerId].stopVideo();
                setAsPaused(videoData); // in case the video is already paused
                break;
        }
        $slideshow.removeClass(classesToRemove);
        $slide.removeClass(classesToRemove);
    }
    function getVideoOptions(evt) {
        return videos[evt.target.h.id];
    }
    function startVideoOnClick(playerId) {
        var videoData = videos[playerId];
        // add loading class to slide
        videoData.$parentSlide.addClass(classes.loading);
        videoData.status = 'open';
        switch (videoData.type) {
            case 'background-chrome':
                unsetBackgroundVideo(playerId, videoData);
                videoPlayers[playerId].unMute();
                privatePlayVideo(playerId, true);
                break;
            case 'chrome':
                privatePlayVideo(playerId, true);
                break;
        }
        // esc to close video player
        $(document).on('keydown.videoPlayer', function(evt) {
            if (evt.keyCode === 27) {
                closeVideo(playerId);
            }
        });
    }
    function sizeBackgroundVideos() {
        $('.' + classes.videoBackground).each(function(index, el) {
            sizeBackgroundVideo($(el));
        });
    }
    function sizeBackgroundVideo($player) {
        var $slide = $player.closest('.' + classes.slide);
        // Ignore cloned slides
        if ($slide.hasClass(classes.slickClone)) {
            return;
        }
        var slideWidth = $slide.width();
        var playerWidth = $player.width();
        var playerHeight = $player.height();
        // when screen aspect ratio differs from video, video must center and underlay one dimension
        if (slideWidth / videoOptions.ratio < playerHeight) {
            playerWidth = Math.ceil(playerHeight * videoOptions.ratio); // get new player width
            $player.width(playerWidth).height(playerHeight).css({
                left: (slideWidth - playerWidth) / 2,
                top: 0
            }); // player width is greater, offset left; reset top
        } else { // new video width < window width (gap to right)
            playerHeight = Math.ceil(slideWidth / videoOptions.ratio); // get new player height
            $player.width(slideWidth).height(playerHeight).css({
                left: 0,
                top: (playerHeight - playerHeight) / 2
            }); // player height is greater, offset top; reset left
        }
        $player
            .prepareTransition()
            .addClass(classes.loaded);
    }
    function unsetBackgroundVideo(playerId) {
        // Switch the background-chrome to a chrome-only player once played
        $('#' + playerId)
            .removeAttr('style')
            .removeClass(classes.videoBackground)
            .addClass(classes.videoChrome);
        videos[playerId].$parentSlideshowWrapper
            .removeClass(classes.slideBackgroundVideo)
            .addClass(classes.playing);
        videos[playerId].$parentSlide
            .removeClass(classes.slideBackgroundVideo)
            .addClass(classes.playing);
        videos[playerId].status = 'open';
    }
    function setBackgroundVideo(playerId) {
        // Switch back to background-chrome when closed
        var $player = $('#' + playerId)
            .addClass(classes.videoBackground)
            .removeClass(classes.videoChrome);
        videos[playerId].$parentSlide
            .addClass(classes.slideBackgroundVideo);
        videos[playerId].status = 'background';
        sizeBackgroundVideo($player);
    }
    function initEvents() {
        $(document).on('click.videoPlayer', '.' + classes.playVideoBtn, function(evt) {
            var playerId = $(evt.currentTarget).data('controls');
            startVideoOnClick(playerId);
        });
        $(document).on('click.videoPlayer', '.' + classes.closeVideoBtn, function(evt) {
            var playerId = $(evt.currentTarget).data('controls');
            closeVideo(playerId);
        });
        // Listen to resize to keep a background-size:cover-like layout
        $(window).on('resize.videoPlayer', $.debounce(250, function() {
            if (youtubeLoaded) {
                sizeBackgroundVideos();
            }
        }));
    }
    function removeEvents() {
        $(document).off('.videoPlayer');
        $(window).off('.videoPlayer');
    }
    return {
        init: init,
        loadVideos: loadVideos,
        loadVideo: loadVideo,
        playVideo: customPlayVideo,
        pauseVideo: pauseVideo,
        removeEvents: removeEvents
    };
})();
bingotheme.slideshows = {};
bingotheme.SlideshowSection = (function() {
    function SlideshowSection(container) {
        var $container = this.$container = $(container);
        var sectionId = $container.attr('data-section-id');
        var slideshow = this.slideshow = '#bingoSlideshows' + sectionId;
        $('.bingossVideo', slideshow).each(function() {
            var $el = $(this);
            bingotheme.SlideshowVideo.init($el);
            bingotheme.SlideshowVideo.loadVideo($el.attr('id'));
        });
        bingotheme.slideshows[slideshow] = new bingotheme.Slideshow(slideshow);
    }
    return SlideshowSection;
})();
bingotheme.SlideshowSection.prototype = _.assignIn({}, bingotheme.SlideshowSection.prototype, {
    onUnload: function() {
        delete bingotheme.slideshows[this.slideshow];
    },
    onBlockSelect: function(evt) {
        var $slideshow = $(this.slideshow);
        // Ignore the cloned version
        var $slide = $('.bingossSlide' + evt.detail.blockId + ':not(.slick-cloned)');
        var slideIndex = $slide.data('slick-index');
        // Go to selected slide, pause autoplay
        $slideshow.slick('slickGoTo', slideIndex).slick('slickPause');
    },
    onBlockDeselect: function() {
        // Resume autoplay
        $(this.slideshow).slick('slickPlay');
    }
});
$(document).ready(function() {
    $(bingo.init);
    $('body').on('ajaxCart.afterCartLoad', function(evt, cart) {
        if (window.ajaxcart_type == 'drawer') {
            bingo.RightDrawer.open();
        }
    });
    
    var sections = new bingotheme.Sections();
    sections.register('bingoSlideshowSection', bingotheme.SlideshowSection);
});
$(window).load(function() {
    $(bingo.productImage);
    $(bingo.loadingSite);
    $( window ).resize(function() {
        bingo.productImage();
    });
  	if (($(window).width()) <= 767){
        var headerHeight = $('#bingoHeader').height();
        $('.contentMobileFixed').css('padding-top', headerHeight);
    }
});
bingo.menuCategoty = function(){
    if (($(window).width()) <= 1199){
        $('#verticalContent').removeClass('in');
    }
}

