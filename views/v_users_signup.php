
<form method='POST' action='/users/p_signup'>

    First Name:<br>
    <input type='text' name='first_name'>
    <br><br>

    Last Name:<br>
    <input type='text' name='last_name'>
    <br><br>

    Email:<br>
    <input type='text' name='email'>
    <br><br>

    Password:<br>
    <input type='password' name='password'>
    
    <br><br>
    
    <?php if(isset($error)): ?>
        <div class='error'>
            Sign up failed. Please fill all the fields and submit again.
        </div>
        <br>
    <?php endif; ?>


    <input type='submit' value='Submit'>

</form>
