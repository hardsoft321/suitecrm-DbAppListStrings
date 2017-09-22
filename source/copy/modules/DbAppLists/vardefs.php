<?php
/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author  Evgeny Pervushin <pea@lab321.ru>
 */
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$dictionary['DbAppList'] = array(
    'table' => 'dbapplists',
    'audited' => true,
    'fields' => array(
        'uniq_name' => array (
          'name' => 'uniq_name',
          'vname' => 'LBL_UNIQ_NAME',
          'type' => 'varchar',
          'len' => '50',
          'audited' => true,
          'required' => true,
        ),
        'maxlen' => array (
            'name' => 'maxlen',
            'vname' => 'LBL_MAXLEN',
            'type' => 'int',
            'len' => '10',
            'audited' => true,
            'required' => true,
        ),
        'first_empty' => array (
            'name' => 'first_empty',
            'vname' => 'LBL_FIRST_EMPTY',
            'type' => 'bool',
            'default' => '1',
            'audited' => true,
        ),

        'dbAppListStrings' => array(
            'name' => 'dbAppListStrings',
            'type' => 'link',
            'relationship' => 'parent_dbappliststrings',
            'module' => 'DbAppListStrings',
            'bean_name' => 'DbAppListString',
            'source' => 'non-db',
            'vname' => 'LBL_DBAPPLISTSTRINGS',
        ),
    ),
    'indices' => array(
        array('name' =>'idx_dbapplist_uniq', 'type' =>'index', 'fields'=>array('uniq_name')),
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

VardefManager::createVardef('DbAppLists', 'DbAppList', array('default', 'assignable'));

$dictionary['DbAppList']['fields']['name']['required'] = true;
$dictionary['DbAppList']['fields']['name']['audited'] = true;

$dictionary['DbAppList']['fields']['DbAppListStringsField'] = array(
    'required' => false,
    'name' => 'DbAppListStringsField',
    'vname' => 'LBL_DBAPPLISTSTRINGS_FIELD',
    'link' => 'dbAppListStrings', //<-required
    'module' => 'DbAppListStrings', //<-required
    'required' => false,
    'sortingField' => 'sorting',
    'type' => 'function',
    'source' => 'non-db',
    'massupdate' => 0,
    'studio' => 'visible',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => false,
    'reportable' => false,
    'function' => array(
        'name' => 'SugarFieldMultiform::getFieldHtml',
        'returns' => 'html',
        'include' => 'custom/include/SugarFields/Fields/Multiform/SugarFieldMultiform.php',
    ),
);
