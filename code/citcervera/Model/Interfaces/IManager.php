<?php
namespace citcervera\Model\Interfaces;

interface IManager
{
    public function Query($query);
    public function Get($id);
    public function GetAll();
    public function Save(\Citcervera\Model\Interfaces\IEntityBase $entity);
    public function Delete($id);
    public function Search2(Array $conditions, Array $format);
    public function Search(string $query,Array $conditions, Array $format);
}