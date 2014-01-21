<?php

class BInputRow extends CInputWidget
{
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_CHECKBOXLIST = 'checkboxlist';
    const TYPE_CHECKBOXLIST_INLINE = 'checkboxlist_inline';
    const TYPE_DROPDOWN = 'dropdownlist';
    const TYPE_FILE = 'file';
    const TYPE_PASSWORD = 'password';
    const TYPE_RADIOLIST = 'radiobuttonlist';
    const TYPE_RADIOLIST_INLINE = 'radiobuttonlist_inline';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_TEXT = 'text';
    const TYPE_STATIC = 'static';

    /**
     * @var ActiveForm
     */
    public $form;

    /**
     * @var The element type.
     */
    public $type;

    /**
     * @var array the data for list inputs.
     */
    public $data = array();

    /**
     * @var array label html attributes.
     */
    public $labelOptions = array();

    /**
     * @var array error html attributes.
     */
    public $errorOptions = array();

    public $prependText;

    public $prependOptions = array();

    public $helperText;

    public function init()
    {
        if (!isset($this->form))
            throw new CException(__CLASS__.': Failed to initialize widget! Form is not set.');

        if (!isset($this->model))
            throw new CException(__CLASS__.': Failed to initialize widget! Model is not set.');

        if (!isset($this->type))
            throw new CException(__CLASS__.': Failed to initialize widget! Input type is not set.');

        if (!in_array($this->type, array(self::TYPE_RADIOLIST, self::TYPE_RADIOLIST_INLINE, self::TYPE_FILE))) {
            if (isset($this->htmlOptions['class'])) {
                $this->htmlOptions['class'] .= ' form-control';
            } else {
                $this->htmlOptions['class'] = 'form-control';
            }
        }

        if (isset($this->labelOptions['class'])) {
            $this->labelOptions['class'] .= ' col-sm-3 control-label';
        } else {
            $this->labelOptions['class'] = 'col-sm-3 control-label';
        }

        if (isset($this->errorOptions['class'])) {
            $this->errorOptions['class'] .= ' help-block';
        } else {
            $this->errorOptions['class'] = 'help-block';
        }
    }

    public function run()
    {
        $hasError = $this->model->getError($this->attribute) !== null;

        echo '<div class="form-group ' . ($hasError ? 'has-error' : '') . '">';

        $this->renderLabel();

        echo '<div class="col-sm-9">';

        if ($this->hasAddOn()) {
            echo '<div class="input-group">';
        }

        $this->renderPrependText();

        $this->renderElement();

        if ($this->hasAddOn()) {
            echo '</div>';
        }

        $this->renderError();

        $this->renderHelperText();

        echo '</div></div>';
    }

    protected function renderPrependText()
    {
        if (isset($this->prependText)) {
            $htmlOptions = $this->prependOptions;

            if (isset($htmlOptions['class'])) {
                $htmlOptions['class'] .= ' input-group-addon';
            } else {
                $htmlOptions['class'] = 'input-group-addon';
            }

            echo CHtml::tag('span', $htmlOptions, $this->prependText);
        }
    }

    /**
     * Returns whether the input has an add-on (prepend and/or append).
     * @return boolean the result
     */
    protected function hasAddOn()
    {
        return isset($this->prependText) || isset($this->appendText);
    }

    protected function renderLabel()
    {
        echo $this->form->labelEx(
            $this->model,
            $this->attribute,
            $this->labelOptions
        );
    }

    public function renderError()
    {
        echo $this->form->error(
            $this->model,
            $this->attribute,
            $this->errorOptions
        );

    }

    public function renderHelperText()
    {
        if (isset($this->helperText)) {
            echo CHtml::tag('p', array('class' => 'help-block'), $this->helperText);
        }
    }

    public function renderElement()
    {
        switch ($this->type) {
            case self::TYPE_TEXT:
                $this->renderTextElement();
                break;

            case self::TYPE_TEXTAREA:
                $this->renderTextareaElement();
                break;

            case self::TYPE_RADIOLIST:
                $this->renderRadioList();
                break;

            case self::TYPE_RADIOLIST_INLINE:
                $this->renderRadioListInline();
                break;

            case self::TYPE_STATIC:
                $this->renderStatic();
                break;

            case self::TYPE_DROPDOWN:
                $this->renderDropdownList();
                break;

            case self::TYPE_FILE:
                $this->renderFileElement();
                break;

            case self::TYPE_PASSWORD:
                $this->renderPasswordElement();
                break;

            default:
                throw new CException(
                    __CLASS__.': Failed to run widget! Type "' . $this->type . '" is invalid.'
                );
        }
    }

    protected function renderTextElement()
    {
        echo $this->form->textField(
            $this->model,
            $this->attribute,
            $this->htmlOptions
        );
    }

    protected function renderTextareaElement()
    {
        echo $this->form->textArea(
            $this->model,
            $this->attribute,
            $this->htmlOptions
        );
    }

    protected function renderRadioList()
    {
        echo '<div class="radio">';
        echo $this->form->radioButtonList(
            $this->model,
            $this->attribute,
            $this->data,
            $this->htmlOptions
        );
        echo '</div>';
    }

    protected function renderRadioListInline()
    {
        $this->htmlOptions['separator'] = ' ';
        $this->htmlOptions['template'] = '{beginLabel} {input} {labelTitle} {endLabel}';
        $this->htmlOptions['labelOptions']['class'] = 'radio-inline';

        echo $this->form->radioButtonList(
            $this->model,
            $this->attribute,
            $this->data,
            $this->htmlOptions
        );
    }

    protected function renderStatic()
    {
        $htmlOptions = $this->htmlOptions;
        $htmlOptions['class'] = 'form-control-static';

        echo CHtml::tag(
            'p',
            $htmlOptions,
            CHtml::resolveValue($this->model, $this->attribute)
        );
    }

    protected function renderDropdownList()
    {
        echo $this->form->dropDownList(
            $this->model,
            $this->attribute,
            $this->data,
            $this->htmlOptions
        );
    }

    protected function renderFileElement()
    {
        echo $this->form->fileField(
            $this->model,
            $this->attribute,
            $this->htmlOptions
        );
    }

    protected function renderPasswordElement()
    {
        echo $this->form->passwordField(
            $this->model,
            $this->attribute,
            $this->htmlOptions
        );
    }
}
