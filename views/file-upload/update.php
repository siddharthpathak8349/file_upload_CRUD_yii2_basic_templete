<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FileUpload $model */

$this->title = 'Update File Upload: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'File Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="file-upload-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
