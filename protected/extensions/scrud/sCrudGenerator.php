<?php

Yii::import('gii.generators.crud.CrudGenerator');

class sCrudGenerator extends CrudGenerator
{
	public $codeModel = 'application.extensions.sGii.scrud.sCrudCode';
}
