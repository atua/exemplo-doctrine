<?php
  require_once 'vendor/autoload.php';

  use Doctrine\ORM\Tools\Setup;
  use Doctrine\ORM\EntityManager;
  use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
  use Doctrine\Common\Annotations\AnnotationReader;
  use Doctrine\Common\Annotations\AnnotationRegistry;

  class EntityManagerFactory
  {
    /**
     * @var EntityManager
     */
    private static $instance;

    private static function createInstance() {
      $dbParams = array(
        'dbname' => 'doctrine_everton',
        'user'   => 'everton',
        'host'   => '10.0.0.3',
        'driver' => 'pdo_pgsql',
      );

      $config = Setup::createConfiguration(true);
      $driver = new AnnotationDriver(new AnnotationReader(), array(__DIR__ . "/src"));

      AnnotationRegistry::registerLoader('class_exists');
      $config->setMetadataDriverImpl($driver);

      self::$instance = EntityManager::create($dbParams, $config);
    }

    /**
     * @return EntityManager
     */
    public static function getInstance() {
      if (!self::$instance) self::createInstance();
      return self::$instance;
    }
  }