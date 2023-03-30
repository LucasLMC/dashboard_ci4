<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{

    private $userModel;

    public function __construct()
    {
        $db        = db_connect('default');
        $this->userModel = model('UserModel', true, $db);
    }

    public function index()
    {
    }

    public function getUsers()
    {
        // if (!$this->request->isAJAX()) {
        //     return redirect()->back();
        // }

        $fields = [
            'id',
            'name',
            'email',
            'active',
            'img_user',
        ];

        $users = $this->userModel->select()
            ->findAll();

        echo '</pre>';
        print_r($users);
        exit;

        $data = [];

        foreach ($users as $user) {
            $data[] = [
                // 'id' => $user->id,
                'img' => $user->img,
                'name' => esc($user->name),
                'email' => esc($user->email),
                'active' => ($user->active == true ? 'Ativo' : '<span class="text-warning">Inativo<span/>'),
            ];
        }

        $return = [
            'data' => $data
        ];

        echo '</pre>';
        print_r($return);
        exit;


        return  $this->response->setJSON($return);
    }
}
