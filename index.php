<html>
<head>
<script>
function validationForm(){

}

</script>

</head>

<body>

<form name="register" action="submitForm.php" onsubmit="return validateForm()" method="post">
    
    <input type="text" id="firstName" name="firstName" placeholder="First name">
    <input type="text" id="lastName" name="lastName" placeholder="Last name">
    <br>

    <input type="text" id="username" name="username" placeholder="Username">
    <br>

    <input type="password" id="password" name="password" placeholder="Password">
    <br>

    <input type="password" id="repeatPassword" name="repeatPassword" placeholder="Repeat password">
    <br>

    <input type="email" id="email" name="email" placeholder="Email">
    <br>



</form>



</body>
</html>