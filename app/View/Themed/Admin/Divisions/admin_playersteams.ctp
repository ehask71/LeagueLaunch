<div class="grid_12">
    <div class="box">
        <h2>
            Adjust Players for <?php echo $division['Divisions']['name'];?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <thead>
                    <tr>
                        <th>Teams</th>
                        <th>Players</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=0;
                        foreach($division[Team] AS $div){
                            echo '<tr>';
                            echo '<td>';
                            echo '<ul id="'.$div[team_id].'" class="droppable teamcontainer">';
                            echo '<li class="placeholder">'.$div['name'].'</li>';
                            echo '</ul>';
                            echo '</td>';
                            if($i==0){
                                echo '<td rowspan="1000">';
                                echo '<ul class="players">';
                                foreach ($players AS $play){
                                    echo '<li id="player_'.$play['Players']['player_id'].'">'.$play['Players']['firstname'].' '.$play['Players']['lastname'].'</li>';          
                                }
                                echo '</ul>';
                                echo '</td>';
                            }
                            echo '</tr>';
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
                <pre>
               <?php print_r($division);print_r($players); ?>
                </pre>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    alert('Test');
});​
</script>