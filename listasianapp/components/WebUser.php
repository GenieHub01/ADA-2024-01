<?php

class WebUser extends CWebUser {

    private $_model = null;
 
    function getRole() {
        if($user = $this->getModel()){
            return $user->role;
        }
    }

    function getDiscount() {
        if($user = $this->getModel()){
            return $user->discount;
        }
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role, discount, email'));
        }
        return $this->_model;
    }

    public function getIP()
    {
        if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            return $_SERVER['HTTP_X_REAL_IP'];
        } else {
            return Yii::app()->request->userHostAddress;
        }
    }

    public function getEmail()
    {
        if($user = $this->getModel()) {
            return $user->email;
        }
    }
}
