<?php

namespace App\Controllers\Admin;

use App\Models\PageModel;

class Pages extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new PageModel();
    }

    public function index()
    {
        $extraData = [
            'page_title' => 'Pages',
            'pages' => $this->model->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return $this->adminView('pages/index', $extraData);
    }

    public function create()
    {
        $extraData = ['page_title' => 'Create Page', 'page' => null];
        return $this->adminView('pages/form', $extraData);
    }

    public function store()
    {
        $data = $this->getPageData();
        if ($this->model->insert($data)) {
            return redirect()->to('/admin/pages')->with('success', 'Page created.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to create page.');
    }

    public function edit(int $id)
    {
        $extraData = [
            'page_title' => 'Edit Page',
            'page' => $this->model->find($id),
        ];
        return $this->adminView('pages/form', $extraData);
    }

    public function update(int $id)
    {
        $data = $this->getPageData();
        if ($this->model->update($id, $data)) {
            return redirect()->to('/admin/pages')->with('success', 'Page updated.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to update page.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/pages')->with('success', 'Page deleted.');
    }

    protected function getPageData(): array
    {
        return [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'content' => $this->request->getPost('content'),
            'excerpt' => $this->request->getPost('excerpt'),
            'template' => $this->request->getPost('template') ?: 'default',
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'seo_title' => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
        ];
    }
}
