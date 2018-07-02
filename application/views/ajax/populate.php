<table class="table table-hover table-striped" id="bootstrap-table">
    <a href="#" class=" search-btn fa fa-search search-table"></a>
    <thead>
    <tr>
        <th>Name</th>
        <th>Loan Amount</th>
        <th>Remaining</th>
    </tr>
    </thead>
    <tbody>
    <?php

    if(!empty($searchdata)){
        $i=0;
        foreach ($searchdata as $search){
            ?>
            <tr>

                <td ng-repeat="subject in item.days" class="ng-binding ng-scope"><?php echo $search['amount'];?></td>
                <td ng-repeat="subject in item.days" class="ng-binding ng-scope"><?php echo $search['amount'];?></td>

            </tr>
            <?php   $i++;   }
    }else {?>
        <tr ng-repeat="item in timetable" class="ng-scope">
            <td colspan="5" style="text-align: center;"><div class="alert alert-warning" role="alert">
                    No records found
                </div></td>
        </tr>
    <?php } ?>
    </tbody>

</table>
