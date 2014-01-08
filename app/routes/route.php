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
    $_SESSION['error'] = 'Таны оруулсан нэр болон нууц үг буруу байна.';
    $app->redirect('/login/');
  }

});

$app->get('/logout/', function () use ($app) {
  $_SESSION['logged']=false;
  $app->redirect('/login/');
});
// admin route
$app->group('/admin', $isLogged($app), function() use ($app) {
  $app->get('/', function () use ($app) {
    $events = Event::all();

    // Render index view
    $app->render('admin/index.html.twig', array('events'=>$events));
  });

  $app->get('/create', function () use ($app) {

    // Render index view
    $app->render('admin/create.html.twig');
  });

  $app->post('/create', function() use ($app) {
    $title = $app->request()->post('title');
    $start_at = $app->request()->post('start_at');
    $finish_at = $app->request()->post('finish_at');
    $description = $app->request()->post('description');

    $event = new \Event();
    $event->title = $title;
    $event->start_at = $start_at;
    $event->finish_at = $finish_at;
    $event->description = $description;
    $event->save();
    $app->redirect('/admin/');
  });

  $app->get('/delete/:id', function($id) use ($app) {
    $event = Event::find($id);
    $event->delete();
    $app->redirect('/admin/');
  });

  $app->get('/edit/:id', function($id) use ($app) {
    $event = Event::find($id);
    $app->render('admin/edit.html.twig', array('event'=>$event));
  });

  $app->post('/edit/:id', function($id) use ($app) {
    $event = Event::find($id);
    $title = $app->request()->post('title');
    $start_at = $app->request()->post('start_at');
    $finish_at = $app->request()->post('finish_at');
    $description = $app->request()->post('description');

    $event->title = $title;
    $event->start_at = $start_at;
    $event->finish_at = $finish_at;
    $event->description = $description;
    $event->save();
    $app->redirect('/admin/');
  });
});
