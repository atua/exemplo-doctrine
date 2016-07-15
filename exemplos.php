<?php

require_once('bootstrap.php');

$entityManager = EntityManagerFactory::getInstance();

class EchoSQLLogger extends \Doctrine\DBAL\Logging\EchoSQLLogger
{
  public function startQuery($sql, array $params = null, array $types = null)
  {
    echo $sql . "; " . (is_array($params) && count($params) ? json_encode(array_values($params)) : "") . PHP_EOL;
  }
}

/** LOGS */
$entityManager
  ->getConfiguration()
  ->setSQLLogger(new EchoSQLLogger());

echo "/** INSERT */\n";
$teste = new \Projeto\BD\Teste();
$teste->nmTeste = 'Teste';

$grupo = new \Projeto\BD\Grupo();
$grupo->nmGrupo = 'Grupo';
$grupo->cdTeste->add($teste);

$entityManager->persist($teste);
$entityManager->persist($grupo);
$entityManager->flush();

$pessoa = new \Projeto\BD\Pessoa();
$pessoa->nmPessoa = 'Pessoa';
$pessoa->cdGrupo = $grupo;

$entityManager->persist($pessoa);
$entityManager->flush();

echo "/** UPDATE */\n";
$pessoaUpdate = $entityManager->find("\\Projeto\\BD\\Pessoa", $pessoa->cdPessoa);
$pessoaUpdate->dtNascimento = new DateTime("now");
$entityManager->persist($pessoaUpdate);
$entityManager->flush();

echo "/** DELETE */\n";
$pessoaDelete = $entityManager->find("\\Projeto\\BD\\Pessoa", $pessoa->cdPessoa);
$entityManager->remove($pessoaDelete);
$entityManager->flush();

echo "/** POPULAR OBJETO */\n";
$grupo = $entityManager->find("\\Projeto\\BD\\Grupo", $grupo->cdGrupo);
print_r($grupo->nmGrupo); echo PHP_EOL;


echo "/** QUERY 1 */\n";

$qb = $entityManager->createQueryBuilder();

$query = $qb
  ->select("g")
  ->from("\\Projeto\\BD\\Grupo", "g")
  ->where("g.cdGrupo = :cdGrupo")
  ->orderBy("g.nmGrupo", "DESC")
  ->setParameter('cdGrupo', 1)
  ->getQuery();

$grupos = $query->setMaxResults(30)->getResult();

foreach ($grupos as $grupo) {
  print_r($grupo->nmGrupo); echo PHP_EOL;
  print_r($grupo->cdTeste->first()->nmTeste); echo PHP_EOL;
}

echo "/** QUERY 2 */\n";

$dql = <<<DQL
  SELECT g 
    FROM \\Projeto\\BD\\Grupo g 
   WHERE g.cdGrupo = :cdGrupo
   ORDER BY g.nmGrupo DESC
DQL;

$query = $entityManager->createQuery($dql);
$query->setParameter('cdGrupo', 1);
$testes = $query->setMaxResults(30)->getResult();

foreach ($grupos as $grupo) {
  print_r($grupo->nmGrupo); echo PHP_EOL;
  print_r($grupo->cdTeste->first()->nmTeste); echo PHP_EOL;
}
