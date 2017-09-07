<?php
/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author  Evgeny Pervushin <pea@lab321.ru>
 */

class DbAppListString extends Basic
{
    var $id;
    var $date_entered;
    var $date_modified;
    var $modified_user_id;
    var $created_by;
    var $created_by_name;
    var $modified_by_name;
    var $name;
    var $table_name = 'dbappliststrings';
    var $object_name = 'DbAppListString';
    var $module_dir = 'DbAppListStrings';

    public function ACLAccess($view, $is_owner = 'not_set')
    {
        require_once 'custom/include/SugarFields/Fields/Multiform/SugarFieldMultiform.php';
        return SugarFieldMultiform::ACLAccessLikeParent($this, 'parent_link', $view);
    }
}
