<?php

declare(strict_types=1);

class Post extends Model
{
    private string $tableName = 'posts';

    public function getPosts(): bool|array
    {
        $this->db->prepareQuery('SELECT `id`, `text` FROM ' . $this->tableName);

        return $this->db->resultAll();
    }

    public function addNewPost(string $text): void
    {
        $this->db->prepareQuery('INSERT INTO ' . $this->tableName . ' (text) VALUES (:text)');
        $this->db->execute(['text' => $text]);
    }
}
