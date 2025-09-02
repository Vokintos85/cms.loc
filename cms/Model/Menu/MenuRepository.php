<?php

namespace Cms\Model\Menu;

use Engine\Model;

class MenuRepository extends Model
{
    public function getAllitems()
    {
        $sql = $this->queryBuilder->select()
            ->from('menu')
            ->orderBy('id', 'ASC')
            ->sql();
            
            return $this->db->query($sql);
    }
}