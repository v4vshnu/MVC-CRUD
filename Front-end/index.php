<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {




  if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['publisher']) && isset($_POST['year'])) {
    $url = "http://localhost:3000/api/v1/library";
    $data = array('title' => $_POST["title"], 'author' => $_POST["author"], 'publisher' => $_POST["publisher"], 'year' => $_POST["year"]);

    // use key 'http' even if you send the request to https://...
    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
      )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */
    }


    $json = file_get_contents($url);
    $json = json_decode($json);
  } else if (isset($_POST['delete'])) {
    $url = "http://localhost:3000/api/v1/library/" . $_POST['delete'];
    // $data = array('title' => $_POST["title"], 'author' => $_POST["author"], 'publisher' => $_POST["publisher"], 'year' => $_POST["year"]);

    // use key 'http' even if you send the request to https://...
    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'DELETE',
        // 'content' => http_build_query($data)
      )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */
    }

    $url = "http://localhost:3000/api/v1/library";
    $json = file_get_contents($url);
    $json = json_decode($json);
  } else if (isset($_POST['e_title']) && isset($_POST['e_author']) && isset($_POST['e_publisher']) && isset($_POST['e_year'])) {
    $url = "http://localhost:3000/api/v1/library/" . $_POST['e_id'];
    $data = array('title' => $_POST["e_title"], 'author' => $_POST["e_author"], 'publisher' => $_POST["e_publisher"], 'year' => $_POST["e_year"]);

    // use key 'http' even if you send the request to https://...
    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'PUT',
        'content' => http_build_query($data)
      )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */
    }


    $json = file_get_contents($url);
    $json = json_decode($json);


    $url = "http://localhost:3000/api/v1/library";
    $result = file_get_contents($url);
    if ($result === FALSE) { /* Handle error */
    }


    $json = file_get_contents($url);
    $json = json_decode($json);
  }
} else {
  $url = "http://localhost:3000/api/v1/library";

  $result = file_get_contents($url);
  if ($result === FALSE) { /* Handle error */
  }


  $json = file_get_contents($url);
  $json = json_decode($json);
}
// $title = $json->results[0]->title;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CRUD Table</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto|Varela+Round'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="container">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h1>Library Books</h1>
          </div>

        </div>
      </div>
      <table class="table table-striped table-hover">
        <thead>
          <div class="col-sm-6" style="margin-left: 830px">
            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Book</span></a>
            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete Books</span></a>
          </div>
          <tr>
            <th>
              <span class="custom-checkbox">
                <input type="checkbox" id="selectAll">
                <label for="selectAll"></label>
              </span>
            </th>
            <th>Book ID</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Year</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($json->data as $value) { ?>
            <tr>
              <td>
                <span class="custom-checkbox">
                  <input type="checkbox" id=name="options[]" value="1">
                  <label for="checkbox1"></label>
                </span>
              </td>
              <td> <?php echo $value->id; ?></td>
              <td> <?php echo $value->title; ?></td>
              <td> <?php echo $value->author; ?></td>
              <td> <?php echo $value->publisher; ?></td>
              <td> <?php echo $value->year; ?></td>
              <td>
                <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="clearfix" style="margin-left: 830px;">
        <ul class="pagination">
          <li class="page-item disabled"><a href="#">Previous</a></li>
          <li class="page-item active"><a href="#" class="page-link">1</a></li>
          <li class="page-item"><a href="#" class="page-link">2</a></li>
          <li class="page-item "><a href="#" class="page-link">3</a></li>
          <li class="page-item"><a href="#" class="page-link">4</a></li>
          <li class="page-item"><a href="#" class="page-link">5</a></li>
          <li class="page-item"><a href="#" class="page-link">Next</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Edit Modal HTML -->
  <div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST">
          <div class="modal-header">
            <h4 class="modal-title">Add A Book</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title" required>
            </div>
            <div class="form-group">
              <label>Author</label>
              <input type="text" class="form-control" name="author" required>
            </div>
            <div class="form-group">
              <label>Publisher</label>
              <input type="text" class="form-control" name="publisher" required>
            </div>
            <div class="form-group">
              <label>Year</label>
              <input type="text" class="form-control" name="year" required>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-success" value="Add" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit Modal HTML -->
  <div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method='POST'>
          <div class="modal-header">
            <h4 class="modal-title">Edit Details of A Book</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <label>Book ID</label>
              <input type="text" class="form-control" name="e_id" required>
            </div>
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="e_title" required>
            </div>
            <div class="form-group">
              <label>Author</label>
              <input type="text" class="form-control" name="e_author" required>
            </div>
            <div class="form-group">
              <label>Publisher</label>
              <input type="text" class="form-control" name="e_publisher" required>
            </div>
            <div class="form-group">
              <label>Year</label>
              <input type="number" class="form-control" name="e_year" required>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Delete Modal HTML -->
  <div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method='POST'>
          <div class="modal-header">
            <h4 class="modal-title">Delete Record</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete these Records?</p>

            <label>Book ID</label>
            <input type="text" class="form-control" name="delete" required>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-danger" value="Delete">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- partial -->
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <script src="./main.js"></script>

</body>

</html>