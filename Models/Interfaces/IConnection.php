<?php
namespace Citcervera\Models\Interfaces;

interface IConnection
{
    public function query(string $query);
    public function insert(string $table, Array $data, Array $format);
    public function update($table, $data, $format, $where, $where_format);
    public function delete(string $table, int $id);
}
