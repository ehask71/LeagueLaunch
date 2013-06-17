<div class="grid_12">
    <div class="box">
        <h2>
            Divisions
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Updated</th>
			    <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($divisions)>0){
                                foreach ($divisions AS $row){
                                    ?>
                        <tr>
                            <td><?=$row['name'];?></td>
                            <td><?=$row['last_updated'];?></td>
                            <td></td>
                        </tr>
                                    <?php
                                }
                            } else {
                                ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No Divisions Configured</td>
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