<?php

session_start();

require_once 'config.php';
require_once 'classes/models/AuthService.php';
require_once 'classes/models/Categorie.php';
require_once 'classes/models/Licencie.php';
require_once 'classes/models/Contact.php';
require_once 'classes/models/Educateur.php';
require_once 'classes/models/Connexion.php';
require_once 'classes/dao/CategorieDAO.php';
require_once 'classes/dao/ContactDAO.php';
require_once 'classes/dao/LicencieDAO.php';
require_once 'classes/dao/EducateurDAO.php';

spl_autoload_register(function ($class) {
include __DIR__ . '/controllers/' . $class . '.php';
});

$connexion = new Connexion(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$categorieDAO = new CategorieDAO($connexion);
$contactDAO = new ContactDAO($connexion);
$licencieDAO = new LicencieDAO($connexion, $categorieDAO, $contactDAO);
$educateurDAO = new EducateurDAO($connexion, $categorieDAO, $contactDAO);

$authService = new AuthService($connexion);

if (isset($_GET['page'])) {
$page = $_GET['page'];
} else {
$page = 'home';
}

if (isset($_GET['action'])) {
$action = $_GET['action'];
} else {
$action = 'index';
}

$controllerName = ucfirst($page) . 'Controller';
$controllerFilePath = 'controllers/' . $controllerName . '.php';

if (file_exists($controllerFilePath)) {
require_once $controllerFilePath;

$requiresAuthentication = in_array($controllerName, ['HomeController', 'EducateurController']);

if ($requiresAuthentication && !isset($_SESSION['educateur'])) {
header('Location: index.php?page=login&action=index');
exit();
}

// Instancier le bon DAO en fonction de la page
switch ($page) {
case 'categorie':
$controller = new $controllerName($categorieDAO);
break;
case 'licencie':
$controller = new $controllerName($licencieDAO, $contactDAO, $categorieDAO);
break;
case 'educateur':
$controller = new $controllerName($educateurDAO, $categorieDAO, $contactDAO);
break;
case 'contact':
$controller = new $controllerName($contactDAO);
break;
default:
$controller = new $controllerName($connexion);
break;
}

$controller->$action(isset($_GET['id']) ? $_GET['id'] : null);
} else {
echo "Page non trouvée";
exit();
}

?>