<div class="grid_12">
    <div class="box">
        <h2>
            <?= __('Random Team Generator'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                <?php 
                    if(count($divisions)>0){
                        foreach ($divisions AS $div){
                            $totalteams = count($div[Divisions]['teams']);
                            if(count($totalteams)>0){
                                echo "<tr>";
                                echo '<td colspan="100">'.$div[Divisions]['name'].'</td>';
                                echo '</tr>';
                                echo '<tr>';
                                $i=0;
                                $r=0;
                                foreach ($div[Divisions]['teams'] AS $team){
                                    echo '<td>';
                                    echo '<h2>'.$team[name].'</h2><br>';
                                    echo '<ul>';
                                    foreach($team['players'] AS $pp){
                                        echo '<li>'.$pp['name'].' '.$pp['ageindays'].'</li>';
                                    }
                                    echo '</ul>';
                                    echo '</td>';
                                    $i++;
                                    $r++;
                                    if($i==5){
                                        if($r==$totalteams){
                                            echo '</tr>';
                                        } else {
                                            echo '</tr><tr>';
                                        }
                                        $i=0;
                                    }
                                }
                            }
                        }
                    }
                ?>
                </table>
                <pre>
                <?php //print_r($divisions);?>
                </pre>
            </div>
        </div>
    </div>
</div>