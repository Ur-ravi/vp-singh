<?php

namespace App\Controllers;

use App\Models\BlogPostModel;
use App\Models\BlogCategoryModel;

class Blog extends BaseController
{
    protected $postModel;
    protected $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = new BlogPostModel();
        $this->categoryModel = new BlogCategoryModel();
    }

    public function index()
    {
        $perPage = 9;
        $page = (int) ($this->request->getGet('page') ?? 1);
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $perPage;

        $posts = $this->postModel->getPublished($perPage, $offset);
        $totalPosts = $this->postModel->getPublishedCount();
        $totalPages = max(1, ceil($totalPosts / $perPage));
        $categories = $this->categoryModel->findAll();

        $extraData = [
            'page_title' => 'Blog | V P Singh Advocate',
            'meta_description' => 'Legal insights and articles by V P Singh Advocate.',
            'posts' => $posts,
            'categories' => $categories,
            'total_posts' => $totalPosts,
            'current_page' => $page,
            'total_pages' => $totalPages,
        ];
        return $this->frontendView('blog/index', $extraData);
    }

    public function view(string $slug)
    {
        $post = $this->postModel->getBySlug($slug);
        if (!$post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Blog post not found');
        }

        // Increment view count
        $this->postModel->incrementViews($post->id);

        // Get related posts
        $related = $this->postModel
            ->where('category_id', $post->category_id)
            ->where('id !=', $post->id)
            ->where('status', 'published')
            ->limit(3)
            ->findAll();

        $extraData = [
            'page_title' => ($post->seo_title ?: $post->title) . ' | V P Singh Advocate',
            'meta_description' => $post->seo_description ?: $post->excerpt,
            'post' => $this->postModel->getWithRelations($post->id),
            'related_posts' => $related,
        ];
        return $this->frontendView('blog/view', $extraData);
    }
}
