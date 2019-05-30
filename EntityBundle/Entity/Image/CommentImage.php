<?php

namespace EntityBundle\Entity\Image;

use EntityBundle\Entity\Comment;
use EntityBundle\Enum\ImageType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CommentImage
 *
 * @ORM\Table(name="comment_image")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\CommentImageRepository")
 */
class CommentImage extends AbstractImage
{
    /**
     * @var Comment
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="EntityBundle\Entity\Comment", inversedBy="images")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comment_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $comment;

    /***********************************************
     *                Virtual fields
     ***********************************************/

    /**
     * Comment Id
     *
     * @return null|int
     */
    public function getCommentId()
    {
        return $this->getComment()->getId();
    }

    /***********************************************/

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return ImageType::FEEDBACK;
    }

    /**
     * @return Comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param Comment $comment
     * @return $this
     */
    public function setComment(Comment $comment)
    {
        $this->comment = $comment;

        return $this;
    }
}
