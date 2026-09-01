<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'location'];

    /**
     * Get menu with its items
     */
    public function getMenuWithItems(string $location): ?object
    {
        $menu = $this->where('location', $location)->first();
        if (!$menu) return null;

        $menu->items = $this->db->table('menu_items')
            ->where('menu_id', $menu->id)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResult();

        return $menu;
    }

    /**
     * Get all menus
     */
    public function getAllMenus(): array
    {
        $menus = $this->findAll();
        foreach ($menus as &$menu) {
            $menu->items = $this->db->table('menu_items')
                ->where('menu_id', $menu->id)
                ->orderBy('sort_order', 'ASC')
                ->get()
                ->getResult();
        }
        return $menus;
    }
}
