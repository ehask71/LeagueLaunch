<div class="grid_12">
    <div class="box">
        <h2>
            <?= __($season[Season][name] . ' ~ Teams'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <?php
                    if (count($divisions) > 0) {
                        foreach ($divisions AS $div) {
                            ?>
                            <tr>
                                <td><?= $div[Divisions][name]; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <style>
                                        #pseudo-table li {float:left; width:22%;} 
                                    </style>
                                    <ul class="pseudo-table">
                                        <?php
                                        if (count($div[Team]) > 0) {
                                            foreach ($div[Team] AS $team) {
                                                echo '<li>';
                                                echo '<div><h2>' . $team['name'] . '</h2>';
                                                echo '<ul>';
                                                if (count($team[players]) > 0) {
                                                    foreach ($team[players] AS $player) {
                                                        echo '<li>' . $player[Players]['firstname'] . ' ' . $player[Players][lastname] . '</li>';
                                                    }
                                                }
                                                echo '</ul>';
                                                echo '</div>';
                                                echo '</li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <pre>
                    <?php print_r($divisions); ?>
                </pre>  
            </div>
        </div>
    </div>
</div>