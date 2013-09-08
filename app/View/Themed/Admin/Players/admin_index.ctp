<div class="grid_12">
    <div class="box">
        <h2>
            <?= __('Select Season'); ?>
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
                                $total = count($season[Divisions]);
                                $i = 0;
                                $r = 0;
                                echo '<tr>';
                                foreach ($season[Divisions] AS $division) {
                                    echo '<td><a href="/admin/players/division/' . $division[division_id] . '/' . $division[season_id] . '" class="button green">';
                                    echo $division[name] . '</a></td>';
                                    $i++;
                                    $r++;
                                    if ($r == $total) {
                                        if ($i < 6) {
                                            $remainder = (6 - $i);
                                            if ($remainder != 0) {
                                                echo '<td colspan="' . $remainder . '"></td>';
                                            }
                                        }
                                    }
                                    if ($i == 6) {
                                        echo '</tr><tr>';
                                        $i = 0;
                                    }
                                }
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr>';
                            echo '<td colspan="6">' . __('No Active Seasons') . '</td>';
                            echo '<tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>