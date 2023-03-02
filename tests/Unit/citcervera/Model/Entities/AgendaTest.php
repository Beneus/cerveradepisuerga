<?php 
namespace tests;

use citcervera\Model\Entities\Agenda;

class AgendaTest extends \PHPUnit\Framework\TestCase
{
    protected $agenda;

    protected function setUp():void{
        $this->agenda = new Agenda();
    }

    public function testAgendaTable():void{
        $this->assertEquals('Agenda',$this->agenda->GetTable());
    }

    public function testAgendaId():void{
        $this->assertEquals('idAgenda',$this->agenda->GetId());
    }

    public function testAgendaInit():void{
        $this->agenda->Init(['Descripcion'=>'fake']);
        $this->assertEquals('fake',$this->agenda->Descripcion);
    }
}
