<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table = 'faqs';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['question', 'answer', 'assignable_type', 'assignable_id', 'is_published', 'sort_order'];

    /**
     * Get FAQs for a specific assignment
     */
    public function getForEntity(string $type, int $id): array
    {
        return $this->where('assignable_type', $type)
            ->where('assignable_id', $id)
            ->where('is_published', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Get global FAQs
     */
    public function getGlobal(): array
    {
        return $this->where('assignable_type', 'global')
            ->where('is_published', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Get all FAQs for admin
     */
    public function getAll(): array
    {
        return $this->orderBy('sort_order', 'ASC')->findAll();
    }
}
