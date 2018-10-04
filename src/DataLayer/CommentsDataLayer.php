<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 3.10.18
 * Time: 9:33
 */

namespace App\DataLayer;

use App\Entity\Comments;
use App\Components\Model\Repository\CommentsRepository;

use Doctrine\ORM\Mapping as ORM;



/**
 * Class CommentsDataLayer
 * @package App\DataLayer
 */
class CommentsDataLayer
{

    /** @var \App\Components\Model\Repository\CommentsRepository *
     * @ORM\Column(type="string")
     */
    protected $repository;


    /**
     * CommentsDataLayer constructor.
     * @param CommentsRepository $commentsRepository
     */
    public function __construct(CommentsRepository $commentsRepository)
    {
         $this->repository = $commentsRepository;
    }


    /**
     * @return array
     */
    public function getAll()
    {
        return  $this->repository->findAllByDate();
    }


    /**
     * @param $id
     * @return \App\Entity\Comments|null
     */
    public function getDetail(int $id)
    {
        return  $this->repository->find($id);
    }

    /**
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteItem(int $id)
    {
       $comment = $this->repository->find($id);
       $this->repository->delete($comment);
    }


    /**
     * @param $data
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertItem(Comments $newcomment)
    {
       $this->repository->insert($newcomment);
    }

}