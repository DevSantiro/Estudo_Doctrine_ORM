<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$alunoRepository = $entityManager->getRepository(Aluno::class);
/**
 * @var Aluno[] $listaAlunos
 */

$listaAlunos = $alunoRepository->findAll();

foreach($listaAlunos as $aluno){
    echo "ID: {$aluno->getId()}\nNome: {$aluno->getNome()}\n\n";
}

echo "{$alunoRepository->find(1)->getNome()}\n\n";

$dados = $alunoRepository->findOneBy([
    'nome' => 'Rodrigo Santiago'
]);

var_dump($dados);