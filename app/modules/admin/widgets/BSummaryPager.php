<?php

class BSummaryPager extends CWidget
{
    public $dataProvider;

    public $cssClass;

    public $text;

    public function init()
    {
        if (!isset($this->text)) {
            $this->text = 'Displaying the single result.|Displaying {start} - {end} of {count} results.';
        }
    }

    public function run()
    {
		if (($count = $this->dataProvider->getItemCount()) <= 0) {
            return;
        }

        $pagination=$this->dataProvider->getPagination();
        $total=$this->dataProvider->getTotalItemCount();
        $start=$pagination->currentPage*$pagination->pageSize+1;
        $end=$start+$count-1;

        if($end>$total) {
            $end=$total;
            $start=$end-$count+1;
        }

        $summaryText = Yii::t(
            'admin',
            $this->text,
            $total
        );

        echo '<div class="'.$this->cssClass.'"><span class="label label-default">';
        echo strtr(
            $summaryText,
            array(
                '{start}'   => $start,
                '{end}'     => $end,
                '{count}'   => $total,
                '{page}'    => $pagination->currentPage+1,
                '{pages}'   => $pagination->pageCount,
            )
        );
        echo '</span></div>';
    }
}
