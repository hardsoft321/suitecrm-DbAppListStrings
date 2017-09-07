<?php
/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author  Evgeny Pervushin <pea@lab321.ru>
 */
$app_list_strings['moduleList']['DbAppLists'] = 'App List Strings';

$app_strings['LBL_ARCHIVE_VALUE_SUFFIX'] = ' (archived value)';

if(file_exists('modules/DbAppLists/DbAppList.php')) {
    require_once 'modules/DbAppLists/DbAppList.php';
    $app_list_strings = array_merge($app_list_strings, DbAppList::getLangAppListStrings('en_us'));
}
