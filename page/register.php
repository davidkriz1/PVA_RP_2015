<form method="post" action="index.php?page=register" id="registerform" class="formregister" autocomplete="off">
  <div class="registerdiv">
    <div class="registertextdiv">
      <span class="registerusername"> Jméno: </span><br />
      <span class="registerpassword"> Heslo: </span><br />
      <span class="registerpassword1"> Znovu: </span><br />
      <span class="registeremail"> E-mail: </span>
    </div>
    <div class="inputregisterdiv">
      <input type="text" class="inputedit" name="RegisterLogin" placeholder="Username" value="<?php if(isset($RegisterLogin)){ echo $RegisterLogin;} ?>"> 
      <input type="password" class="inputedit" name="RegisterPassword1" placeholder="Password">
      <input type="password" class="inputedit" name="RegisterPassword2" placeholder="Password2">
      <input type="text" class="inputedit" name="RegisterEmail" placeholder="E-mail" value="<?php if(isset($RegisterEmail)) { echo $RegisterEmail;} ?>">
    </div>
  </div>          
  <input type="submit" name="register" id="registerbutton" class="submit" value="Zaregistrovat">
</form>