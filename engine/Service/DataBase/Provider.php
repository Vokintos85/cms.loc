<?php

namespace Engine\Service\DataBase;

use Engine\Service\AbstractProvider;
use Engine\Core\Database\Connection;

class Provider extends AbstractProvider
{
    public $serviceName = 'db';

    /**
     * @return mixed
     */
  public  function init()
    {
      $db = new Connection();

      $this->di->set($this->serviceName, $db);
    }
}