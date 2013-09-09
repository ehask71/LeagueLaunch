<div class="grid_12">
    <div class="box">
        <h2>
            <?= __('Move Players'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <p>This will allow you to move players to a new division. This will remove the player from any team he or she is currently a player in</p>
                <form action="/admin/players/division/<?=$div;?>/<?=$season;?>" method="POST" id="manageplayers" onsubmit="return checkDivision();">
                    <input type="hidden" name="data[Divisions][current_division]" value="<?=$div;?>"/>
                    <input type="hidden" name="data[Divisions][season_id]" value="<?=$season;?>"/>
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
                                echo '<td width="15%"><input type="checkbox" name="data[PlayersToSeasons][player_id][]" value="'.$player[PlayersToSeasons][id].'_'.$player[Players][player_id].'"></td>';
                                echo '<td>'.$player[Players][firstname].' '.$player[Players][lastname].'</td>';
                                echo '<td>'.$player[Players][league_age].'</td>';
                                echo '<td>'.$player[Divisions][name].'</td>';     
                                echo '</tr>';
                            }
                            echo '<tr>';
                            echo '<td>New Divsion</td>';
                            echo '<td colspan="3"><select name="data[Divisions][division_id]" id="division_id">';
                            echo '<option value="">Please Select</option>';
                            foreach ($divisions AS $k=>$v){
                                if($k==0)
                                    continue;
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
                <pre><?php                        print_r($players);?></pre>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function checkDivision(){
    if(!$('#manageplayers input[type="checkbox"]').is(':checked')){
      alert("Please check at least one.");
      return false;
    }
    if($('#division_id').val() == ''){
        alert('You Need To Select A New Division!');
        return false;
    }
}
</script>