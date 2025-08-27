<?php
namespace Admin\Model\Setting;

use Engine\Model;

class SettingRepository extends Model
{
    public function getSettings()
    {
        $sql = $this->queryBuilder->select()
            ->from('setting')
            ->orderBy('id', 'ASC')
            ->sql();

        return $this->db->query($sql)
            ->fetchAll(\PDO::FETCH_OBJ);
    }

    public function update(string $key, string $value): bool
    {
        try {
            $sql = "UPDATE `setting` SET `value` = :value WHERE `key_field` = :key_field";

            $result = $this->db->execute($sql, [
                'key_field' => $key,
                'value' => $value,
            ]);

            return $result != false;

        } catch (\Exception $e) {
            error_log('Update post error: ' . $e->getMessage());
            return false;
        }
    }
}