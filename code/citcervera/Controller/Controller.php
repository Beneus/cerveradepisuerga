<?php

namespace citcervera\Controller;

use citcervera\Model\Managers\Manager;
use citcervera\Model\Interfaces\IEntityBase;
use Exception;

class Controller
{

    private $_response;
    private $_requestMethod;
    private $_data;
    private $_entity;
    private $_entityManager;

    public function __construct(IEntityBase $entity, $requestMethod, $data)
    {
        $this->_requestMethod = $requestMethod;
        $this->_data = $data;
        $this->_entity = $entity;
        $this->_entityManager = new Manager($this->_entity);
    }

    public function processRequest()
    {
        try {
            switch ($this->_requestMethod) {
                case 'GET':
                    if ($this->_data) {
                        $this->_response = $this->get($this->_data);
                    } else {
                        $this->_response = $this->getAllUsers();
                    };

                    if ($this->_response['status'] === 'OK') {
                        echo json_encode($this->_response);
                    }
                    break;
                case 'POST':
                    $this->_response = $this->create($this->_data);
                    if ($this->_response['status'] === 'Created') {
                        echo json_encode($this->_response);
                    }
                    break;
                case 'PUT':
                    $this->_response = $this->update($this->_data);
                    if ($this->_response['status'] === 'Updated') {
                        echo json_encode($this->_response);
                    }
                    break;
                case 'DELETE':
                    $this->_response = $this->delete($this->_data);
                    if ($this->_response['status'] === 'Deleted') {
                        echo json_encode($this->_response);
                    }
                    break;
                default:
                    $this->_response = $this->notFoundResponse();
                    if ($this->_response['status'] === 'Not Found') {
                        echo json_encode($this->_response);
                    }
                    break;
            }
        } catch (Exception $e) {
            echo json_encode($e);
        }
    }

    private function get($id)
    {
        $result = $this->_entityManager->Get($id);
        $response['status'] = 'OK';
        $response['code'] = '200';
        $response['body'] = $result;
        return $response;
    }

    private function getAllUsers()
    {
        $result = $this->_entityManager->GetAll();
        $response['status'] = 'OK';
        $response['code'] = '200';
        $response['body'] = $result;
        return $response;
    }

    private function create($input)
    {
        $input = $this->_entityManager->cast($this->_entity, $input);
        $result = $this->_entityManager->Save($input);
        $response['status'] = 'Created';
        $response['code'] = '201';
        $response['body'] = $result;
        return $response;
    }

    private function update($input)
    {
        $input = $this->_entityManager->cast($this->_entity, $input);
        $result = $this->_entityManager->Save($input);
        $response['status'] = 'Updated';
        $response['code'] = '200';
        $response['body'] = $result;
        return $response;
    }

    private function delete($id)
    {
        $result = $this->_entityManager->Delete($id);
        $response['status'] = 'Deleted';
        $response['code'] = '200';
        $response['body'] = $result;
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status'] = 'Not Found';
        $response['code'] = '404';
        $response['body'] = null;
        return $response;
    }
}
