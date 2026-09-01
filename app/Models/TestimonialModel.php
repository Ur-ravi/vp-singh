<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialModel extends Model
{
    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['client_name', 'review', 'rating', 'location', 'image', 'source', 'is_published', 'sort_order'];

    /**
     * Get published testimonials
     */
    public function getPublished(): array
    {
        return $this->where('is_published', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }
}
