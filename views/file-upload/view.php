<?php
use yii\helpers\Html;
?>
<div class="file-upload-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="uploaded-file">
    <?php if ($model->file_path): ?>
        <?php
            $fileExtension = pathinfo($model->file_path, PATHINFO_EXTENSION);
        ?>
        
        <?php if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])): ?>
            <div style="text-align: center;">
                <?= Html::img(Yii::getAlias('@web') . '/' . $model->file_path, [
                    'alt' => $model->file_name,
                    'style' => 'max-width: 100%; height: auto; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;',
                ]) ?>
            </div>
        <?php elseif ($fileExtension === 'pdf'): ?>
            <div style="text-align: center;">
                <?= Html::a('View PDF', Yii::getAlias('@web') . '/' . $model->file_path, [
                    'target' => '_blank',
                    'class' => 'btn btn-info btn-sm',
                ]) ?>
            </div>
        <?php else: ?>
            <p>File type not supported for preview.</p>
        <?php endif; ?>

        <p style="font-weight: bold;"><?= Html::encode($model->file_name) ?></p>
    <?php else: ?>
        <p>No file uploaded.</p>
    <?php endif; ?>
</div>

</div>