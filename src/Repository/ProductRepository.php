<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ProductRepository extends EntityRepository
{
  
  public function getProducts($page, $nbPerPage)
  {
    $query = $this->createQueryBuilder('p')
      ->orderBy('p.title', 'ASC')
      ->getQuery();

    $query
      ->setFirstResult(($page-1) * $nbPerPage)
      ->setMaxResults($nbPerPage);

    return new Paginator($query, true);
  }
}