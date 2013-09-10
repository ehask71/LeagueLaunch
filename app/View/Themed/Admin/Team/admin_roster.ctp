<div class="grid_12">
    <div class="box">
        <h2>
            <?= __($team[Team][name].' Roster'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <thead>
                        <tr>
                            <th>Player</th>
                            <th>Parent</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($team[Team][players])>0){
     foreach ($team[Team][players] AS $player){
         echo '<tr>';
         echo '<td>'.$player[Players][firstname].' '.$player[Players][lastname].'</td>';
         echo '<td>'.$player[Account][firstname].' '.$player[Account][lastname].'</td>';
         echo '<td>Email:'.$player[Account]['email'].'<br/>Phone:'.$player[Account]['phone'].'</td>';
         echo '</tr>';
     }  
                        } else {
                            ?>
                        <tr>
                            <td colspan="3">No Players To Display</td>
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