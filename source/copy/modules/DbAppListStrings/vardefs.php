<?php
/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author  Evgeny Pervushin <pea@lab321.ru>
 */
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$dictionary['DbAppListString'] = array(
    'table' => 'dbappliststrings',
    'audited' => true,
    'fields' => array(
        'parent_name' => array(
            'name' => 'parent_name',
            'rname' => 'name',
            'id_name' => 'parent_id',
            'type' => 'relate',
            'vname'=>'LBL_LIST_RELATED_TO',
            'isnull' => 'true',
            'module' => 'DbAppLists',
            'table' => 'dbapplists',
            'massupdate' => false,
            'source'=>'non-db',
            'link'=>'parent_link',
            'unified_search' => true,
            'importable' => 'true',
        ),
        'parent_id' => array (
            'name' => 'parent_id',
            'type' => 'id',
            'reportable'=>false,
            'vname'=>'LBL_PARENT_ID',
            'audited' => true,
        ),
        'parent_link' => array(
            'name' => 'parent_link',
            'type' => 'link',
            'relationship' => 'parent_dbappliststrings',
            'module' => 'DbAppLists',
            'bean_name' => 'DbAppList',
            'link_type' => 'one',
            'source' => 'non-db',
            'vname'=>'LBL_LIST_RELATED_TO',
        ),

        'uniq_name' => array (
            'name' => 'uniq_name',
            'vname' => 'LBL_UNIQ_NAME',
            'type' => 'varchar',
            'len' => '20',
            'audited' => true,
            'required' => true,
        ),
        'lang' => array (
            'name' => 'lang',
            'vname' => 'LBL_LANGUAGE',
            'type' => 'enum',
            'len' => '10',
            'options' => $GLOBALS['sugar_config']['languages'],
            'default' => $GLOBALS['sugar_config']['default_language'],
            'audited' => true,
            'required' => true,
        ),
        'sorting' => array (
            'name' => 'sorting',
            'vname' => 'LBL_SORTING',
            'type' => 'int',
            'len' => '10',
            'required' => true,
        ),
        'archive' => array (
            'name' => 'archive',
            'vname' => 'LBL_ARCHIVE',
            'type' => 'bool',
            'default' => '0',
            'audited' => true,
        ),
    ),
    'indices' => array(
        array('name' =>'idx_dbappliststrings_parent', 'type'=>'index', 'fields'=>array('parent_id','deleted')),
    ),
    'relationships' => array(
        'parent_dbappliststrings' => array (
            'lhs_module'=> 'DbAppLists',
            'lhs_table'=> 'dbapplists',
            'lhs_key' => 'id',
            'rhs_module'=> 'DbAppListStrings',
            'rhs_table'=> 'dbappliststrings',
            'rhs_key' => 'parent_id',
            'relationship_type'=>'one-to-many',
        ),
    ),
);

VardefManager::createVardef('DbAppListStrings', 'DbAppListString', array('default'));

$dictionary['DbAppListString']['fields']['name']['required'] = true;
$dictionary['DbAppListString']['fields']['name']['audited'] = true;
