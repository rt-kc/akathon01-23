<?php 
session_start();

include("./conn/func.php");
// Get the submitted department number
$department_num = $_POST['departments'];

// Get the submitted names and hosts as arrays
$name = $_POST['name'];
$host = $_POST['host'];


$output = array();

for ($i = 0; $i < $department_num; $i++) {
  $item = array('key' => $name[$i], 'value' => $host[$i]);
  array_push($output, $item);
}

$rdata = [
    "vlans" => $output
];

$response = updateData("users", $rdata, $_SESSION['userid']);

echo $response;

$op = convertVlan($rdata);

echo $op;
?>

<script>
// Assign the JSON data to a JavaScript variable
var jsonData = <?php echo $op; ?>;

// Now you can use the jsonData variable in your JavaScript code
console.log(jsonData);
</script>

<?php header('Location: ./cryptoscam.php'); ?>