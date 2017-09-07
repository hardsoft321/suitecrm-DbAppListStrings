<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$listViewDefs['DbAppLists'] = array(
  'NAME' => array (
    'label'   => 'LBL_NAME',
    'default' => true,
    'sortable'=> true,
    'width' => '30',
    'link'    => true,
  ),
  'UNIQ_NAME' => array (
    'label'   => 'LBL_UNIQ_NAME',
    'default' => true,
    'sortable'=> true,
    'width' => '30',
  ),
  'MAXLEN' => array (
    'label'   => 'LBL_MAXLEN',
    'default' => false,
    'sortable'=> true,
    'width' => '10',
  ),
  'ASSIGNED_USER_NAME' => array(
    'width' => '9',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'default' => true
  ),
  'CREATED_BY_NAME' => array (
    'label'   => 'LBL_CREATED',
    'default' => false,
    'sortable'=> true,
    'width' => '20',
  ),
  'DATE_ENTERED' => array (
    'label'   => 'LBL_DATE_ENTERED',
    'default' => true,
    'sortable'=> true,
    'width' => '20',
  ),
);
