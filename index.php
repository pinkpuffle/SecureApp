<html>
<head>
<script>
function validationForm(){
    var check = true; //check if form is validated

    let username = document.forms["register"]["username"].value;
    let password = document.forms["register"]["password"].value;
    let repeatPassword = document.forms["register"]["repeatPassword"].value;

    let firstName = document.forms["register"]["firstName"].value;
    let lastName = document.forms["register"]["lastName"].value;
    let email = document.forms["register"]["email"].value;
    let phoneNumber = document.forms["register"]["phoneNumber"].value;
    let dateOfBirth = document.forms["register"]["dateOfBirth"].value;
    let gender = document.forms["register"]["gender"].value;

    let adddressNumber = document.forms["register"]["addressNumber"].value;
    let addressL1 = document.forms["register"]["addressL1"].value;
    let addressL2 = document.forms["register"]["addressL2"].value;
    let town = document.forms["register"]["town"].value;
    let county = document.forms["register"]["county"].value;
    let postcode = document.forms["register"]["postcode"].value;
    let country = document.forms["register"]["country"].value;

    //username
    if(noValue(username) || over100(username)){
        check = false;
    }

    if(noValue(password) || over100(password)){
        check = false;
    }

    if(repeatPassword != password){
        check = false;
    }

    return check;
}

function noValue(input){ if(input.length <= 0){return true;} }

function over100(input){ if(input.length > 100{return true;}) }

</script>

</head>

<body>

<h1>Register</h1><br>

<form name="register" action="submitForm.php" onsubmit="return validateForm()" method="post">
    
    <h3>Login details</h3>

    <label for="username">Username</label><br>
    <input type="text" id="username" name="username" placeholder="Username"><br>

    <label for="Password">Password</label><br>
    <input type="password" id="password" name="password" placeholder="Password">
    <input type="password" id="repeatPassword" name="repeatPassword" placeholder="Repeat password"><br>

    <h3>Personal details</h3>

    <label for="name">Name</label><br>
    <input type="text" id="firstName" name="firstName" placeholder="First name">
    <input type="text" id="lastName" name="lastName" placeholder="Last name"><br>
    
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" placeholder="email@example.com"><br>

    <label for="phoneNumber">Phone number</label><br>
    <input type="text" id="tel" name="phoneNumber" placeholder="01234-567891"
    pattern="[0-9]{5}-[0-9]{6}"><br>

    <label for="dateOfBirth">Date of Birth</label><br>
    <input type="date" id="dateOfBirth" name="dateOfBirth"><br>

    <label for="gender">Gender</label><br>
    <input type="radio" id="male" name="gender" value="male">
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female">
    <label for="female">Female</label>
    <input type="radio" id="Non-binary" name="gender" value="Non-binary">
    <label for="non-binary">Non-binary</label><br>
    

    <h3>Address</h3>

    <input type="text" id="addressNumber" name="addressNumber" placeholder="Address number"><br>

    <input type="text" id="addressL1" name="addressL1" placeholder="Address line 1"><br>

    <input type="text" id="addressL2" name="addressL2" placeholder="Address line 2 (optional)"><br>

    <input type="text" id="town" name="town" placeholder="Town/City"><br>

    <input type="text" id="county" name="county" placeholder="County"><br>

    <input type="text" id="postcode" name="postcode" placeholder="Postcode"><br>

    <input type="text" id="country" name="country" placeholder="Country"><br>

    <button class="button">Submit</button>
</form>



</body>
</html>