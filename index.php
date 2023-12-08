<html>
<head>
<script>
function validateForm(){
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
    let petData = document.forms["register"]["petData"].value;

    //reset warnings
    document.getElementById("usernameWarning").innerHTML = "";
    document.getElementById("passwordWarning").innerHTML = "";
    document.getElementById("repeatPasswordWarning").innerHTML = "";
    document.getElementById("firstNameWarning").innerHTML = "";
    document.getElementById("lastNameWarning").innerHTML = "";
    document.getElementById("emailWarning").innerHTML = "";
    document.getElementById("phoneNumberWarning").innerHTML = "";
    document.getElementById("dateOfBirthWarning").innerHTML = "";
    document.getElementById("genderWarning").innerHTML = "";
    document.getElementById("addressNumberWarning").innerHTML = "";
    document.getElementById("addressL1Warning").innerHTML = "";
    document.getElementById("addressL2Warning").innerHTML = "";
    document.getElementById("townWarning").innerHTML = "";
    document.getElementById("countyWarning").innerHTML = "";
    document.getElementById("postcodeWarning").innerHTML = "";
    document.getElementById("countryWarning").innerHTML = "";
    document.getElementById("petDataWarning").innerHTML = "";



    //username
    if(underL(username, 5) || overL(username, 30)){
        document.getElementById("usernameWarning").innerHTML = "Username must be between 5 and 30 characters";
        check = false;
    }

    //password
    if(underL(password, 5) || overL(password, 30)){
        document.getElementById("passwordWarning").innerHTML = "Password must be between 5 and 30 characters";
        check = false;
    }
    if(repeatPassword != password){
        document.getElementById("repeatPasswordWarning").innerHTML = "Passwords must match";
        check = false;
    }


    //first name
    if(underL(username, 1) || overL(firstName, 30)){
        document.getElementById("firstNameWarning").innerHTML = "First name must be between 1 and 30 characters";
        check = false;
    }

    //last name
    if(underL(username, 1) || overL(lastName, 30)){
        document.getElementById("lastNameWarning").innerHTML = "Last name must be between 1 and 30 characters";
        check = false;
    }

    //email
    if(!isValidEmail(email)){
        document.getElementById("emailWarning").innerHTML = "Email must be valid format";
        check = false;
    }

    //phone
    if(!isValidPhone(phoneNumber)){
        document.getElementById("phoneNumberWarning").innerHTML = "Phone number must be valid format";
        check = false;
    }

    //dob
    if(!isValidDate(dateOfBirth)){
        document.getElementById("dateOfBirthWarning").innerHTML = "Date of birth must be valid format";
        check = false;
    }

    //gender
    if(!["male", "female", "non-binary"].includes(gender)){
        document.getElementById("genderWarning").innerHTML = "Must be a valid gender";
        check = false;
    }

    //address number
    if(!isNumber(addressNumber) || underL(addressNumber, 1) || overL(addressNumber, 10)){
        document.getElementById("addressNumberWarning").innerHTML = "Must be a valid number between 1 and 10 characters";
    }


    //address L1
    if(underL(addressL1, 3) || overL(addressL1, 30)){
        document.getElementById("addressL1Warning").innerHTML = "Address line 1 must be betweem 3 and 30 character";
        check = false;
    }

    //address L2
    if(overL(addressL1, 30)){
        document.getElementById("addressL2Warning").innerHTML = "Address line 2 must be under 30 character";
        check = false;
    }

    //town
    if(underL(town, 3) || overL(town, 30)){
        document.getElementById("townWarning").innerHTML = "Town must be between 3 and 30 characters";
        check = false;
    }

    //county
    if(underL(county, 3) || overL(county, 30)){
        document.getElementById("countyWarning").innerHTML = "County must be between 3 and 30 characters";
        check = false;
    }

    //postcode
    if(!isValidPostcode(postcode)){
        document.getElementById("postcodeWarning").innerHTML = "Must be a valid postcode";
        check = false;
    }

    //county
    if(underL(county, 3) || overL(county, 30)){
        document.getElementById("countryWarning").innerHTML = "County must be between 3 and 30 characters";
        check = false;
    }

    //pet data
    if(!isValidJSON(petData)){
        document.getElementById("petDataWarning").innerHTML = "Must be valid JSON";
        check = false;
    }


    check = false; //for testing

    return false;
}

