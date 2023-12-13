<html>
<body>
<?php
include 'config.php';

if($_POST){ $main; } //check if posted
else { error("1"); }

function main(){
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
    //pet data
    $petData = $_POST["petData"];




}

$conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//database functions
function userAlreadyExists($conn, $username){
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$result = $stmt->get_result();
    if(mysqli_num_rows($result) == 0){ return true; } //user exists
}

function insertUser($conn, $username, $password){
    $stmt = $conn->prepare("INSERT INTO users (username, password)
    VALUES (?, ?)");
    $stmt->bind_param("ss",$username,$password);

    if($stmt->execute() === TRUE){
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function getUserID($conn, $username){
    $stmt = $conn->prepare("SELECT userID FROM users WHERE username = ?");
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
    return $row["userID"];
}

function insertUserDetails($conn, $userID, $firstName, $lastName, $email, $phoneNumber, $dateofBirth, $gender){
    $stmt = $conn->prepare("INSERT INTO userdetails (userID, firstName, lastName, email, phoneNumber, dateOfBirth, gender)
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss",$userID, $firstName, $lastName, $lastName, $email, $phoneNumber, $dateOfBirth, $gender);

    if($stmt->execute() === TRUE){;
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function insertAddress($conn, $userID, $addressNumber, $addressL1, $addressL2, $town, $county, $postcode, $country){
    $stmt = $conn->prepare("INSERT INTO addresses (userID, addressNumber, lineOne, lineTwo, town, county, postcode, country)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss",$userID, $addressNumber, $addressL1, $addressL2, $town, $county, $postcode, $country);

    if($stmt->execute() === TRUE){;
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function insertPet($conn, $userID, $petName, $petType, $petAge){
    $stmt = $conn->prepare("INSERT INTO userdetails (userID, name, type, age)
    VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi",$userID, $petName, $petType, $petAge);

    if($stmt->execute() === TRUE){;
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//validation functions
function underL($input, $l){ if(strlen($input) < $l){ return true; } }
function overL($input, $l){ if(strlen($input) > $l){ return true; } }

function isValidEmail($email){
    $re = "/\S+@\S+\.\S+/";
    return preg_match($re, $email);
}

function isValidPhone($number){
    $re = "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im";
    return preg_match($re, $phone);
}

function isValidDate($date) {
    $tempDate = explode('-', $date);
    // checkdate(month, day, year)
    return checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
    //https://stackoverflow.com/a/29093651
  }

function isValidPostcode($postcode){
    $re = "/^[A-Z]{1,2}[0-9]{1,2}[A-Z]{0,1} ?[0-9][A-Z]{2}$/i";
    return preg_match($re, $postcode);
}

function removeSpace($input){
    return preg_replace("/\s/g", "", $input);
}


function error($code){
    echo "Error: code " . $code;
}




?>

</body>
</html>