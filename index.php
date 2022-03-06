<!-- INSERT INTO `mynotes` (`sno`, `title`, `description`, `time`) VALUES (NULL, 'Go to market', 'for buy a book', current_timestamp()); -->

<?php 
  $insert = "false";
    // connecting to the database locally
    $severname = "localhost";
    $username = "root";
    $password = "";
    $database = "notes";
    
    //create a connection to the database
    $conn = mysqli_connect($severname, $username, $password, $database);

    // Die if connection was not successful
    if(!$conn){
      die("Sorry we failed to connect " . mysqli_connect_error());
    } else {
      // echo "Connection was Successful";
    }
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
      $title = $_POST["title"];
      $description = $_POST["description"];

      //SQL query to be executed
      $sql = "INSERT INTO   `mynotes` (`title`, `description`) VALUES ('$title', '$description')";
      $result = mysqli_query($conn, $sql);

      //Add alert on add task
      if($result){
        $insert = "true";
      } else {
        echo "error";
      }
    }
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
      $('#myTable').DataTable();
    } );
  </script>
  <title>!Notes - easy notes</title>
</head>

<body>
  <!-- Nav bar start here -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/crud">!Notes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/crud">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- Nav bar end here -->
   <?php
        if($insert){
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Success!</strong> Your note has been inserted successfully.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
  ?> 
  <!-- Forms start here -->
  <div class="conatiner my-4 " >
    <h2>Add a note</h2>
    <form actions="/crud" method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>
  <!-- Forms Ends here -->
  <div class="conatiner my-4" >
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col"> S. No.</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php 
                $sql = "SELECT * FROM `mynotes`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while($row = mysqli_fetch_assoc($result)){
                  $sno = $sno+1;
                  echo "<tr>
                  <th scope='row'>". $sno ."</th>
                  <td>" .  $row['title'] . "</td>
                  <td>" . $row['description'] . "</td>
                  <td> Actions </td>
                </tr>";
                } 
              ?>
      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>