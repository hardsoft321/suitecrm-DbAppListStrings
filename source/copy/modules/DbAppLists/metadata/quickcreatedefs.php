<?php
$viewdefs ['DbAppLists'] = array (  'QuickCreate' =>
  array (
    'templateMeta' => array (
      'form' => array (
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
