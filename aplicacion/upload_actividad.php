<?php
$uploads_dir = 'img/actividades';
$name = $_FILES['archivo']['name'];
$loc = $uploads_dir . '/' . $name;

move_uploaded_file($_FILES["archivo"]["tmp_name"], $loc);
