<?php

    // include('connection/connect.php');

// a function for determining the type of browser
function getUserAgent()
{
    }

// function for extracting IP address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

// function for extracting user's mac address for unix
function unix_os(){
    ob_start();
    system('ifconfig -a');
    $mycom = ob_get_contents(); // Capture the output into a variable
    ob_clean(); // Clean (erase) the output buffer
    $findme = "Physical";
    //Find the position of Physical text 
    $pmac = strpos($mycom, $findme); 
    $mac = substr($mycom, ($pmac + 37), 18);

    return $mac;
    }

// get mac address for windows users
function win_os(){ 
    ob_start();
    system('ipconfig-a');
    $mycom=ob_get_contents(); // Capture the output into a variable
    ob_clean(); // Clean (erase) the output buffer
    $findme = "Physical";
    $pmac = strpos($mycom, $findme); // Find the position of Physical text
    $mac=substr($mycom,($pmac+36),17); // Get Physical Address

    return $mac;
   }


    // get user details
        $user_agent = getUserAgent(); //user browser
        $ip_address = getIp();     // user ip address
        $mac_address = unix_os();   // user mac address
        $page_name = $_SERVER["SCRIPT_NAME"];      // page the user looking
        $current_page = $page_name."?".$query_string; 

echo $ip_address;
echo $mac_address;
exit;
        // get time
        date_default_timezone_set('UTC+3');
        $date = date("Y-m-d");
        $time = date("H:i:s");


    // storing the information to the database
    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        mysqli_query($connect, "INSERT INTO visitors (browser, ip_address, page_name, mac_address, current_page, visitor_date, visitor_time) VALUES ('$user_agent', '$ip_address', '$page_name', '$mac_address', '$current_page', '$date', '$time')");

?>