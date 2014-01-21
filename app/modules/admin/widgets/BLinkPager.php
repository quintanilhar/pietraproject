<?php

class BLinkPager extends CLinkPager
{
    public $selectedPageCssClass = 'active';

    public $hiddenPageCssClass = 'disabled';
    
    public $nextPageLabel = '&raquo;';
    
    public $prevPageLabel = '&laquo;';

    public $cssFile = false;

    public function init()
    {
        if (isset($this->htmlOptions['class'])) {
            $this->htmlOptions['class'] .= ' pagination';
        } else {
            $this->htmlOptions['class'] = 'pagination';
        }
    }

    public function run()
    {
		$this->registerClientScript();
		$buttons = $this->createPageButtons();

		if (empty($buttons)) {
			return;
        }

        array_shift($buttons);
        array_pop($buttons);

		echo $this->header;
		echo CHtml::tag('ul',$this->htmlOptions,implode("\n",$buttons));
		echo $this->footer;
    }

	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		if($hidden || $selected)
			$class.=' '.($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);

        if ($hidden) {
            return '<li class="'.$class.'"><span>'.$label.'</span></li>';
        } else if ($selected) {
            return '<li class="'.$class.'"><span>'.$label.' <span class="sr-only">(current)</span></span></li>';
        } else {
            return '<li class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page)).'</li>';
        }
	}
}
