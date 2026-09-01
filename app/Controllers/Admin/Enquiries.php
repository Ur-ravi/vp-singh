<?php

namespace App\Controllers\Admin;

use App\Models\EnquiryModel;

class Enquiries extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new EnquiryModel();
    }

    public function index()
    {
        $filters = [
            'status' => $this->request->getGet('status'),
            'search' => $this->request->getGet('search'),
        ];
        $result = $this->model->getPaginated(20, $filters);

        $extraData = [
            'page_title' => 'Enquiries',
            'enquiries' => $result['data'],
            'total' => $result['total'],
            'pager' => $result['pager'],
            'filters' => $filters,
        ];
        return $this->adminView('enquiries/index', $extraData);
    }

    public function view(int $id)
    {
        $extraData = [
            'page_title' => 'Enquiry #' . $id,
            'enquiry' => $this->model->find($id),
        ];
        return $this->adminView('enquiries/view', $extraData);
    }

    public function update(int $id)
    {
        $data = [
            'status' => $this->request->getPost('status'),
            'admin_notes' => $this->request->getPost('admin_notes'),
        ];

        if ($this->model->update($id, $data)) {
            return redirect()->back()->with('success', 'Enquiry updated.');
        }
        return redirect()->back()->with('error', 'Failed to update.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/enquiries')->with('success', 'Enquiry deleted.');
    }
}
