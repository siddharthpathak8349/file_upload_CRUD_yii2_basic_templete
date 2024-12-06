<?php
namespace app\controllers;
use app\models\FileUpload;
use app\models\FileUploadSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class FileUploadController extends Controller
{

    // this behaviour is for  all  user login and  logout user both  can access  everything  form this controller 

                    // public function behaviors()
                    // {
                    //     return array_merge(
                    //         parent::behaviors(),
                    //         [
                    //             'verbs' => [
                    //                 'class' => VerbFilter::className(),
                    //                 'actions' => [
                    //                     'delete' => ['POST'],
                    //                 ],
                    //             ],
                    //         ]
                    //     );
                    // }





    // this behivour is for  authrozition  user  which is authroized  for  CRUD  opreation 

                    // public function behaviors()
                    // {
                    //     return [
                    //         'access' => [
                    //             'class' => AccessControl::class,
                    //             'rules' => [
                    //                 [
                    //                     // Restrict all actions to authenticated users
                    //                     'allow' => true,
                    //                     'roles' => ['@'], // '@' means only logged-in users can access
                    //                 ],
                    //             ],
                    //         ],
                    //         'verbs' => [
                    //             'class' => VerbFilter::class,
                    //             'actions' => [
                    //                 'logout' => ['post'],
                    //                 'delete' => ['post'], // Ensure DELETE action uses POST
                    //             ],
                    //         ],
                    //     ];
                    // }



    public function actionIndex()
    {
        $searchModel = new FileUploadSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new FileUpload();
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'file_path');
            if ($file) {
                $filePath = 'uploads/' . uniqid() . '.' . $file->extension;
                if ($file->saveAs($filePath)) {
                    $model->file_path = $filePath;
                }
            }
            if ($model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = FileUpload::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('The requested file does not exist.');
        }
        $existingFilePath = $model->file_path;

        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($model, 'file_path');

            if ($uploadedFile) {
                $fileName = time() . '_' . $uploadedFile->baseName . '.' . $uploadedFile->extension;
                $filePath = 'uploads/' . $fileName;
                if ($uploadedFile->saveAs($filePath)) {
                    $model->file_path = $filePath;
                }
            } elseif (Yii::$app->request->post('remove_file') === '1') {
                $model->file_path = null;
            } else {
                $model->file_path = $existingFilePath;
            }

            if ($model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = FileUpload::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
