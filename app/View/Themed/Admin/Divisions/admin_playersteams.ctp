<style>
    .droppable {
        min-height: 25px;
    }
</style>
<div class="grid_12">
    <div class="box">
        <h2>
            Adjust Players for <?php echo $division['Divisions']['name']; ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <a href="#" onclick="saveTeams();" class="button small green">Save Teams</a>
                <table>
                    <thead>
                        <tr>
                            <th>Teams</th>
                            <th>Players</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($division[Team] AS $div) {
                            echo '<tr>';
                            echo '<td>';
                            echo '<h2>'. $div['name'].'</h2>';
                            echo '<ol id="team_' . $div[team_id] . '" class="droppable teamcontainer">';
                           // echo '<li class="placeholder">Drop Here</li>';
                            echo '</ol>';
                            echo '</td>';
                            if ($i == 0) {
                                echo '<td rowspan="1000">';
                                echo '<ul class="players">';
                                foreach ($players AS $play) {
                                    echo '<li id="player_' . $play['Players']['player_id'] . '">' . $play['Players']['firstname'] . ' ' . $play['Players']['lastname'] . '</li>';
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
                    <?php
                    print_r($division);
                    print_r($players);
                    ?>
                </pre>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var season_id = '<?php echo $division[Divisions][season_id];?>';
    $(document).ready(function(){
        $(".players li").draggable({	
            cursor: 'hand',
            revert: 'invalid',
            opacity: 0.6,
            helper: 'clone',
            zIndex: 100
        });
        $( ".droppable" ).droppable({
            tolerance: "pointer",
            accept: ".players li",
            activeClass: "ui-state-hover",
            hoverClass: "ui-state-active",
            drop: function (event, ui) {         
                var target = $(this).attr("id");
                var clone = $(ui.draggable).clone();
                $(this).append(clone);
                $(ui.draggable).remove();
                $.post("/save.php", { season: season_id,team: target.replace('team_',''), player_id: clone.attr("id").replace('player_','') }, function (data) {
                    alert("success!");
                });
                
            }
        })
        $( ".droppable" ).sortable({
            //items: "li:not(.placeholder)",
            connectWith: '.droppable',
            update: function (){
                console.log('update');
            }
        });
    });
    function saveTeams(e){
        e.preventDefault();
        var teams = $('.droppable').serialize();
        console.log(teams);
    }
</script>
