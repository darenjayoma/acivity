<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "activity";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['submit_create'])){
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO employee (name, position, salary) VALUES ('$name', '$position', '$salary')";

    if ($conn->query($sql) === TRUE) {
        echo "Employee created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$sql = "SELECT * FROM employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Position</th><th>Salary</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["position"]."</td><td>".$row["salary"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


if(isset($_POST['submit_update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $sql = "UPDATE employee SET name='$name', position='$position', salary='$salary' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


if(isset($_POST['submit_delete'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM employee WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>


<form method="post">
    <input type="text" name="name" placeholder="Name">
<select name="position"> 
<option> SELECT POSITION <option>   
<option value ="employee"> employee<option>   
<option value ="manager"> manager<option>   
<option value= "janitor"> janitor<option>   
</select>   
    <input type="text" name="salary" placeholder="Salary">
    <button type="submit" name="submit_create">Create Employee</button>
</form>

<form method="post">
    <input type="text" name="id" placeholder="Employee ID">
    <input type="text" name="name" placeholder="Name">
    <select name="position"> 
    <option> UPDATE POSITION <option>  
<option value ="employee"> employee<option>   
<option value ="manager"> manager<option>   
<option value= "janitor"> janitor<option>   
</select> 
    <input type="text" name="salary" placeholder="Salary">
    <button type="submit" name="submit_update">Update Employee</button>
</form>

<form method="post">
    <input type="text" name="id" placeholder="Employee ID">
    <button type="submit" name="submit_delete">Delete Employee</button>
</form>

<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            margin: 5px;
            padding: 8px;
        }
        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>