<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;



/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(
 * fields={"email"},
 * message="l'email que vous avez indiqué est déjà utilisé"
 * )
 * @UniqueEntity(
 * fields={"username"},
 * message="Le nom que vous avez indiqué est déjà utilisé"
 * )
 */
class User implements UserInterface{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $admin;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @Assert\NotBlank(message = "le nom ne peut être vide")
     * @Assert\Length(
     *      min = 1,
     *      max = 25,
     *      minMessage = "Ce nom est trop court",
     *      maxMessage = "Ce nom est trop long",
     * )
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
    * @ORM\Column(type="string")
    * @Assert\Length(min="6", minMessage="Votre mot de passe doit faire minimum 6 caractères")
    */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas entrez le même mot de passe")
     */
    public $confirm_password;


     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Posts", mappedBy="user")
     */
    private $posts;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Forums", mappedBy="user")
     */
    private $forums;

    public function __construct() {
        $this->posts = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(?bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function eraseCredentials() {}

    public function getSalt() {}


    public function getUserIdentifier() {
        return $this->username;
    }

    /**
     * Get the value of posts
     */ 
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set the value of posts
     *
     * @return  self
     */ 
    public function setPosts($posts)
    {
        $this->posts = $posts;

        return $this;
    }
 
    public function getForums()
    {
        return $this->forums;
    }

    public function setForums($forums)
    {
        $this->forums = $forums;

        return $this;
    }

    /**
     * Get the value of roles
     */ 
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
