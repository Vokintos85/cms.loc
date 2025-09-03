<?php

namespace Cms\Model\MenuItem\MenuItem;

use Engine\Model;

class MenuItemRepository extends Model
{
    const NEW_MENU_ITEM_NAME = 'New item';


    /**
     * @param $menuId
     * @param $params
     * @return void
     */
    public function getItems($menuId, $params = [])
    {
        $sql = $this->queryBuilder
            ->select()
            ->from('menu_item')
            ->where('menu_id', $menuId)
            ->orderBy('position', 'ASC')
            ->sql();

    }
}