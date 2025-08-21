<?php

namespace Admin\Model\Page;

use Engine\Model;

class PageRepository extends Model
{
    public function getPages()
    {
        $sql = $this->queryBilder->select()
            ->from('page')
            ->orderBy('id', 'ASC')
            ->sql();

        return $this->db->query($sql);
    }

    public function getPage($id)
    {
        $qb = $this->queryBilder
            ->select()
            ->from('page')
            ->where('id', $id);

        return $this->db->query($qb->sql(), $qb->params())->fetch();
    }

    public function test()
    {
        $user = new User();
        $user->setEmail('test@admin.com');
        $user->setPassword(md5(rand(1, 10)));
        $user->setRole('user');
        $user->setHash('new');
        $user->save();
    }

    /**
     * @param $params
     * @return string|null
     */
    public function createPage($params)
    {
        $page = new Page();
        $page->setTitle($params['title']);
        $page->setContent($params['content']);
        $pageid = $page->save();

        return $pageid;
    }
}
