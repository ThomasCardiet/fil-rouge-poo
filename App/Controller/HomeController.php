<?php
namespace App\Controller;

use App\Model\SondageModel;
use App\Model\UserModel;

class HomeController extends AbstractController {

    public function __construct()
    {
        parent::__construct(new UserModel());
    }

    public function renderIndex(){

        $values = [];
        if ($this->auth->islogged()) {
            $poll_model = new SondageModel();
            $values['polls'] = $poll_model->getAll();
        }

        $model = new SondageModel();

        require $this->render("homeView.php");
    }

    public function renderProfile(){

        if (!$this->auth->islogged()) {
            $this->redirectToRoute('home');
            return;
        }

        if(!empty($_POST))
        {
            // CHANGE USERNAME
            if(isset($_POST['change_username_submit'])) {
                $new_username = $_POST['change_username_value'];
                if(!empty($new_username)) {
                    if ($this->model->getUserBy('username', $new_username) !== false) {
                        $msg = 'Ce pseudo est déjà utilisé.';
                    }else {
                        $this->model->updateUser($_SESSION['id'], 'username', $new_username);
                        $msg = "Pseudo modifié avec succès";
                    }
                }else $msg = 'Merci de remplir tous les champs.';
            }

            // CHANGE EMAIL
            if(isset($_POST['change_email_submit'])){
                $new_email = $_POST['change_email_value'];
                if(!empty($new_email)) {
                    if ($this->model->getUserBy('email', $new_email) !== false) {
                        $msg = 'Cet email est déjà utilisé.';
                    }else {
                        $this->model->updateUser($_SESSION['id'], 'email', $new_email);
                        $msg = "Email modifié avec succès";
                    }
                }else $msg = 'Merci de remplir tous les champs.';
            }

            //CHANGE PASSWORD
            if(isset($_POST['change_password_submit'])){
                $new_password = $_POST['change_password_value'];
                if(!empty($new_password)) {
                    $this->model->updateUser($_SESSION['id'], 'password', $new_password);
                    $msg = "Mot de passe modifié avec succès";
                }else $msg = 'Merci de remplir tous les champs.';
            }
        }

        $user = $this->model->getUserBy('id', $_SESSION['id']);

        require $this->render("profileView.php");
    }

}