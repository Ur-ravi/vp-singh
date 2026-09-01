<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogPostModel extends Model
{
    protected $table = 'blog_posts';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'title', 'slug', 'excerpt', 'content', 'featured_image',
        'author_id', 'category_id', 'status', 'published_at', 'scheduled_at',
        'view_count', 'seo_title', 'seo_description', 'seo_og_image',
        'seo_canonical', 'seo_robots',
    ];

    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'slug' => 'required|max_length[255]|is_unique[blog_posts.slug,id,{id}]',
        'content' => 'required',
    ];

    /**
     * Get published posts
     */
    public function getPublished(int $limit = 10, int $offset = 0): array
    {
        return $this->where('status', 'published')
            ->where('published_at <=', date('Y-m-d H:i:s'))
            ->orderBy('published_at', 'DESC')
            ->limit($limit, $offset)
            ->findAll();
    }

    /**
     * Get published count
     */
    public function getPublishedCount(): int
    {
        return $this->where('status', 'published')
            ->where('published_at <=', date('Y-m-d H:i:s'))
            ->countAllResults();
    }

    /**
     * Get by slug
     */
    public function getBySlug(string $slug)
    {
        return $this->where('slug', $slug)->first();
    }

    /**
     * Get with author and category
     */
    public function getWithRelations(int $id)
    {
        return $this->select('blog_posts.*, users.username as author_name, blog_categories.name as category_name')
            ->join('users', 'users.id = blog_posts.author_id', 'left')
            ->join('blog_categories', 'blog_categories.id = blog_posts.category_id', 'left')
            ->find($id);
    }

    /**
     * Get all posts with author and category for admin
     */
    public function getAllWithRelations(): array
    {
        return $this->select('blog_posts.*, users.username as author_name, blog_categories.name as category_name')
            ->join('users', 'users.id = blog_posts.author_id', 'left')
            ->join('blog_categories', 'blog_categories.id = blog_posts.category_id', 'left')
            ->orderBy('blog_posts.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Increment view count
     */
    public function incrementViews(int $id): bool
    {
        return $this->increment($id, 'view_count');
    }
}
