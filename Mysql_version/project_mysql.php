<!DOCTYPE html>
<?php
// Read the first line of mysql
$servername = "your_server_name"; //localhost
$username = "your_username"; //root
$password = "your_password"; 
$dbname = "your_database_name"; 

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Find the first id
$sql = "select MIN(id),MAX(id) from proj_table";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$min_id = $row['MIN(id)'];
$max_id = $row['MAX(id)'];

// $id = 23;
$sql = "select * from proj_table where id = $min_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
  // echo "<br> id: ". $row["id"]. " - url: ". $row["url"]. " cms: " . $row["cms"] . "<br>";
  $id = $row['id'];
  $url = $row['url'];
  $cms = $row['cms'];
  // while($row = $result->fetch_assoc()) {
  //     echo "<br> id: ". $row["id"]. " - url: ". $row["url"]. " cms: " . $row["cms"] . "<br>";
  // }
} else {
    echo "0 results";
}
$conn->close();
?>

<html>
  <head>
    <style>
    #navbar {
      overflow: hidden;
      background-color: #333;
    }
    button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 25px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 6px 2px;
      cursor: pointer;
    }
    #navbar button:hover {
      background-color: #ddd;
      color: black;
    }
    #nextb{
      margin-right: 10px;
    }
    #lastb{
      margin-right: 10px;
    }
    #submitb{
      padding: 10px 25px;
      margin-left: 10px;
    }
    #gotob{
      margin-right: 10px;
    }

    </style>
    <!-- Jquery function -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

      $(document).ready(function(){
        // submit button
        $("#submitb").click(function(e){
          e.preventDefault();
          var id = document.getElementById("saveid").getAttribute("style");
          // alert(id);
          // alert("Begin");
          if($('#notes').val()){
            $.ajax({
              type: 'POST',
              url: 'mysql.php',
              dataType: 'html',
              data: {'notes': $('#notes').val(),'id':id,},
              success: function(result){
                alert("Submit!");
              }
            });
          }
          else {
            alert("Please Enter Notes.");
          }
        });

        // Go button
        $("#gotob").click(function(e){
          e.preventDefault();
          if($('#topage').val()>=<?php echo $min_id; ?> && $('#topage').val()<=<?php echo $max_id; ?>){
            $.ajax({
              type: 'POST',
              url: 'mysql.php',
              dataType: 'html',
              data: {'id': $('#topage').val()},
              // data: {'id': document.getElementById("#saveid").getAttribute("style") + 1},
              success: function(result){
                // Return result is a string
                var result_list = result.split("\n");
                var return_id = result_list[7];
                var return_url = result_list[8];http://127.0.0.1/project_sqlite.php
                var return_cms = result_list[9];
                $("#showurl").text(return_url);
                $("#object").attr("data", return_url);
                $("#notes").attr("placeholder", return_cms);
                $("#saveid").attr("style", return_id);
              }
            });
          }
          else{
            alert("Wrong Number");
          }
        });

        // Next button
        $("#nextb").click(function(e){
          e.preventDefault();
          var id = document.getElementById("saveid").getAttribute("style");
          // alert(id);
          if(id < <?php echo $max_id; ?>){
            // alert("Begin");
            $.ajax({
              type: 'POST',
              url: 'mysql.php',
              dataType: 'html',
              data: {'id': Number(id) +1},
              // data: {'id': document.getElementById("#saveid").getAttribute("style") + 1},
              success: function(result){
                // Return result is a string
                var result_list = result.split("\n");
                var return_id = result_list[7];
                var return_url = result_list[8];
                var return_cms = result_list[9];
                $("#showurl").text(return_url);
                $("#object").attr("data", return_url);
                $("#notes").attr("placeholder", return_cms);
                $("#saveid").attr("style", return_id);
              }
            });
          }else{
            alert("The Last One.");
          }
        });

        // Last button
        $("#lastb").click(function(e){
          e.preventDefault();
          var id = document.getElementById("saveid").getAttribute("style");
          if(id > <?php echo $min_id; ?>){
            // alert(id);
            // alert("Begin");
            $.ajax({
              type: 'POST',
              url: 'mysql.php',
              dataType: 'html',
              data: {'id': Number(id) -1},
              // data: {'id': document.getElementById("#saveid").getAttribute("style") + 1},
              success: function(result){
                // Return result is a string
                var result_list = result.split("\n");
                var return_id = result_list[7];
                var return_url = result_list[8];
                var return_cms = result_list[9];
                $("#showurl").text(return_url);
                $("#object").attr("data", return_url);
                $("#notes").attr("placeholder", return_cms);
                $("#saveid").attr("style", return_id);
              }
            });
          }else{
            alert("The First One.");
          }
        });

      });
    </script>
  </head>
  <body style="margin:0;">
    <!-- The bar in the top -->
    <div style="position: absolute;width:100%">
      <div id='navbar'>
        <div style="float:left;display:block;color:white;background-color:#4CAF50;padding:0,0,10px;">
          <p id="showurl" style="margin-left: 10px;margin-right:10px;">
            <?php echo $url; ?>
          </p>
          <p id="saveid", style=<?php echo $id; ?>> </p>
        </div>
        <div style="float:left;display:block;margin-left: 10px;padding-top:15px;">
          <input id="notes" type="text" placeholder=<?php echo $cms; ?>>
        </div>
        <div>
        <button id="submitb" type="button" style="float:left;display:block;">Submit</button>
        <button id="nextb" type="button" style="float:right;display:block;">Next</button>
        <button id="lastb" type="button" style="float:right;display:block;">Last</button>
        <button id="gotob" type="button" style="float:right;display:block;">Go</button>
        <div style="float:right;display:block;margin-right: 10px;padding-top:15px;">
          <input id="topage" type="text" placeholder=<?php echo $min_id; ?>-<?php echo $max_id; ?>>
        </div>

      </div>
      <div>
        <object id="object" type="text/html" data=<?php echo $url; ?> width="100%" style="height:calc(100vh - 70px);overflow-y:scroll;"></object>
      </div>
    </div>
    <script>
      window.onscroll = function() {myFunction()};
      var navbar = document.getElementById("navbar");
      var sticky = navbar.offsetTop;
      function myFunction() {
        if (window.pageYOffset >= sticky) {
          navbar.classList.add("sticky")
        } else {
          navbar.classList.remove("sticky");
        }
      }
    </script>

  </body>
</html>
