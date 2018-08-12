<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");

use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
CModule::IncludeModule('highloadblock');

$highloadBlockData = array ( 'NAME' => 'Menu', 'TABLE_NAME' => 'menu' );
$result = HLBT::add($highloadBlockData);
$highLoadBlockId = $result->getId();
//если произошла ошибка выведем её
if(!$highLoadBlockId){
    var_dump($result->getErrorMessages());
}
//name, depth, parent

function getEntityDataClass($hlBlockId)
{
    if (empty($hlBlockId) || $hlBlockId < 1) {
        return false;
    }
    $hlblock = HLBT::getById($hlBlockId)->fetch();
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}

$userTypeEntity    = new CUserTypeEntity();

$userTypeData1    = array(
    'ENTITY_ID'         => 'HLBLOCK_'.$highLoadBlockId,
    'FIELD_NAME'        => 'UF_NAME',
    'USER_TYPE_ID'      => 'string',
    'XML_ID'            => 'UF_NAME',
    'SORT'              => 500,
    'MULTIPLE'          => 'N',
    'MANDATORY'         => 'Y',
    'SHOW_FILTER'       => 'N',
    'SHOW_IN_LIST'      => '',
    'EDIT_IN_LIST'      => '',
    'IS_SEARCHABLE'     => 'N',
    'SETTINGS'          => array(
        'DEFAULT_VALUE' => '',
        'SIZE'          => '20',
        'ROWS'          => '1',
        'MIN_LENGTH'    => '0',
        'MAX_LENGTH'    => '0',
        'REGEXP'        => '',
    ),
    'EDIT_FORM_LABEL'   => array(
        'ru'    => 'Название пункта',
        'en'    => 'Item name',
    ),
    'LIST_COLUMN_LABEL' => array(
        'ru'    => 'Название пункта',
        'en'    => 'Item name',
    ),
    'LIST_FILTER_LABEL' => array(
        'ru'    => 'Название пункта',
        'en'    => 'Item name',
    ),
    'ERROR_MESSAGE'     => array(
        'ru'    => 'Ошибка при заполнении пользовательского свойства <Название пункта>',
        'en'    => 'An error in completing the user field <Название пункта>',
    ),
    'HELP_MESSAGE'      => array(
        'ru'    => '',
        'en'    => '',
    ),
);

//$userTypeData2    = array(
//    'ENTITY_ID'         => 'HLBLOCK_'.$highLoadBlockId,
//    'FIELD_NAME'        => 'DEPTH',
//    'USER_TYPE_ID'      => 'string',
//    'XML_ID'            => 'UF_DEPTH',
//    'SORT'              => 500,
//    'MULTIPLE'          => 'N',
//    'MANDATORY'         => 'Y',
//    'SHOW_FILTER'       => 'N',
//    'SHOW_IN_LIST'      => '',
//    'EDIT_IN_LIST'      => '',
//    'IS_SEARCHABLE'     => 'N',
//    'SETTINGS'          => array(
//        'DEFAULT_VALUE' => '',
//        'SIZE'          => '20',
//        'ROWS'          => '1',
//        'MIN_LENGTH'    => '0',
//        'MAX_LENGTH'    => '0',
//        'REGEXP'        => '',
//    ),
//    'EDIT_FORM_LABEL'   => array(
//        'ru'    => 'Уровень пункта',
//        'en'    => 'Item level',
//    ),
//    'LIST_COLUMN_LABEL' => array(
//        'ru'    => 'Уровень пункта',
//        'en'    => 'Item level',
//    ),
//    'LIST_FILTER_LABEL' => array(
//        'ru'    => 'Название свойства',
//        'en'    => 'Item level',
//    ),
//    'ERROR_MESSAGE'     => array(
//        'ru'    => 'Ошибка при заполнении пользовательского свойства <Уровень пункта>',
//        'en'    => 'An error in completing the user field <Уровень пункта>',
//    ),
//    'HELP_MESSAGE'      => array(
//        'ru'    => '',
//        'en'    => '',
//    ),
//);

$userTypeData3    = array(
    'ENTITY_ID'         => 'HLBLOCK_'.$highLoadBlockId,
    'FIELD_NAME'        => 'UF_PARENT_ID',
    'USER_TYPE_ID'      => 'integer',
    'XML_ID'            => 'UF_PARENT',
    'SORT'              => 500,
    'MULTIPLE'          => 'N',
    'MANDATORY'         => 'N',
    'SHOW_FILTER'       => 'N',
    'SHOW_IN_LIST'      => '',
    'EDIT_IN_LIST'      => '',
    'IS_SEARCHABLE'     => 'N',
    'SETTINGS'          => array(
        'DEFAULT_VALUE' => '',
    ),
    'EDIT_FORM_LABEL'   => array(
        'ru'    => 'ID родителя',
        'en'    => 'Item parent',
    ),
    'LIST_COLUMN_LABEL' => array(
        'ru'    => 'ID родителя',
        'en'    => 'Item parent',
    ),
    'LIST_FILTER_LABEL' => array(
        'ru'    => 'ID родителя',
        'en'    => 'Item parent',
    ),
    'ERROR_MESSAGE'     => array(
        'ru'    => 'Ошибка при заполнении пользовательского свойства <ID родителя>',
        'en'    => 'An error in completing the user field <ID родителя>',
    ),
    'HELP_MESSAGE'      => array(
        'ru'    => '',
        'en'    => '',
    ),
);

$userTypeId = $userTypeEntity->Add($userTypeData1);
//$userTypeId2 = $userTypeEntity->Add($userTypeData2);
$userTypeId2 = $userTypeEntity->Add($userTypeData3);

$entity_data_class = GetEntityDataClass($highLoadBlockId);
$carResult = $entity_data_class::add([
    'UF_NAME' => 'Машина',
]);
$carId = $carResult->getId();
$entity_data_class::add([
    'UF_NAME' => 'Легковая',
    'UF_PARENT_ID' => $carId
]);
$flyingAidResult = $entity_data_class::add([
    'UF_NAME' => 'Летальное средство',
]);
$flyingAidId = $flyingAidResult->getId();
$truckResult = $entity_data_class::add([
    'UF_NAME' => 'Грузовик',
    'UF_PARENT_ID' => $carId
]);
$truckId = $truckResult->getId();
$entity_data_class::add([
    'UF_NAME' => 'Поезд',
]);
$entity_data_class::add([
    'UF_NAME' => 'Вертолет',
    'UF_PARENT_ID' => $flyingAidId
]);
$entity_data_class::add([
    'UF_NAME' => 'Камаз',
    'UF_PARENT_ID' => $truckId
]);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>