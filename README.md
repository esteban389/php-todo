# PHP TODO App

## Description
**A simple and lightweight TODO app built with PHP, HTML, JavaScript, and Bootstrap.**

## Project structure
The project is organized into two main folders:

### Frontend
Contains the items related to the front aside from the index file
  - `todo_item.php` : An API endpoint that receives a todo task information as a JSON and responds with an html to
  be rendered in the index

### Backend
Contains all the items related to the back
  - `db.php` : Connection to the MySql database
  - `dbQueries.php` : Functions to make queries to the database
  - `error_messages.php` : Defines constants associated errors
  - `tasks.php` : API endpoint to perform CRUD operations on the tasks

## Installation

The project was built using xampp for the server, this means it requires an apache server, php interpreter and a
mysql database server, I haven't tested the project in other enviroments


