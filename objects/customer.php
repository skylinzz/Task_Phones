<?php
class Customer {

    
    private $con;
    private $table_name = "customer";

    private $countries = array(
        array("Cameroon", "237", "/\(237\)\ ?[2368]\d{7,8}$/"),
        array("Ethiopia", "251", "/\(251\)\ ?[1-59]\d{8}$/"),
        array("Morocco", "212", "/\(212\)\ ?[5-9]\d{8}$/"),
        array("Mozambique", "258", "/\(258\)\ ?[28]\d{7,8}$/"),
        array("Uganda", "256", "/\(256\)\ ?\d{9}$/")
    );

    public function __construct($db){
        $this->con = $db;           

    }

    public function read(){
        $query = "SELECT * FROM ". $this->table_name;

        $result = $this->con->query($query);

        return $result;
    }

    public function checkCode($phone){

        if(preg_match('(\(237\)).*', $phone) === 1) return 'Cameroon';
        else if(preg_match('(\(251\)).*', $phone) === 1) return 'Ethiopia';
        else if(preg_match('(\(212\)).*', $phone) === 1) return 'Morocco';
        else if(preg_match('(\(258\)).*', $phone) === 1) return 'Mozambique';
        else if(preg_match('(\(256\)).*', $phone) === 1) return 'Uganda';
        else return 'Erro';
    }

    public function getCountry($phone){
        // check if match is found
        if (preg_match_all("/\((\d+)\).*/", $phone, $matches) == 1){
            
            foreach($this->countries as $country){
                if ($country[1] == $matches[1][0]){
                    return $country[0];
                }
            }
        }
        return "Country not Found";
    }


    public function validate($phone){
        if (preg_match_all("/\((\d+)\).*/", $phone, $matches) == 1){
            
            foreach($this->countries as $country){
                if ($country[1] == $matches[1][0]){
                    if (preg_match_all($country[2], $phone) === 1) return 'Valid';

                    return 'Invalid';
                }
        
            }
        }
        return False;
    }

    public function filter_by_country($country_prefix){
        $striped = htmlspecialchars(strip_tags($country_prefix));

        $query = "SELECT * FROM customer WHERE phone LIKE '(".$striped.")%'";

        $result = $this->con->query($query);

        return $result;
    }

   
}
?>