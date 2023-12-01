<html>
<head>
<script>
function validationForm(){
    let username = document.forms["register"]["username"].value;
    let password = document.forms["register"]["password"].value;
    let repeatPassword = document.forms["register"]["repeatPassword"].value;
    let email = document.forms["register"]["email"].value;
    let firstName = document.forms["register"]["firstName"].value;
    let lastName = document.forms["register"]["lastName"].value;
    let dateOfBirth = document.forms["register"]["dateOfBirth"].value;
    let gender = document.forms["register"]["gender"].value;

    let adddressNumber = document.forms["register"]["addressNumber"].value;
    let addressL1 = document.forms["register"]["addressL1"].value;
    let addressL2 = document.forms["register"]["addressL2"].value;
    let town = document.forms["register"]["town"].value;
    let county = document.forms["register"]["county"].value;
    let postcode = document.forms["register"]["postcode"].value;
    let country = document.forms["register"]["country"].value;

}

</script>

</head>

<body>

<h1>Register</h1><br>

<form name="register" action="submitForm.php" onsubmit="return validateForm()" method="post">
    
    <h3>User details</h3>
    <input type="text" id="username" name="username" placeholder="Username"><br>

    <input type="password" id="password" name="password" placeholder="Password"><br>

    <input type="password" id="repeatPassword" name="repeatPassword" placeholder="Repeat password"><br>

    <input type="email" id="email" name="email" placeholder="Email"><br>

    <input type="text" id="firstName" name="firstName" placeholder="First name">
    <input type="text" id="lastName" name="lastName" placeholder="Last name"><br>

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