<?php
namespace App\Controller;

use Core\Controller\Controller;
use Core\Controller\FormController;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->loadModel('task');
    }

    public function todo()
    {
        $tasks = $this->task->all();

        return $this->render('task/todo.html', [
            'tasks' => $tasks
        ]);
    }

    public function addTask()
    {
        $form = new FormController();
        $form->field('name', ['require']);

        $errors = $form->hasErrors();

        if (!isset($errors['post'])) {
            $datas = $form->getDatas();
            $verified = $this->verifDatas($datas);

            if (empty($errors)) {
                if ($this->task->create($verified)) {
                    $task = $this->task->find($this->task->last());
                    $task = $task->objectToArray($task);
                    echo json_encode($task);
                }else{
                    echo "error";
                }
            }else{
                $this->flash()->addAlert('Veillez à remplir correctement le champ');
            }
        }
    }

    public function checkTask()
    {
        $id = $_POST['id'];
        $datetime = new \DateTime();
        $fields['done_at'] = $datetime->format(('Y-m-d H:i:s'));

        if ($this->task->update($id, 'id', $fields)) {
            echo 'ok';
        }else{
            echo 'error';
        }
    }

    public function editTask()
    {
        $id = $_POST['id'];
        $field['name'] = $_POST['name'];

        if($this->task->update($id, 'id', $field)){
            $nameTask = $this->task->find($id)->getName();
            echo $nameTask;
        }else{
            echo 'error';
        }
    }

    public function deleteTask()
    {
        $id = $_POST['id'];

        if ($this->task->delete($id)) {
            echo 'ok';
        }else{
            echo 'error';
        }
    }
}