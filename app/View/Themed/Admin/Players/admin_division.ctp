<div class="grid_12">
    <div class="box">
        <h2>
            <?= __('Move Players'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <form action="/admin/players/division/<?=$div;?>/<?=$season;?>" method="POST" onsubmit="return checkDivision();">
                <table>
                    <thead>
                        <th>&nbsp</th>
                        <th>Player</th>
                        <th>League Age</th>
                        <th>Division</th>
                    </thead>
                    <tbody>
                        <?php
                        if(count($players)>0){
                            foreach ($players AS $player){
                                echo '<tr>';
                                echo '<td><input type="checkbox" name="data[PlayersToSeasons][player_id][]" value="'.$player[PlayersToSeasons][player_id].'"></td>';
                                echo '<td>'.$player[Players][firstname].' '.$player[Players][lastname].'</td>';
                                echo '<td>'.$players[Players][league_age].'</td>';
                                echo '<td>'.$player[Divisions][name].'</td>';     
                                echo '</tr>';
                            }
                            echo '<tr>';
                            echo '<td>New Divsion</td>';
                            echo '<td colspan="3"><select name="data[Divisions][division_id]" id="division_id">';
                            echo '<option value="">Please Select</option>';
                            foreach ($divisions AS $k=>$v){
                                echo '<option value="'.$k.'">'.$v.'</option>';
                            }
                            echo '</select>';
                            echo '</td>';
                            echo '</tr><tr>';
                            echo '<td colspan="4"><input type="submit" name="submit" value="Change Divisions"></td></tr>';
                        } else {
                            ?>
                        <tr>
                            <td colspan="4">No Players</td>
                        </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function checkDivision(){
    if($('#division_id').val() == ''){
        return false;
    }
}
</script>