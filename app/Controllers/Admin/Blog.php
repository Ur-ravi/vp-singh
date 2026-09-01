<?php

namespace App\Controllers\Admin;

use App\Models\BlogPostModel;
use App\Models\BlogCategoryModel;
use App\Models\BlogTagModel;

class Blog extends BaseController
{
    protected $postModel;
    protected $categoryModel;
    protected $tagModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = new BlogPostModel();
        $this->categoryModel = new BlogCategoryModel();
        $this->tagModel = new BlogTagModel();
    }

    // ========== POSTS ==========

    public function index()
    {
        $extraData = [
            'page_title' => 'Blog Posts',
            'posts' => $this->postModel->getAllWithRelations(),
        ];
        return $this->adminView('blog/index', $extraData);
    }

    public function create()
    {
        $extraData = [
            'page_title' => 'Create Blog Post',
            'post' => null,
            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll(),
        ];
        return $this->adminView('blog/form', $extraData);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|max_length[255]',
            'slug' => 'required|max_length[255]|is_unique[blog_posts.slug]',
            'content' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please fill in all required fields.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'excerpt' => $this->request->getPost('excerpt'),
            'content' => $this->request->getPost('content'),
            'author_id' => $this->auth->id(),
            'category_id' => $this->request->getPost('category_id') ?: null,
            'status' => $this->request->getPost('status') ?: 'draft',
            'published_at' => $this->request->getPost('status') === 'published' ? date('Y-m-d H:i:s') : null,
            'seo_title' => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
        ];

        $featuredImage = $this->uploadImage('featured_image');
        if ($featuredImage) {
            $data['featured_image'] = $featuredImage;
        }

        $postId = $this->postModel->insert($data);

        if ($postId) {
            // Handle tags
            $tags = $this->request->getPost('tags') ?: [];
            $this->syncTags($postId, $tags);
            return redirect()->to('/admin/blog')->with('success', 'Blog post created successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create blog post.');
    }

    public function edit(int $id)
    {
        $post = $this->postModel->find($id);
        if (!$post) {
            return redirect()->to('/admin/blog')->with('error', 'Post not found.');
        }

        $postTags = $this->db->table('blog_post_tags')->where('post_id', $id)->get()->getResult();
        $post->tag_ids = array_column($postTags, 'tag_id');

        $extraData = [
            'page_title' => 'Edit Blog Post',
            'post' => $post,
            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll(),
        ];
        return $this->adminView('blog/form', $extraData);
    }

    public function update(int $id)
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'excerpt' => $this->request->getPost('excerpt'),
            'content' => $this->request->getPost('content'),
            'category_id' => $this->request->getPost('category_id') ?: null,
            'status' => $this->request->getPost('status') ?: 'draft',
            'seo_title' => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
        ];

        if ($this->request->getPost('status') === 'published' && !$this->request->getPost('published_at')) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        $featuredImage = $this->uploadImage('featured_image');
        if ($featuredImage) {
            $data['featured_image'] = $featuredImage;
        }

        if ($this->postModel->update($id, $data)) {
            $tags = $this->request->getPost('tags') ?: [];
            $this->syncTags($id, $tags);
            return redirect()->to('/admin/blog')->with('success', 'Blog post updated successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update blog post.');
    }

    public function delete(int $id)
    {
        if ($this->postModel->delete($id)) {
            $this->db->table('blog_post_tags')->where('post_id', $id)->delete();
            return redirect()->to('/admin/blog')->with('success', 'Blog post deleted.');
        }
        return redirect()->to('/admin/blog')->with('error', 'Failed to delete post.');
    }

    protected function syncTags(int $postId, array $tagIds): void
    {
        $this->db->table('blog_post_tags')->where('post_id', $postId)->delete();
        foreach ($tagIds as $tagId) {
            if (!empty($tagId)) {
                $this->db->table('blog_post_tags')->insert([
                    'post_id' => $postId,
                    'tag_id' => (int) $tagId,
                ]);
            }
        }
    }

    // ========== CATEGORIES ==========

    public function categories()
    {
        $extraData = [
            'page_title' => 'Blog Categories',
            'categories' => $this->categoryModel->findAll(),
        ];
        return $this->adminView('blog/categories', $extraData);
    }

    public function storeCategory()
    {
        $name = $this->request->getPost('name');
        $slug = $this->request->getPost('slug') ?: self::slugify($name);

        $this->categoryModel->insert([
            'name' => $name,
            'slug' => $slug,
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/admin/blog/categories')->with('success', 'Category created.');
    }

    public function deleteCategory(int $id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to('/admin/blog/categories')->with('success', 'Category deleted.');
    }

    // ========== TAGS ==========

    public function tags()
    {
        $extraData = [
            'page_title' => 'Blog Tags',
            'tags' => $this->tagModel->findAll(),
        ];
        return $this->adminView('blog/tags', $extraData);
    }

    public function storeTag()
    {
        $name = $this->request->getPost('name');

        $this->tagModel->insert([
            'name' => $name,
            'slug' => self::slugify($name),
        ]);

        return redirect()->to('/admin/blog/tags')->with('success', 'Tag created.');
    }

    public function deleteTag(int $id)
    {
        $this->tagModel->delete($id);
        return redirect()->to('/admin/blog/tags')->with('success', 'Tag deleted.');
    }

    /**
     * Generate a URL-friendly slug from a string.
     */
    protected static function slugify(string $text): string
    {
        // Transliterate non-ASCII characters
        if (function_exists('iconv')) {
            $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        }
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9\-]/', '-', $text);
        $text = preg_replace('/-+/', '-', $text);
        return trim($text, '-');
    }

    protected function uploadImage(string $fieldName): ?string
    {
        $file = $this->request->getFile($fieldName);
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadDir = ROOTPATH . 'public/uploads/blog';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newName = 'blog_' . time() . '_' . bin2hex(random_bytes(8)) . '.' . $file->getExtension();
            $file->move($uploadDir, $newName, true);
            return 'uploads/blog/' . $newName;
        }
        return null;
    }
}
