<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'main';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();

    public $seo_keywords;
    public $seo_description = 'Asian Directory advertising that actually works, and Asian Directory in your pocket everywhere you go, transform your business with the UK\'s very first Asian Directory. Download and browse all our adverts.';

    public $canonical;

    public function init()
    {
        parent::init();

        $cs = Yii::app()->clientScript;

        if (Yii::app()->user->isGuest) {

            $cs->coreScriptPosition = CClientScript::POS_END;
            $cs->defaultScriptFilePosition = CClientScript::POS_END;
        }

        $cs->registerScriptFile('/js/main.js');

        $this->canonical = Yii::app()->request->hostInfo . Yii::app()->request->url;
    }
}
