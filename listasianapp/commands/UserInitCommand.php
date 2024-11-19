<?php

class UserInitCommand extends CConsoleCommand
{

//    public function run($args)
//    {


        /*
        $list = Yii::app()->db->createCommand()
            ->from('Advert')
            ->where('image <> ""')
            ->queryAll();
        //$list = Advert::model()->findAll('image <> ""');
        $path = Yii::getPathOfAlias('application') . '/../www';
        foreach ($list as $item) {
            if (!file_exists($path . $item['image'])) {
                echo $path . $item['image'] . "\r\n";
                $command = Yii::app()->db->createCommand();
                $command->update('Advert',
                    [
                        'image'=>''
                    ],
                    'id=:id',
                    [
                        ':id'=>$item['id']
                    ]
                );
            }
        }
        */

/*
        $command = Yii::app()->db->createCommand();
        $command->update('User',[
                'email'=>'admin-blue',
                'hash'=>CPasswordHelper::hashPassword('Peartr3353@'),
            ],
            'id=1');
*/

        /*
        $command = Yii::app()->db->createCommand();

        $command->truncateTable('User');

        $command->insert('User',[
            'email'=>'admin',
            'hash'=>CPasswordHelper::hashPassword('admin'),
            'role'=>User::ROLE_ADMIN,
            'create_time'=>new CDbExpression('NOW()')
        ]);
        */


        /*
        $command->insert('User',[
            'email'=>'user',
            'hash'=>CPasswordHelper::hashPassword('user'),
            'role'=>User::ROLE_USER
        ]);*/
//    }

    public function actionAdd2()
    {
        Yii::app()->db->createCommand()->insert('User',[
            'email'=>'agent7@asiandirectoryapp.com',
            'hash'=>CPasswordHelper::hashPassword('Ag6choc$1'),
            'role'=>User::ROLE_ADMIN,
            'create_time'=>new CDbExpression('NOW()')
        ]);
        echo "done\n";
    }

    public function actionEdit()
    {
        $user = User::model()->findByPk(57);
        $user->hash = CPasswordHelper::hashPassword('ADAtr3353@');
        $user->save(false);
        echo "done\n";
    }
}