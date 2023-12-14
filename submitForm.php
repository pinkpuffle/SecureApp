<html>
<body>
<?php
include 'config.php';
function exceptions_error_handler($severity, $message, $filename, $lineno) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
}

set_error_handler('exceptions_error_handler');

if($_POST){ //check if posted
    main();
}
else {
    echo "Error code: 50";
    exit();
 }

function main(){

    try{
        
        $checks = array_fill(0, 20, true); //array for error checks
        


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
        //petData
        $petData = $_FILES["petData"]["tmp_name"];
        $fileContent = file_get_contents($petData);

        //validation
        //login details
        //username
        if(underL($username, 5) || overL($username, 30)){
            $checks[0] = false;
        }

        //password
        if(underL($password, 5) || overL($password, 30)){
            $checks[1] = false;
        }
        if($repeatPassword != $password){
            $checks[2] = false;
        }

        //personal details
        //first name
        if(underL($username, 1) || overL($firstName, 30)){
            $checks[3] = false;
        }

        //last name
        if(underL($username, 1) || overL($lastName, 30)){
            $checks[4] = false;
        }

        //email
        if(!isValidEmail($email)){
            $checks[5] = false;
        }

        //phone
        if(!isValidPhone(removeSpace($phoneNumber))){
            $checks[6] = false;
        }

        //dob
        if(!isValidDate($dateOfBirth)){
            $checks[7] = false;
        }

        //gender
        if(!in_array($gender, array("male", "female", "non-binary"))){
            $checks[8] = false;
        }

        //address
        //address number
        if(!is_numeric($addressNumber) || underL($addressNumber, 1) || overL($addressNumber, 10)){
            $checks[9] = false;
        }

        //address L1
        if(underL($addressL1, 3) || overL($addressL1, 30)){
            $checks[10] = false;
        }

        //address L2
        if(overL($addressL1, 30)){
            $checks[11] = false;
        }

        //town
        if(underL($town, 3) || overL($town, 30)){
            $checks[12] = false;
        }

        //county
        if(underL($county, 3) || overL($county, 30)){
            $checks[13] = false;
        }

        //postcode
        if(!isValidPostcode($postcode)){
            $checks[14] = false;
        }

        //county
        if(underL($county, 3) || overL($county, 30)){
            $checks[15] = false;
        }

        //pet data 
        if(isJsonValid($fileContent)){ //if JSON is valid
            $petDataArray = json_decode($fileContent, true);
            $attributes = array_keys($petDataArray);

            if($attributes[0] == "name" && $attributes[1] == "type" && $attributes[2] == "age"){ //if attributes formatted correctly
                
                if(!is_numeric($petDataArray["age"])){
                    $checks[18] = false;
                }
            }
            else{
                $checks[17] = false;
            }
        }
        else{
            $checks[16] = false; //not valid
        }

        if(in_array(false, $checks)){ //if any validation checks not pass
            $code = 1;
            foreach($checks as $check){
                if($check == false){ //for each check check if false
                    echo "Error code: " . $code . "<br>"; //print error code
                }
                $code++;
            }
            exit();
        }
        else{
            echo "Database stuff goes here";
        }

    }catch(Exception $e){ //error in validation
        echo "Error code: 51";
        exit();
    }

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
    return preg_match($re, $number);
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
    return preg_replace("/\s+/", "", $input);
}

function isJsonValid($data) { 
    //https://www.geeksforgeeks.org/how-to-validate-json-in-php/
    if (!empty($data)) { 
        return is_string($data) &&  
          is_array(json_decode($data, true)) ? true : false; 
    } 
    return false; 
}





?>

</body>
</html>