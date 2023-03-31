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
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

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
                'img' => $user->img_user,
                'name' => anchor("users/show/$user->id", esc($user->name), 'title="Show user ' . $userName . '"'),
                'email' => esc($user->email),
                'active' => ($user->active == true ? '<i class="fa fa-unlock text-success"></i> Ativo ' : '<span class="text-warning"><i class="fa fa-lock"></i> Inativo <span/>'),
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

        $data = [
            'title' => "Show details for user " . esc($user->name),
            'user' => $user
        ];

        return view('Users/show', $data);
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
