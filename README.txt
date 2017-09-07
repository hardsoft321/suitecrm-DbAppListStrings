Добавление и редактирование справочников

Требуются пакеты
 * multiform

Пример vardefs:

//Указать uniq_name справочника, это можно сделать и через студию
$dictionary['Lead']['fields']['lead_source']['options'] = 'lead_source';

//Настроить функцию. Если этот шаг пропустить, опции будут содержать все значения, включая архивные.
//Эта функция на странице создания показывает только активные опции.
$dictionary['Lead']['fields']['lead_source']['function'] = array(
    'name' => 'DbAppList::getBeanFieldOptions',
    'include' => 'modules/DbAppLists/DbAppList.php',
);
//Чтобы не пересекаться с app_list_strings, можно указать options_db. Он имеет приоритет перед options.
$dictionary['Lead']['fields']['lead_source']['options_db'] = 'lead_source';


Рекомендуемые права доступа в нужной роли:
 * Доступ на модуль - Доступен
 * Просмотр, Правка, Список - Владелец
 * остальные - Заблокировано
