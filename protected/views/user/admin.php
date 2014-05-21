

<h1>Manage Admin</h1>
<div id="statusMsg">
    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-info flash-' . $key . '">' . $message . "</div>\n";
    }
    ?>
</div>
<?php echo CHtml::link('Create Admin', array('user/createAdmin'), array('class' => 'btn btn-primary btn-sm')); ?>
<hr>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'itemsCssClass' => 'table table-bordered',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'username',
        array(
            'type' => 'raw', // this is for your related group members of the current group
            'name' => 'admin.departemen', // this will access the attributeLabel from the member model class, and assign it to your column header
            'value' => '$data->admin->departemen', // this will access the current group's 1st member and give out the firstname of that member
        // this tells that the value type is raw and no formatting is to be applied to it
        ),
        array(
            'class' => 'CButtonColumn',
            'afterDelete' => 'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
            'template' => '{view2}{update2}{delete}',
            'buttons' => array
                (
                'update2' => array
                    (
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/update.png',
                    'url' => 'Yii::app()->createUrl("user/updateAdmin", array("id"=>$data->id))',
                ),
                'view2' => array
                    (
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
                    'url' => 'Yii::app()->createUrl("user/viewAdmin", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
