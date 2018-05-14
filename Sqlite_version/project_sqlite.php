<!DOCTYPE html>
<?php
$dbname = 'your_database_file_name';
$tbname = 'your_table_name';


try{
  $db = new SQLite3($dbname);
}catch(Exception $e){
  echo $e->getMessage();
}
$sql = "select MIN(id),MAX(id) from $tbname";

$result = $db->query($sql);
try{
  $row = $result->fetchArray(SQLITE3_ASSOC);
}catch(Exception $e){
  echo $e->getMessage();
}

$min_id = $row['MIN(id)'];
$max_id = $row['MAX(id)'];
// echo $min_id;
// echo $max_id;

$sql = "select * from $tbname where id = $min_id";
$result = $db->query($sql);
try{
  // output data of each row
  $row = $result->fetchArray(SQLITE3_ASSOC);
  // echo "<br> id: ". $row["id"]. " - url: ". $row["url"]. " cms: " . $row["cms"] . "<br>";
  $id = $row['id'];
  $url = $row['url'];
  $cms = $row['cms'];

  // while($row = $result->fetch_assoc()) {
  //     echo "<br> id: ". $row["id"]. " - url: ". $row["url"]. " cms: " . $row["cms"] . "<br>";
  // }
} catch(Exception $e){
  echo $e->getMessage();
}
$db->close();
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
    /* #gotob{
      margin-right: 10px;
    } */
    #owner_button{
      padding: 10px 25px;
      margin-left: 10px;
    }

    </style>
    <!-- Jquery function -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

      $(document).ready(function(){
        // notes submit button
        $("#submitb").click(function(e){
          e.preventDefault();
          var id = document.getElementById("saveid").getAttribute("style");
          // alert(id);
          // alert("Begin");
          if($('#notes').val()){
            $.ajax({
              type: 'POST',
              url: 'sqlite.php',
              dataType: 'html',
              data: {'notes': $('#notes').val(),'id':id,},
              success: function(result){
                alert("Submit!");
                alert(result);
              }
            });
          }
          else {
            alert("Please Enter Notes.");
          }
        });

        // Owner submit button
        $("#owner_button").click(function(e){
          e.preventDefault();
          var id = document.getElementById("saveid").getAttribute("style");
          // alert(id);
          // alert("Begin");
          if($('#owners').val()){
            $.ajax({
              type: 'POST',
              url: 'sqlite.php',
              dataType: 'html',
              data: {'owners': $('#owners').val(),'id':id,},
              success: function(result){
                alert("Submit!");
                alert(result);
              }
            });
          }
          else {
            alert("Please Enter Owner.");
          }
        });

        // // Go button
        // $("#gotob").click(function(e){
        //   e.preventDefault();
          // if($('#topage').val()>=<?php echo $min_id; ?> && $('#topage').val()<=<?php echo $max_id; ?>){
        //     $.ajax({
        //       type: 'POST',
        //       url: 'sqlite.php',
        //       dataType: 'html',
        //       data: {'id': $('#topage').val()},
        //       // data: {'id': document.getElementById("#saveid").getAttribute("style") + 1},
        //       success: function(result){
        //         // Return result is a string.
        //         var result_list = result.split("\n");
        //         var return_id = result_list[7];
        //         var return_url = result_list[8];
        //         var return_cms = result_list[9];
        //         $("#showurl").text(return_url);
        //         $("#object").attr("data", return_url);
        //         $("#notes").attr("placeholder", return_cms);
        //         $("#saveid").attr("style", return_id);
        //       }
        //     });
        //   }
        //   else{
        //     alert("Wrong Number");
        //   }
        // });

        // Next button
        $("#nextb").click(function(e){
          e.preventDefault();
          var id = document.getElementById("saveid").getAttribute("style");
          if(id < <?php echo $max_id; ?>){
            alert("Go next website.");
            $.ajax({
              type: 'POST',
              url: 'sqlite.php',
              dataType: 'html',
              data: {'id': Number(id) +1},
              // data: {'id': document.getElementById("#saveid").getAttribute("style") + 1},
              success: function(result){
                // Return result is a string
                var result_list = result.split("\n");
                var return_id = result_list[6];
                var return_url = result_list[7];
                var return_cms = result_list[8];
                $("#showurl").text(return_url);
                $("#object").attr("data", return_url);
                $("#notes").attr("placeholder", return_cms);
                $("#saveid").attr("style", return_id);
                // alert(result);
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
            alert("Go last website.");
            $.ajax({
              type: 'POST',
              url: 'sqlite.php',
              dataType: 'html',
              data: {'id': Number(id) -1},
              // data: {'id': document.getElementById("#saveid").getAttribute("style") + 1},
              success: function(result){
                // Return result is a string
                var result_list = result.split("\n");
                var return_id = result_list[6];
                var return_url = result_list[7];
                var return_cms = result_list[8];
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
        <button id="submitb" type="button" style="float:left;display:block;">Submit</button>
        <div style="float:left;display:block;margin-left: 10px;padding-top:15px;">
          <input id="owners" type="text" placeholder="Input Owner" />
        </div>
        <button id="owner_button" type="button" style="float:left;display:block;">Submit</button>
        <div>
        <button id="nextb" type="button" style="float:right;display:block;">Next</button>
        <button id="lastb" type="button" style="float:right;display:block;">Last</button>
        <!-- <button id="gotob" type="button" style="float:right;display:block;">Go</button> -->
        <!-- <div style="float:right;display:block;margin-right: 10px;padding-top:15px;">
          <input id="topage" type="text" placeholder=<?php echo $min_id; ?>-<?php echo $max_id; ?>>
        </div> -->
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
