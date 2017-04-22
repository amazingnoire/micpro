<?php
use yii\helpers\ArrayHelper;
use \yii\db\ActiveRecord;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Task;
?>
<div class="text-center"><h1>ПРОЕКТ: <?=$project_name[0]->name?></h1></div>
<div class='row'>
    <div class='col-sm-12'>
        <div class='box bordered-box blue-border box-collapsed' style='margin-bottom:0;'>
            <div class='box-header blue-background'>
                <div class='title'>Задачи на исполнение</div>
                <div class='actions'>
                    <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                    </a>

                    <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                    </a>
                </div>
            </div>
            <div class='box-content box-no-padding'>
                <div class='responsive-table'>
                    <div class='scrollable-area'>
                        <table class='data-table table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                            <tr>
                                <th>
                                    Задача
                                </th>
                                <th>
                                    Описание
                                </th>
                                <th>
                                    Дата начала
                                </th>
                                <th>
                                    Планируемая дата завершения
                                </th>
                                <th>
                                    Загруженность исполнителя, %
                                </th>
                                <th>
                                    Завершенность, %
                                </th>
                                <th>
                                    Комментарий
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($task_ispoln as $t_i){?>
                                <tr>
                                    <td> <?=$t_i->name?></td>
                                    <td> <?=$t_i->description?></td>
                                    <td> <?=$t_i->start_date?></td>
                                    <td> <?=$t_i->plan_end_date?></td>
                                    <td> <?=$t_i->employment_percentage?></td>
                                    <td>
                                        <?php Pjax::begin(); ?>
                                        <?php $tid=$t_i['task_id']?>
                                        <?php
                                        if (!empty($ts)){
                                        $t_i->complete_percentage=$ts;
                                        $t_i->save();?>
                                        <div style="display: none"><?= Yii::$app->db->createCommand()->update('task', ['complete_percentage' => $ts], ['task_id' => $tid])->execute(); ?></div><?php
                                        }?>
                                        <?php $tcp=$t_i['complete_percentage']?>
                                        <?= Html::beginForm(['index'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                                        <?= Html::input('hidden', 'id', $tid) ?>
                                        <?= Html::input('number', 'complete', $tcp, ['class' => 'form-control','max'=>100,'min'=>0,'step'=>1]) ?>
                                        <?= Html::submitButton('Принять', ['class' => 'btn btn-lg btn-primary', 'name'=>'button'.$tid]) ?>
                                        <?= Html::endForm() ?>
                                        <?php $ts = $_POST['complete']?>

                                        <?php Pjax::end(); ?>
                                    </td>
                                    <td> <?=$t_i->status?></td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='row'>
    <div class='col-sm-12'>
        <div class='box bordered-box orange-border box-collapsed' style='margin-bottom:0;'>
            <div class='box-header orange-background'>
                <div class='title'>Задачи на согласование</div>
                <div class='actions'>
                    <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                    </a>

                    <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                    </a>
                </div>
            </div>
            <div class='box-content box-no-padding'>
                <div class='responsive-table'>
                    <div class='scrollable-area'>
                        <table class='data-table table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                            <tr>
                                <th>
                                    Задача
                                </th>
                                <th>
                                    Описание
                                </th>
                                <th>
                                    Дата начала
                                </th>
                                <th>
                                    Планируемая дата завершения
                                </th>
                                <th>
                                    Загруженность исполнителя, %
                                </th>
                                <th>
                                    Комментарий
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($task_sogl as $t_s){?>
                                <tr>
                                    <td> <?=$t_s->name?></td>
                                    <td> <?=$t_s->description?></td>
                                    <td> <?=$t_s->start_date?></td>
                                    <td> <?=$t_s->plan_end_date?></td>
                                    <td> <?=$t_s->employment_percentage?></td>
                                    <td> <?=$t_s->status?></td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
