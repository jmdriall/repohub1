



<?php echo form_open('administrator/login/verify',array('class'=>'login')); ?>
<p>
    <label for="login">Login</label>
    <input type="text" name="login" id="login" placeholder="Login">
</p>

<p>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" placeholder="Password">
</p>
<?php
    if (isset($error))
    {
        echo '<span class="warning">' . $error . '</span>';
    }
?>
<p class="login-submit">
    <button type="submit" class="login-button" id="submit_button" name="submit" >Login</button>
</p>

<p class="forgot-password"><a href="index.html">Forgot your password?</a></p>
<?php echo form_hidden('action', $action);?>
<?php echo form_close();?>