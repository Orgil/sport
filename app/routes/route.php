<?php

$isLogged = function($app) {
  return function() use ($app) {
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
      if ($app->request->getPathInfo() !== '/login')
        $app->redirect('/login');
    }
  };
};

// Define routes
$app->get('/', $isLogged($app) , function () use ($app) {
  // Render index view
  $app->render('index.html.twig');
});

$app->get('/login/', $isLogged($app), function () use ($app) {
  $error = (isset($_SESSION['error'])) ? $_SESSION['error'] : '';
  // Render index view
  $app->render('login.html.twig', array('error' => $error));
  unset($_SESSION['error']);
});

$app->post('/login/', function () use ($app) {

  $username = $app->request()->post('username');
  $password = md5($app->request()->post('password'));

  $user = new \User();
  $record = $user::find_by_username_and_password($username,$password);
  if (!empty($record)) {
    $_SESSION['logged']=true;
    $app->redirect('/');
  } else {
    $_SESSION['error'] = 'username or password is wrong';
    $app->redirect('/login/');
  }

});

$app->get('/logout/', function () use ($app) {
  $_SESSION['logged']=false;
  $app->redirect('/login/');
});
// admin route
$app->get('/admin/', $isLogged($app), function () use ($app) {
  // Render index view
  $app->render('admin/index.html.twig');
});
