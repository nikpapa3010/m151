<?php
// Model
foreach (scandir('./model/') as $file) {
  $path = './model/' . $file;
  if (is_file($path)) {
    require_once $path;
  }
}

// Repository
foreach (scandir('./repository/') as $file) {
  $path = './repository/' . $file;
  if (is_file($path)) {
    require_once $path;
  }
}

// Views
foreach (scandir('./views/') as $file) {
  $path = './views/' . $file;
  if (is_file($path)) {
    require_once $path;
  }
}

?>