<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FileUpload */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-upload-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_path')->fileInput() ?>

    <?php if ($model->file_path): ?>
        <div>
            <p>Current File:</p>
            <?php
            $fileExtension = pathinfo($model->file_path, PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])): ?>
                <?= Html::img(Yii::getAlias('@web') . '/' . $model->file_path, [
                    'style' => 'max-width: 150px; max-height: 150px; border: 1px solid #ddd; padding: 5px;',
                ]) ?>
            <?php elseif ($fileExtension === 'pdf'): ?>
                <?= Html::a('View PDF', Yii::getAlias('@web') . '/' . $model->file_path, ['target' => '_blank']) ?>
            <?php endif; ?>
        </div>

        <div>
            <?= Html::checkbox('remove_file', false, ['label' => 'Remove current file']) ?>
        </div>
    <?php endif; ?>

    <?= Html::hiddenInput('remove_image', 0, ['id' => 'remove-image-input']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>