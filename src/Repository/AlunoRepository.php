<?php 

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Aluno;
use Doctrine\ORM\EntityRepository;

class AlunoRepository extends EntityRepository
{
    public function buscaCursosPorAluno()
    {
        $entityManager = $this->getEntityManager();
        $classeAluno = Aluno::class;
        $dql = "SELECT aluno, telefones, cursos FROM $classeAluno aluno JOIN aluno.telefones telefones JOIN aluno.cursos cursos";
        $query = $entityManager->createQuery($dql);
        return $query->getResult();
    }

    public function buscaCursosPorAluno2()
    {
        $query = $this->createQueryBuilder('a')
        ->join('a.telefones', 't')
        ->join('a.cursos', 'c')
        ->addSelect('t')
        ->addSelect('c')
        ->getQuery();
        
        return $query->getResult();
    }

}