<?php

namespace App\Models;

use CodeIgniter\Model;

class PracticeAreaModel extends Model
{
    protected $table = 'practice_areas';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'title', 'slug', 'short_description', 'description', 'icon',
        'image', 'cta_label', 'is_featured', 'is_published', 'sort_order',
        'seo_title', 'seo_description', 'seo_og_image', 'seo_canonical', 'seo_robots',
    ];

    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'slug' => 'required|max_length[255]|is_unique[practice_areas.slug,id,{id}]',
    ];

    protected $useSoftDeletes = false;

    /**
     * Get published practice areas ordered
     */
    public function getPublished(): array
    {
        return $this->where('is_published', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Get by slug
     */
    public function getBySlug(string $slug)
    {
        return $this->where('slug', $slug)->first();
    }

    /**
     * Get featured practice area
     */
    public function getFeatured()
    {
        return $this->where('is_featured', 1)->where('is_published', 1)->first();
    }
}
