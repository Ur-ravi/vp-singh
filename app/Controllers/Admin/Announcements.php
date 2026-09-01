<?php

namespace App\Controllers\Admin;

use App\Models\AnnouncementModel;

class Announcements extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AnnouncementModel();
    }

    public function index()
    {
        $extraData = [
            'page_title' => 'Announcements',
            'announcements' => $this->model->getAll(),
        ];
        return $this->adminView('announcements/index', $extraData);
    }

    public function create()
    {
        $extraData = ['page_title' => 'Create Announcement', 'announcement' => null];
        return $this->adminView('announcements/form', $extraData);
    }

    public function store()
    {
        $data = [
            'text' => $this->request->getPost('text'),
            'cta_label' => $this->request->getPost('cta_label'),
            'cta_url' => $this->request->getPost('cta_url'),
            'start_date' => $this->request->getPost('start_date') ?: null,
            'end_date' => $this->request->getPost('end_date') ?: null,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($this->model->insert($data)) {
            return redirect()->to('/admin/announcements')->with('success', 'Announcement created.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to create.');
    }

    public function edit(int $id)
    {
        $extraData = [
            'page_title' => 'Edit Announcement',
            'announcement' => $this->model->find($id),
        ];
        return $this->adminView('announcements/form', $extraData);
    }

    public function update(int $id)
    {
        $data = [
            'text' => $this->request->getPost('text'),
            'cta_label' => $this->request->getPost('cta_label'),
            'cta_url' => $this->request->getPost('cta_url'),
            'start_date' => $this->request->getPost('start_date') ?: null,
            'end_date' => $this->request->getPost('end_date') ?: null,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($this->model->update($id, $data)) {
            return redirect()->to('/admin/announcements')->with('success', 'Announcement updated.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to update.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/announcements')->with('success', 'Announcement deleted.');
    }
}
