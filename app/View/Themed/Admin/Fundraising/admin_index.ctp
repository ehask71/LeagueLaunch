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
                            <td><?=$row['Fundraiser']['name'];?></td>
                            <td><?=$row['Fundraiser']['start'];?></td>
                            <td><?=$row['Fundraiser']['end'];?></td>
                            <td><?=$row['Fundraiser']['active'];?></td>
                            <td><a class="button green" href="/admin/fundraising/viewraffle/<?=$row['Fundraiser']['id'];?>">Entries</a>&nbsp;<a class="button red" href="/admin/fundraising/buyraffle/<?=$row['Fundraiser']['id'];?>">Buy</a></td>
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
