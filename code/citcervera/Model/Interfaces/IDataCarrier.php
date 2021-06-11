<?php
namespace citcervera\Model\Interfaces;

interface IDataCarrier
{
    public function GetEntities($key);
    public function Set($obj, $key = null);
    public function Del($key);
}