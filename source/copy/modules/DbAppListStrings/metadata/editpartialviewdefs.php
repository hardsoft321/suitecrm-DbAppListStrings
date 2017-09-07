<?php

$viewdefs ['DbAppListStrings'] = array ( 'EditView' =>
  array (
    'templateMeta' => array (
      'form' =>  array (
        'headerTpl' => 'custom/include/SugarFields/Fields/Multiform/empty.tpl',
        'footerTpl' => 'custom/include/SugarFields/Fields/Multiform/empty.tpl',
      ),
      'maxColumns' => '4',
      'widths' => array (
        array (
          'label' => '10',
          'field' => '30',
        ),
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
    ),
    'panels' => array (
      'default' => array (
        array(
          'name',
          'uniq_name',
        ),
        array(
          'lang',
          'archive',
        ),
      ),
    ),
  ),
);
