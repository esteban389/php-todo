<?php
    include __DIR__ . '/db.php';
    require_once __DIR__ . '/error_messages.php';
    global $errorMessages;


    
    function getItems(){
        $GET_ITEMS_QUERY = "SELECT * FROM todoItems ORDER BY id DESC";
        return mysqli_query($GLOBALS['db'],$GET_ITEMS_QUERY);
    }
    
    function insertItem($taskText) {
        global $errorMessages;
    
        if (!empty($taskText)) {
            $INSERT_TASK_QUERY = "INSERT INTO todoItems (text,status) VALUES (?,0)";
            $prepared_statement = mysqli_prepare($GLOBALS['db'], $INSERT_TASK_QUERY);
    
            if ($prepared_statement) {
                mysqli_stmt_bind_param($prepared_statement, "s", $taskText);
                $result = mysqli_stmt_execute($prepared_statement);
    
                if ($result === false) {
                    $error = mysqli_stmt_error($prepared_statement);
                    error_log("MySQL error: $error");
                    mysqli_stmt_close($prepared_statement);
                    return false;
                } else {
                    // Get the ID of the last inserted record
                    $insertedId = mysqli_insert_id($GLOBALS['db']);
                    mysqli_stmt_close($prepared_statement);
                    $response = ['id' =>$insertedId,
                                 'text' =>$taskText,
                                 'status'=>0];
                    return $response; // Return the inserted ID
                }
            } else {
                $error = mysqli_error($GLOBALS['db']);
                error_log("MySQL statement preparation error: $error");
                return QUERY_ERROR_QUERY_PREPARATION;
            }
        } else {
            return QUERY_ERROR_ARGUMENT_TYPE;
        }
    }
    

    function changeStatus($status, $id){
        global $errorMessages;
        if (is_numeric($status) && is_numeric($id)) {
            // Convert $status and $id to integers
            $status = (int)$status;
            $id = (int)$id;
    
            // Validate the $status value (assuming it should be 0 or 1)
            if ($status !== 0 && $status !== 1) {
                // Handle invalid $status value
                return QUERY_ERROR_ARGUMENT_VALUE;
            }
    
            // Continue with the query
            $status = $status == 1 ? 0 : 1;
            $UPDATE_ITEM_STATUS_QUERY = "UPDATE todoItems SET status = ? WHERE id = ?";

            $prepared_statement = mysqli_prepare($GLOBALS['db'], $UPDATE_ITEM_STATUS_QUERY);
            if($prepared_statement){
                mysqli_stmt_bind_param($prepared_statement, "ii", $status, $id);
    
                $result = mysqli_stmt_execute($prepared_statement);
        
                if ($result === false) {
                    // Handle the query error
                    $error = mysqli_stmt_error($prepared_statement);
                    error_log("MySQL error: $error");
                    return false;
                } else {
                    // Query was successful, return the query result
                    return $result;
                }
            }else{
                // Handle the error in preparing the statement
                $error = mysqli_error($GLOBALS['db']);
                error_log("MySQL statement preparation error: $error");
                return false;
            }
                
        } else {
            // Return type error
            return QUERY_ERROR_ARGUMENT_TYPE;
        }
    }

    function removeItem($id){
        global $errorMessages;
        if (is_numeric($id)) {
            // Convert $status and $id to integers
            $id = (int)$id;
    
            $REMOVE_ITEM_QUERY = "DELETE FROM todoItems  WHERE id=?";
    
            $prepared_statement = mysqli_prepare($GLOBALS['db'], $REMOVE_ITEM_QUERY);
            if($prepared_statement){
                mysqli_stmt_bind_param($prepared_statement, "i", $id);
    
                $result = mysqli_stmt_execute($prepared_statement);
    
        
                if ($result === false) {
                    // Handle the query error
                    $error = mysqli_stmt_error($prepared_statement);
                    error_log("MySQL error: $error");
                    mysqli_stmt_close($prepared_statement);
                    return false;
                } else {
                    // Query was successful, return the query result
                    mysqli_stmt_close($prepared_statement);
                    return $result;
                }
            }else{
                // Handle the error in preparing the statement
                $error = mysqli_error($GLOBALS['db']);
                error_log("MySQL statement preparation error: $error");
                return false;
            }
        } else {
            // Return type error
            return QUERY_ERROR_ARGUMENT_TYPE;
        }
    }
?>