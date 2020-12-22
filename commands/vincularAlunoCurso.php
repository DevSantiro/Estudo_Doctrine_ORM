<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Curso;
use Alura\Doctrine\Helper\EntityManagerFactory;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$idAluno = $argv[1];
$idCurso = $argv[2];

/** @var Curso $curso */
$curso = $entityManager->find(Curso::class, $idCurso);
/** @var Aluno $aluno */
$aluno = $entityManager->find(Aluno::class, $idAluno);

// Aqui a Chamada é recursiva, então não preciso adicionar um Curso ao Aluno, ele já faz isso.
$curso->addAluno($aluno);

$entityManager->flush();