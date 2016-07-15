<?php

  require_once('bootstrap.php');

  use Doctrine\ORM\Tools\Console\ConsoleRunner;

  $entityManager = EntityManagerFactory::getInstance();

  return ConsoleRunner::createHelperSet($entityManager);
