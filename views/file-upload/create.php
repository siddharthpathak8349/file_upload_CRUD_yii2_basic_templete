<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FileUpload $model */

$this->title = 'Create File Upload';
$this->params['breadcrumbs'][] = ['label' => 'File Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-upload-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