//over and under length
function underL(input, l){ if(input.length < l){return true;} }
function overL(input, l){ if(input.length > l){return true;} }

function isValidEmail(email){
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
    //https://stackoverflow.com/questions/46155/how-can-i-validate-an-email-address-in-javascript
    //may need to be edited
}

function isValidPhone(number){
    var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    return re.test(number);
    //https://stackoverflow.com/a/29767609
}

function isValidDate(d){
    return !isNaN((new Date(d)).getTime());
    //https://stackoverflow.com/a/36000303
}

function isNumber(number){
    try{
        Integer.parseInt(number);
    }catch(e){
        return false;
    }
    return true;
}

function isValidPostcode(postcode){
    var re = /^[A-Z]{1,2}[0-9]{1,2}[A-Z]{0,1} ?[0-9][A-Z]{2}$/i;
    return re.test(postcode);
}

function isValidJSON(jSON){
    try{
        JSON.parse(jSON);
    }catch(e){
        return false;
    }
    return true;
}

</script>

</head>

<body>

<h1>Register</h1><br>

<form name="register" action="submitForm.php" onsubmit="return validateForm()" method="post">
    
    <h3>Login details</h3>

    <label for="username">Username</label><br>
    <input type="text" id="username" name="username" placeholder="Username" required><br>
    <p id="usernameWarning"></p><br>

    <label for="Password">Password</label><br>
    <input type="password" id="password" name="password" placeholder="Password" required>
    <input type="password" id="repeatPassword" name="repeatPassword" placeholder="Repeat password" required><br>
    <p id="passwordWarning"></p><br>
    <p id="repeatPasswordWarning"></p><br>

    <h3>Personal details</h3>

    <label for="name">Name</label><br>
    <input type="text" id="firstName" name="firstName" placeholder="First name" required>
    <input type="text" id="lastName" name="lastName" placeholder="Last name" required><br>
    <p id="firstNameWarning"></p><br>
    <p id="lastNameWarning"></p><br>
    
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" placeholder="email@example.com" required><br>
    <p id="emailWarning"></p><br>

    <label for="phoneNumber">Phone number</label><br>
    <input type="text" id="tel" name="phoneNumber" placeholder="01234-567891"
    pattern="[0-9]{5}-[0-9]{6}" required><br>
    <p id="phoneNumberWarning"></p><br>

    <label for="dateOfBirth">Date of Birth</label><br>
    <input type="date" id="dateOfBirth" name="dateOfBirth" required><br>
    <p id="dateOfBirthWarning"></p><br>

    <label for="gender">Gender</label><br>
    <input type="radio" id="male" name="gender" value="male" required>
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female">
    <label for="female">Female</label>
    <input type="radio" id="Non-binary" name="gender" value="Non-binary">
    <label for="non-binary">Non-binary</label><br>
    <p id="genderWarning"></p><br>
    

    <h3>Address</h3>

    <input type="text" id="addressNumber" name="addressNumber" placeholder="Address number" required><br>
    <p id="addressNumberWarning"></p><br>

    <input type="text" id="addressL1" name="addressL1" placeholder="Address line 1" required><br>
    <p id="addressL1Warning"></p><br>

    <input type="text" id="addressL2" name="addressL2" placeholder="Address line 2 (optional)"><br>
    <p id="addressL2Warning"></p><br>

    <input type="text" id="town" name="town" placeholder="Town/City" required><br>
    <p id="townWarning"></p><br>

    <input type="text" id="county" name="county" placeholder="County" required><br>
    <p id="countyWarning"></p><br>

    <input type="text" id="postcode" name="postcode" placeholder="Postcode" required><br>
    <p id="postcodeWarning"></p><br>

    <input type="text" id="country" name="country" placeholder="Country" required><br>
    <p id="countryWarning"></p><br>

    <h3>Pet information</h3><br>
    JSON format: pets: Pet name, Pet type, Pet age<br>
    <input type="file" name="petData" id="petData"><br><br>
    <p id="petDataWarning"></p><br>

    <button class="button">Submit</button>
</form>


</body>
</html>