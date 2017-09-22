<?php
/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author  Evgeny Pervushin <pea@lab321.ru>
 */

class DbAppList extends Basic
{
    var $id;
    var $date_entered;
    var $date_modified;
    var $modified_user_id;
    var $created_by;
    var $created_by_name;
    var $modified_by_name;
    var $name;
    var $table_name = 'dbapplists';
    var $object_name = 'DbAppList';
    var $module_dir = 'DbAppLists';

    public function bean_implements($interface)
    {
        switch($interface){
            case 'ACL':return true;
        }
        return false;
    }

    public function ACLAccess($view,$is_owner='not_set',$in_group='not_set')
    {
        $view = strtolower($view);
        if($view == 'duplicate') {
            return BeanFactory::newBean($this->module_name)->ACLAccess('edit', $is_owner, $in_group);
        }
        return parent::ACLAccess($view, $is_owner, $in_group);
    }

    public function isOwner($user_id)
    {
        //запрещаем создание, редактировать можно после того, как админ поставит ответственного
        if(empty($this->id)) {
            return false;
        }
        return parent::isOwner($user_id);
    }

    public function validate()
    {
        global $db;
        $record_id = !empty($this->id) ? $db->quote($this->id) : '';
        $fields = array(
            'uniq_name' => $db->quote($this->uniq_name),
        );
        $sql = "SELECT 1 FROM {$this->table_name} WHERE deleted = 0 ";
        if($record_id) {
            $sql .= " AND id != '$record_id' ";
        }
        foreach($fields as $name => $value) {
            $sql .= $value ? " AND LOWER($name) = LOWER('$value') " : " AND $name IS NULL ";
        }
        if($db->fetchOne($sql)) {
            return array(
                array(
                    'name'=>'uniq_name',
                    'message' => 'Справочник с таким именем существует!',
                ),
            );
        }

        if(isset($GLOBALS['app_list_strings'][strtolower($this->uniq_name)]) && (!$record_id || $this->fetched_row['uniq_name'] != $this->uniq_name)) {
            return array(
                array(
                    'name'=>'uniq_name',
                    'message' => 'Выпадающий список с таким именем существует',
                ),
            );
        }

        return array();
    }

    public function save($check_notify = FALSE)
    {
        $this->uniq_name = strtolower($this->uniq_name);
        return parent::save($check_notify);
    }

    public function mark_deleted($id)
    {
        $link = 'dbAppListStrings';
        $bean = BeanFactory::getBean($this->module_name, $id);
        $bean->load_relationship($link);
        $children = $bean->$link->getBeans();
        parent::mark_deleted($id);
        foreach($children as $child) {
            $child->mark_deleted($child->id);
        }
    }

    public static function getBeanFieldOptions($focus, $name, $value, $view)
    {
        $listName = !empty($focus->field_defs[$name]['options_db']) ? $focus->field_defs[$name]['options_db'] : $focus->field_defs[$name]['options'];
        $lang = $GLOBALS['current_language'];
        $returnArchived = $view != 'EditView';
        return $returnArchived && isset($GLOBALS['app_list_strings'][$listName])
            ? $GLOBALS['app_list_strings'][$listName]
            : self::getOptions($listName, $lang, $returnArchived, $value);
    }

    public static function getOptions($listName, $lang, $returnArchived = true, $ensureValue = null)
    {
        $db = !empty($GLOBALS['db']) ? $GLOBALS['db'] : DBManagerFactory::getInstance();

        $options = array();
        $first_empty = $db->getOne("SELECT first_empty FROM dbapplists WHERE uniq_name = '".$db->quote($listName)."' AND deleted = 0");
        if($first_empty) {
            $options[''] = '';
        }

        $sql = "SELECT als.uniq_name, als.name, als.archive FROM dbapplists al, dbappliststrings als
WHERE
    al.uniq_name = '".$db->quote($listName)."'
    AND als.parent_id = al.id
    AND als.lang = '".$db->quote($lang)."'
    AND als.deleted = 0 AND al.deleted = 0
";
        if(!$returnArchived) {
            $sql .= " AND (als.archive = 0 OR als.uniq_name = '".$db->quote($ensureValue)."') ";
        }
        $sql .= " ORDER BY als.sorting";

        $dbRes = $db->query($sql);
        while($row = $db->fetchByAssoc($dbRes)) {
            $options[$row['uniq_name']] = $row['archive'] ? $row['name'].$GLOBALS['app_strings']['LBL_ARCHIVE_VALUE_SUFFIX'] : $row['name'];
        }
        return $options;
    }

    public static function getLangAppListStrings($lang)
    {
        $db = !empty($GLOBALS['db']) ? $GLOBALS['db'] : DBManagerFactory::getInstance();

        $options = array();

        $sql = "SELECT al.uniq_name AS list_name, al.first_empty, als.uniq_name, als.name, als.archive
FROM dbapplists al, dbappliststrings als
WHERE
    als.lang = '".$db->quote($lang)."'
    AND als.parent_id = al.id
    AND als.deleted = 0 AND al.deleted = 0
ORDER BY al.uniq_name, als.sorting";

        $dbRes = $db->query($sql);
        while($row = $db->fetchByAssoc($dbRes)) {
            if(!isset($options[$row['list_name']]) && $row['first_empty']) {
                $options[$row['list_name']][''] = '';
            }
            $options[$row['list_name']][$row['uniq_name']] = $row['archive'] ? $row['name'].$GLOBALS['app_strings']['LBL_ARCHIVE_VALUE_SUFFIX'] : $row['name'];
        }
        return $options;
    }

    public static function clearCache()
    {
        foreach($GLOBALS['sugar_config']['languages'] as $language => $name) {
            sugar_cache_clear('app_list_strings.'.$language);
        }
        //при сохранении в студии записывается custom/include/*.lang.php, но в студии запретил редактировать db-поля
    }
}
