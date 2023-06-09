<?php
function uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

        // 32 bits for "time_low"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

// 3 tables
function getData($table)
{
    $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/$table/rows/";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            "Content-Type: application/json",
            "Accept: application/json",
            "X-Cassandra-Token: AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39"
        )
    );
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);
    return $data;
}

//admin - users and devices
function deleteData($table, $primaryKey)
{
    $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/$table/$primaryKey";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            "Content-Type: application/json",
            "Accept: application/json",
            "X-Cassandra-Token: AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39"
        )
    );

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function updateData($table, $data, $primaryKey)
{
    $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/$table/$primaryKey";

    $data_string = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            "Content-Type: application/json",
            "Accept: application/json",
            "X-Cassandra-Token: AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39",
        )
    );

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

//users, layouts
function postData($table, $data)
{
    $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/$table";

    $data_string = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            "Content-Type: application/json",
            "Accept: application/json",
            "X-Cassandra-Token: AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39",
        )
    );

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function convertVlan($input)
{
    // Convert the input JSON string to a PHP array
    $vlans = $input["data"]["vlans"];

    // Initialize an empty array to hold the output
    $output = array();

    // Iterate through each VLAN in the input array
    foreach ($vlans as $vlan) {
        // Create a new VLAN object with the specified ID and host
        $vlanObj = array(
            "id" => $vlan["key"],
            "host" => $vlan["value"],
            "port" => array(
                array(
                    "switch" => "",
                    "switchport" => array()
                )
            )
        );

        // Add the new VLAN object to the output array
        $output[] = $vlanObj;
    }

    // Convert the output PHP array to a JSON string and return it
    return json_encode($output);
}

function printVlan($input)
{
    // Convert the input JSON string to a PHP array
    $vlans = json_decode($input, true);

    // Initialize an empty array to hold the output
    $output = array();

    // Iterate through each VLAN in the input array
    foreach ($vlans as $vlan) {
        // Create a new VLAN object with the specified ID and host
        $vlanObj = array(
            "id" => "",
            "host" => $vlan["value"],
            "name" => $vlan["key"],
            "port" => array(
                array(
                    "switch" => "",
                    "switchport" => array()
                )
            )
        );

        // Add the new VLAN object to the output array
        $output[] = $vlanObj;
    }

    // Convert the output PHP array to a JSON string and return it
    return json_encode($output);
}

function convertTime($timestamp)
{
    // Parse the original timestamp string into a DateTime object
    $datetime = new DateTime($timestamp);
    // Convert the DateTime object to the desired format
    $formatted_timestamp = $datetime->format("Y-m-d H:i:s O");
    echo $formatted_timestamp;
}
?>