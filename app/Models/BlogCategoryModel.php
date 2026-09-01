<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogCategoryModel extends Model
{
    protected $table = 'blog_categories';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'slug', 'description'];

    protected $validationRules = [
        'name' => 'required|max_length[100]',
        'slug' => 'required|max_length[100]|is_unique[blog_categories.slug,id,{id}]',
    ];

    public function getBySlug(string $slug)
    {
        return $this->where('slug', $slug)->first();
    }
}
