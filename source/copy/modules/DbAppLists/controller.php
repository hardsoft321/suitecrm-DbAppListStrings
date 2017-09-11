<?php
/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author Evgeny Pervushin <pea@lab321.ru>
 */

require_once('include/MVC/Controller/SugarController.php');
require_once('modules/DbAppLists/DbAppList.php');

class DbAppListsController extends SugarController
{
    public function action_save()
    {
        $errors = $this->bean->validate();
        if(!empty($errors)) {
            $errMsg = '';
            foreach($errors as $err)
                $errMsg .= $err['message']."<br/>\n";
            sugar_die($errMsg);
        }

        parent::action_save();

        if(isset($_POST['description'])) {
            unset($_POST['description']);
        }
        $itemsModule = 'DbAppListStrings';
        $fieldName = 'DbAppListStringsField';
        if(isset($_POST[$itemsModule])) {
            require_once 'custom/include/SugarFields/Fields/Multiform/SugarFieldMultiform.php';
            $field = new SugarFieldMultiform;
            $field->save($this->bean, $fieldName);
        }

        DbAppList::clearCache();
    }

    protected function action_delete()
    {
        parent::action_delete();
        DbAppList::clearCache();
    }

    public function action_validate()
    {
        $this->view = '';
        $this->pre_save();
        $errors = $this->bean->validate();
        echo json_encode(array(
            'errors' => $errors,
        ));
    }
}
