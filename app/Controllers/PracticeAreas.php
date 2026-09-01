<?php

namespace App\Controllers;

use App\Models\PracticeAreaModel;
use App\Models\FaqModel;

class PracticeAreas extends BaseController
{
    protected $model;
    protected $faqModel;

    public function __construct()
    {
        parent::__construct();
        $this->model = new PracticeAreaModel();
        $this->faqModel = new FaqModel();
    }

    public function index()
    {
        $extraData = [
            'page_title' => 'Practice Areas | V P Singh Advocate',
            'practice_areas' => $this->model->getPublished(),
        ];
        return $this->frontendView('practice_areas/index', $extraData);
    }

    public function view(string $slug)
    {
        $area = $this->model->getBySlug($slug);
        if (!$area) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Practice area not found');
        }

        $extraData = [
            'page_title' => ($area->seo_title ?: $area->title) . ' | V P Singh Advocate',
            'meta_description' => $area->seo_description,
            'practice_area' => $area,
            'all_areas' => $this->model->getPublished(),
            'faqs' => $this->faqModel->getForEntity('practice_area', $area->id),
        ];
        return $this->frontendView('practice_areas/view', $extraData);
    }
}
