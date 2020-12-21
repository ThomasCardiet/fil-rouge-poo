<?php


namespace App\Controller;

use App\Model\UserModel;
use Core\security\Auth;

class SecurityController
    extends AbstractController
{

    public function __construct()
    {
        parent::__construct(new UserModel());
    }

    public function renderRegister()
    {

        if ($this->auth->islogged()) {
            $this->redirectToRoute('home');
            return;
        }

        $msg = [];

        if (!empty($_POST)) {
            if (!empty($_POST['user_name']) && !empty($_POST['user_email']) && !empty($_POST['user_password'])) {
                $username = $_POST['user_name'];
                $email = $_POST['user_email'];
                $password = $_POST['user_password'];

                if ($this->model->getUserBy('username', $username) !== false) {
                    $msg['error'] = 'Ce pseudo est déjà utilisé.';
                } elseif ($this->model->getUserBy('email', $email) !== false) {
                    $msg['error'] = 'Cet email est déjà utilisé.';
                } else {
                    $this->model->addUser($username, $email, $password);
                    $this->redirectToRoute('home');
                    return;
                }
            } else {
                $msg['error'] = 'Merci de remplir tous les champs.';
            }

        }

        require $this->render("inscriptionView.php");
    }

    public function renderLogin()
    {

        if ($this->auth->islogged()) {
            $this->redirectToRoute('home');
            return;
        }

        $msg = [];

        if (!empty($_POST)) {
            if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
                $username = $_POST['user_name'];
                $password = $_POST['user_password'];

                $auth_value = $this->auth->login($username, $password);
                if ($auth_value) {
                    $this->redirectToRoute('home');
                    return;
                } else {
                    $msg['error'] = 'Le pseudo ou le mot de passe est incorrect.';
                }


            } else {
                $msg['error'] = 'Merci de remplir tous les champs.';
            }

        }

        require $this->render("connexionView.php");

    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->redirectToRoute('home');
        exit();
    }
}