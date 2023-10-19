<?php
include __DIR__ . '/dbQueries.php';

function json_encode_mysqliResult($mysqli_result){
    $data = [];

    // Fetch and store data in an array
    while ($row = $mysqli_result->fetch_assoc()) {
        $data[] = $row;
    }
    
    // Encode the array and return as a JSON string
    return json_encode($data);
}
function httpResponse(int $httpCode = 400, $jsonResponse)
{
    http_response_code($httpCode);
    header('Content-Type: application/json');
    if($jsonResponse instanceof mysqli_result){
        echo json_encode_mysqliResult($jsonResponse);
    }else{
        echo json_encode($jsonResponse);
    }
}

function handleDeleteRequest($taskId)
{
    $deleteData = file_get_contents("php://input");
    $requestData = json_decode($deleteData, true);
    if ($requestData === null || !isset($requestData['id'])) {
        httpResponse(400, ['error' => 'Invalid data format or missing data']);
        return;
    }

    if ($requestData['id'] !== $taskId) {
        httpResponse(400, ['error' => 'Invalid data, the id query param and the JSON id must be the same']);
        return;
    }

    $success = removeItem($taskId);
    if ($success) {
        httpResponse(200, ['success' => 'Task has been deleted']);
    } else {
        httpResponse(500, ['error' => 'Failed to delete task']);
    }
    
}

function handlePutRequest($taskId)
{
    $putData = file_get_contents("php://input");
    $requestData = json_decode($putData, true);

    if ($requestData === null || !isset($requestData['status']) || !isset($requestData['id'])) {
        httpResponse(400, ['error' => 'Invalid data format or missing data']);
        return;
    }

    if ($requestData['id'] !== $taskId) {
        httpResponse(400, ['error' => 'Invalid data, the id query param and the JSON id must be the same']);
        return;
    }

    $success = changeStatus($requestData['status'], $requestData['id']);
    if ($success) {
        httpResponse(200, ['success' => 'Status has been changed', 'updatedStatus' => $requestData['status'] == 1 ? 0 : 1]);
    } else {
        httpResponse(500, ['error' => 'Failed to change status']);
    }
}

function handlePostRequest() {
    // Get the JSON data from the request body
    $putData = file_get_contents("php://input");
    $requestData = json_decode($putData, true);

    // Check if the JSON data is valid and contains the required fields
    if ($requestData === null || !isset($requestData['task'])) {
        httpResponse(400, ['error' => 'Invalid data format or missing data']);
        return;
    }


    // Get the task text from the JSON data
    $taskText = $requestData['task'];

    // Insert or update the task in your database (you may need to adapt this part to your database structure)
    $result = insertItem($taskText);
    global $errorMessages;
    if(in_array($result,$errorMessages,true)){
        switch ($result){
            case QUERY_ERROR_ARGUMENT_TYPE:
                httpResponse(400, ['error' => $errorMessages[QUERY_ERROR_ARGUMENT_TYPE]]);
                break;
            case QUERY_ERROR_QUERY_PREPARATION:
                httpResponse(400, ['error' => $errorMessages[QUERY_ERROR_QUERY_PREPARATION]]);
        }
    }
    if ($result) {
        httpResponse(200,$result);
    } else {
        httpResponse(500, ['error' => 'Failed to update task']);
    }
}


$requestMethod = $_SERVER["REQUEST_METHOD"];
$taskId = null;

// Parse the task ID from the URL
if (isset($_GET['taskId'])) {
    $taskId = ($_GET['taskId']);
}

switch ($requestMethod) {
    case "GET":
        if ($taskId === null){
            $tasks = getItems();
            httpResponse(200,$tasks);
        }
        break;
    case "POST":
        handlePostRequest();
        break;
    case "DELETE":
        if ($taskId === null) {
            httpResponse(400, ['error' => 'Invalid Request, must specify a task, add a task ID as a query parameter']);
        } else {
            handleDeleteRequest($taskId);
        }
        break;
    case "PUT":
        if ($taskId === null) {
            httpResponse(400, ['error' => 'Invalid Request, must specify a task, add a task ID as a query parameter']);
        } else {
            handlePutRequest($taskId);
        }
        break;
    default:
        httpResponse(405, ['error' => 'Invalid Request Method']);
        break;
}

?>