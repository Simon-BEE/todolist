<?php
namespace App\Controller;

use Cocur\Slugify\Slugify;
use Core\Controller\Controller;
use Core\Controller\FormController;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->loadModel('category');
        $this->loadModel('post');
    }

    public function show(int $id, string $slug)
    {
        $category = $this->category->find($id);
        if ($category->getSlug() != $slug || 
                $category->getId() != $id) {
            $this->redirect($this->getUri('category_show', [
                'id' => $category->getId(),
                'slug' => $category->getSlug()]));
        }

        $posts = $this->post->findAll($category->getId(), 'category_id');

        return $this->render('category/show.html', [
            'category' => $category,
            'posts' => $posts
        ]);
    }

    public function add()
    {
        $form = new FormController();
        $form->field('name', ['require', 'length' => 5]);

        $errors = $form->hasErrors();
        if (!isset($errors['post'])) {
            $datas = $form->getDatas();

            if (empty($errors)) {
                $slugify = new Slugify();
                $datas['slug'] = $slugify->slugify($datas['name']);
                $verified = $this->verifDatas($datas);
                $this->category->create($verified);
                $this->flash()->addSuccess('La catégorie a bien été ajouté');
                $this->redirect();
            }
        }
        return $this->render('category/add.html');
    }
}