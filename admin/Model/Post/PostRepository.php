<?php

namespace Admin\Model\Post;

use Engine\Model;
use Exception;
class PostRepository extends Model
{
    public function getPosts()
    {
        $sql = $this->queryBuilder->select()
            ->from('post')
            ->orderBy('id', 'ASC')
            ->sql();

        return $this->db->query($sql);
    }

    public function getPost($id)
    {
        $qb = $this->queryBuilder
            ->select()
            ->from('post')
            ->where('id', $id);

        return $this->db->query($qb->sql())->fetch();
    }

    /**
     * @param $params
     * @return string|null
     */
    public function createPost($params)
    {
        $post = new Post();
        $post->setTitle($params['title']);
        $post->setContent($params['content']);
        $postId = $post->save();

        return $postId;
    }

    public function updatePost($postId, $data)
    {
        try {
            // Простой SQL запрос без QueryBuilder
            $sql = "UPDATE post SET title = :title, content = :content, date = :date WHERE id = :id";

            $result = $this->db->execute($sql, [
                'title' => $data['title'],
                'content' => $data['content'] ?? '',
                'date' => date('Y-m-d H:i:s'),
                'id' => $postId
            ]);

            return $result !== false;

        } catch (\Exception $e) {
            error_log('Update post error: ' . $e->getMessage());
            return false;
        }
    }
}