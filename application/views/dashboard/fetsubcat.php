   <select name="courireselect" class="form-control" id="courireselect" >                    <option value="">Choose a category</option>                    <?php                    require_once APPPATH.'views/pages/aoth/external-conn.php';                   $prev="bt_";                    $under_main_cat_qu = mysqli_query($dbh,"select * from " . $prev . "categories where pid='0' and status='Y' and group_id = ".$groupid." ORDER BY cat_name");                    $under_main_cat_found = mysqli_num_rows($under_main_cat_qu);                    while ($main_cat_info = mysqli_fetch_array($under_main_cat_qu)) {                        $main_cat_id = $main_cat_info['id'];                        $main_cat_name = $main_cat_info['cat_name'];                        // $main_has_subcat = getdata_row_count($prev.'categories','id',"pid='$main_cat_id' AND status='Y'");                        // if($main_has_subcat==0){ continue; }                        ?>                        <optgroup label="<?php echo strtoupper($main_cat_name); ?>" >                            <?php                            // for sub category                             $under_sub_cat_qu = mysqli_query($dbh,"select * from " . $prev . "categories where pid = '$main_cat_id' and status='Y' ORDER BY cat_name");                            $under_sub_cat_found = mysqli_num_rows($under_sub_cat_qu);                            if ($under_sub_cat_found) {                                while ($sub_cat_info = mysqli_fetch_array($under_sub_cat_qu)) {                                    $sub_cat_id = $sub_cat_info['id'];                                    $sub_cat_name = $sub_cat_info['cat_name'];                                    ?>                                    <option value="<?php echo $sub_cat_id; ?>" >  -- <?php echo ucwords($sub_cat_name); ?> </option>                                    <?php                                }                            }                            ?>                        </optgroup>                        <?php                    }                    ?>                </select>