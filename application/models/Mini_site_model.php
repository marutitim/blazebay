<?php

class Mini_site_model  extends CI_Model {

    /*
     * Added BY Timothy maruti On 28-08-2017 ENDS
     */
    // ------------------------------------------------------------------------

    function __construct() {
        parent::__construct ();
    }

    function add($table, $insertArray) {
        try {
            $this->pdo->insert ( $table, $insertArray );
            return $this->pdo->insert_id ();
        } catch ( Exception $e ) {
            echo 'Caught exception: ', $e->getMessage (), "\n";
        }
    }
  function execute($query){

        $query = $this->pdo->query ($query);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;


}

    function getTabledata($table) {
        $query = $this->pdo->get ( $table );
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

    function getDataById($table, $where) {
        $this->pdo->where ( $where );
        $query = $this->pdo->get ( $table );
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

    function update($table, $data, $where) {
        $this->pdo->where ( $where );
        return $this->pdo->update ( $table, $data );
    }
    function delete($table, $where) {
        $this->pdo->where ( $where );
        return $this->pdo->delete ( $table );
    }
    function getStateDropdown() {
        $query = $this->pdo->query ( "select * from country_states where country_name like 'India'" );
        if ($query->num_rows () > 0) {
            $catArray = $query->result_array ();
        } else {
            $catArray = "";
        }
        $catDataArray [0] = "Select State";
        if (! empty ( $catArray )) {
            foreach ( $catArray as $category ) {
                $id = $category ['state_name'];
                $name = $category ['state_name'];
                $catDataArray [$id] = $name;
            }
        } else {
            $catDataArray = "";
        }
        return $catDataArray;
    }

    function getFeaturedProducts() {
        $this->pdo->select ( 'p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\' AND p.wholesale=0' );
        $this->pdo->order_by('p.id','DESC');
       $this->pdo->limit('30');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
 function getwholesaleProducts(){
	      $this->pdo->select ( 'p.* ');
          $this->pdo->from ( 'bt_products as p' );
          $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
          $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\' AND p.wholesale=1' );
          $this->pdo->order_by('p.id');
          $this->pdo->limit('40');
          $query = $this->pdo->get ();
          if ($query->num_rows () > 0) {
              $resultData = $query->result_array ();
          } else {
              $resultData = false;
          }
          return $resultData; 
 }
    function gethotSellingProducts(){
          $this->pdo->select ( 'p.* ');
          $this->pdo->from ( 'bt_products as p' );
          $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
          $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\' AND p.wholesale=0  AND p.image !=\'\' ' );
          $this->pdo->order_by('RAND()');
          $this->pdo->limit('12');
          $query = $this->pdo->get ();
          if ($query->num_rows () > 0) {
              $resultData = $query->result_array ();
          } else {
              $resultData = false;
          }
          return $resultData;
      }

    function get_allActive_supplierList($limit,$where){
        $this->pdo->select( 's.id as business_id,s.*,m.user_id as member_id ');
        $this->pdo->distinct('s.id');
        $this->pdo->from ( 'bt_products as p');
        $this->pdo->join ( 'bt_product_cats as pc', 'pc.offer_id=p.id');
        $this->pdo->join ( 'bt_categories as c', 'pc.cid=c.id');
        $this->pdo->join ( 'bt_business as s', 's.user_id=p.uid');
        $this->pdo->join ( 'bt_members as m', 'm.user_id=p.uid');
        $this->pdo->where ($where);
        $this->pdo->limit($limit);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

	 function get_allActive_supplierList2($limit,$where){
        $this->pdo->select( 's.id as business_id,s.*,m.user_id as member_id ');
        $this->pdo->distinct('s.id');
        $this->pdo->from ( 'bt_products as p');
        $this->pdo->join ( 'bt_product_cats as pc', 'pc.offer_id=p.id');
        $this->pdo->join ( 'bt_categories as c', 'pc.cid=c.id');
        $this->pdo->join ( 'bt_business as s', 's.user_id=p.uid');
        $this->pdo->join ( 'bt_members as m', 'm.user_id=p.uid');
        $this->pdo->where ($where);
        $this->pdo->limit($limit);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

    function trade_categories_details($limit,$where){
        $this->pdo->select( 's.id as business_id,s.*,m.user_id as member_id ');
        $this->pdo->distinct('s.id');
        $this->pdo->from ( 'bt_products as p');
        $this->pdo->join ( 'bt_product_cats as pc', 'pc.offer_id=p.id');
        $this->pdo->join ( 'bt_categories as c', 'pc.cid=c.id');
        $this->pdo->join ( 'bt_business as s', 's.user_id=p.uid');
        $this->pdo->join ( 'bt_members as m', 'm.user_id=p.uid');
        $this->pdo->where ($where);
        $this->pdo->limit($limit);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

  function getdata_row_count($subcategory){
        $this->pdo->select( 'p.id,p.approved,pc.cid');
        $this->pdo->from ( 'bt_products as p');
        $this->pdo->join ( 'bt_product_cats as pc', 'pc.offer_id=p.id');
        $this->pdo->join ( 'bt_members as m', 'm.user_id=p.uid');
        $this->pdo->where ('p.id > 0 AND pc.cid = '.$subcategory.' AND p.approved = \'yes\' AND wholesale=0 AND m.suspended=\'N\'');
        $this->pdo->group_by('p.id');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
            }
  
  function has_scat_pro_count($subcategory){
        $this->pdo->select( 'p.id,p.approved,pc.cid');
        $this->pdo->from ( 'bt_products as p');
        $this->pdo->join ( 'bt_product_cats as pc', 'p.id = pc.offer_id');
        $this->pdo->join ( 'bt_categories as c', 'c.id = pc.cid');
        $this->pdo->join ( 'bt_members as m', 'm.user_id=p.uid');
        $this->pdo->where ('pc.cid = '.$subcategory.' AND p.approved = \'yes\' AND p.wholesale=0 AND m.suspended=\'N\' ');
        $this->pdo->group_by('p.id');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

function dbsuply(){
       $this->pdo->select( 'p.id as pid');
        $this->pdo->from ( 'bt_products as p');
        $this->pdo->join ( 'bt_product_cats as pc', 'p.id = pc.offer_id');
        $this->pdo->join ( 'bt_members as m', 'm.user_id=p.uid');
        $this->pdo->where ('p.approved = \'yes\' AND p.wholesale=0 AND m.suspended=\'N\' ');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
}
    function dbsuplywhere($where){
        $this->pdo->select( 'p.id as pid');
        $this->pdo->from ( 'bt_products as p');
        $this->pdo->join ( 'bt_product_cats as pc', 'p.id = pc.offer_id');
        $this->pdo->join ( 'bt_members as m', 'm.user_id=p.uid');
        $this->pdo->where ('p.approved = \'yes\' AND p.wholesale=0 AND m.suspended=\'N\' '.$where.'' );
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

    function wholesellers(){
        $prev='bt_';
        $productTable 			= $prev . "products";
        $productCategoryTable 	= $prev . "product_cats";
        $categoryTable 			= $prev . "categories";
        $businessTable 			= $prev . "business";
        $membersTable     		= $prev . "members";
        $wholesalePriceTable    = $prev . "wholesale_product_price";


        $sqlStatement = "SELECT 
							c.id as category_id,
							c.cat_name,
							p.id as product_id,
							p.title as product_name, 
							p.*, 
							m.user_id as member_id,
							m.firstname as member_firstname,
							m.lastname as member_lastname,
							m.email as member_email,
							s.id as business_id, 
							s.company_name as business_name,
							s.minisite_prefix,
							s.services as business_services,
							s.address1 as business_address1,
							s.email as business_email,
							s.website as business_website

						FROM 
							" . $productTable . " p 
						JOIN " .$productCategoryTable. " pc ON pc.offer_id=p.id 
						JOIN " .$categoryTable. " c ON pc.cid=c.id 
						JOIN " .$businessTable. " s ON s.user_id=p.uid
						JOIN " .$membersTable. " m ON m.user_id=p.uid
						WHERE p.approved ='yes' AND m.suspended='N' AND p.image !=''\", \" ORDER BY RAND() LIMIT 12";
        $query = $this->pdo->query ($sqlStatement);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;

    }

    function total_wsale_products(){
        $prev='bt_';
        $total_wsale_select = " SELECT p.id FROM 
                               bt_products as p 
                              JOIN ".$prev."product_cats as pc ON p.id=pc.offer_id  
                              JOIN ".$prev."categories as c ON c.id=pc.cid
                              WHERE p.wholesale='1' AND p.approved ='yes' GROUP BY p.id";

        $query = $this->pdo->query ($total_wsale_select);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;

    }

    function prochk_category(){
        $prev='bt_';
        $qry = "SELECT pc.*,c.cat_name FROM  bt_product_cats as pc 
                JOIN ".$prev."products as p ON p.id=pc.offer_id  
                JOIN ".$prev."categories as c ON c.id=pc.cid
        WHERE p.wholesale='1' AND p.approved ='yes' LIMIT 1";
        $query = $this->pdo->query ($qry);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;

    }

    function undercat_products(){
        $prev='bt_';
        $qry = "SELECT p.* FROM  bt_products as p 
                JOIN ".$prev."product_cats as pc ON p.id = pc.offer_id
                JOIN ".$prev."members m ON m.user_id=p.uid
        WHERE p.wholesale='1' AND p.approved ='yes' AND p.image !='' AND m.suspended='N' LIMIT 18";
        $query = $this->pdo->query ($qry);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;

    }

    function getWholesale_categoryList(){
        $prev='bt_';
        $productTable 			= $prev . "products";
        $productCategoryTable 	= $prev . "product_cats";
        $categoryTable 			= $prev . "categories";
        $businessTable 			= $prev . "business";
        $membersTable     		= $prev . "members";
        $wholesalePriceTable    = $prev . "wholesale_product_price";

        //JOIN " .$businessTable. " s ON s.user_id=p.uid

        $sqlStatement = "SELECT 
							c.id as category_id,
							c.cat_name as category_name,
							c.*

						FROM 
							" . $productTable . " p 
						JOIN " .$productCategoryTable. " pc ON pc.offer_id=p.id 
						JOIN " .$categoryTable. " c ON pc.cid=c.id 
						JOIN " .$businessTable. " s ON s.user_id=p.uid
						JOIN " .$membersTable. " m ON m.user_id=p.uid
						WHERE p.approved ='yes' AND p.wholesale=1 AND m.suspended='N' ORDER BY RAND() LIMIT 2";
        $query = $this->pdo->query ($sqlStatement);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;

    }
    function getPremium_supplierBrands(){
        $this->pdo->select( 's.id as business_id,s.*,m.user_id as member_id ');
        $this->pdo->distinct('s.id');
        $this->pdo->from ( 'bt_products as p');
        $this->pdo->join ( 'bt_product_cats as pc', 'pc.offer_id=p.id');
        $this->pdo->join ( 'bt_categories as c', 'pc.cid=c.id');
        $this->pdo->join ( 'bt_business as s', 's.user_id=p.uid');
        $this->pdo->join ( 'bt_members as m', 'm.user_id=p.uid');
        $this->pdo->limit(28);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;

    }
    function get_hot_wholesaleProduct_list(){
        $prev='bt_';
        $productTable 			= $prev . "products";
        $productCategoryTable 	= $prev . "product_cats";
        $categoryTable 			= $prev . "categories";
        $businessTable 			= $prev . "business";
        $membersTable     		= $prev . "members";
        $wholesalePriceTable    = $prev . "wholesale_product_price";


        $sqlStatement = "SELECT 
							c.id as category_id,
							c.cat_name,
							p.id as product_id,
							p.title as product_name, 
							p.*, 
							m.user_id as member_id,
							m.firstname as member_firstname,
							m.lastname as member_lastname,
							m.email as member_email,
							s.id as business_id, 
							s.company_name as business_name,
							s.minisite_prefix,
							s.services as business_services,
							s.address1 as business_address1,
							s.email as business_email,
							s.website as business_website

						FROM 
							" . $productTable . " p 
						JOIN " .$productCategoryTable. " pc ON pc.offer_id=p.id 
						JOIN " .$categoryTable. " c ON pc.cid=c.id 
						JOIN " .$businessTable. " s ON s.user_id=p.uid
						JOIN " .$membersTable. " m ON m.user_id=p.uid
						WHERE p.approved ='yes' AND p.wholesale=1 AND m.suspended='N' LIMIT 12";
        $query = $this->pdo->query ($sqlStatement);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;

    }
    function get_wholesale_most_selling_product_list(){
        $prev='bt_';
        //defined used tables
        $productTable 			= $prev . "products";
        $productCategoryTable 	= $prev . "product_cats";
        $categoryTable 			= $prev . "categories";
        $businessTable 			= $prev . "business";
        $membersTable     		= $prev . "members";
        $wholesalePriceTable    = $prev . "wholesale_product_price";


        $orderTable    			= $prev . "order";
        $orderProductTable    	= $prev . "order_product";


        $sqlStatement = "SELECT 
							c.id as category_id,
							c.cat_name,
							p.id as product_id,
							p.title as product_name, 
							p.*, 
							m.user_id as member_id,
							m.firstname as member_firstname,
							m.lastname as member_lastname,
							m.email as member_email,
							s.id as business_id, 
							s.company_name as business_name,
							s.minisite_prefix,
							s.services as business_services,
							s.address1 as business_address1,
							s.email as business_email,
							s.website as business_website

						FROM 
							" . $productTable . " p 
						JOIN " .$productCategoryTable. " pc ON pc.offer_id=p.id 
						JOIN " .$categoryTable. " c ON pc.cid=c.id 
						JOIN " .$businessTable. " s ON s.user_id=p.uid
						JOIN " .$membersTable. " m ON m.user_id=p.uid
						WHERE p.approved ='yes' AND p.wholesale=1 AND m.suspended='N' ORDER BY p.id DESC LIMIT 6";
        $query = $this->pdo->query ($sqlStatement);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;

    }
    function getSuppliers_byCountry($countryId){
        $prev='bt_';
        //defining table names::
        $saleOfferTable   		= $prev . "offers";
        $productTable 			= $prev . "products";
        $productCategoryTable 	= $prev . "product_cats";
        $categoryTable 			= $prev . "categories";
        $membersTable 			= $prev . "members";
        $businessTable 			= $prev . "business";

        //sql statement
        $sqlStatement = "SELECT
							s.id as business_id,
							s.*,
							m.user_id as member_id,
							m.firstname as member_firstname,
							m.lastname as member_lastname,
							m.email as member_email,
							m.country as member_country
							
						FROM 
							 " .$productTable. " p 
						JOIN " .$businessTable. " s ON s.user_id=p.uid 
						JOIN " .$membersTable. " m ON m.user_id =p.uid
						WHERE 
							m.suspended='N' AND m.usertype='2'";

        //if where condition passed it will added with "AND "
        if (!empty($countryId)) {
            $sqlStatement .= " AND m.country = '$countryId' LIMIT 6";
        }else{
            $sqlStatement .= " AND m.country !='' LIMIT 6";
        }
        $query = $this->pdo->query ($sqlStatement);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;

    }

 function getmenus($id,$adminId){
        $this->pdo->select( 'am.*');
        $this->pdo->from ( 'bt_adminmenu as am');
        $this->pdo->join ( 'bt_admin_grant as ag', 'am.id=ag.prog_id');
        //$this->pdo->where ('am.parent_id="'.$id.'" and ag.admin_id="'.$adminId.'" and am.status="Y"');
        $this->pdo->order_by('am.name','ASC');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
            }
  function getmenus2($adminId){
        $this->pdo->select( 'am.*');
        $this->pdo->from ( 'bt_adminmenu as am');
        $this->pdo->join ( 'bt_admin_grant as ag', 'am.id=ag.prog_id','left');
       // $this->pdo->where (' ag.admin_id="'.$adminId.'" and am.status="Y"');
        $this->pdo->order_by('am.name','ASC');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
            }
  function getcountRecods($query){

        $query = $this->pdo->query ($query);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;


}

    function getsupplier_users(){
        $this->pdo->select( 'm.*');
        $this->pdo->from ( 'bt_members as m');
        $this->pdo->join ( 'bt_business as b', 'b.user_id = m.user_id');
        $this->pdo->where ('m.suspended ="N" AND m.usertype ="2"');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
}