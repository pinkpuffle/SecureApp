<html>
<body>
<?php
include 'config.php';
//login details
$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);
$repeatPassword = htmlspecialchars($_POST["repeatPassword"]);
//personal details
$firstName = htmlspecialchars($_POST["firstName"]);
$lastName = htmlspecialchars($_POST["lastName"]);
$email = htmlspecialchars($_POST["email"]);
$phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
$dateOfBirth = htmlspecialchars($_POST["dateOfBirth"]);
$gender = htmlspecialchars($_POST["gender"]);
//address
$addressNumber = htmlspecialchars($_POST["addressNumber"]);
$addressL1 = htmlspecialchars($_POST["addressL1"]);
$addressL2 = htmlspecialchars($_POST["addressL2"]);
$town = htmlspecialchars($_POST["town"]);
$county = htmlspecialchars($_POST["county"]);
$postcode = htmlspecialchars($_POST["postcode"]);
$country = htmlspecialchars($_POST["country"]);

$conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

function insertUser($username, $password){

}

function insertUserDetails($firstName, $lastName, $email, $phoneNumber, $dateofBirth, $gender){

}

function insertAddress($addressNumber, $addressL1, $addressL2, $town, $county, $postcode, $country){

}

function insertPet(){

}

?>

</body>
</html>