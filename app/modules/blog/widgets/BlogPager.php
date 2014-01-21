<?php

class BlogPager extends CLinkPager
{
    public $selectedPageCssClass = 'active';

    public $hiddenPageCssClass = null;
    
    public $nextPageLabel = '&gt;';
    
    public $prevPageLabel = '&lt;';

    public $cssFile = false;

	public $previousPageCssClass = 'prev';

	public $nextPageCssClass = 'next';

	public $maxButtonCount = 3;

    public $route;

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
		echo CHtml::tag('div',$this->htmlOptions,implode("\n",$buttons));
		echo $this->footer;
    }

	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
        if ($hidden) {
            return;
        } else if ($hidden || $selected) {
			$class.=' '. $this->selectedPageCssClass;

            return '<span class="'.$class.'">'.$label.'</span>';
        } else {
            return CHtml::link($label,$this->createPageUrl($page));
        }
	}

	protected function createPageUrl($page)
    {
        return $this->route . '?' . $this->getPages()->pageVar . '=' . ++$page;
    }
}
