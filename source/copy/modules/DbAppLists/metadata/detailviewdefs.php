<?php
$duplicateBtn = <<<'TPL'
{if $bean->aclAccess("duplicate")}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accesskey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='{$bean->module_name}'; _form.return_action.value='DetailView'; _form.isDuplicate.value=true; _form.action.value='EditView'; _form.return_id.value='{$bean->id}';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if}
TPL;
$viewdefs ['DbAppLists'] = array (  'DetailView' =>
  array (
    'templateMeta' => array (
      'form' => array (
        'buttons'=>array(
          'EDIT',
          array (
            'customCode' => $duplicateBtn,
          ),
          'DELETE',
        ),
      ),
      'maxColumns' => '2',
      'widths' => array (
        array (
          'label' => '10',
          'field' => '30',
        ),
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
    ),
    'panels' => array (
      'LBL_INFORMATION' => array (
        array ('name', 'uniq_name'),
        array ('description', 'maxlen'),
      ),
      'LBL_DBAPPLISTSTRINGS' => array (
        array(
          array(
            'name' => 'DbAppListStringsField',
            'hideLabel' => true,
          ),
        ),
      ),
      'LBL_PANEL_ASSIGNMENT' => array (
        array (
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          '',
        ),
        array (
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
            'label' => 'LBL_DATE_ENTERED',
          ),
          array (
            'name' => 'date_modified',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
            'label' => 'LBL_DATE_MODIFIED',
          ),
        ),
      ),
    ),
  ),
);
