<?php include "includes/functions.php"; ?>
<?php
select_all();
edit_todo();
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style>
        .todo {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 3px;
            border: 1px solid #cccccc;
            margin-top: 5px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="todo text-center">
            <h1>TODO App With PHP and MYSQL</h1>
            <h3>Add a New Todo</h3>
            <form action="" method="post">
                <div class="form-group">

                    <?php
                    $id = $_GET['edit_todo'];
                    $sql = "SELECT * FROM todo WHERE id = {$id}";
                    $results = query($sql);

                    while ($row = mysqli_fetch_assoc($results)) {
                        $name = $row['name'];
                    }
                    ?>
                    <input type="text" class="form-control" name="todo" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="edit_todo" value="Update Todo">
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>ID</th>
                    <th>Todo</th>
                    <th>Date Added</th>
                    <th>Edit Todo</th>
                    <th>Delete Todo</th>
                </thead>
                <tbody>
                    <?php
                    $result= select_all();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $date = $row['date'];

                    ?>

                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><a href="edit.php?edit_todo=<?php echo $id; ?>" name="edit_todo" class="btn btn-primary">Edit todo</a></td>
                            <td><a href="index.php?delete_todo=<?php echo $id; ?>" name="delete_todo" class="btn btn-danger">Delete todo</a></td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>