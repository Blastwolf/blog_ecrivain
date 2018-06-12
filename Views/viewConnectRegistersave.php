<?php
$title = 'Page de connexion';
ob_start();
?>
    <div class="connectRegister-Wrapper">
        <div class="connect-block">
            <h2>Se Connecter : </h2>
            <form class="connect" method="POST" action="index.php?action=connect">
                <label for="user-name">Nom d'utilisateur :</label><input type="text" name="user-name" required
                                                                         id="user-name"><br/>
                <label for="user-pass">Votre mot de passe :</label><input type="password" name="user-pass" required
                                                                          id="user-pass"><br/>
                <input type="submit" name="connect">
                <p style="color:red"><?php if (isset($messCon)) {
                        echo $messCon;
                    } ?></p>
            </form>
        </div>
        <div class="register-block">
            <h2>S'enregistrer : </h2>
            <form class="register" method="POST" action="index.php?action=connect">
                <label for="user-name">Nom d'utilisateur :</label><input type="text" name="user-name-register"
                                                                         id="user-name-register" required
                                                                         value="<?php if (isset($_POST['user-name-register'])) echo $_POST['user-name-register']; ?>"><br/>
                <label for="user-pass">Votre mot de passe :</label><input type="password" name="user-pass-register"
                                                                          required
                                                                          id="user-pass-register"><br/>
                <label for="user-pass">Confirmer votre mot de passe :</label><input type="password"
                                                                                    name="user-pass-register-verif"
                                                                                    required
                                                                                    id="user-pass-verif"><br/>
                <input type="submit" name="register">
                <p style="color:red;"><?php if (isset($messReg)) {
                        echo $messReg;
                    } ?></p>
            </form>
        </div>
    </div>
<?php
$content = ob_get_clean();
require_once ROOT . '/views/template.php';