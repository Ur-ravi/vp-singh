<?php

namespace App\Controllers\Admin;

use App\Models\TestimonialModel;

class Testimonials extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new TestimonialModel();
    }

    public function index()
    {
        $extraData = [
            'page_title' => 'Testimonials',
            'testimonials' => $this->model->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return $this->adminView('testimonials/index', $extraData);
    }

    public function create()
    {
        $extraData = ['page_title' => 'Add Testimonial', 'testimonial' => null];
        return $this->adminView('testimonials/form', $extraData);
    }

    public function store()
    {
        $data = [
            'client_name' => $this->request->getPost('client_name'),
            'review' => $this->request->getPost('review'),
            'rating' => $this->request->getPost('rating') ?: 5,
            'location' => $this->request->getPost('location'),
            'source' => $this->request->getPost('source'),
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
        ];

        if ($this->model->insert($data)) {
            return redirect()->to('/admin/testimonials')->with('success', 'Testimonial added.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to add testimonial.');
    }

    public function edit(int $id)
    {
        $extraData = [
            'page_title' => 'Edit Testimonial',
            'testimonial' => $this->model->find($id),
        ];
        return $this->adminView('testimonials/form', $extraData);
    }

    public function update(int $id)
    {
        $data = [
            'client_name' => $this->request->getPost('client_name'),
            'review' => $this->request->getPost('review'),
            'rating' => $this->request->getPost('rating') ?: 5,
            'location' => $this->request->getPost('location'),
            'source' => $this->request->getPost('source'),
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
        ];

        if ($this->model->update($id, $data)) {
            return redirect()->to('/admin/testimonials')->with('success', 'Testimonial updated.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to update.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/testimonials')->with('success', 'Testimonial deleted.');
    }
}
