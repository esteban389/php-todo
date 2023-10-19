function createTodoItemHTML(task){
    return `<li class='list-group-item d-flex justify-content-between align-items-center' id=${task.id} data-status=${task.status}>
        <span>${task.text}</span>
        <div>
            <button class='btn btn-success' type='submit' onclick='updateStatus(this)'>
                Check
            </button>
            <button class='btn btn-danger' type='submit' onclick='deleteTask(this)'>
                Remove
            </button>
        </div>
    </li>`;
}

fetch("./backend/tasks.php")
    .then(response =>{
        if(!response.ok){
            throw new Error('Página no encontrada');
        }
        return response.json();
    })
    .then(json =>{
        let listContainer = document.getElementById("todo-list");
        listContainer.innerHTML = "";
        
        json.forEach(task => {
            console.log(task);
            let todoItemHTML =  createTodoItemHTML(task);

            listContainer.innerHTML += todoItemHTML;
        });

    });

document.getElementById("taskForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission

    const taskInput = document.getElementById("task");
    const taskText = taskInput.value;

    if (taskText.trim() !== "") {
        const formData = new FormData();
        formData.append("task", taskText);
        const formDataJSON = {};
        formData.forEach((value, key) => {
            formDataJSON[key] = value;
        });
        fetch("./backend/tasks.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json", // Set the content type to JSON
            },
            body: JSON.stringify(formDataJSON),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Failed to add task");
                }
                taskInput.value = ""; // Clear the input field
                console.log(response)
                return response.json();
            })
            .then(json =>{
                let listContainer = document.getElementById("todo-list");
                console.log(json) 
                let todoItemHTML =  createTodoItemHTML(json);

                listContainer.innerHTML = todoItemHTML + listContainer.innerHTML;
            })
            .catch(error => {
                console.error(error);
            });
    }
});



function updateStatus(button){
    let liElement = button.closest('li');
    let id = liElement.getAttribute('id');
    let status = liElement.getAttribute('data-status');
    let dataObject = {"id":id,"status":status};
    let dataJson = JSON.stringify(dataObject);
    fetch(`./backend/tasks.php?taskId=${id}`,{
            method: "PUT",
            headers: {'Content-Type':"application/json"},
            body:dataJson
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Página no encontrada');
            }else{
                return response.json()
            }
        })
        .then(json=>{
            liElement.setAttribute("data-status",json.updatedStatus );
        })
        .catch(error => {
            console.error(error.message);
        });
}

function deleteTask(button){
    let liElement = button.closest('li');
    let id = liElement.getAttribute('id');
    let dataObject = {"id":id};
    let dataJson = JSON.stringify(dataObject);
    fetch(`./backend/tasks.php?taskId=${id}`,{
            method: "DELETE",
            headers: {'Content-Type':"application/json"},
            body:dataJson
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Página no encontrada');
            }else{
                liElement.remove();
            }
        })
        .catch(error => {
            console.error(error.message);
        });
}
