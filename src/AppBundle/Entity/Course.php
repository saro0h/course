<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Course
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please provide a title.")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Please provide a description.")
     */
    private $description;

    /**
     * @ORM\Column
     * @Assert\Image(
     *     maxWidth = 750,
     *     maxHeight = 300
     * )
     * @Assert\NotBlank(message="Please provide an image.")
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="datetime")
     */
    private $postedAt;

    /**
     * @ORM\Column
     * @Assert\NotBlank(message="Please provide an author.")
     */
    private $author;

    public function __construct()
    {
        $this->postedAt = new \Datetime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    public function getPostedAt()
    {
        return $this->postedAt;
    }

    public function setPostedAt(\Datetime $postedAt)
    {
        $this->postedAt = $postedAt;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }
}
