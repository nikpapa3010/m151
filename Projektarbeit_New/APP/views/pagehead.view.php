<?php
function drawPageHead(string $title, string $redirect = null, int $redirsec = 0) {
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlspecialchars($title . ' | ' . GeneralVariables::$MainPageName); ?></title>
  
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  
  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="https://upload.wikimedia.org/wikipedia/commons/a/a1/Alpine_skiing_pictogram.svg" sizes="any">

  <?php
    if (isset($redirect)) {
      echo "<meta http-equiv=\"Refresh\" content=\"$redirsec; url='$redirect'\" />";
    }
  ?>

  <style>
    body 
    {
      background-image: url('https://i.pinimg.com/originals/2a/a6/5d/2aa65d6331ade92cdb50e9e84a5de2cd.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;  
      background-size: auto;
    }

    .transbox
    {
      margin: auto;
      background-color: #ffffffe1;
      /* border: 1px solid black; */
      padding: 10px;
    }

    h1 
    {
    text-align: center;
    }
    .nav-link
    {
      color: black !important ;
    }

    .pcenter  
    {
      text-align: center;
    }

    .footer {
      padding: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
<?php
}
?>