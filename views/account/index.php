<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\base\Widget;
$this->title = 'Account List';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
	<div class="btn-group">
    	<?= Html::a('Delete Selected', [''], ['class' => 'btn btn-danger delete-all', 'disabled' => 'disabled']) ?>
    	<span class="btn btn-default delete-num">0</span>
    </div>
    <?= Html::a('New Account', ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Import Accounts', ['import'], ['class' => 'btn btn-warning']) ?>
</p>
<?= GridView::widget([
    'options' => ['class' => 'gridview', 'style' => 'overflow:auto', 'id' => 'grid'],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'pager' => [
        'firstPageLabel' => 'First Page',
        'lastPageLabel' => 'Last Page',
    ],
    'rowOptions' => function($model, $key, $index, $grid){
        return ['class' => $index % 2 == 0 ? 'label-white' : 'label-grey' ];
    },
    'columns' => [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'name' => 'id',
            'headerOptions' => ['width' => '10'],
        ],
        [
            'class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['width' => '10'],
        ],
        'accountId',
        'state',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Operations',
            'headerOptions' => ['width' => '90'],
            'template' => '{view}&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;{delete}',
            'buttons' => [
                'view' => function($url, $model, $key){
                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                    ['view', 'accountId' => $key],
                    ['title' => 'View']);
                },
                'update' => function($url, $model, $key){
                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                    ['update', 'accountId' => $key],
                    ['title' => 'Update']);
                },
                'delete' => function($url, $model, $key){
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                    ['delete', 'accountId' => $key],
                    ['title' => 'Delete',
                     'data' => ['confirm' => "Are you sure to delete account $key?"],
                    ]);
                },
            ],
        ],
    ],
]); 
$this->registerJs("
$(document).on('click', '.gridview', function () {
    var keys = $('#grid').yiiGridView('getSelectedRows');
    if(keys.length>0){
        $('.delete-all').attr('disabled', false);
        $('.delete-num').html(keys.length);
        $('.delete-all').attr('href', 'index.php?r=account/delete-all&keys='+keys);
    }else{
        $('.delete-all').attr('disabled', 'disabled');
        $('.delete-num').html(0);
        $('.delete-all').attr('href', '');
    }
});
$(document).on('click', '.delete-all', function(){
    if($(this).attr('disabled')){
        return false;
    }else{
        var num = $('.delete-num').html();
        if(!confirm('are you sure to delete these '+num+' accounts?')){
            return false;
        }
    }
});
");
?>
<p>
	<div class="btn-group">
    	<?= Html::a('Delete Selected', [''], ['class' => 'btn btn-danger delete-all', 'disabled' => 'disabled']) ?>
    	<span class="btn btn-default delete-num">0</span>
    </div>
    <?= Html::a('New Account', ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Import Accounts', ['import'], ['class' => 'btn btn-warning']) ?>
</p>
