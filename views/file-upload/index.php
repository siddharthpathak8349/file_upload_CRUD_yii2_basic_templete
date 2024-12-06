<?php
use app\models\FileUpload;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FileUploadSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'File Uploads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-upload-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create File Upload', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'file_name',
            [
                'attribute' => 'file_path',
                'label' => 'Preview',
                'format' => 'raw', 
                'value' => function ($model) {
                    $fileExtension = pathinfo($model->file_path, PATHINFO_EXTENSION);
                    if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])) {
                        return Html::img(Yii::getAlias('@web') . '/' . $model->file_path, [
                            'style' => 'max-width: 50px; max-height: 50px; border: 1px solid #ddd; padding: 2px;',
                            'alt' => $model->file_name,
                        ]);
                    } elseif ($fileExtension === 'pdf') {
                        return Html::a('View PDF', Yii::getAlias('@web') . '/' . $model->file_path, [
                            'target' => '_blank',
                            'class' => 'btn btn-info btn-sm',
                        ]);
                    }
                    return 'No preview available';
                },
            ],
            'uploaded_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FileUpload $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
