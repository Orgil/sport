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
  $user = User::find($_SESSION['user_id']);
  // Render index view
  $app->render('index.html.twig', array('user' => $user));
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

  $record = User::find_by_username_and_password($username,$password);
  if (!empty($record)) {
    $_SESSION['logged'] = true;
    $_SESSION['user_id'] = $record->id;
    $app->redirect('/');
  } else {
    $_SESSION['error'] = 'Таны оруулсан нэр болон нууц үг буруу байна.';
    $app->redirect('/login/');
  }

});

$app->get('/logout/', function () use ($app) {
  $_SESSION['logged']=false;
  unset($_SESSION['user_id']);
  $app->redirect('/login/');
});
// admin route
$app->group('/admin', $isLogged($app), function() use ($app) {

  //json events
  $app->get('/events', function () use ($app) {
    $events = Event::all();
    // Render index view
    $eventsArray = array();
    foreach ($events as $event) {
      switch ($event->type) {
        case 0:
          $class='event-yellow';
          break;
        case 1:
          $class='event-blue';
          break;
        case 2:
          $class='event-orange';
          break;
        default:
          $class='event-green';
          break;
      }
      $tmp = array(
        'id'=> $event->id,
        'title'=>$event->title,
        'class'=>$class,
        'start'=>strtotime($event->start_at)*1000,
        'end'=>strtotime($event->finish_at)*1000,
        'description'=>$event->description
      );
      array_push($eventsArray, $tmp);
    }
    $json = array('success'=>1, 'result'=>$eventsArray);
    echo json_encode($json);
  });

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
    $type = $app->request()->post('type');

    $event = new \Event();
    $event->title = $title;
    $event->start_at = $start_at;
    $event->finish_at = $finish_at;
    $event->description = $description;
    $event->type = $type;
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
    $type = $app->request()->post('type');

    $event->title = $title;
    $event->start_at = $start_at;
    $event->finish_at = $finish_at;
    $event->description = $description;
    $event->type = $type;
    $event->save();
    $app->redirect('/admin/');
  });
});
