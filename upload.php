<html>
  <head>
  <script>
  function delayer(){
    window.location = "index.php"
  }
  </script>
  </head>
<body onLoad="setTimeout('delayer()', 3000)">
<?php
if ((($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 2000000))
//2 mb limit
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else{
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "File successfully saved.";
      }
    }
  }
else
  {
  echo "Invalid file.";
  }
echo "<br/>You will be redirected back to the home page.";
?>
</body>
</html>