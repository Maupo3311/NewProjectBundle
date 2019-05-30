<?php

namespace EntityBundle\Entity\Image;

use EntityBundle\Entity\Feedback;
use EntityBundle\Enum\ImageType;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="feedback_image")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\FeedbackImageRepository")
 */
class FeedbackImage extends AbstractImage
{
    /**
     * @var Feedback
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="EntityBundle\Entity\Feedback", inversedBy="images")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="feedback_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $feedback;

    /***********************************************
     *                Virtual fields
     ***********************************************/

    /**
     * Feedback Id
     *
     * @return null|int
     */
    public function getFeedbackId()
    {
        return $this->getFeedback()->getId();
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
     * @return Feedback
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param Feedback $feedback
     * @return $this
     */
    public function setFeedback(Feedback $feedback)
    {
        $this->feedback = $feedback;

        return $this;
    }
}