<?php

class TagCloud extends CWidget
{
    public $maxTags = 10;

    public function run()
    {
        $tags = Tag::model()->findTagWeights($this->maxTags);
        echo '<ul class="tags">';
        foreach ($tags as $tag=>$weight) {
            $link=CHtml::link(
                CHtml::encode($tag),
                BlogConfig::getFullHomeUrl() . '?tag=' . $tag,
                array('class' => 'border-radius')
            );

            echo CHtml::tag('li', array(), $link)."\n";
        }
        echo '</ul>';
    }
}
