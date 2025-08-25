<?php

namespace Admin\Model\Page;

use Engine\Model;

class PageRepository extends Model
{
    public function getPages()
    {
        $sql = $this->queryBuilder->select()
            ->from('page')
            ->orderBy('id', 'ASC')
            ->sql();

        return $this->db->query($sql);
    }

    public function getPage($id)
    {
        $qb = $this->queryBuilder
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

    public function updatePage($pageId, $data)
    {
        try {
            // Простой SQL запрос без QueryBuilder
            $sql = "UPDATE page SET title = :title, content = :content, date = :date WHERE id = :id";

            $result = $this->db->execute($sql, [
                'title' => $data['title'],
                'content' => $data['content'] ?? '',
                'date' => date('Y-m-d H:i:s'),
                'id' => $pageId
            ]);

            return $result !== false;

        } catch (\Exception $e) {
            error_log('Update page error: ' . $e->getMessage());
            return false;
        }
    }
}
