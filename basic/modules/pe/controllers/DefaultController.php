<?php

namespace app\modules\pe\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Task;
use app\models\Project;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Default controller for the `pe` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
/* ФОРМА1
<?php $form = ActiveForm::begin();?>
<?=$form->field($complete, 'complete')->textInput(['type' => 'number','value' => $t_i['complete_percentage'],'max'=>100,'min'=>0,'step'=>1])->label(false);?>
<?php ActiveForm::end();?>

ФОРМА2
<?= Html::beginForm(['index'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
<?= Html::input('number', 'complete', Yii::$app->request->post('complete'), ['class' => 'form-control']) ?>
<?= Html::submitButton('Принять', ['class' => 'btn btn-lg btn-primary']) ?>
<?= Html::endForm() ?>
*/

        $task_ispoln=Task::find()->where(['status'=>2,'project_id' => 2])->all();
        $task_sogl=Task::find()->where(['status'=>1,'project_id' => 2])->all();


        /*$projects = Project::find()
            ->select('project.*')
            ->leftJoin('task', '`task`.`project_id` = `project`.`project_id`')
            ->where(['task.status' => Task::STATUS_ACTIVE])
            ->with('tasks')
            ->all();*/
        $project_name = Project::find()
            ->joinWith('tasks')
            ->select(['project.name'])
            ->where(['project.project_id' => 2])
            ->all();


        /*$projects = Project::find()
            ->joinWith('tasks')
            ->where(['task.status' => 2])
            ->asArray()->all();*/

        //$projects=Project::find()->all();

        $complete= new Task();
        if($complete->load(Yii::$app->request->post()))
        {
            $complete=$complete->complete;
        }


        //return $this->render('ispolnitel',['tasks'=>$tasks,'project'=>$project,'description'=>$description,'task_info'=>$task_info]);
        return $this->render('index',['task_ispoln'=>$task_ispoln,'task_sogl'=>$task_sogl,'complete'=>$complete,'project_name'=>$project_name]);
    }
}
