<?php

namespace App\Controllers\Admin;

use App\Models\MenuModel;

class Navigation extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new MenuModel();
    }

    public function index()
    {
        $extraData = [
            'page_title' => 'Navigation',
            'menus' => $this->model->getAllMenus(),
        ];
        return $this->adminView('navigation/index', $extraData);
    }

    public function store()
    {
        $this->model->insert([
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
        ]);
        return redirect()->to('/admin/navigation')->with('success', 'Menu created.');
    }

    public function update(int $id)
    {
        $this->model->update($id, [
            'name' => $this->request->getPost('name'),
        ]);
        return redirect()->to('/admin/navigation')->with('success', 'Menu updated.');
    }

    public function delete(int $id)
    {
        $this->db->table('menu_items')->where('menu_id', $id)->delete();
        $this->model->delete($id);
        return redirect()->to('/admin/navigation')->with('success', 'Menu deleted.');
    }

    public function storeItem()
    {
        $this->db->table('menu_items')->insert([
            'menu_id' => $this->request->getPost('menu_id'),
            'parent_id' => $this->request->getPost('parent_id') ?: null,
            'label' => $this->request->getPost('label'),
            'url' => $this->request->getPost('url'),
            'target' => $this->request->getPost('target') ?: '_self',
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'is_cta' => $this->request->getPost('is_cta') ? 1 : 0,
        ]);
        return redirect()->to('/admin/navigation')->with('success', 'Menu item added.');
    }

    public function updateItem(int $id)
    {
        $this->db->table('menu_items')->where('id', $id)->update([
            'label' => $this->request->getPost('label'),
            'url' => $this->request->getPost('url'),
            'target' => $this->request->getPost('target') ?: '_self',
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
            'is_cta' => $this->request->getPost('is_cta') ? 1 : 0,
        ]);
        return redirect()->to('/admin/navigation')->with('success', 'Menu item updated.');
    }

    public function deleteItem(int $id)
    {
        $this->db->table('menu_items')->where('id', $id)->delete();
        return redirect()->to('/admin/navigation')->with('success', 'Menu item deleted.');
    }
}
