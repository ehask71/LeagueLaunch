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
                                echo '<td rowspan="1000"></td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <pre>
               <?php print_r($division); ?>
                </pre>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $( "ul li" ).each(function(){
        $(this).draggable({
            helper: "clone"
        });
    });

    $( ".day" ).droppable({
        activeClass: "ui-state-hover",
        hoverClass: "ui-state-active",
        accept: ":not(.ui-sortable-helper)",
        drop: function( event, ui ) {
            var targetElem = $(this).attr("id");
            $( ui.draggable ).clone().appendTo( this );
        }
    }).sortable({
        items: "li:not(.placeholder)",
        sort: function() {
            $( this ).removeClass( "ui-state-default" );
        }
    });
});​
</script>