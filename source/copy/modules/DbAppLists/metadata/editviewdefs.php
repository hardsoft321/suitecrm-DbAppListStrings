<?php
$viewdefs ['DbAppLists'] = array (  'EditView' =>
  array (
    'templateMeta' => array (
      'form' => array (
      ),
      'includes'=> array(
          array('file'=>'modules/DbAppLists/js/cyr2lat-translit/translit.js'),
          array('file'=>'modules/DbAppLists/js/editview.js'),
      ),
      'maxColumns' => '2',
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
      'LBL_INFORMATION' => array (
        array ('name', 'uniq_name'),
        array ('description', 'maxlen'),
      ),
      'LBL_DBAPPLISTSTRINGS' => array (
        array(
          array(
            'name' => 'DbAppListStringsField',
            'hideLabel' => true,
          ),
        ),
      ),
      'LBL_PANEL_ASSIGNMENT' => array (
        array (
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          '',
        ),
      ),
    ),
  ),
);
