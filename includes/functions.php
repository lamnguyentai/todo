<?php include "db.php"; ?>
<?php


function query($query)
{
    global $connection;
    return mysqli_query($connection, $query);
}

function select_all()
{
    $sql = "SELECT * FROM todo";
    $result = query($sql);

    return $result;
}

function redirect($location)
{
    header("Location: $location");
}

function error_check($result)
{
    global $connection;
    die("Failed" . mysqli_error($connection));
}


function delete_todo()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['todo'])) {
        $todo = $_POST['todo'];
        date_default_timezone_set("Asia/Tokyo");
        $date = date('Y年m月d日 H時i分');
        $sql = "INSERT INTO todo(name, date) VALUES ('$todo', '$date')";
        $result = query($sql);

        if (!$result) {
            error_check($result);
        } else {
            redirect("index.php?todo=added");
        }
    }

    if (isset($_GET['delete_todo'])) {
        $dtl_delete = $_GET['delete_todo'];
        $sql_delete = "DELETE FROM todo WHERE id={$dtl_delete}";
        $result_delete = query($sql_delete);
        redirect("index.php?todo=deleted");
    }
}


function edit_todo(){

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['edit_todo'])) {
    $name = $_POST['todo'];
    date_default_timezone_set("Asia/Tokyo");
    $date = date('Y年m月d日 H時i分');
    $id = $_GET['edit_todo'];
    $sql = "UPDATE todo SET name = '$name', date = '$date' WHERE id = $id";
    $result = query($sql);
    redirect("index.php?todo=updated");
}

}




?>