<div class="col-md-12 company-list">

    <h3>Advert list</h3>

    <?= CHtml::link('Create', ['create'], ['class' => 'btn btn-success']) ?>
    <?= CHtml::link('Active', ['index', 'paid' => 1, 'active'=>1], ['class' => 'btn btn-success']) ?>
    <?= CHtml::link('Not paid', ['index', 'paid' => 0], ['class' => 'btn btn-success']) ?>
    <?= CHtml::link('Not active', ['index', 'active'=>0], ['class' => 'btn btn-success']) ?>

    <?php $this->widget('booster.widgets.TbGridView', array(
        'id'=>'advert-grid',
        'dataProvider'=>$dataProvider,
        'columns'=>array(
            [
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}'
            ],
            [
                'name'=>'active',
                'value'=>'Yii::app()->format->formatBoolean($data->active)',
            ],
            [
                'name'=>'package',
                'value'=>'$data->getPackage()'
            ],
            [
                'name'=>'paid',
                'type'=>'raw',
                'value'=>' $data->paid ? "Paid" : CHtml::link("Pay", ["advert/view", "id"=>$data->id])',
            ],
            [
                'name' => 'expiry_date',
                'value' => 'Yii::app()->format->formatDate($data->expiry_date)',
                'htmlOptions'=>[
                ]
            ],
            'name',
            'address',
            'postcode',
            'telephone',
            'fax',
        ),
    )); ?>

</div>
