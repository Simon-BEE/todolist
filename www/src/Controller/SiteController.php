<?php
namespace App\Controller;

use Core\Controller\Controller;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->loadModel('post');
        $this->loadModel('category');
    }

    public function index()
    {
        $posts = $this->post->all();
        foreach ($posts as $value) {
            $postsWithCateg[] = $value->setCategory($this->category->find($value->getCategoryId()));
        }
        
        return $this->render('site/index.html', [
            'posts' => $postsWithCateg
        ]);
    }

}