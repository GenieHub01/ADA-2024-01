<?php
/**
 * Created by PhpStorm.
 * User: k
 * Date: 08.11.16
 * Time: 21:28
 */

class LinkPager extends CLinkPager
{

    public $firstPageLabel = false;
    public $lastPageLabel = false;
    public $nextPageLabel = '>>';
    public $prevPageLabel = '<<';
    public $maxButtonCount = 5;
    public $header = '';

    public function run()
    {
        $this->registerClientScript();
        $buttons = $this->createPageButtons();
        if (empty($buttons))
            return;
        echo $this->header;
        echo implode("", $buttons);
        echo $this->footer;
    }

    protected function createPageButton($label, $page, $class, $hidden, $selected)
    {
        if ($hidden || $selected)
            $class .= ' ' . ($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);
        return CHtml::link($label, $this->createPageUrl($page), ['class' => $class]);
    }
}
