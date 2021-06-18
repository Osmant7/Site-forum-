<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ForumsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ForumsRepository")
 */
class Forums
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SousCategories", inversedBy="forums")
     * @ORM\JoinColumn(name="souscategories_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $souscategories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Posts", mappedBy="theForum")
     */
    private $posts;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="forums")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
    */
    private $user;

    public function __construct() {
        $this->user = new ArrayCollection();
    }


    public function getId(): ?int {
        return $this->id;
    }

     public function setId($id) {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self {
        $this->createdAt = $createdAt;

        return $this;
    }
 
    public function getSouscategories()
    {
        return $this->souscategories;
    }

    public function setSouscategories($souscategories)
    {
        $this->souscategories = $souscategories;

        return $this;
    }

 
    public function getPosts()
    {
        return $this->posts;
    }

    public function setPosts($posts)
    {
        $this->posts = $posts;

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
