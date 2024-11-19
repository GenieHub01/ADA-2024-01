<?php
/* @var $this CategoryController */
/* @var $data Category */
?>

<div class="company-list-item">
	
    <h4><?= CHtml::link($data->name, ['category/index', 'code'=>$data->code]); ?></h4>

</div>
