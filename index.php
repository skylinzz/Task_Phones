<?php
include_once 'database/conection.php';
include_once 'objects/customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

$stmt = $customer->read();

if (!$stmt){
    print_r($db->errorInfo());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Eduardo Ribeiro</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/countries.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">-->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

  <script src="js/countries.js"></script>
</head>
<body>
<div class="container">
  <h2>Phone Index</h2>
  <div class="row">
  <div class="col-sm">
    <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">Country</span>
  </div>
  <select class="custom-select" id="countryList" onchange="refreshData('COUNTRY');">
      <option selected value="-1">Select a Country..</option>
      <option value="237">Cameroon</option>
      <option value="251">Ethiopia</option>
      <option value="212">Morocco</option>
      <option value="258">Mozambique</option>
      <option value="256">Uganda</option>
  </select>
</div>
    </div>
    <div class="col-sm">

    <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">Valid</span>
  </div>
  <select class="custom-select" id="isValidOptions" onchange="refreshData('VALID');">
      <option selected value="-1">Select an Option...</option>
      <option value="1">Valid</option>
      <option value="2">Invalid</option>
  </select>
</div>
    </div>
    <div class="col-sm">
    </div>
  </div>
  
  <br>
  <table class="table table-striped table-bordered" id="customersTable">
    <thead>
      <tr>
        <th>Country</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Valid</th>
      </tr>
    </thead>
    <tbody id="myTable">
      <?php foreach($stmt as $a){ ?>
      <tr>
        <td><?=$customer->getCountry($a['phone'])?></td>
        <td><?=$a['name']?></td>
        <td><?=$a['phone']?></td>
        <td><?=$customer->validate($a['phone'])?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
    </div>
    <script>
      $(document).ready(function(){
        $('#customersTable').DataTable({
          responsive: true,
          sDom: 'lrtip',
          "bPaginate": false, 
          "bInfo": false
        });
      });
    </script>
</body>
</html>