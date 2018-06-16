<?php
require_once ROOT . '/models/ConnectRegisterManager.php';

class ConnectRegisterController
{
    private $connectRegisterManager;
    private $viewFrontendController;

    function __construct()
    {
        $this->connectRegisterManager = new ConnectRegisterManager();
        $this->viewFrontendController = new ViewFrontendController();
    }

    public function connectUser($userName, $password)
    {
        $result = $this->connectRegisterManager->getUserDetails($userName);
        $isPasswordCorrect = password_verify($password, $result['pass']);
        if ($isPasswordCorrect && $this->connectRegisterManager->validUser($userName)) {
            $_SESSION['user'] = $userName;
            $this->viewFrontendController->showAccueil();
        } else {
            $messCon = 'Combinaison mot de passe/utilisateur incorrect';
            require ROOT . '/views/viewConnectRegister.php';
        }
    }

    public function deconnectUser()
    {
        $_SESSION = [];
        session_destroy();

    }

    public function addUser($userName, $password, $verif_pass)
    {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $verif_pass_hash = password_verify($verif_pass, $pass_hash);

        if (isset($userName) && ($verif_pass_hash)) {
            /*--------On test si le pseudo est deja prit------------*/
            if (!$this->connectRegisterManager->validUser($userName)) {
                $this->connectRegisterManager->addUser($userName, $pass_hash);
                $this->viewFrontendController->showAccueil();
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
