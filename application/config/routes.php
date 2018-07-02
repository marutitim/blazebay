<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$domainsize=count(explode('.', str_replace("www.","",$_SERVER['SERVER_NAME'])));

switch ($domainsize) {
    case 3:
            $route['m/contact-us'] = 'Minisite/contact';
            $route['m/overview'] = 'Minisite/overview';
            $route['m/category/(:any)/(:any)'] = 'Minisite/category/$1/$2';
            $route['m/(:any)/(:any)'] = 'Minisite/index/$1/$2';
            $route['default_controller'] = "Minisite";

        break;
    default:


        $route['minisite'] = 'Minisite/index';
        $route['m/(:any)/(:any)/(:any)/(:any)'] = 'Minisite/supplierProducts/$1/$2/$3/$4';
        $route['m/contact-us'] = 'Minisite/contact';
        $route['m/overview'] = 'Minisite/overview';
        $route['m/category/(:any)/(:any)'] = 'Minisite/category/$1/$2';
        $route['forgot-password'] = 'Pages/forgot_password';
        $route['edit-profile'] = 'Pages/edit_profile';
        $route['manage-buy-offers'] = 'Pages/manage_buy_offers';
        $route['post-buy-offers'] = 'Pages/post_buy_offers';
        $route['post-product'] = 'Pages/post_product';
        $route['buyer-orderlist'] = 'Pages/buyer_orderlist';
        $route['favorite-list'] = 'Pages/favorite_list';
        $route['buyer-transactions'] = 'Pages/buyer_transactions';
        $route['send-new-message'] = 'Pages/send_new_message';
        $route['check-messages'] = 'Pages/check_messages';
        $route['my-contacts'] = 'Pages/my_contacts';
        $route['enquiries-received'] = 'Pages/enquiries_received';
        $route['reply-enquiries-received/(:any)'] = 'Pages/reply_enquiries_received/$1';
        $route['enquiries-sent'] = 'Pages/enquiries_sent';
        $route['change-password'] = 'Pages/change_password';
        $route['view-buyer-order/(:any)'] = 'Pages/view_buyer_order/$1';
        $route['buyer-track-order/(:any)'] = 'Pages/buyer_track_order/$1';
        $route['buyer_order_payment'] = 'Pages/buyer_order_payment';
        $route['upgrade-courier-membership'] = 'Pages/upgrade_courier_membership';
        $route['edit-companyprofile'] = 'Pages/edit_companyprofile';
        $route['courier-transactions'] = 'Pages/courier_transactions';
        $route['post-photo'] = 'Pages/post_photo';
        $route['post-company-location'] = 'Pages/post_company_location';
        $route['courier-orderlist'] = 'Pages/courier_orderlist';
        $route['courier-view-quotation/(:any)'] = 'Pages/courier_view_quotation/$1';
        $route['manage-trades'] = 'Pages/manage_trades';
        $route['trade-details/(:any)/(:any)'] = 'Pages/trade_details/$1/$2';
        $route['trade-all'] = 'Pages/trade_all';
        $route['post-tradeshow'] = 'Pages/post_tradeshow';
        $route['courier-locations'] = 'Pages/courier_locations';
        $route['upgrade-membership'] = 'Pages/upgrade_membership';
        $route['upgrade-membership/payment/(:any)'] = 'Pages/upgrade_membership_payment/$1';
        $route['minisite-banners'] = 'Pages/minisite_banners';
        $route['manage-minisite'] = 'Pages/manage_minisite';


        $route['validateMpesa'] = 'Checkout/validateMpesa';
        $route['company-logo'] = 'Pages/company_logo';
        $route['manage-theme'] = 'Pages/manage_theme';
        $route['manage-products'] = 'Pages/manage_products';
        $route['manage-wholesale-products'] = 'Pages/manage_wholesale_products';
        $route['edit-product/(:any)'] = 'Pages/edit_product/$1';
        $route['post-wholesale-product'] = 'Pages/post_wholesale_product';
        $route['manage-sell-offers'] = 'Pages/manage_sell_offers';
        $route['post-sell-offers'] = 'Pages/post_sell_offers';
        $route['supplier-orderlist'] = 'Pages/supplier_orderlist';
        $route['viewsupplier_quotation/(:any)'] = 'Pages/viewsupplierQuotation/$1';
        $route['process-update-form-sell-postoffers/(:any)'] = 'Pages/process_update_form_sell_postoffers/$1';


        $route['all-secured-products/(:any)/(:any)'] = 'Pages/all_secured_products/$1/$2';
        $route['post-buy-requirements'] = 'Pages/post_buy_requirements';
        $route['supplier-transactions'] = 'Pages/supplier_transactions';
        $route['sale-offers'] = 'Pages/sale_offers';
        $route['buy-offers'] = 'Pages/buyOffers';
        $route['buy-offers/(:any)/(:any)'] = 'Pages/buyOffers/$1/$2';
        $route['manage-order-online'] = 'Pages/manage_order_online';
        $route['buyer-track-order/(:any)'] = 'Pages/trackorderonline/$1';
        $route['access-secure-trade-services'] = 'Pages/access_secure_trade_services';
        $route['order-with-trade-security'] = 'Pages/makeOrder2';

        $route['wholesale-product-edit/(:any)'] = 'Pages/wholesale_product_edit/$1';
        $route['process-edit-product'] = 'Pages/process_edit_product';
        $route['process_post_product'] = 'Pages/process_post_product';
        $route['setbunner/(:any)'] = 'Pages/setbunner/$1';
        $route['delet_banner/(:any)'] = 'Pages/delet_banner/$1';
        $route['wishlist-remove'] = 'Pages/delete_wishlist';
        $route['success/(:any)'] = 'Pages/success/$1';





        $route['reset-forgot-password/(:any)'] = 'Pages/reset_forgot_password/$1';
        $route['activate-account/(:any)'] = 'Pages/activate_account/$1';
        $route['process_forgot_change_password/(:any)'] = 'Pages/process_forgot_change_password/$1';
        $route['post-buy-offers/(:any)'] = 'Pages/postbuyoffersedit/$1';
        $route['process_update_form_buy_postoffers/(:any)'] = 'Pages/process_update_form_buy_postoffers/$1';
        $route['prod_price/(:any)'] = 'Pages/prod_price/$1';
        $route['file-complaint/(:any)'] = 'Pages/fileComplaint/$1';
        $route['process_mini_logo/(:any)'] = 'Pages/process_mini_logo/$1';
        $route['edit-offer-products/(:any)'] = 'Pages/edit_offers/$1';
        $route['faq-help'] = 'Pages/faq';
        $route['site-help'] = 'Pages/sitehelp';
        $route['product-details/(:any)/(:any)/(:any)'] = 'Products/productDetails/$1/$2/$3';

        $route['industries/(:any)/(:any)'] = 'Products/industries/$1/$2';


        $route['wholesell/(:any)'] = 'Pages/wholesellsearch/$1';
        $route['wholesell-search/(:any)/(:any)/(:any)'] = 'Pages/wholesellsearch/$1/$2/$3';
        $route['wholesell/price-greater-than/(:any)'] = 'Pages/wholesellsearchpriceG/$1';
        $route['wholesell/price-greater-than/(:any)/(:any)/(:any)'] = 'Pages/wholesellsearchpriceG/$1/$2/$3';
        $route['wholesell/price-less-than/(:any)'] = 'Pages/wholesellsearchpriceL/$1';
        $route['wholesell/price-less-than/(:any)/(:any)/(:any)'] = 'Pages/wholesellsearchpriceL/$1/$2/$3';
        $route['wholesell/(:any)/(:any)'] = 'Pages/wholesell/$1/$2';

        $route['all-products/price-greater-than/(:any)'] = 'Pages/allproducts/$1';
        $route['all-products/price-greater-than/(:any)/(:any)/(:any)'] = 'Pages/allproductsG/$1/$2/$3';
        $route['all-products/price-less-than/(:any)'] = 'Pages/allproductsL/$1';
        $route['all-products/price-less-than/(:any)/(:any)/(:any)'] = 'Pages/allproductsL/$1/$2/$3';

        $route['all/products/price-greater-than/(:any)'] = 'Pages/allproducts/$1';
        $route['all/products/price-greater-than/(:any)/(:any)/(:any)'] = 'Pages/allproductsG/$1/$2/$3';
        $route['all/products/price-less-than/(:any)'] = 'Pages/allproductsL/$1';
        $route['all/products/price-less-than/(:any)/(:any)/(:any)'] = 'Pages/allproductsL/$1/$2/$3';
        $route['sale-offers/(:any)'] = 'Pages/sale_offers_products/$1';
        $route['sale-offers/price-greater-than/(:any)'] = 'Pages/sale_offers_products/$1';
        $route['sale-offers/price-greater-than/(:any)/(:any)/(:any)'] = 'Pages/sale_offers_productsG/$1/$2/$3';
        $route['sale-offers/price-less-than/(:any)'] = 'Pages/sale_offers_productsL/$1';
        $route['sale-offers/price-less-than/(:any)/(:any)/(:any)'] = 'Pages/sale_offers_productsL/$1/$2/$3';
        $route['sale-offers/(:any)/(:any)'] = 'Pages/sale_offers_products/$1';
        $route['sale-offers/(:any)/(:any)/(:any)'] = 'Pages/sale_offers_products/$1';


        $route['all-products/(:any)/(:any)'] = 'Products/allcategories/$1/$2';
        $route['all/products/(:any)/(:any)'] = 'Products/listProducts/$1/$2';
        $route['all/products/(:any)'] = 'Products/all/$1';

        $route['products-all/(:any)/(:any)'] = 'Pages/prod/$1/$2';
        $route['all/products'] = 'Products/all';
        $route['all-products'] = 'Products/all';
        $route['all-companies'] = 'Pages/allcampanies';
        $route['all/companies/(:any)/(:any)'] = 'Pages/allcampaniesPages/$1/$2';
        $route['fetCouriers/(:any)/(:any)'] = 'Pages/fetcuriors/$1/$2';

        $route['suppliers-per-country/(:any)'] = 'Pages/percountry/$1';
        $route['suppliers-per-country/(:any)/(:any)/(:any)'] = 'Pages/percountry/$1/$2/$3';

        $route['all/companies/page/(:any)'] = 'Pages/searchcompanies/$1/$2';
        $route['all-products/(:any)'] = 'Products/all/$1';
        $route['all/(:any)/(:any)/(:any)/(:any)'] = 'Pages/supplierProducts/$1/$2/$3/$4';


        $route['all/products/(:any)/(:any)/(:any)'] = 'Products/searchInPage/$1/$2/$3';
        $route['all/products/(:any)/(:any)/(:any)/(:any)'] = 'Products/allcategories/$1/$2/$3/$4';
        $route['all-products-with-trade-security/(:any)/(:any)'] = 'Products/getTradeproducts/$1/$2/$3';
        $route['company-details/(:any)/(:any)'] = 'Pages/allcampanies/$1/$2';
        $route['all/(:any)'] = 'categories/allCategories/$1';
        $route['seller/(:any)/(:any)/products'] = 'Products/sellerProducts/$1/$2';
        $route['buy-offers/details/(:any)/(:any)'] = 'Products/productOffers/$1/$2';
        $route['company-details/(:any)/(:any)/(:any)'] = 'Products/productSupplier/$1/$2/$3';
        $route['company-details/(:any)/(:any)/(:any)/(:any)'] = 'Products/productSupplier/$1/$2/$3/$4';

        $route['supplier/(:any)/(:any)/(:any)/(:any)'] = 'Pages/supplierProducts/$1/$2/$3/$4';
        $route['industry/(:any)/(:any)/(:any)/(:any)'] = 'Pages/industryProducts/$1/$2/$3/$4';
        $route['report-abuse/(:any)'] = 'Pages/reportAbuse/$1';


        $route['wholesale/product-details/(:any)/(:any)/(:any)'] = 'Products/whoproductDetails/$1/$2/$3';
        $route['all-category'] = 'Categories/allCategories';
        $route['allcategory/(:any)/(:any)'] = 'Categories/allincategory/$1/$2';
        $route['make-an-order/(:any)'] = 'Pages/makeOrder/$1';
        $route['make-an-order/(:any)/(:any)'] = 'Pages/makeOrder/$1/$2';
       // $route['order/(:any)/(:any)'] = 'Pages/makeOrder2/$1/$2';

        $route['make-an-order/(:any)/(:any)/(:any)/(:any)'] = 'Pages/makeOrder/$1/$2/$3/$4';
        $route['makeOrder2/(:any)'] = 'Pages/makeOrder2/$1';
        $route['processMakeanOrder'] = 'Checkout/processMakeanOrder';
        $route['Pages/processlogin'] = 'Pages/processlogin';
         $route['refund-return'] = 'Pages/refund_Return';
        $route['partner-with-us'] = 'Pages/partner_with_us';
        $route['discover-products-and-suppliers'] = 'Pages/discover_products_and_suppliers';


        $route['search'] = 'Pages/search';

        $route['product-add-to-wishlist'] = 'Products/addtofav';

         $route['processlogin'] = 'Pages/processlogin';
        $route['getGrandTotal/(:any)'] = 'Pages/getGrandTotal/$1';
        $route['make-an-order2/(:any)'] = 'Pages/makeOrder2/$1';
        $route['get/supplier/Details/(:any)'] = 'Pages/getsupplierDetails/$1';

        $route['orderaddress/(:any)'] = 'Pages/orderaddress/$1';
        $route['delivery/(:any)'] = 'Pages/delivery/$1';
        $route['orderpayment/(:any)'] = 'Pages/orderpayment/$1';
        $route['locations-pricing'] = 'Pages/locations_pricing';
        $route['edit-location-pricing/(:any)'] = 'Pages/edit_location_pricing/$1';
        $route['courierDetails/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Pages/courierDetails/$1/$2/$3/$4/$5/$6/$7';
        $route['manage-products/my_products_list/(:any)'] = 'Pages/my_products_list/$1';
        $route['manage-products/products-list/(:any)/(:any)'] = 'Pages/my_products_list/$1/$2';
        $route['access/api/users/(:num)'] = 'access/api/users/id/$1';
        $route['access/api/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'access/api/users/id/$1/format/$3$4';
        $route['payViaNunurEwallet'] = 'Checkout/payViaNunurEwallet';
        $route['purchase-orderlist'] = 'Pages/purchase_orderlist';
        $route['quote_update/(:any)/(:any)'] = 'Pages/quote_update/$1/$2';
        $route['all-featured-products'] = 'Products/allfeatured';
        $route['all-featured-products/(:any)/(:any)'] = 'Products/allfeatured/$1/$2';
        $route['all-wholesale-products'] = 'Products/allwholesale';
        $route['all-wholesale-products/(:any)/(:any)'] = 'Products/allwholesale/$1/$2';
        $route['all-products/filter/under/(:any)'] = 'Products/filter_product/$1';
        $route['getTradeproducts/(:any)'] = 'Products/getTradeproducts/$1';
        $route['core-file'] = 'Core/index';
        $route['my_wholesale_products_list/(:any)'] = 'Products/my_wholesale_products_list/$1';
        $route['my_wholesale_products_list/(:any)/(:any)/(:any)'] = 'Products/my_wholesale_products_list/$1/$2/$3';

        $route['pesapal'] = 'Pages/pesapal';
        $route['get/sub/subcat/(:any)'] = 'Pages/fetsubcat/$1';
        $route['our-partners'] = 'Pages/ourpartners';
        $route['switchLanguage'] = "Pages/switchLang";

        $route['contact-supplier/(:any)/(:any)'] = "Pages/contactSupplierView/$1/$2";
        $route['(:any)/(:any)'] = 'Pages/persupplier/$1/$2';
        $route['(:any)'] = 'pages/$1';


        $route['default_controller'] = "Pages";

        break;
}



$route['404_override'] = 'pages/error';
$route['translate_uri_dashes'] = FALSE;

