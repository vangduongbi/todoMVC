<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Todo</title>
    <link rel="stylesheet" href="../public/style.css">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <?php
                        session_start();
                        if(isset($_SESSION['flash_message'])) {
                            $message = $_SESSION['flash_message'];
                            unset($_SESSION['flash_message']);
                        }
                    ?>
                    <?php if (!empty($message)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $message ?>
                    </div>
                    <?php } ?>
                    <div class="card-body">
                        <form action="./tasks/save" method="post">
                            <h4 class="card-title">Awesome Todo list</h4>
                            <div class="add-items d-flex"> <input name="title" type="text" class="form-control todo-list-input" placeholder="Title"> <button type="submit" class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button> </div>
                            <div class="form-group">
                                <label for="sel1">Select list:</label>
                                <select class="form-control" name="status">
                                    <option value="<?= TasksController::PLANNING ?>">Planning</option>
                                    <option value="<?= TasksController::DOING ?>">Doing</option>
                                    <option value="<?= TasksController::COMPLETE ?>">Complete</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start">Start date:</label>
                                <input type="date" name="start_date">
                            </div>
                            <div class="form-group">
                                <label for="start">End date:</label>
                                <input type="date" name="end_date">
                            </div>
                            <div class="list-wrapper">
                                <ul class="d-flex flex-column-reverse todo-list">
                                    <?php foreach ($works as $work) { ?>
                                    <li class= <?= $work->status == TasksController::COMPLETE ? "completed" : ""; ?>>
                                        <div class="form-check"> 
                                            <label class="form-check-label"> <?= $work->title ?> <i class="input-helper"></i></label>
                                        </div> 
                                        <a href="./tasks/delete?id=<?= $work->id ?>" class="remove mdi mdi-close-circle-outline"></a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
