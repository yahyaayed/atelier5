<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }


public function getAuthorsOrderedByEmail(){
    return $this->createQueryBuilder('a')
                ->orderBy('a.email','DESC')
                ->getQuery()
                ->getResult();
}

public function getAuthorsByUsername($username){
    return $this->createQueryBuilder('a')
                ->where('a.username LIKE ?1')
                ->orWhere('a.email LIKE ?2')
                ->setParameter('1',$username)
                ->setParameter('2',$username)
                ->getQuery()
                ->getResult();
}
}
