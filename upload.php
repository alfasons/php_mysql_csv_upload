<?php

//upload.php

session_start();

$error = '';

$html = '';

if ($_FILES['file']['name'] != '') {
  $file_array = explode(".", $_FILES['file']['name']);

  $extension = end($file_array);

  if ($extension == 'csv') {
    $file_data = fopen($_FILES['file']['tmp_name'], 'r');

    $file_header = fgetcsv($file_data);

    $html .= '<table class="table table-bordered"><tr>';

    for ($count = 0; $count < count($file_header); $count++) {
      $html .= '
   <th>
    <select name="set_column_data" class="form-control set_column_data" data-column_number="' . $count . '">
     <option value="">Set Count Data</option>
     <option value="first_name">First Name</option>
     <option value="last_name">Last Name</option>
     <option value="email">Email</option>
    </select>
   </th>
   ';
    }

    $html .= '</tr>';

    $limit = 0;

    while (($row = fgetcsv($file_data)) !== FALSE) {
      $limit++;

      if ($limit < 6) {
        $html .= '<tr>';

        for ($count = 0; $count < count($row); $count++) {
          $html .= '<td>' . $row[$count] . '</td>';
        }

        $html .= '</tr>';
      }

      $temp_data[] = $row;
    }

    $_SESSION['file_data'] = $temp_data;

    $html .= '
  </table>
  <br />
 
  <div class="step-buttons">
                                <button type="button" class="btn btn-primary" onclick="prevStep(2)">Previous</button>
                               
                                <button type="button" name="import" id="import" class="btn btn-success" disabled>Next</button>
                            </div>
  <br />
  ';
  } else {
    $error = 'Only <b>.csv</b> file allowed';
  }
} else {
  $error = 'Please Select CSV File';
}

$output = array(
  'error'  => $error,
  'output' => $html,
  'test'=>'hellow world  hirchir',
);
logThis('INFO', 'The  output is ' . print_r($output, true));
echo json_encode($output);


function logThis($LEVEL, $logThis)
{
  /*
   * log
   */
  $logFile = "";
  $logLevel = "";
  switch ($LEVEL) {
    case "INFO":
      $logFile = "/var/www/logs/upload/info.log";
      $logLevel = "INFO";
      break;
    case "ERROR":
      $logFile = "/var/www/logs/upload/error.log";
      $logLevel = "ERROR";
      break;

    case "DEBUG":
      $logFile = "/var/www/logs/upload/debug.log";
      $logLevel = "DEBUG";
      break;
    default:
      $logFile = "/var/www/logs/upload/info.log";
      $logLevel = "DEFAULT";
  }

  $e = new Exception();
  $trace = $e->getTrace();
  //position 0 would be the line that called this function so we ignore it
  $last_call = isset($trace[1]) ? $trace[1] : array();
  $lineArr = $trace[0];

  $function = isset($last_call['function']) ? $last_call['function'] . "()|" : "";
  $line = isset($lineArr['line']) ? $lineArr['line'] . "|" : "";
  $file = isset($lineArr['file']) ? $lineArr['file'] . "|" : "";

  $remote_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] . "|" : "";
  $date = date("Y-m-d H:i:s");
  $string = $date . "|$logLevel|$file$function$remote_ip$line" . $logThis . "\n";
  if (!is_file($logFile)) {
    mkdir(dirname($logFile), 0755, true);
    touch($logFile);
  }
  file_put_contents($logFile, $string, FILE_APPEND);
}
