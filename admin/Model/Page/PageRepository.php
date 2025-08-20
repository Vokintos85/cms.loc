<?php

namespace Admin\Model\Page;

use Engine\Model;

class PageRepository extends Model
{
    public function getPages()
    {
        $sql = $this->queryBuilder->select()
            ->from('page')
            ->orderBy('id', 'DESC')
            ->sql();

        return $this->db->query($sql);
    }

    public function test()
    {
        $user = new User;
        $user->setEmail('test@admin.com');
        $user->setPassword(md5(rand(1, 10)));
        $user->setRole('user');
        $user->setHash('new');
        $user->save();
    }

}