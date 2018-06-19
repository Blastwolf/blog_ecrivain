<?php
$title = 'Page de connection et d\'enregistrement';
ob_start();
?>
    <section class="connect-register-wrapper">
        <div class="connect">
            <h2>Se Connecter : </h2>
            <form class="alt" method="POST" action="index.php?action=connect">

                <label for="user-name">Nom d'utilisateur :</label>
                <input type="text" name="user-name" required id="user-name" value="<?php if (isset($_POST['user-name'])) {
                    echo $_POST['user-name'];
                } ?>">

                <label for="user-pass">Votre mot de passe :</label>
                <input type="password" name="user-pass" required></br>

                <input type="submit" name="connect" value="Se connecter">

                <?php if (isset($messCon)) {
                    echo '<p class="error-connecte-register">' . $messCon . '</p>';
                } ?>

            </form>
        </div>


        <div class="register">

            <h2>S'enregistrer : </h2>

            <form class="alt" method="POST" action="index.php?action=connect">

                <label for="user-name-register">Nom d'utilisateur :</label>
                <input type="text" name="user-name-register" id="user-name-register" required value="<?php if (isset($_POST['user-name-register'])) echo $_POST['user-name-register']; ?>"><br/>

                <label for="user-pass-register">Votre mot de passe :</label><input type="password" name="user-pass-register" required id="user-pass-register"><br/>

                <label for="user-pass-register-verif">Confirmer votre mot de passe :</label><input type="password" name="user-pass-register-verif" required id="user-pass-verif"><br/>

                <input type="submit" name="register">

                <?php if (isset($messReg)) {
                    echo '<p class="error-connecte-register">' . $messReg . '</p>';
                } ?>

            </form>
        </div>
    </section>
<?php
$content = ob_get_clean();
require_once ROOT . '/views/template.php';