<div class="grid_12">
    <div class="box">
        <h2>
            Fundraisers
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Active</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($fundraisers)>0){
                                foreach ($fundraisers AS $row){
                                    ?>
                        <tr>
                            <td><?=$row['name'];?></td>
                            <td><?=$row['start_date'];?></td>
                            <td><?=$row['end_date'];?></td>
                            <td><?=$row['is_active'];?></td>
                            <td></td>
                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                        <tr>
                            <td colspan="5">No Fundraisers</td>
                        </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<pre>
<?php			    print_r($users);?>
</pre>