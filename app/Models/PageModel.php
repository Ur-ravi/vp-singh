<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'title', 'slug', 'content', 'excerpt', 'template', 'featured_image',
        'is_published', 'sort_order', 'seo_title', 'seo_description',
        'seo_og_image', 'seo_canonical', 'seo_robots',
    ];

    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'slug' => 'required|max_length[255]|is_unique[pages.slug,id,{id}]',
    ];

    public function getBySlug(string $slug)
    {
        return $this->where('slug', $slug)->first();
    }

    /**
     * Get page with its sections
     */
    public function getWithSections(int $id)
    {
        $page = $this->find($id);
        if ($page) {
            $page->sections = $this->db->table('page_sections')
                ->where('page_id', $id)
                ->where('is_visible', 1)
                ->orderBy('sort_order', 'ASC')
                ->get()
                ->getResult();
        }
        return $page;
    }

    /**
     * Get page sections by key
     */
    public function getSectionsBySlug(string $slug): array
    {
        $page = $this->where('slug', $slug)->first();
        if (!$page) return [];

        return $this->db->table('page_sections')
            ->where('page_id', $page->id)
            ->where('is_visible', 1)
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResult();
    }
}
