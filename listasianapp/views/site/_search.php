<?php 
    // if (!Yii::app()->user->checkAccess(User::ROLE_ADMIN)): ?>

    <div class="search-block">

        <form action="/">

            <label for="search-input">

                <?= CHtml::searchField('q', Yii::app()->request->getQuery('q'), ['placeholder' => 'Search for a Wedding Supplier/Business here...']); ?>
                
                <label for="search-submit"><i class="fa fa-search" aria-hidden="true"></i></label>
                <input class="search-submit" id="search-submit" type="submit">


            </label>
            
            <?= CHtml::radioButtonList('t',
                Yii::app()->request->getQuery('t', 0),
                Category::$searchType,
                [
                    'separator' => ''
                ]
            ); ?>

        </form>

    </div>

<?php 
// endif; 
?>
