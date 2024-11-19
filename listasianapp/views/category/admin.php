<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
    'Categories'
);

$this->menu=array(
    //array('label'=>'List Category', 'url'=>array('index')),
    //array('label'=>'Create Category', 'url'=>array('create')),
);

?>

<div class="col-md-12 company-list">

    <h3>Manage Categories</h3>

    <?= CHtml::link('Create', ['create'], ['class' => 'btn btn-success']); ?>

    <?php $this->widget('booster.widgets.TbGridView', array(
        'id'=>'category-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>[
            'code',
            [
                'name'=>'parent_id',
                'value'=>'$data->parent ? $data->parent->name : null',
                'filter'=>CArray::merge(
                    [
                        0 => 'Parent'
                    ],
                    CHtml::listData(Category::model()->getCategorys(), 'id', 'name')
                )
            ],
            'name',
            'url',
            [
                'class'=>'CButtonColumn',
                'template'=>'{update} {delete}'
            ],
        ],
    //    'pagerCssClass' => 'pagination',
    //    'pager' => [
    //        'class' => 'LinkPager',
    //    ]
    )); ?>

</div>
