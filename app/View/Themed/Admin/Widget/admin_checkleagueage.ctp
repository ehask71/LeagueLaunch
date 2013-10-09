<div class="grid_12">
    <div class="box">
        <h2>
            <?= __('Random Team Generator'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <pre>
                <?php print_r($results);?>
                </pre>
                
                <?php 
                foreach($results AS $r){
                    if(isset($r[queries])){
                        foreach ($r[queries] AS $v){
                            echo $v.";<br>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>            