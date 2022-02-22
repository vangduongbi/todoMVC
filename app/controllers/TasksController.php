<?php

class TasksController
{
    const PLANNING = 1;
    const DOING    = 2;
    const COMPLETE = 3;
    
    /**
     * index
     * @author hosylibi
     * @since 2022-02-22
     */
    public function index()
    {
        $works = Tasks::getAll();

        $viewFile = "app/views/works.php";
        require_once $viewFile;
    }
    
    /**
     * save data post
     * @author hosylibi
     * @since 2022-02-22
     */
    public function save()
    {
        $task  = new Tasks();
    
        if (!empty($_POST) && $error = $task->save($_POST)) {
            session_start();
            $_SESSION['flash_message'] = $error;
        }
        header('Location:../tasks');
    }
    
    /**
     * delete
     * @author hosylibi
     * @since 2022-02-22
     * Delete task
     */
    public function delete()
    {
        $id = $_GET['id'];
        Tasks::delete($id);
        header('Location:../tasks');
    }
}
