<div class="grid_12">
    <div class="box">
        <h2>
            <?= __('Add New Registration ~ Step 2 Add Products'); ?>
            <span class="l"></span>
            <span class="r"></span>
        </h2>
        <div class="block">
            <div class="block_in">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Created</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($products) > 0) {
                            foreach ($products AS $prod) {
                                ?>
                                <tr>
                                    <td><?php echo $prod['Products']['name']; ?></td>
                                    <td><?php echo $prod['Products']['price']; ?></td>
                                    <td><?php echo $prod['Products']['created']; ?></td>
                                    <td>

                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4">No Products Assigned To This Registration</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                echo $this->Form->create('Products', array("type" => "file", "id" => "newProduct",
                    'inputDefaults' => array(
                        'div' => false,
                        'label' => false,
                        'before' => '<section class="form_row"><div class="grid_2">',
                        'between' => '</div><div class="grid_10"><div class="block_content">',
                        'after' => '</div></div><div class="clear"></div></section>'
                        )));
                echo $this->Form->input('reg_id', array('type' => 'hidden', 'value' => $regid));
                echo $this->Form->input('category_id', array('type' => 'hidden', 'value' => 1));
                echo $this->Form->input('name');
                echo $this->Form->input('description', array('type' => 'textarea'));
                echo $this->Form->input('price');
                echo $this->Form->input('active', array('type' => 'select', 'class' => 'chzn-select', 'options' => array(
                        1 => 'Yes',
                        0 => 'No')));
                ?>
            </div>
        </div>
    </div>
</div>