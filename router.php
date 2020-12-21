<?php

// PAGES
use App\Controller\AbstractController;
use App\Controller\HomeController;
use App\Controller\SecurityController;
use App\Controller\SondageController;

if(array_key_exists("page", $_GET)) {
    switch ($_GET["page"]) {

        case 'home':
            (new HomeController())->renderIndex();
            break;
        case 'login':
            (new SecurityController())->renderLogin();
            break;
        case 'register':
            (new SecurityController())->renderRegister();
            break;
        case 'logout':
            (new SecurityController())->logout();
            break;
        case 'sondage':
            (new SondageController())->renderResponses();
            break;
        case 'sondageResult':
            (new SondageController())->renderResults();
            break;
        case 'profil':
            (new HomeController())->renderProfile();
            break;
        case 'admin':
            (new SondageController())->renderAdmin();
            break;
        case 'getResultsApi':
            (new SondageController())->getResponses__API__();
            break;
        default:
            (new AbstractController(null))->redirectToRoute('home');
            break;
    }

}else {
    $controller = new HomeController();
    $controller->renderIndex();
}
