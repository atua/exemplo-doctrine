<?php
require_once('bootstrap.php');

$entityManager = EntityManagerFactory::getInstance();

$entityManager->getConfiguration()->setMetadataDriverImpl(
  new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
    $entityManager->getConnection()->getSchemaManager()
  )
);

$cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory();
$cmf->setEntityManager($entityManager);
$arrMetadata = $cmf->getAllMetadata();

$namespace = "Projeto\\BD\\";

@exec("rm -rf " . __DIR__ . "/src");

foreach ($arrMetadata as &$metadata) {
  $metadata->name = $namespace . $metadata->name;

  foreach ($metadata->associationMappings as &$association)
    $association["targetEntity"] = $namespace . $association["targetEntity"];
}

class EntityGenerator extends \Doctrine\ORM\Tools\EntityGenerator {
  const FIELD_VISIBLE_PUBLIC = 'public';

  public function setFieldVisibility($visibility)
  {
    $this->fieldVisibility = $visibility;
  }
}

$entityGenerator = new EntityGenerator();
$entityGenerator->setGenerateAnnotations(true);
$entityGenerator->setFieldVisibility(EntityGenerator::FIELD_VISIBLE_PUBLIC);
$entityGenerator->setGenerateStubMethods(false);
$entityGenerator->setRegenerateEntityIfExists(true);
$entityGenerator->setUpdateEntityIfExists(true);
$entityGenerator->generate($arrMetadata, __DIR__ . "/src");