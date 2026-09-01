<?php

namespace App\Controllers\Admin;

use App\Models\PageModel;

class PolicyPages extends BaseController
{
    protected $model;

    /** Known policy page slugs — add new policies here */
    protected array $policySlugs = [
        'privacy-policy',
        'terms-conditions',
        'legal-disclaimer',
        'refund-cancellation-policy',
        'cookie-policy',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->model = new PageModel();
    }

    /**
     * List all policy pages
     */
    public function index()
    {
        $pages = $this->model
            ->whereIn('slug', $this->policySlugs)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        // Rebuild slug→page map so we can show all policies even if a row is missing
        $found = [];
        foreach ($pages as $p) {
            $found[$p->slug] = $p;
        }

        $allPolicies = [];
        foreach ($this->policySlugs as $slug) {
            $allPolicies[$slug] = $found[$slug] ?? (object) [
                'id'            => null,
                'title'         => ucwords(str_replace('-', ' ', $slug)),
                'slug'          => $slug,
                'content'       => '',
                'is_published'  => 0,
                'sort_order'    => 0,
                'seo_title'     => '',
                'seo_description' => '',
                '_needs_create' => true,
            ];
        }

        $extraData = [
            'page_title' => 'Policy Pages',
            'policies'   => $allPolicies,
        ];
        return $this->adminView('policy_pages/index', $extraData);
    }

    /**
     * Edit a single policy page (create row first if it does not exist)
     */
    public function edit(string $slug)
    {
        $page = $this->model->where('slug', $slug)->first();

        // If the page doesn't exist yet in the DB, pre-fill defaults
        if (!$page) {
            $page = (object) [
                'id'              => null,
                'title'           => ucwords(str_replace('-', ' ', $slug)),
                'slug'            => $slug,
                'content'         => '',
                'excerpt'         => '',
                'template'        => 'default',
                'featured_image'  => null,
                'is_published'    => 1,
                'sort_order'      => 0,
                'seo_title'       => '',
                'seo_description' => '',
                'seo_og_image'    => null,
                'seo_canonical'   => null,
                'seo_robots'      => 'index, follow',
                '_needs_create'   => true,
            ];
        }

        $extraData = [
            'page_title' => 'Edit Policy: ' . $page->title,
            'page'       => $page,
        ];
        return $this->adminView('policy_pages/form', $extraData);
    }

    /**
     * Store or update a policy page
     */
    public function save()
    {
        $slug = $this->request->getPost('slug');

        if (!in_array($slug, $this->policySlugs)) {
            return redirect()->to('/admin/policy-pages')->with('error', 'Invalid policy page.');
        }

        $data = [
            'title'           => $this->request->getPost('title'),
            'slug'            => $slug,
            'content'         => $this->request->getPost('content'),
            'excerpt'         => $this->request->getPost('excerpt'),
            'template'        => 'default',
            'is_published'    => $this->request->getPost('is_published') ? 1 : 0,
            'sort_order'      => (int) $this->request->getPost('sort_order'),
            'seo_title'       => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
        ];

        $existing = $this->model->where('slug', $slug)->first();

        if ($existing) {
            if ($this->model->update($existing->id, $data)) {
                return redirect()->to('/admin/policy-pages')->with('success', 'Policy page updated.');
            }
        } else {
            if ($this->model->insert($data)) {
                return redirect()->to('/admin/policy-pages')->with('success', 'Policy page created.');
            }
        }

        return redirect()->back()->withInput()->with('error', 'Failed to save policy page.');
    }

    /**
     * Toggle published status
     */
    public function toggle(string $slug)
    {
        $page = $this->model->where('slug', $slug)->first();
        if ($page) {
            $this->model->update($page->id, [
                'is_published' => $page->is_published ? 0 : 1,
            ]);
            $status = $page->is_published ? 'unpublished' : 'published';
            return redirect()->to('/admin/policy-pages')->with('success', "Policy page {$status}.");
        }
        return redirect()->to('/admin/policy-pages')->with('error', 'Policy page not found.');
    }

    /**
     * Delete a policy page (only removes the DB row, not the slug from the allowed list)
     */
    public function delete(string $slug)
    {
        $page = $this->model->where('slug', $slug)->first();
        if ($page) {
            $this->model->delete($page->id);
            return redirect()->to('/admin/policy-pages')->with('success', 'Policy page deleted.');
        }
        return redirect()->to('/admin/policy-pages')->with('error', 'Policy page not found.');
    }
}
