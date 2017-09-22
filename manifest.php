<?php
global $sugar_config;
$sugarVersion = isset($sugar_config['suitecrm_version']) ? 'Suite'.$sugar_config['suitecrm_version'] : $sugar_config['sugar_version'];

$manifest = array(
    'name' => 'DbAppListStrings',
    'acceptable_sugar_versions' => array(),
    'acceptable_sugar_flavors' => array('CE'),
    'author' => 'hardsoft321',
    'description' => 'Добавление и редактирование справочников',
    'is_uninstallable' => true,
    'published_date' => '2017-08-14',
    'type' => 'module',
    'version' => '1.1.0',
);
$installdefs = array(
    'id' => 'DbAppListStrings',
    'beans' => array(
        array(
            'module' => 'DbAppLists',
            'class' => 'DbAppList',
            'path' => 'modules/DbAppLists/DbAppList.php',
            'tab' => true,
        ),
        array(
            'module' => 'DbAppListStrings',
            'class' => 'DbAppListString',
            'path' => 'modules/DbAppListStrings/DbAppListString.php',
            'tab' => false,
        ),
    ),
    'copy' => array(
        array(
            'from' => '<basepath>/source/copy',
            'to' => '.'
        ),
        array (
            'from' => "<basepath>/source/upgrade_unsafe/{$sugarVersion}/",
            'to' => '.',
        ),
    ),
    'language' => array(
        array(
            'from' => '<basepath>/source/language/application/ru_ru.DbAppListStrings.php',
            'to_module' => 'application',
            'language' => 'ru_ru',
        ),
        array(
            'from' => '<basepath>/source/language/application/en_us.DbAppListStrings.php',
            'to_module' => 'application',
            'language' => 'en_us',
        ),
    ),
);
