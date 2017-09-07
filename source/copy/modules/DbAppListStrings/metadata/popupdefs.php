<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$popupMeta = array(
    'moduleMain' => 'DbAppListStrings',
    'varName' => 'DBAPPLISTSTRING',
    'orderBy' => 'date_entered desc',
    'searchInputs' =>
        array('name', 'uniq_name'),
    'listviewdefs' => array(
        'NAME' => array (
            'width'   => '30',
            'label'   => 'LBL_NAME',
            'link'    => true,
            'default' => true),
        'UNIQ_NAME' => array (
            'width'   => '30',
            'label'   => 'LBL_UNIQ_NAME',
            'link'    => true,
            'default' => true),
    ),
    'searchdefs'   => array(
        'name',
        'uniq_name',
    )
);
