<?php

namespace Citcervera\Models\Managers;

include_once('Models/Interfaces/IManager.php');
include_once('Models/Connections/DB.php');

use Citcervera\Models\Interfaces\IManager;
use Citcervera\Models\Connections\DB;
use Citcervera\Models\Interfaces\IEntityBase;

class Manager implements IManager
{

    #region Construct

    public function __construct
        (
            IEntityBase $entity
        )
    {
        $this->_entity = $entity;
        $this->_entityTable = $this->get_class_name(get_class($this->_entity));
        $this->_db = new DB();
    }

    #endregion

    public function Query($query,$fetch_type = 'fetch_assoc',\Citcervera\Models\Interfaces\IEntityBase $entity = null) 
    {
        if($fetch_type == 'fetch_object')
        {
            $entities = [];
            $ret = $this->_db->query($query,$fetch_type);
            if($ret){
                foreach($ret as $value){
                    $entities[] = $this->cast($entity, $value);
                }
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
        $ret = $this->_db->select('SELECT * FROM ' . $this->_entityTable . ' WHERE IdAgenda = ?', array($id), array('%d'));
        return $this->cast($this->_entity, $ret[0]);
    }

    public function GetAll()
    {
        $ret = $this->_db->selectAll('SELECT * FROM ' . $this->_entityTable );
        $entities = [];
        if($ret){
            foreach($ret as $value){
                $entities[] = $this->cast(new $this->_entity, $value);
            }
        }
        return $entities;
    }

    public function Search2(Array $conditions, Array $format)
    {
        $ret = $this->_db->Search2($this->_entityTable, $conditions, $format );
        $entities = [];
        if($ret){
            foreach($ret as $value){
                $entities[] = $this->cast(new $this->_entity, $value);
            }
        }
        return $entities;
    }

    public function Search(string $query, Array $conditions, Array $format)
    {
        $ret = $this->_db->Search($this->_entityTable, $query, $conditions, $format );
        $entities = [];
        if($ret){
            foreach($ret as $value){
                $entities[] = $this->cast(new $this->_entity, $value);
            }
        }
        return $entities;
    }

    public function Save(\Citcervera\Models\Interfaces\IEntityBase $entity)
    {
        if($entity->idAgenda){
            $ret = $this->_db->update(
                'Agenda', 
                $entity, 
                array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'), 
                array('idAgenda'=>$entity->idAgenda), 
                array('%d')
            );
            if ($ret){
                return 'Update record ' . $entity->idAgenda ;
            }
            else
            {
                return 'Nothing to Update ' ;
            }
        }else{
            $ret = $this->_db->insert(
                'Agenda', 
                (array) $entity, 
                array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')
            );
            if ($ret){
                return 'Inserted into Agenda ';
            }
            else
            {
                return 'Nothing to Insert ' ;
            }
        }
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

    private function arrayToClass($data, $class) {
        return new $class($data);
    } 

    public static function cast(\Citcervera\Models\Interfaces\IEntityBase $destination, \stdClass $source)
    {
        $sourceReflection = new \ReflectionObject($source);
        $sourceProperties = $sourceReflection->getProperties();

        foreach ($sourceProperties as $sourceProperty) {
            $name = $sourceProperty->getName();
            $destination->{$name} = $source->$name;
        }
        return $destination;
    }
}