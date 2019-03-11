<?php
/**
* Article Model
*/
class Article
{
  public static function first()
  {
    $connection = mysqli_connect("localhost","root","root");
    if (!$connection) {
      die('Could not connect: ' . mysqli_error());
    }

    mysqli_set_charset($connection, "UTF8");

    mysqli_select_db($connection, "mffc");

    $result = mysqli_query($connection, "SELECT * FROM articles limit 0,1");

    if ($row = mysqli_fetch_array($result)) {
      echo '<h1>'.$row["title"].'</h1>';
      echo '<p>'.$row["content"].'</p>';
    }

    mysqli_close($connection);
  }
}