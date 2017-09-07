<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $mod_strings;

if(ACLController::checkAccess('DbAppLists','list',true)){
    $module_menu[] = array("index.php?module=DbAppLists&action=index", $mod_strings['LBL_MODULE_NAME'], 'DbAppLists');
}

$bean = BeanFactory::newBean('DbAppLists');
if($bean->ACLAccess('edit')){
    $module_menu[] = Array("index.php?module=DbAppLists&action=EditView", $mod_strings['LBL_CREATE_DBAPPLIST'], 'DbAppLists');
}
