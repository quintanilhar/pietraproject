<?php

class Icon extends CWidget
{
    protected $pageIcons = array(
        'default' => array(
            1 => 'iconQuemSomos',
            2 => 'iconPropostaValor',
            3 => 'iconFoco',
            4 => 'iconDiferencial',
        ),
        'servicos' => array(
            5 => 'iconEstrategiaBlue',
            7 => 'iconGestaoLarge',
            8 => 'iconExcelenciaBlue',
            9 => 'iconDesenvolvimentoPessoasLarge',
        ),
    );

    public $scope = 'default';

    public $pageId;

    public function init()
    {
        if (!isset($this->pageId) && !is_numeric($this->pageId)) {
            throw new CException(__CLASS__.': Failed to initialize widget! pageId is not set or is not a valid number.');
        }

        if (!isset($this->scope) && !isset($this->pageIcons[$this->scope])) {
            throw new CException(__CLASS__.': Failed to initialize widget! scope is not set or is not a valid scope.');
        }
    }

    public function run()
    {
        if (!isset($this->pageIcons[$this->scope][$this->pageId])) {
            return null;
        }

        echo $this->pageIcons[$this->scope][$this->pageId];
    }
}
