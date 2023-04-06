<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User;

class Users extends BaseController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Listagem de usuarios ativos'
        ];

        return view('Users/index', $data);
    }

    public function createUsers()
    {
        $userInfo = $this->request->getJSON();


        $data = [
            'name' => $userInfo->name,
            'email' => $userInfo->email,
            'password' => $userInfo->password,
            'active' => true
        ];

        $user = new User($data);
        $new = $this->userModel->save($user);
        // $new = true;

        if ($new === true) {
            $user = $this->userModel->orderBy('id', "desc")->first();

            $return = array(
                'msg' => "User $user->name created with success",
                'user_id' => $user->id,
                'user_email' => $user->email

            );
            return $this->response->setJSON($return);
        }

        return $this->response->setJSON($new);
    }

    public function getUsers()
    {

        $fields = [
            'id',
            'name',
            'email',
            'active',
            'img_user',
        ];

        $users = $this->userModel->select($fields)
            ->findAll();

        $data = [];

        foreach ($users as $user) {

            $userName = esc($user->name);

            $data[] = [
                'id' => $user->id,
                'img' => $user->img_user,
                'name' => $user->name,
                'email' => $user->email,
                'active' => ($user->active == true ? 'Ativo' : 'Inativo'),
            ];
        }

        $return = [
            'data' => $data
        ];

        return  $this->response->setJSON($return);
    }

    public function show(int $id = null)
    {

        $user = $this->getUserOrNotFound($id);


        return  $this->response->setJSON($user);
    }

    public function update()
    {
        $userInfo = $this->request->getJSON();

        $user = $this->getUserOrNotFound($userInfo->id);

        if (isset($userInfo->password) && $userInfo->password != $userInfo->password_confirm) {
            return $this->response->setJSON('a senha deve ser igual a confirmacao de senha');
        }

        $newUser = [
            "name" => isset($userInfo->name) ? $userInfo->name : $user->name,
            "email" => isset($userInfo->email) ? $userInfo->email : $user->email,
            "password" => isset($userInfo->password) ? $userInfo->password : '',
            "active" => isset($userInfo->active) ? $userInfo->active : $user->active,
        ];

        if (empty($newUser['password'])) {
            unset($newUser['password']);
        };

        $new = $user->fill($newUser);

        if ($user->hasChanged() == false) {

            return $this->response->setJSON('Nao ha dados para atualizar');
        }

        $new = $this->userModel->update($user->id, $newUser);

        if ($new === true) {
            $user = $this->getUserOrNotFound($userInfo->id);
            return $this->response->setJSON($user);
        } else {
        }

        return $this->response->setJSON($new);
    }



    /**
     * Method to get user
     * 
     * @param integer $id
     * @return Exception|object
     */

    private function getUserOrNotFound(int $id = null)
    {
        if (!$id || !$user = $this->userModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("User $id not found");
        }

        return $user;
    }
}
