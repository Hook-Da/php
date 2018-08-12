<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");

use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

CModule::IncludeModule('highloadblock');

/**
 * Отладка
 * @param $var
 */
function d($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

/**
 * Получить сущность highloadblock
 * @param $hlBlockId
 */
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

/**
 * Получить элементы из highloadblock
 * @param $hlBlockId
 * @return mixed
 */
function getHlBlockElements($hlBlockId)
{
    $entityDataClass = getEntityDataClass($hlBlockId);
    $rsData = $entityDataClass::getList([
        "select" => ['*'],
    ]);
    while ($arRes = $rsData->Fetch()) {
        $menu[$arRes['ID']] = $arRes;
    }

    return $menu;
}

function getTree($menu)
{
    $tree = [];
    foreach ($menu as $id => &$item) {
        if ($item['UF_PARENT_ID'] === null) {
            $tree[$id] = &$item;
        } else {
            $menu[$item['UF_PARENT_ID']]['CHILDS'][$id] = &$item;
        }
    }

    return $tree;
}

function tplMenu($category)
{
    $menu = '<li>' . $category['UF_NAME'];

    if (isset($category['CHILDS'])) {
        $menu .= '<ul>' . showCat($category['CHILDS']) . '</ul>';
    }
    $menu .= '</li>';

    return $menu;
}


function showCat($data)
{
    $string = '';
    foreach ($data as $item) {
        $string .= tplMenu($item);
    }
    return $string;
}

$HL_BLOCK_ID = 1;
$hlBlockElements = getHlBlockElements($HL_BLOCK_ID);
$tree = getTree($hlBlockElements);
$catMenu = showCat($tree);

//Выводим на экран
echo '<ul>' . $catMenu . '</ul>';

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
