<html lang="en" dir="ltr">

<?php require 'db.php'; ?>

<head>
  <meta charset="utf-8">
  <title>test</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <h1 class="navbar-brand">Media Library Sandbox</h1>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div class="container">
    <h3>Current Objects</h3>
    <?php
      $all = getAll();
      if (mysqli_num_rows($all)==0) { echo "No content found!"; }
      else {
        while($row = $all->fetch_assoc()) {
          echo $row['name'] . " " . $row['key'];
          echo "<br/>";
        }
      }
    ?>
  </div>
  <div class="container">
    <form action="upload.php" method="post" enctype="multipart/form-data">
      Select image to upload:
   <div>
     <label for="file-upload"><input type="file" id="file-upload" name="uploadedFile"></label>
   </div>
   <input type="submit" name="uploadBtn" value="Upload" />
    </form>
  </div>

  <div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="key">Key</label>
      <input type="text" id="key" name="key"><br><br>
      <input type="submit" name="findKey" value="Submit">
    </form>
    <?php
    if(isset($_POST) && $_POST["key"]!=="") {
      $url = getURL($_POST["key"]);
      echo <<<IMAGE
        <img src="{$url}" alt='not found'"/>
      IMAGE;

    }
    ?>
  </div>
</body>

</html>
