<?php
/* @var $this LowonganController */
/* @var $model Lowongan */
/* @var $form CActiveForm */
?>

<div class="form">
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert ' . $key . '">' . $message . "</div>\n";
    }
?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'lowongan-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model, null , null, array('class'=>'alert alert-danger')); ?>
    <table class="table-condensed">
        <tbody>
            <tr>
                <th><?php echo $form->labelEx($model, 'nama'); ?></th>
                <td><?php echo $form->textField($model, 'nama', array('size' => 30, 'maxlength' => 30)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'deskripsi'); ?></th>
                <td><?php echo $form->textArea($model, 'deskripsi', array('size' => 60, 'maxlength' => 74000, 'rows' => 5)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'persyaratan'); ?></th>
                <td><?php echo $form->textArea($model, 'persyaratan', array('size' => 60, 'maxlength' => 71000, 'rows' => 15)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'departemen'); ?></th>
                <td><?php
                    if (Yii::app()->user->isSuperAdmin()) {
                        echo $form->dropDownList($model, 'departemen', array(
                            'SIS' => 'SIS',
                            'COM' => 'COM',
                            'PMO' => 'PMO',
                            'PRD' => 'PRD',
                            'IMP' => 'IMP',
                            'KOU' => 'KOU'));
                    } else {
                        //cari departemen
                        $id = Yii::app()->user->id;
                        $modelAdmin = Admin::model()->findByAttributes(array('id_user' => $id));
                        echo $form->hiddenField($model, 'departemen', array('value' => $modelAdmin->departemen));
                        echo $modelAdmin->departemen;
                    }
                    ?></td>
            </tr>
<!--            <tr>
                <th><?php // echo $form->labelEx($model, 'Tampilkan*');  ?></th>
                <td>
                    <?php
//                            echo $form->dropDownList($model, 'new', array(
//                                '1' => 'Yes',
//                                '0' => 'No'));
                    ?>
                    <?php //echo $form->error($model, 'new'); ?></td>
            </tr>-->
            <!-- Nampilin check box tahapan -->
            <?php if ($this->action->Id == 'create') { ?>
                <?php foreach ($tahaps as $i => $item): ?>
                    <tr>
                        <th><?php echo $form->labelEx($item, $item->nama); ?></th>
                        <td><?php echo $form->checkBox($item, '[' . $i . ']nama', array('value' => 1, 'uncheckValue' => 0)); ?>
                            <?php echo $form->error($item, '[' . $i . ']nama'); ?></td>
                    </tr>
                    <tr><?php echo $form->hiddenField($item, '[' . $i . ']id', array('value' => $item->id)); ?>
                        <?php echo $form->error($item, '[' . $i . ']id'); ?>

                        <?php
                    endforeach;
                }
                ?></tr>
        </tbody>
    </table>
    <br>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary btn-sm')); ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->