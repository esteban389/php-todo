<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title><b>FIBr-List</b></title>

</head>
<body>
<div class="container mt-5">
    <h1>FIBr-List</h1>
    <form id="agregarTareaForm">
        <input type="text" id="Nueva Tarea" class="form-control" placeholder="nueva Tarea" onkeyup="myFunction()" required>
        <button type="submit" class="btn btn-primary mt-2">Agregar Tarea</button>
    </form>
    
    <ul id="List" class="list-group mt-3">

    <div class="list-group">
    <li> <a href="#" class="list-group-item list-group-item-success">levantarse</a> </li>
    <li> <a href="#" class="list-group-item list-group-item-info">tender la cama</a> </li>
    <li> <a href="#" class="list-group-item list-group-item-warning">aseo personal</a> </li>
    <li> <a href="#" class="list-group-item list-group-item-danger">darle comida a el gato</a> </li>
  </div>

    </ul>

  <script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("Nueva Tarea");
    filter = input.value.toUpperCase();
    ul = document.getElementById("List");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>

</div>

</body>
</html>