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
    $owner = $_POST['owners'];
    // echo $note;
    // echo $id;

    //Create connection
    try{
      $db = new SQLite3('kentproj');
    }catch(Exception $e){
      echo $e->getMessage();
    }

    if($_POST['notes']){
      echo "Note Submit button\n";
      // Write notes to the mysql database
      $sql = "UPDATE proj_table SET notes='$note' WHERE id=$id";
      $db->query($sql);

      $sql = "select * from proj_table where id = $id";
      $result = $db->query($sql);
      $row = $result->fetchArray(SQLITE3_ASSOC);
      $new_note = $row['notes'];
      echo "id: ".$id." new_note: ".$new_note;
    }
    if($_POST['owners']){
      echo "Owner Submit button";
      // Write notes to the mysql database
      $sql = "UPDATE proj_table SET owner='$owner' WHERE id=$id";
      $db->query($sql);
      $sql = "select * from proj_table where id = $id";
      $result = $db->query($sql);
      $row = $result->fetchArray(SQLITE3_ASSOC);
      $new_owner = $row['owner'];
      echo "id: ".$id." new_owner: ".$new_owner;
    }
    else {
      // echo "Next button\n";

      // query in mysql
      $sql = "select * from proj_table where id = $id";
      $result = $db->query($sql);

      // output data of each row
      $row = $result->fetchArray(SQLITE3_ASSOC);
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

    }
    $db->close();
  ?>
</body>
</html>
