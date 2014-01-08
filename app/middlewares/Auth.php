<?php

namespace Sport;

class Auth
{
  public function isLogged($app)
  {
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true)
      $app->redirect('/login');
  }

  public function authenticate($username, $password)
  {

  }

}
