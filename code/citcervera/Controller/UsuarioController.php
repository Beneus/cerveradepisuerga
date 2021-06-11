<?php
namespace citcervera\Controller;

use citcervera\Model\Entities\Usuario;
use citcervera\Model\Managers\Manager;

class UsuarioController {

    private $_response;
    private $_requestMethod;
    private $_userId;

    public function __construct($requestMethod, $id)
    {
        $this->_requestMethod = $requestMethod;
        $this->_userId = $id;
        $this->_usuario = new Usuario();
        $this->_usuarioManager = new Manager($this->_usuario);
    }

    public function processRequest()
    {
        switch ($this->_requestMethod) {
            case 'GET':
                if ($this->_userId) {
                    $this->_response = $this->get($this->_userId);
                } else {
                    $this->_response = $this->getAllUsers();
                };
                
                if ($this->_response['status_code_header'] === 'HTTP/1.1 200 OK') {
                    echo json_encode($this->_response);
                }
                break;
                case 'POST':
                    $this->_response = $this->createUserFromRequest();
                break;
        }
        

        /*
        switch ($this->_requestMethod) {
            case 'GET':
                if ($this->userId) {
                    $response = $this->getUser($this->userId);
                } else {
                    $response = $this->getAllUsers();
                };
                break;
            case 'POST':
                $response = $this->createUserFromRequest();
                break;
            case 'PUT':
                $response = $this->updateUserFromRequest($this->userId);
                break;
            case 'DELETE':
                $response = $this->deleteUser($this->userId);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
        */
    }

    private function get($id)
    {
        $result = $this->_usuarioManager->Get($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getAllUsers()
    {
        $result = $this->_usuarioManager->GetAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createUserFromRequest(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        
        $response = $this->_usuarioManager->Save($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

}
