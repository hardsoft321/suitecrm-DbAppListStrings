<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $mod_strings;

if(ACLController::checkAccess('DbAppListStrings','list',true)){
    $module_menu[] = array("index.php?module=DbAppListStrings&action=index", $mod_strings['LBL_MODULE_NAME'], 'DbAppListStrings');
}

$bean = BeanFactory::newBean('DbAppLists');
if($bean->ACLAccess('edit')){
    $module_menu[] = Array("index.php?module=DbAppListStrings&action=EditView", $mod_strings['LBL_CREATE_DBAPPLISTSTRING'], 'DbAppListStrings');
}
