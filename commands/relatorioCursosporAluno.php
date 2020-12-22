<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;
use Doctrine\DBAL\Logging\DebugStack;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();
$alunosRepository = $entityManager->getRepository(Aluno::class);
// /** @var Aluno[] $alunos */


$dbubstack = new DebugStack();
$entityManager->getConfiguration()->setSQLLogger($dbubstack);


$classeAluno = Aluno::class;
$dql = "SELECT aluno, telefones, cursos FROM $classeAluno aluno JOIN aluno.telefones telefones JOIN aluno.cursos cursos";
$query = $entityManager->createQuery($dql);
$alunos = $query->getResult();

foreach($alunos as $aluno){
    $telefones = $aluno->getTelefones()->map(function(Telefone $telefone){
        return $telefone->getNumero();
    })->toArray();

    echo "ID Aluno: {$aluno->getId()}\n";
    echo "Nome: {$aluno->getNome()}\n";
    echo "Telefones: ". implode(", ", $telefones) . "\n";
    $cursos = $aluno->getCursos();

    foreach ($cursos as $curso){
        echo "\tID Curso: {$curso->getId()}\n";
        echo "\tNome Curso: {$curso->getNome()}\n";
        echo "\n";
    }
    echo "\n";
}


// print_r($dbubstack);
echo "\n";

foreach($dbubstack->queries as $queryInfo){
    echo $queryInfo['sql'] . "\n";
}