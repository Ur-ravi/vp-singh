<?php

namespace App\Controllers;

use App\Models\PageModel;
use App\Models\FaqModel;

class Pages extends BaseController
{
    protected $pageModel;
    protected $faqModel;

    public function __construct()
    {
        parent::__construct();
        $this->pageModel = new PageModel();
        $this->faqModel = new FaqModel();
    }

    public function about()
    {
        $extraData = [
            'page_title' => 'About V P Singh Advocate',
            'advocate' => (new \App\Models\AdvocateProfileModel())->getProfile(),
            'practice_areas' => (new \App\Models\PracticeAreaModel())->getPublished(),
        ];
        return $this->frontendView('pages/about', $extraData);
    }

    public function view(string $slug)
    {
        $page = $this->pageModel->getBySlug($slug);
        if (!$page) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
        }

        $extraData = [
            'page_title' => $page->seo_title ?: $page->title,
            'meta_description' => $page->seo_description,
            'page' => $page,
            'faqs' => $this->faqModel->getForEntity('page', $page->id),
        ];
        return $this->frontendView('pages/view', $extraData);
    }
}
