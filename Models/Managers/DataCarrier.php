<?php
namespace Citcervera\Models\Managers;

include_once('Models/Interfaces/IDataCarrier.php');

use Citcervera\Models\Interfaces\IDataCarrier;

class DataCarrier implements IDataCarrier
{
    private $items = array();

    public function Set($obj, $key = null) {
        if ($key == null) {
            throw new \Exception("Key $key already in use.");
        }
        else {
            if (isset($this->items[$key])) {
                throw new \Exception("Key $key already in use.");
            }
            else {
                $this->items[$key] = $obj;
            }
        }
    }

    public function GetEntities($key) {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        else {
            throw new \Exception("Invalid key $key.");
        }
    }

    public function Del($key) {
        if (isset($this->items[$key])) 
        {
            unset($this->items[$key]);
        }
        else {
            throw new \Exception("Invalid key $key.");
        }
    }

    
}