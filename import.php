<?php

//import.php

if(isset($_POST["first_name"]))
{
 $connect = new PDO("mysql:host=localhost; dbname=upload_mapping", "admin", "");

 session_start();

 $file_data = $_SESSION['file_data'];

 unset($_SESSION['file_data']);

 foreach($file_data as $row)
 {
  @$data[] = '("'.$row[$_POST["first_name"]].'", "'.$row[$_POST["last_name"]].'", "'.$row[$_POST["email"]].'")';
 }

 if(isset($data))
 {
  $query = "
  INSERT INTO csv_file 
  (first_name, last_name, email) 
  VALUES ".implode(",", $data)."
  ";

  $statement = $connect->prepare($query);

  if($statement->execute())
  {
   echo 'Data Imported Successfully';
  }
 }
}



?>