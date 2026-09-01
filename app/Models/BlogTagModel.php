<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogTagModel extends Model
{
    protected $table = 'blog_tags';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'slug'];

    protected $validationRules = [
        'name' => 'required|max_length[100]',
        'slug' => 'required|max_length[100]|is_unique[blog_tags.slug,id,{id}]',
    ];
}
