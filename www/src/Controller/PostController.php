<?php
namespace App\Controller;

use Cocur\Slugify\Slugify;
use Core\Controller\Controller;
use Core\Controller\FormController;

class PostController extends Controller
{
    public function __construct()
    {
        $this->loadModel('post');
        $this->loadModel('category');
    }

    public function show(int $id, string $slug)
    {
        $post = $this->post->find($id);
        if ($post->getSlug() != $slug || 
                $post->getId() != $id) {
            $this->redirect($this->getUri('post_show', [
                'id' => $post->getId(),
                'slug' => $post->getSlug()]));
        }

        $post = $post->setCategory($this->category->find($post->getCategoryId()));
        return $this->render('post/show.html', [
            'post' => $post
        ]);
    }

    public function add(int $id = NULL, string $slug = NULL)
    {
        if($id && $slug){
            $post = $this->post->find($id);
            if ($post->getSlug() != $slug || 
                    $post->getId() != $id) {
                $this->redirect($this->getUri('post_show', [
                    'id' => $post->getId(),
                    'slug' => $post->getSlug()]));
            }
            $post = $post->setCategory($this->category->find($post->getCategoryId()));
        }

        $form = new FormController();
        $form->field('name', ['require', 'length' => 5])
            ->field('category_id', ['require'])
            ->field('content', ['require', 'length' => 50]);

        $errors = $form->hasErrors();
        if (!isset($errors['post'])) {
            $datas = $form->getDatas();

            if (empty($errors)) {
                $slugify = new Slugify();
                $datas['slug'] = $slugify->slugify(\substr($datas['name'], 0, 30));
                $verified = $this->verifDatas($datas);
                if ($post) {
                    if ($this->post->update($id, 'id', $verified)) {
                        $this->flash()->addSuccess('L\'article a bien été modifié');
                        $url = $this->getUri('post_show', [
                            'id' => $id,
                            'slug' => $verified['slug']
                        ]);
                        $this->redirect($url);
                    }else{
                        $this->flash()->addAlert('Erreur de requête');
                        $this->redirect();
                    }
                }else{
                    if ($this->post->create($verified)) {
                        $this->flash()->addSuccess('L\'article a bien été ajouté');
                        $url = $this->getUri('post_show', [
                            'id' => $this->post->last(),
                            'slug' => $verified['slug']
                        ]);
                        $this->redirect($url);
                    }else{
                        $this->flash()->addAlert('Erreur de requête');
                        $this->redirect();
                    }
                }
            }else{
                dd($errors);
            }
        }

        $categories = $this->category->all();
        return $this->render('post/add.html', [
            'categories' => $categories,
            'post' => $post
        ]);
    }

    public function delete($id, $slug)
    {
        $post = $this->post->find($id);
        if ($post->getSlug() != $slug || 
                $post->getId() != $id) {
            $this->redirect($this->getUri('post_show', [
                'id' => $post->getId(),
                'slug' => $post->getSlug()]));
        }

        if ($this->post->delete($post->getId())) {
            $this->flash()->addSuccess('Votre article a bien été supprimé');
            $this->redirect();
        }
    }
}