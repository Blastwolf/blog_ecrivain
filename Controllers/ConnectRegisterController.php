<?php
require_once ROOT . '/models/ConnectRegisterManager.php';

class ConnectRegisterController
{

    static public function connectUser($userName, $password)
    {

        $connectResgisterManager = new ConnectRegisterManager();
        $result = $connectResgisterManager->connectUser($userName, $password);
        $isPasswordCorrect = password_verify($password, $result['pass']);
        if ($isPasswordCorrect && $connectResgisterManager->validUser($userName)) {
            $_SESSION['user'] = $userName;
            require ROOT . '/views/viewAccueil.php';

        } else {
            $messCon = 'invalide utilisateur password';
            require ROOT . '/views/viewConnectRegister.php';
        }

    }

    static function deconnectUser()
    {
        $_SESSION = [];
        session_destroy();

    }

    static public function addUser($userName, $password, $verif_pass)
    {
        $userNameSafe = htmlspecialchars($userName);
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $verif_pass_hash = password_verify($verif_pass, $pass_hash);

        if (isset($userName) && ($verif_pass_hash)) {
            $connectResgisterManager = new ConnectRegisterManager();
            /*--------On test si le pseudo est deja prit------------*/
            if (!$connectResgisterManager->validUser($userNameSafe)) {
                $connectResgisterManager->addUser($userNameSafe, $pass_hash);
                require ROOT . '/views/viewAccueil.php';
            } else {
                $messReg = 'Cet nom d\'utilisateur est déjà prit';
                require ROOT . '/views/viewConnectRegister.php';
            }
        } else {
            $messReg = 'Mot de passe différents';
            require ROOT . '/views/viewConnectRegister.php';
        }
    }

}
