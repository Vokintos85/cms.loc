<?php

namespace Engine\Service\DataBase;

use Engine\Service\AbstractProvider;
use Engine\Core\Database\Connection;

class Provider extends AbstractProvider
{
    public string $serviceName = 'db';

  public  function init(): void
  {
      $db = new Connection();

      $this->di->set($this->serviceName, $db);
  }
}