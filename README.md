# PHP TODO App

## Description
**A simple and lightweight TODO app built with PHP, HTML, JavaScript, and Bootstrap.**

## Project structure
The project is organized into two main folders, along with an index.html file in the root directory:

### Index
It's the only view in the project, on the first load it makes a fetch request to get all the todo tasks once it is fetched it also makes a request with each task to get an html to be displayed
It contains updateStatus and deleteTask javascript functions which make API requests with the appropiate http methods and if the result is succesful there is a response in the interface

### Frontend
Contains the items related to the front aside from the index file
  - `todo_item.php` : An API endpoint that receives a todo task information as a JSON and responds with an html to be rendered in the index

### Backend
Contains all the items related to the back
  - `db.php` : Connection to the MySql database
  - `dbQueries.php` : Functions to make queries to the database
  - `error_messages.php` : Defines constants associated errors
  - `tasks.php` : API endpoint to perform CRUD operations on the tasks

## Installation

The project was built using xampp for the server, this means it requires an apache server, php interpreter and a mysql database server, I haven't tested the project in other enviroments


