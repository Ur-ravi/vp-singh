<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;

class Users extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }

    public function index()
    {
        $extraData = [
            'page_title' => 'Users',
            'users' => $this->model->orderBy('created_at', 'DESC')->findAll(),
        ];
        return $this->adminView('users/index', $extraData);
    }

    public function create()
    {
        $extraData = ['page_title' => 'Create User', 'user' => null];
        return $this->adminView('users/form', $extraData);
    }

    public function store()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role') ?: 'editor',
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($this->model->insert($data)) {
            return redirect()->to('/admin/users')->with('success', 'User created.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to create user.');
    }

    public function edit(int $id)
    {
        $extraData = [
            'page_title' => 'Edit User',
            'user' => $this->model->find($id),
        ];
        return $this->adminView('users/form', $extraData);
    }

    public function update(int $id)
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'role' => $this->request->getPost('role') ?: 'editor',
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($this->model->update($id, $data)) {
            return redirect()->to('/admin/users')->with('success', 'User updated.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to update user.');
    }

    public function delete(int $id)
    {
        if ($id == $this->auth->id()) {
            return redirect()->to('/admin/users')->with('error', 'You cannot delete your own account.');
        }
        $this->model->delete($id);
        return redirect()->to('/admin/users')->with('success', 'User deleted.');
    }
}
