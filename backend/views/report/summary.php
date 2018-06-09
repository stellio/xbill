<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ContractorGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Отчеты');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo $this->render('/layouts/report-menu') ?>

      <?php

      $isFa = true;

      $defaultExportConfig = [
          GridView::HTML => [
              'label' => Yii::t('kvgrid', 'HTML'),
              'icon' => $isFa ? 'file-text' : 'floppy-saved',
              'iconOptions' => ['class' => 'text-info'],
              'showHeader' => true,
              'showPageSummary' => true,
              'showFooter' => true,
              'showCaption' => true,
              'filename' => Yii::t('kvgrid', 'grid-export'),
              'alertMsg' => Yii::t('kvgrid', 'The HTML export file will be generated for download.'),
              'options' => ['title' => Yii::t('kvgrid', 'Hyper Text Markup Language')],
              'mime' => 'text/html',
              'config' => [
                  'cssFile' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'
              ]
          ],
          GridView::CSV => [
              'label' => Yii::t('kvgrid', 'CSV'),
              'icon' => $isFa ? 'file-code-o' : 'floppy-open',
              'iconOptions' => ['class' => 'text-primary'],
              'showHeader' => true,
              'showPageSummary' => true,
              'showFooter' => true,
              'showCaption' => true,
              'filename' => Yii::t('kvgrid', 'grid-export'),
              'alertMsg' => Yii::t('kvgrid', 'The CSV export file will be generated for download.'),
              'options' => ['title' => Yii::t('kvgrid', 'Comma Separated Values')],
              'mime' => 'application/csv',
              'config' => [
                  'colDelimiter' => ",",
                  'rowDelimiter' => "\r\n",
              ]
          ],
          GridView::TEXT => [
              'label' => Yii::t('kvgrid', 'Text'),
              'icon' => $isFa ? 'file-text-o' : 'floppy-save',
              'iconOptions' => ['class' => 'text-muted'],
              'showHeader' => true,
              'showPageSummary' => true,
              'showFooter' => true,
              'showCaption' => true,
              'filename' => Yii::t('kvgrid', 'grid-export'),
              'alertMsg' => Yii::t('kvgrid', 'The TEXT export file will be generated for download.'),
              'options' => ['title' => Yii::t('kvgrid', 'Tab Delimited Text')],
              'mime' => 'text/plain',
              'config' => [
                  'colDelimiter' => "\t",
                  'rowDelimiter' => "\r\n",
              ]
          ],
          GridView::EXCEL => [
              'label' => Yii::t('kvgrid', 'Excel'),
              'icon' => $isFa ? 'file-excel-o' : 'floppy-remove',
              'iconOptions' => ['class' => 'text-success'],
              'showHeader' => true,
              'showPageSummary' => true,
              'showFooter' => true,
              'showCaption' => true,
              'filename' => Yii::t('kvgrid', 'grid-export'),
              'alertMsg' => Yii::t('kvgrid', 'The EXCEL export file will be generated for download.'),
              'options' => ['title' => Yii::t('kvgrid', 'Microsoft Excel 95+')],
              'mime' => 'application/vnd.ms-excel',
              'config' => [
                  'worksheet' => Yii::t('kvgrid', 'ExportWorksheet'),
                  'cssFile' => ''
              ]
          ],

          GridView::JSON => [
              'label' => Yii::t('kvgrid', 'JSON'),
              'icon' => $isFa ? 'file-code-o' : 'floppy-open',
              'iconOptions' => ['class' => 'text-warning'],
              'showHeader' => true,
              'showPageSummary' => true,
              'showFooter' => true,
              'showCaption' => true,
              'filename' => Yii::t('kvgrid', 'grid-export'),
              'alertMsg' => Yii::t('kvgrid', 'The JSON export file will be generated for download.'),
              'options' => ['title' => Yii::t('kvgrid', 'JavaScript Object Notation')],
              'mime' => 'application/json',
              'config' => [
                  'colHeads' => [],
                  'slugColHeads' => false,
                  'jsonReplacer' => null,
                  'indentSpace' => 4
              ]
          ],
          ];


          $gridColumns = [
              // ['class' => 'kartik\grid\SerialColumn'],
              [
                  'attribute' => 'group',
                  'noWrap' => true,
                  'pageSummary'=>'Итого',
              ],
              [
                  'attribute' => 'name',
                  'noWrap' => true,

              ],
              [
                  'attribute' => 'lastname',
                  'noWrap' => true,
              ],
              [
                  'attribute' => 'firstname',
                  'noWrap' => true,
              ],
              [
                  'attribute' => 'middlename',
                  'noWrap' => true,
              ],
              [
                  'attribute' => 'phone',
                  'noWrap' => true,
              ],
              [
                  'attribute' => 'contractorCity',
                  'noWrap' => true,
              ],
              [
                  'attribute' => 'address',
                  'noWrap' => true,
              ],
              [
                  'attribute' => 'issued_at',
                  'format' => 'date',
                  'noWrap' => true,
              ],
              [
                  'attribute' => 'object_id',
                  'noWrap' => true,
                  'value' => function($model) {
                      return ($model->object) ? $model->object->name : '';
                  }
              ],
              [
                  'attribute' => 'type_id',
                  'noWrap' => true,
                  'value' => function($model) {
                      return ($model->type) ? $model->type->name : '';
                  }
              ],
              [
                  'attribute' => 'number_from',
                  'noWrap' => true,
                  'label' => 'Ном. от',
              ],
              [
                  'attribute' => 'number_to',
                  'noWrap' => true,
                  'label' => 'Ном. до',
              ],
              [
                  'attribute' => 'sold_total',
                  'noWrap' => true,
                  'label' => 'Продано',
                  'format' => ['decimal', 0],
                  'pageSummary' => true,
              ],
              [
                  'attribute' => 'trip_total',
                  'noWrap' => true,
                  'label' => 'Ходок',
                  'format' => ['decimal', 0],
                  'pageSummary' => true,
              ],

          ];


          echo GridView::widget([
              'dataProvider' => $dataProvider,
              // 'filterModel' => $searchModel,
              'columns' => $gridColumns,
              'showPageSummary' => true,
              'panel' => [
                'heading' => '<h3 class="panel-title">Сводные данные</h3>',
                'type' => 'info',
                'before' => '',
                'footer' => true,
              ],
              // 'export' => true,
              'toolbar' => [
                  '{export}',
              ],
              'export'=>[
                  'fontAwesome'=>true
              ],
              'exportContainer' => ['class' => 'btn-group-sm'],
              'exportConfig' => $defaultExportConfig,

          ]);
      ?>
