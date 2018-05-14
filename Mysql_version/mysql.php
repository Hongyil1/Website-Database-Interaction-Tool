<!DOCTYPE html>
<html>
<head>

</head>
<body>
  <?php
    // // $q = $_POST['id'];
    // echo "$q";
    $id = $_POST['id'];           # prints "value"
    $note = $_POST['notes'];
    // echo $note;

    // Read the first line of mysql
    $servername = "your_server_name"; //localhost
    $username = "your_user_name"; //root
    $password = "your_password";
    $dbname = "your_database_name";
    $tbname = "your_table_name";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($_POST['notes']){
      echo "Submit button";
      // Write notes to the mysql database
      $sql = "UPDATE $tbname SET notes='$note' WHERE id=$id";
      $conn->query($sql);
      $sql = "select * from $tbname where id = $id";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $new_note = $row['notes'];
      echo "id: ".$id." new_note: ".$new_note;
    }
    else {
      echo "Next button\n";

      // query in mysql
      $sql = "select * from $tbname where id = $id";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_assoc();
        // echo "<br> id: ". $row["id"]. " - url: ". $row["url"]. " cms: " . $row["cms"] . "<br>";
        $new_id = $row['id'];
        $new_url = $row['url'];
        $new_cms = $row['cms'];
        echo $new_id."\n";
        echo $new_url."\n";
        echo $new_cms."\n";
        // while($row = $result->fetch_assoc()) {
        //     echo "<br> id: ". $row["id"]. " - url: ". $row["url"]. " cms: " . $row["cms"] . "<br>";
        // }
        // echo "<br> id: ". $row["id"]. " - url: ". $row["url"]. " cms: " . $row["cms"] . "<br>";

      } else {
          echo "No More Results";
      }
    }

    $conn->close();
  ?>
</body>
</html>
