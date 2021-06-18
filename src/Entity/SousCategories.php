<?php

namespace App\Entity;

use App\Repository\SousCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SousCategoriesRepository")
 */
class SousCategories
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
    private $Title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Sujet;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="SousCategories")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $categorie;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Forums", mappedBy="souscategories")
     */
    private $forums;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->Sujet;
    }

    public function setSujet(?string $Sujet): self
    {
        $this->Sujet = $Sujet;

        return $this;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

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
}
