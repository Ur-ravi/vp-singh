<?php

namespace App\Controllers\Admin;

use App\Models\FaqModel;

class Faqs extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new FaqModel();
    }

    public function index()
    {
        $extraData = [
            'page_title' => 'FAQs',
            'faqs' => $this->model->getAll(),
        ];
        return $this->adminView('faqs/index', $extraData);
    }

    public function create()
    {
        $extraData = [
            'page_title' => 'Create FAQ',
            'faq' => null,
            'practice_areas' => (new \App\Models\PracticeAreaModel())->findAll(),
            'pages' => (new \App\Models\PageModel())->findAll(),
            'posts' => (new \App\Models\BlogPostModel())->findAll(),
        ];
        return $this->adminView('faqs/form', $extraData);
    }

    public function store()
    {
        $data = [
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'assignable_type' => $this->request->getPost('assignable_type') ?: null,
            'assignable_id' => $this->request->getPost('assignable_id') ?: null,
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
        ];

        if ($this->model->insert($data)) {
            return redirect()->to('/admin/faqs')->with('success', 'FAQ created successfully.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to create FAQ.');
    }

    public function edit(int $id)
    {
        $faq = $this->model->find($id);
        $extraData = [
            'page_title' => 'Edit FAQ',
            'faq' => $faq,
            'practice_areas' => (new \App\Models\PracticeAreaModel())->findAll(),
            'pages' => (new \App\Models\PageModel())->findAll(),
            'posts' => (new \App\Models\BlogPostModel())->findAll(),
        ];
        return $this->adminView('faqs/form', $extraData);
    }

    public function update(int $id)
    {
        $data = [
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'assignable_type' => $this->request->getPost('assignable_type') ?: null,
            'assignable_id' => $this->request->getPost('assignable_id') ?: null,
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
        ];

        if ($this->model->update($id, $data)) {
            return redirect()->to('/admin/faqs')->with('success', 'FAQ updated successfully.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to update FAQ.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/faqs')->with('success', 'FAQ deleted.');
    }
}
