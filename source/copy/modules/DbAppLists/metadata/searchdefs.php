<?php

$searchdefs ['DbAppLists'] = array (
  'templateMeta' =>
  array (
    'maxColumns' => '2',
    'maxColumnsBasic' => '2',
    'widths' =>
    array (
      'label' => '10',
      'field' => '20',
    ),
  ),
  'layout' => array (
    'basic_search' => array (
      'name',
      'uniq_name',
    ),
    'advanced_search' => array (
      'name',
      'uniq_name',
      'created_by' =>
      array (
        'name' => 'created_by',
        'type' => 'enum',
        'label' => 'LBL_CREATED_BY_USER',
        'function' =>
        array (
          'name' => 'get_user_array',
          'params' =>
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'date_entered' => array (
          'name' => 'date_entered',
          'default' => true,
          'width' => '10%',
          'label' => 'LBL_DATE_ENTERED',
      ),
      'assigned_user_id' =>
      array (
        'name' => 'assigned_user_id',
        'type' => 'enum',
        'label' => 'LBL_ASSIGNED_TO',
        'function' =>
        array (
          'name' => 'get_user_array',
          'params' =>
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
    ),
  ),
);

