<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
    $status = $_GET["status"];
    $id = $_GET["id"];
    $taskText = $_GET["taskText"];
    echo todoItem($id,$taskText,$status);
}
function todoItem($id,$taskText,$status){
        echo "
        <li class='list-group-item d-flex justify-content-between align-items-center' id=$id data-status=$status>
            <span>".
            "$taskText</span>
            <div>
                <button class='btn btn-success' type='submit' onclick='updateStatus(this)'>
                    Check
                </button>
                <button class='btn btn-danger' type='submit' onclick='deleteTask(this)'>
                    Remove
                </button>
            </div>
        </li>";
}
?>
