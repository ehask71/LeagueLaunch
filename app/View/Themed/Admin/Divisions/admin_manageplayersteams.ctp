<div class="grid_12">
    <div class="box">
        <h2>
            Active Seasons
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <tbody>
                        <?php
                        if (count($seasons) > 0) {
                            foreach ($seasons AS $season) {
                                ?>
                                <tr>
                                    <td colspan="100"><?php echo $season[Season][name]; ?></td>
                                </tr>
                                <?php
                                if(count($season[Divisions])>0){
                                    $i=0;
                                    echo '<tr>';
                                    foreach($season[Divisions] AS $division){
                                        echo '<td><a href="/admin/divisions/playersteams/'.$division[division_id].'/'.$division[season_id].'" class="button green">';
                                        echo $division[name].'</a></td>';
                                        $i++;
                                        if($i == 7){
                                            echo '</tr><tr>';
                                            $i=0;
                                        }
                                    }
                                    echo '</tr>';
                                }
                            }
                        } else {
                            ?>
                                <tr>
                                    <td colspan="10">No Seasons</td>
                                </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <pre>
                    <?php print_r($seasons); ?>
                </pre>
            </div>
        </div>
    </div>
</div>