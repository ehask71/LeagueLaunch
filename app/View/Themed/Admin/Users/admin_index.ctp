<div class="grid_12">
    <div class="box">
        <h2>
            Users
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
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
                            <td><?=$row['User']['firstname'].' '.$row['User']['firstname'];?></td>
                            <td><?=$row['is_active'];?></td>
                            <td></td>
                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                        <tr>
                            <td colspan="5">No Users</td>
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