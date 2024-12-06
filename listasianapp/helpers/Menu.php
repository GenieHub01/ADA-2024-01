<?php

class Menu
{
    public static function items()
    {

        $menu = [
            ['label' => 'Home', 'url' => 'https://www.mailzion.com/#category-anchor'],
            ['label' => 'Directory', 'url' => 'https://www.mailzion.com/#category-anchor'],
            ['label' => 'Register', 'url' => ['site/register'], 'visible' => Yii::app()->user->isGuest],
            ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::app()->user->isGuest]
        ];

        if (Yii::app()->user->role == User::ROLE_USER) {

            $menu = CMap::mergeArray($menu, [
                ['label' => 'Adverts', 'url' => ['advert/index']],
                ['label' => 'Payments', 'url' => ['paylog/index']]
            ]);
            
        } elseif (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
            
            $items = [
                ['label' => 'Users', 'url' => ['user/admin']],
                ['label' => 'Category', 'url' => ['category/admin']],
                ['label' => 'Adv', 'url' => ['advert/admin']],
                ['label' => 'Payments', 'url' => ['paylog/admin']],
                ['label' => 'No Renewal prices', 'url' => ['price/update']],
                //['label' => 'Prices', 'url' => ['packagePrice/admin']],
                ['label' => 'Subscription', 'url' => ['plan/admin']],
            ];
            
            $menu = CMap::mergeArray($menu, $items);
        }

        return $menu;
    }
}
