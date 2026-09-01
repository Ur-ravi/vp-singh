<?php

namespace App\Controllers\Admin;

use App\Models\LocationModel;

class Locations extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new LocationModel();
    }

    public function index()
    {
        $extraData = [
            'page_title' => 'Locations',
            'locations' => $this->model->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return $this->adminView('locations/index', $extraData);
    }

    public function create()
    {
        $extraData = ['page_title' => 'Add Location', 'location' => null];
        return $this->adminView('locations/form', $extraData);
    }

    public function store()
    {
        $data = $this->getLocationData();
        if ($this->model->insert($data)) {
            return redirect()->to('/admin/locations')->with('success', 'Location added.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to add location.');
    }

    public function edit(int $id)
    {
        $extraData = [
            'page_title' => 'Edit Location',
            'location' => $this->model->find($id),
        ];
        return $this->adminView('locations/form', $extraData);
    }

    public function update(int $id)
    {
        $data = $this->getLocationData();
        if ($this->model->update($id, $data)) {
            return redirect()->to('/admin/locations')->with('success', 'Location updated.');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to update.');
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/locations')->with('success', 'Location deleted.');
    }

    protected function getLocationData(): array
    {
        return [
            'office_name' => $this->request->getPost('office_name'),
            'address' => $this->request->getPost('address'),
            'city' => $this->request->getPost('city'),
            'state' => $this->request->getPost('state'),
            'pin' => $this->request->getPost('pin'),
            'phone' => $this->request->getPost('phone'),
            'whatsapp' => $this->request->getPost('whatsapp'),
            'email' => $this->request->getPost('email'),
            'google_maps_url' => $this->request->getPost('google_maps_url'),
            'latitude' => $this->request->getPost('latitude') ?: null,
            'longitude' => $this->request->getPost('longitude') ?: null,
            'office_hours' => $this->request->getPost('office_hours'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
        ];
    }
}
