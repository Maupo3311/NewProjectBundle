<?php

namespace EntityBundle\Entity;

use EntityBundle\Entity\Image\FeedbackImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * Feedback
 *
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="feedback")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\FeedbackRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Feedback
{
    /**
     * @var int
     *
     * @Serializer\Expose()
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @Serializer\Expose()
     * @ORM\ManyToOne(targetEntity="User", inversedBy="feedbacks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @Serializer\Expose()
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var DateTime
     *
     * @Serializer\Expose()
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var ArrayCollection $images
     *
     * @Serializer\Groups({"details"})
     * @Serializer\Expose()
     * @ORM\OneToMany(
     *     targetEntity="EntityBundle\Entity\Image\FeedbackImage",
     *      cascade={"persist","remove"},
     *      orphanRemoval=true,
     *      mappedBy="feedback"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="images_id", referencedColumnName="id", nullable=true)
     * })
     */
    public $images;

    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param FeedbackImage $image
     * @return $this
     */
    public function addImages(FeedbackImage $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * @param array $images
     * @return $this
     */
    public function setImages(array $images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Feedback constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->created = new DateTime();
        $this->images  = new ArrayCollection;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Feedback
     */
    public function setUser(User $user): Feedback
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set created.
     *
     * @param DateTime $created
     *
     * @return Feedback
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created.
     *
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}
