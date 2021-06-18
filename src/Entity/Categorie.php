<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SousCategories", mappedBy="categorie")
     */
    private $souscategories;



    public function getId(): ?int {
        return $this->id;
    }

     public function setId($id) {
        $this->id = $id;

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
 
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
