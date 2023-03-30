<?php

namespace App\Controllers;

use App\Controllers\BaseController;

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

        $users = $this->userModel->select($fields)
            ->findAll();

        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'img' => $user->img_user,
                'name' => esc($user->name),
                'email' => esc($user->email),
                'active' => ($user->active == true ? '<i class="fa fa-unlock text-success"></i> Ativo ' : '<span class="text-warning"><i class="fa fa-lock"></i> Inativo <span/>'),
            ];
        }

        $return = [
            'data' => $data
        ];

        return  $this->response->setJSON($return);
    }
}
