<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 3.10.18
 * Time: 9:26
 */

namespace App\Components\Model\Repository;

use App\Entity\Comments;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * Class CommentsRepository
 * @package App\Components\Model\Repository
 */
class CommentsRepository extends ServiceEntityRepository
{
    /**
     * CommentsRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comments::class);
    }

    /**
     * @return array
     */
    public function findAllByDate()
    {
        return parent::findBy(array(),array('dateinsert' => 'DESC'));
    }

    /**
     * @param Comments $data
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insert(Comments $comment)
    {
      $entityManager = $this->getEntityManager();
      $entityManager->persist($comment);
      $entityManager->flush();
    }


    /**
     * @param Comments $comment
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Comments $comment)
    {
      $entityManager = $this->getEntityManager();
      $entityManager->remove($comment);
      $entityManager->flush();
    }

}