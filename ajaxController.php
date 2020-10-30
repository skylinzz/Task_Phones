<?php
include_once 'database/conection.php';
include_once 'objects/customer.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    if (isset($_GET['prefix']) && !empty($_GET['prefix']) && isset($_GET['isValid']) && !empty($_GET['isValid'])){

        $database = new Database();
        $db = $database->getConnection();

        $customer = new Customer($db);

        $prefix = $_GET['prefix'];
        $is_valid = $_GET['isValid'];
 
        $response;

        if ($prefix == -1){
            //get all data!
            $response = $customer->read();
        }else{
            $response = $customer->filter_by_country($prefix);
        }

        $htmlTable = "";
        foreach($response as $a){

            $valid = $customer->validate($a['phone']);;
            //echo $valid;

            if ($is_valid == 2 && $valid != "Invalid") {
                continue;
            }
            if ($is_valid == 1 && $valid !== "Valid"){
                continue;
            }
            
            $htmlTable.= "<tr>
                <td>".$customer->getCountry($a['phone'])."</td>
                <td>".$a['name']."</td>
                <td>".$a['phone']."</td>
                <td>".$valid."</td>
            </tr>";
        }
        echo $htmlTable;
    }
}
?>