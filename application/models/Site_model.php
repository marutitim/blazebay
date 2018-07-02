<?php

class Site_model  extends CI_Model {

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

	    function addQ($qry) {
        try {
            $this->pdo->insert ( $table, $insertArray );
            return $this->pdo->insert_id ();
        } catch ( Exception $e ) {
            echo 'Caught exception: ', $e->getMessage (), "\n";
        }
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

	    function getRowData($table, $where) {
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


    function premium_supplierBrands() {
        $this->pdo->select( 's.id as business_id,s.*,m.user_id as member_id ');
        $this->pdo->distinct('s.id');
        $this->pdo->from ( 'bt_products as p');
        $this->pdo->join ( 'bt_product_cats as pc', 'pc.offer_id=p.id');
        $this->pdo->join ( 'bt_categories as c', 'pc.cid=c.id');
        $this->pdo->join ( 'bt_business as s', 's.user_id=p.uid');
        $this->pdo->join ( 'bt_members as m', 'm.user_id=p.uid');
        $this->pdo->where ( '`p`.`approved` = \'yes\' AND `m`.`suspended` = \'N\' AND s.company_logo <>\'\'' );
        $this->pdo->limit(5);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function categories() {
        $this->pdo->select ( ' * ');
        $this->pdo->from ( 'bt_categories' );
        $this->pdo->where ( 'pid =0 AND status = "Y"  ' );
        $this->pdo->order_by('cat_name','ASC');
        $this->pdo->limit(9);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function getFeaturedProducts() {
        $this->pdo->select ( 'p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\' AND p.wholesale=0 AND p.id!=21492 AND p.price <>0 AND p.price <>\'\' ' );
        $this->pdo->order_by('RAND()');
       $this->pdo->limit(20);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

    function getSellOffersProducts() {
        $this->pdo->select ( 'p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_offers as o', 'p.id=o.prod_id', 'right' );
        $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\' AND  o.expireson > NOW()  AND p.price<>0' );
        $this->pdo->order_by('RAND()');
        $this->pdo->limit(20);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function product($productId) {
        $this->pdo->select ( 'p.*,');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->where ( '`p`.`id` ='.$productId.'');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function productDetails($productId) {
        $this->pdo->select ( 'p.*,b.*,m.* ,p.id as pid');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_business as b', 'b.user_id = p.uid', 'right' );
        $this->pdo->where ( '`p`.`id` ='.$productId.'  AND m.suspended=\'N\'  AND p.approved =\'yes\'  AND p.price<>0');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

    function relatedproducts($catId) {
        $this->pdo->select ( 'cat_name,c.cid,p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_product_cats as c', 'c.offer_id = p.id', 'right' );
        $this->pdo->join ( 'bt_categories as ca', 'ca.id = c.cid', 'right' );

        $this->pdo->where ( '`c`.`cid` ='.$catId.'  AND m.suspended=\'N\'  AND p.approved =\'yes\'  AND p.price<>0' );
        $this->pdo->order_by('p.title','ASC');
        $this->pdo->limit(5);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function productImages($productId) {
        $this->pdo->select ( 'i.* ');
        $this->pdo->from ( 'bt_product_images as i' );
        $this->pdo->where ( '`i`.`offer_id` ='.$productId.'');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

    function categoryIds($pid) {
        $this->pdo->select ( 'id');
        $this->pdo->from ( '`bt_categories` ' );
        $this->pdo->where ( 'group_id="'.$pid.'" ' );
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

    function getCompaniesByCountryId($country_id,$searchTearm) {

        $this->pdo->select ( 'LOWER(b.company_name) as title,"company",m.user_img as image,b.user_id as uid,b.* ');
        $this->pdo->from ( 'bt_business as b' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id=b.user_id', 'right' );
        $this->pdo->where ( ' m.suspended=\'N\' AND m.usertype=2  AND b.status = \'Y\'  AND m.country='.$country_id.'
         AND b.`company_name like "%'.$searchTearm.'%"');
        $this->pdo->order_by('b.`company_name`','ASC');
        $this->pdo->limit(6);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function getProductsByCatId($dataIds,$searchTearm) {
        $this->pdo->select ( 'cat_name,c.cid,p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_product_cats as c', 'c.offer_id = p.id', 'right' );
        $this->pdo->join ( 'bt_categories as ca', 'ca.id = c.cid', 'right' );

        $this->pdo->where ( '(p.`description` REGEXP "'.$searchTearm.'" OR p.title like "%'.$searchTearm.'%")
         AND c.cid IN ('.$dataIds.') OR `c`.`cid` IN( SELECT id FROM bt_categories WHERE pid IN("'.$dataIds.'"))  AND m.suspended=\'N\'   AND p.approved =\'yes\'  AND p.price <>0  AND p.price <>\'\' ' );
        $this->pdo->order_by('p.title','ASC');
        $this->pdo->limit(6);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function search($searchTearm) {
        $this->pdo->select ( 'cat_name,c.cid,p.title as title,p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_product_cats as c', 'c.offer_id = p.id', 'right' );
        $this->pdo->join ( 'bt_categories as ca', 'ca.id = c.cid', 'right' );

        $this->pdo->where ( '`p`.`title` LIKE "%'.$searchTearm.'%"  AND m.suspended=\'N\'  AND p.approved =\'yes\'  AND p.price <>0 AND p.price <>\'\' ' );

        $this->pdo->order_by('p.title','ASC');
        $this->pdo->limit(6);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function newArrival() {
        $this->pdo->select ( 'cat_name,c.cid,p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_product_cats as c', 'c.offer_id = p.id', 'right' );
        $this->pdo->join ( 'bt_categories as ca', 'ca.id = c.cid', 'right' );

        $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\'  AND  p.uid NOT IN(1839,1509,1823,1813,983,1794) AND p.price <>0  AND p.price <>\'\' ' );
        $this->pdo->group_by('c.cid');
        $this->pdo->order_by('p.id','DESC');
        $this->pdo->limit(10);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function getNewProducts() {
        $this->pdo->select ( 'cat_name,c.cid,p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_product_cats as c', 'c.offer_id = p.id', 'right' );
        $this->pdo->join ( 'bt_categories as ca', 'ca.id = c.cid', 'right' );

        $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\'  AND p.price <>0  AND p.price <>\'\' ' );
        $this->pdo->group_by('c.cid');
        $this->pdo->order_by('p.id','DESC');
        $this->pdo->order_by('RAND()');

        $this->pdo->limit(15);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function getcustomNewProducts() {
        $this->pdo->select ( 'cat_name,c.cid,p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_product_cats as c', 'c.offer_id = p.id', 'right' );
        $this->pdo->join ( 'bt_categories as ca', 'ca.id = c.cid', 'right' );

        $this->pdo->where ( 'p.id IN(22164,22151,22149,22148,22142,22024)' );
        $this->pdo->order_by('p.id','DESC');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;


    }
    function productsUnder1000() {
        $this->pdo->select ( 'cat_name,c.cid,p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_product_cats as c', 'c.offer_id = p.id', 'right' );
        $this->pdo->join ( 'bt_categories as ca', 'ca.id = c.cid', 'right' );

        $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\'  AND (p.price !="" AND p.price <= 1)' );
        $this->pdo->order_by('p.price','ASC');
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;


    }
    function bestsellerProducts() {
        $this->pdo->select ( 'p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_product_cats as c', 'c.offer_id = p.id', 'right' );

        $this->pdo->where ( 'p.uid IN(1506,1507,1508,1509,1510,1511) AND m.suspended=\'N\' AND p.approved =\'yes\' AND p.image<>\'\' AND p.price <>0 AND p.price <>\'\' ' );
        $this->pdo->order_by('RAND()');
        $this->pdo->limit(18);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }

    function getNewProductsInCat($catId) {
        $this->pdo->select ( 'cat_name,c.cid,p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->join ( 'bt_product_cats as c', 'c.offer_id = p.id', 'right' );
        $this->pdo->join ( 'bt_categories as ca', 'ca.id = c.cid', 'right' );
        $this->pdo->where ( 'c.cid IN('.$catId.') AND p.price <>0 AND p.price <>\'\' ' );
        $this->pdo->order_by('p.id','DESC');
        $this->pdo->limit(15);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
    function getallProducts($limit) {
        $this->pdo->select ( 'p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\'  AND p.price <>0 AND p.price <>\'\'   '   );
        $this->pdo->order_by('p.id','DESC');
        $this->pdo->limit($limit);
        $query = $this->pdo->get ();
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
    }
 
   function getallProductType($limit,$producttype) {
		
		if($producttype=='Wholesale'){
			$type=1;
		}
		else if($producttype=='Featured'){
			$type=0;
		}
		else if($producttype=='Hotselling'){
			$type=0;
		}
        $this->pdo->select ( 'p.* ');
        $this->pdo->from ( 'bt_products as p' );
        $this->pdo->join ( 'bt_members as m', 'm.user_id = p.uid', 'right' );
        $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\' AND p.price <>0 AND p.price <>\'\'  AND p.image!=" "  AND wholesale='.$type.'');
       $this->pdo->order_by('RAND()');
		//$this->pdo->order_by('p.id','DESC');
        $this->pdo->limit($limit);
        $query = $this->pdo->get();
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
          $this->pdo->where ( 'm.suspended=\'N\' AND p.approved =\'yes\' AND p.wholesale=1 AND p.price <>0 AND p.price <>\'\' ' );
          $this->pdo->order_by('RAND()');
		  //$this->pdo->order_by('p.id','DESC');
          $this->pdo->limit(40);
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
        $this->pdo->where ( 'm.suspended="N" AND p.approved ="yes" AND p.wholesale=0 AND p.price <>0 AND p.price <>\'\' ' );
        $this->pdo->order_by('RAND()');
       $this->pdo->limit(6);
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
        WHERE p.wholesale='1' AND p.approved ='yes' AND p.image !='' AND m.suspended='N' ORDER BY p.id DESC LIMIT 18";
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
						WHERE p.approved ='yes' AND p.wholesale='1' AND m.suspended='N' ORDER BY RAND() LIMIT 6";
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
						WHERE p.approved ='yes' AND p.wholesale=1 AND m.suspended='N' ORDER BY p.id DESC LIMIT 36";
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
        $sqlStatement = "SELECT DISTINCT
							s.id as business_id,
							s.*,
							m.user_id as member_id,
							m.firstname as member_firstname,
							m.lastname as member_lastname,
							m.email as member_email,
							m.country as member_country
							
						FROM 
							 " .$productTable. " p 
						RIGHT JOIN " .$businessTable. " s ON s.user_id=p.uid 
						RIGHT JOIN " .$membersTable. " m ON m.user_id =p.uid
						WHERE 
							m.suspended='N' AND m.usertype='2'
							
							";

        //if where condition passed it will added with "AND "
        if (!empty($countryId)) {
            $sqlStatement .= " AND m.country = '$countryId'  ";
        }else{
            $sqlStatement .= " AND m.country !='' ";
        }
		  $sqlStatement .= " GROUP BY s.id ORDER BY RAND() ";
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
  function execute($query){

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
	
		function getcourierDropdown($query) {
		$query = $this->pdo->query ($query);
		if ($query->num_rows () > 0) {
			$selArray = $query->result_array ();
		} else {
			$selArray = "";
		}
		$dropdwn [0] = "Select Courier";
		if (! empty ( $selArray )) {
			foreach ( $selArray as $dropdwn ) {
				$id = $dropdwn['id'];
				$name = $dropdwn ['company_name'];
				$selDataArray [$id] = $name;
			}
		} else {
			$selDataArray = "";
		}
		return $selDataArray;
	}
	
	function getcountryDropdown($query) {
		$query = $this->pdo->query ($query);
		if ($query->num_rows () > 0) {
			$selArray = $query->result_array ();
		} else {
			$selArray = "";
		}
		$dropdwn [0] = "Select Country";
		if (! empty ( $selArray )) {
			foreach ( $selArray as $dropdwn ) {
				$id = $dropdwn['country_id'];
				$name = $dropdwn ['country_name'];
				$selDataArray [$id] = $name;
			}
		} else {
			$selDataArray = "";
		}
		return $selDataArray;
	}

		function getgroupDropdown($query) {
		$query = $this->pdo->query ($query);
		if ($query->num_rows () > 0) {
			$selArray = $query->result_array ();
		} else {
			$selArray = "";
		}
		$dropdwn [0] = "Select Group";
		if (! empty ( $selArray )) {
			foreach ( $selArray as $dropdwn ) {
				$id = $dropdwn['group_id'];
				$name = $dropdwn ['group_name'];
				$selDataArray [$id] = $name;
			}
		} else {
			$selDataArray = "";
		}
		return $selDataArray;
	}
	
		function getcategoryDropdown($query) {
		$query = $this->pdo->query ($query);
		if ($query->num_rows () > 0) {
			$selArray = $query->result_array ();
		} else {
			$selArray = "";
		}
		$dropdwn [0] = "Select Category";
		if (! empty ( $selArray )) {
			foreach ( $selArray as $dropdwn ) {
				$id = $dropdwn['id'];
				$name = $dropdwn ['cat_name'];
				$selDataArray [$id] = $name;
			}
		} else {
			$selDataArray = "";
		}
		return $selDataArray;
	}
	
	function getstatesDropdown($query) {
		$query = $this->pdo->query ($query);
		if ($query->num_rows () > 0) {
			$selArray = $query->result_array ();
		} else {
			$selArray = "";
		}
		$dropdwn [0] = "Select State";
		if (! empty ( $selArray )) {
			foreach ( $selArray as $dropdwn ) {
				$id = $dropdwn['state_id'];
				$name = $dropdwn ['state_name'];
				$selDataArray [$id] = $name;
			}
		} else {
			$selDataArray = "";
		}
		return $selDataArray;
	}

	function getcityDropdown($query) {
		$query = $this->pdo->query ($query);
		if ($query->num_rows () > 0) {
			$selArray = $query->result_array ();
		} else {
			$selArray = "";
		}
		$dropdwn [0] = "Select State";
		if (! empty ( $selArray )) {
			foreach ( $selArray as $dropdwn ) {
				$id = $dropdwn['city_id'];
				$name = $dropdwn ['city_name'];
				$selDataArray [$id] = $name;
			}
		} else {
			$selDataArray = "";
		}
		return $selDataArray;
	}
	
	function get_enqreceived($user_id){
		$prev="bt_";
		$saleOfferTable   		= $prev . "offers";

		$productTable 			= $prev . "products";

		$productCategoryTable 	= $prev . "product_cats";

		$categoryTable 			= $prev . "categories";

		$membersTable 			= $prev . "members";

		$businessTable 			= $prev . "business";

		$enquiryTable  = $prev . "enquiry";
		$sqlStatement = "SELECT

								e.id as enquiry_id,

								e.*,

								m.user_id as member_id,

								m.firstname as member_firstname,

								m.lastname as member_lastname,

								m.email as member_email,

								m.country as member_country

								

							FROM 

								 " .$enquiryTable. " e 

							LEFT JOIN " .$membersTable. " m ON m.user_id = e.sender_id

							WHERE e.receiver_id ='$user_id'  ORDER BY e.id DESC ";

 $query = $this->pdo->query ($sqlStatement);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
	}

	function get_enquiryData_sent($user_id){
		$prev="bt_";
		$saleOfferTable   		= $prev . "offers";

		$productTable 			= $prev . "products";

		$productCategoryTable 	= $prev . "product_cats";

		$categoryTable 			= $prev . "categories";

		$membersTable 			= $prev . "members";

		$businessTable 			= $prev . "business";

		$enquiryTable  = $prev . "enquiry";
		
			$sqlStatement = "SELECT
								e.id as enquiry_id,

								e.*,

								m.user_id as member_id,

								m.firstname as member_firstname,

								m.lastname as member_lastname,

								m.email as member_email,

								m.country as member_country

								

							FROM 

								 " .$enquiryTable. " e 

							LEFT JOIN " .$membersTable. " m ON m.user_id = e.receiver_id

							WHERE e.sender_id = '$user_id' ORDER BY e.id DESC";
							 $query = $this->pdo->query ($sqlStatement);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
	}
	
	function getTradeShowList($tradeshow_id){
				//defined used tables
        $prev="bt_";
		$tradeShowTable    	= $prev . "tradeshow";

		$membersTable      	= $prev . "members";

		$businessTable      = $prev . "business";



		$sqlStatement = "SELECT 

							t.*,

							m.user_id as member_id,

							m.firstname as member_firstname,

							m.lastname as member_lastname,

							m.email as member_email,

							m.usertype as member_usertype,

							m.memtype as member_memtype,

							s.id as business_id, 

							s.company_name as business_name,

							s.minisite_prefix,

							s.services as business_services,

							s.address1 as business_address1,

							s.email as business_email,

							s.website as business_website



						FROM 

							" . $tradeShowTable . " t 

						JOIN " .$membersTable.  " m ON m.user_id = t.user_id

						JOIN " .$businessTable. " s ON s.user_id = t.user_id

						WHERE t.approved = 'Y' AND m.suspended='N'  AND t.tradeshow_id='".$tradeshow_id."'";
	 $query = $this->pdo->query ($sqlStatement);
        if ($query->num_rows () > 0) {
            $resultData = $query->result_array ();
        } else {
            $resultData = false;
        }
        return $resultData;
	}
	}