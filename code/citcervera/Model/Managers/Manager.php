<?php

namespace citcervera\Model\Managers;

use citcervera\Model\Interfaces\IManager;
use citcervera\Model\Connections\DB;
use citcervera\Model\Interfaces\IEntityBase;

class Manager implements IManager
{

    #region Construct

    public function __construct(IEntityBase $entity = null)
    {
        if($entity){
            $this->_entity = $entity;
            $this->_entityTable = $entity->GetTable();
            $this->_entityId = $entity->GetId();
        }
        $this->_db = new DB();
    }

    #endregion

    public function Query($query, $fetch_type = 'fetch_assoc', \Citcervera\Model\Interfaces\IEntityBase $entity = null) 
    {
        if($fetch_type == 'fetch_object')
        {
            $entities = [];
            $ret = $this->_db->query($query,$fetch_type);
            if($ret){
                $entities = [];
               
                foreach($ret as $value)
                {
                    $castValue = $this->cast2(new $entity, $value);
                    $entities[] = $castValue;
                }
                return $entities;
            }
            return $entities;
        }
        else
        {
            return $this->_db->query($query,$fetch_type);
        }
    }

    public function Get($id)
    {
        $ret = $this->_db->select('SELECT * FROM ' . $this->_entityTable . ' WHERE ' . $this->_entityId . ' = ?', array($id), array('%d'));
        return $this->cast($this->_entity, $ret[0]);
    }

    public function GetAll()
    {
        $ret = $this->_db->selectAll('SELECT * FROM ' . $this->_entityTable );
        $entities = [];
        if($ret)
        {
            foreach($ret as $value)
            {
                $entities[] = $this->cast(new $this->_entity, $value);
            }
        }
        return $entities;
    }

    public function Search2(Array $conditions, Array $format)
    {
        $ret = $this->_db->Search2($this->_entityTable, $conditions, $format );
        $entities = [];
        if($ret)
        {
            foreach($ret as $value)
            {
                $entities[] = $this->cast(new $this->_entity, $value);
            }
        }
        return $entities;
    }

    public function Search(string $query, Array $conditions, Array $format)
    {
        $ret = $this->_db->Search($this->_entityTable, $query, $conditions, $format );
        $entities = [];
        if($ret)
        {
            foreach($ret as $value)
            {
                $entities[] = $this->cast(new $this->_entity, $value);
            }
        }
        return $entities;
    }

    public function Save(IEntityBase $entity)
    {
        $id = $entity->GetId();
        $table = $entity->GetTable();
        $props = get_object_vars($entity);
        // var_dump($props);
        //var_dump($table);
        if($entity->$id)
        {
             $ret = $this->_db->update(
                $table, 
                $props, 
                array_fill(0, count($props), '%s'),
                array($id => $entity->$id), 
                array('%d')
            );
            if ($ret)
            {
                return 'Update record ' . $entity->$id ;
            }
            else
            {
                return 'Nothing to Update ' ;
            }
             
        }
        else
        {
            $ret = $this->_db->insert(
                $table, 
                $props, 
                array_fill(0, count($props), '%s')
            );
            if ($ret)
            {
                return 'Inserted into ' . $table;
            }
            else
            {
                return 'Nothing to Insert ' ;
            }
        }
    }

    public function GetLastInsertedId()
    {
        return $this->_db->GetLastInsertedId();
    }

    public function Delete($id)
    {
        if($id)
        {
            $ret = $this->_db->delete($this->_entityTable,$id);
        }
        if($ret)
        {
            return 'delete record '. $id;
        }
        else
        {
            return 'Nothing to delete.';
        }  
    }

    private function get_class_name($classname)
    {
        if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
        return $pos;
    }

    private function arrayToClass($data, $class) 
    {
        return new $class($data);
    } 

    public static function cast(\Citcervera\Model\Interfaces\IEntityBase $destination, \stdClass $source)
    {
        $sourceReflection = new \ReflectionObject($source);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) 
        {
            $name = $sourceProperty->getName();
            $destination->{$name} = $source->$name;
        }
        return $destination;
    }

    public static function cast2(\Citcervera\Model\Interfaces\IEntityBase $destination, \stdClass $source)
    {
        $sourceReflection = new \ReflectionObject($source);
        $destinationReflection = new \ReflectionObject($destination);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) 
        {
            $sourceProperty->setAccessible(true);
            $name = $sourceProperty->getName();
            $value = $sourceProperty->getValue($source);
            if($destinationReflection->hasProperty($name))
            {
                $propDest = $destinationReflection->getProperty($name);
                $propDest->setAccessible(true);
                $propDest->setValue($destination,$value);
            }
            else
            {
                $destination->$name = $value;
            }
            
        }
        return $destination;
    }
}