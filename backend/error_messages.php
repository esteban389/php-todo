<?php


    //The query was successful
    define("QUERY_SUCCESS",1);
    //Passed wrong data type as argument to the query
    define("QUERY_ERROR_ARGUMENT_TYPE", 101);
    //Passed unexpected value as argument to the query
    define("QUERY_ERROR_ARGUMENT_VALUE", 102);
    //There was an error preparing the query
    define("QUERY_ERROR_QUERY_PREPARATION", 103);
    //There was an error executing the query
    define("QUERY_ERROR_QUERY_EXECUTION", 104);
    
    $errorMessages  = [
        QUERY_SUCCESS => "Query completed succesfully",
        QUERY_ERROR_ARGUMENT_TYPE => "Invalid argument type",
        QUERY_ERROR_ARGUMENT_VALUE => "Invalid argument value",
        QUERY_ERROR_QUERY_PREPARATION => "Query preparation failed",
        QUERY_ERROR_QUERY_EXECUTION => "Query execution failed",

    ];
?>