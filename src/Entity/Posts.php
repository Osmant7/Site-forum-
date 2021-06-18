<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Posts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;


     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Forums", inversedBy="posts")
     * @ORM\JoinColumn(name="forums_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $theForum; 

     /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $brochureFilename;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
    */
    private $user;

    public function __construct() {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
       public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

 
    public function getBrochureFilename()
    {
        return $this->brochureFilename;
    }
 
    public function setBrochureFilename($brochureFilename)
    {
        $this->brochureFilename = $brochureFilename;

        return $this;
    }
 
    public function getTheForum()
    {
        return $this->theForum;
    }
 
    public function setTheForum($theForum)
    {
        $this->theForum = $theForum;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }
 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}
