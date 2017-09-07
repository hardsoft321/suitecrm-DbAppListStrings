<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$listViewDefs['DbAppListStrings'] = array(
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
  'LANG' => array (
    'label'   => 'LBL_LANGUAGE',
    'default' => true,
    'sortable'=> true,
    'width' => '30',
  ),
  'ARCHIVE' => array (
    'label'   => 'LBL_ARCHIVE',
    'default' => true,
    'sortable'=> true,
    'width' => '30',
  ),
  'SORTING' => array (
    'label'   => 'LBL_SORTING',
    'default' => false,
    'sortable'=> true,
    'width' => '30',
  ),
  'PARENT_NAME' => array(
    'type' => 'relate',
    'label' => 'LBL_LIST_RELATED_TO',
    'id' => 'PARENT_ID',
    'module' => 'DbAppLists',
    'width' => '20%',
    'link' => true,
    'sortable' => true,
    'default' => true,
    'related_fields' => array('parent_id'),
    'ACLTag' => 'DbAppLists',
  ),
  'CREATED_BY_NAME' => array (
    'label'   => 'LBL_CREATED',
    'default' => true,
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
