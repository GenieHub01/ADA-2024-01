<?php
/* @var $this AdvertController */
/* @var $data Advert */
?>

<div class="company-list-item">
    
    <a href="<?= $data->getSeoUrl(); ?>">
        <i class="fa fa-external-link advert-link"></i>
        <h4><?= $data->name; ?></h4>


        <div>
            <b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
            <?php echo CHtml::encode($data->address); ?>
        </div>

        <div>
            <b><?php echo CHtml::encode($data->getAttributeLabel('postcode')); ?>:</b>
            <?php echo CHtml::encode($data->postcode); ?>
        </div>

        <div>
            <b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
            <?php echo CHtml::encode($data->telephone); ?>
        </div>

        <?php if ($data->web): ?>
            <div>
                <b><?php echo CHtml::encode($data->getAttributeLabel('web')); ?>:</b>
                <?php echo CHtml::link($data->web, $data->web); ?>
            </div>
        <?php endif; ?>
    </a>

</div>
