<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenusSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Header Menu
        $this->db->table('menus')->insert([
            'name' => 'Main Navigation',
            'location' => 'header',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $menuId = $this->db->insertID();

        $headerItems = [
            ['menu_id' => $menuId, 'parent_id' => null, 'label' => 'About', 'url' => '/about', 'target' => '_self', 'is_active' => 1, 'sort_order' => 1, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'label' => 'Practice Areas', 'url' => '/practice-areas', 'target' => '_self', 'is_active' => 1, 'sort_order' => 2, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'label' => 'Insights', 'url' => '/blog', 'target' => '_self', 'is_active' => 1, 'sort_order' => 3, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'label' => 'Contact', 'url' => '/contact', 'target' => '_self', 'is_active' => 1, 'sort_order' => 4, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $menuId, 'parent_id' => null, 'label' => 'Book Consultation', 'url' => '/book-consultation', 'target' => '_self', 'is_active' => 1, 'sort_order' => 5, 'css_class' => null, 'is_cta' => 1, 'created_at' => $now, 'updated_at' => $now],
        ];
        $this->db->table('menu_items')->insertBatch($headerItems);

        // Footer Menu
        $this->db->table('menus')->insert([
            'name' => 'Footer Navigation',
            'location' => 'footer',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $footerMenuId = $this->db->insertID();

        $footerItems = [
            ['menu_id' => $footerMenuId, 'parent_id' => null, 'label' => 'About', 'url' => '/about', 'target' => '_self', 'is_active' => 1, 'sort_order' => 1, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $footerMenuId, 'parent_id' => null, 'label' => 'Practice Areas', 'url' => '/practice-areas', 'target' => '_self', 'is_active' => 1, 'sort_order' => 2, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $footerMenuId, 'parent_id' => null, 'label' => 'Blog', 'url' => '/blog', 'target' => '_self', 'is_active' => 1, 'sort_order' => 3, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $footerMenuId, 'parent_id' => null, 'label' => 'Contact', 'url' => '/contact', 'target' => '_self', 'is_active' => 1, 'sort_order' => 4, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $footerMenuId, 'parent_id' => null, 'label' => 'Book Consultation', 'url' => '/book-consultation', 'target' => '_self', 'is_active' => 1, 'sort_order' => 5, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $footerMenuId, 'parent_id' => null, 'label' => 'Privacy Policy', 'url' => '/privacy-policy', 'target' => '_self', 'is_active' => 1, 'sort_order' => 6, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $footerMenuId, 'parent_id' => null, 'label' => 'Terms & Conditions', 'url' => '/terms-conditions', 'target' => '_self', 'is_active' => 1, 'sort_order' => 7, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $footerMenuId, 'parent_id' => null, 'label' => 'Legal Disclaimer', 'url' => '/legal-disclaimer', 'target' => '_self', 'is_active' => 1, 'sort_order' => 8, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $footerMenuId, 'parent_id' => null, 'label' => 'Refund Policy', 'url' => '/refund-cancellation-policy', 'target' => '_self', 'is_active' => 1, 'sort_order' => 9, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['menu_id' => $footerMenuId, 'parent_id' => null, 'label' => 'Cookie Policy', 'url' => '/cookie-policy', 'target' => '_self', 'is_active' => 1, 'sort_order' => 10, 'css_class' => null, 'is_cta' => 0, 'created_at' => $now, 'updated_at' => $now],
        ];
        $this->db->table('menu_items')->insertBatch($footerItems);
    }
}
