<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 2.10.18
 * Time: 15:50
 */


namespace App\Components\Model\Facade;

use App\DataLayer\CommentsDataLayer;
use App\Entity\Comments;


/**
 * Class CommentsFacade
 * @package App\Components\Model\Facade
 */
class CommentsFacade
{

    /** @var \App\DataLayer\CommentsDataLayer **/
    protected $dataLayer;

    /**
     * CommentsFacade constructor.
     * @param CommentsDataLayer $commentsDataLayer
     */
    public function  __construct (
        CommentsDataLayer $commentsDataLayer
    )
    {
      $this->dataLayer = $commentsDataLayer;
    }


    /**
     * @return array
     */
    public function getIndexPageData()
    {
      return $this->dataLayer->getAll();
    }


    /**
     * @param int $id
     * @return \App\Entity\Comments|null
     */
    public function getDetailPageData(int $id)
    {
        return $this->dataLayer->getDetail($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteComment(int $id)
    {
        return $this->dataLayer->deleteItem($id);
    }


    /**
     * @param Comment $newcomment
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertNewComment(Comments $newcomment)
    {
       $newcomment->setDateinsert(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
       $this->dataLayer->insertItem($newcomment);
    }


}