<?php
  require_once 'vendor/autoload.php';

  use \Doctrine\ORM\Tools\Setup;
  use \Doctrine\ORM\EntityManager;

  $dbParams = array(
    'dbname' => 'doctrine_everton',
    'user'   => 'everton',
    'host'   => '10.0.0.3',
    'driver' => 'pdo_pgsql',
  );

  $config = Setup::createAnnotationMetadataConfiguration(array("src"), true);
  return EntityManager::create($dbParams, $config);