<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TermRepository")
 */
class Term
{
    public function __toString()
    {
        return $this->getTerm();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $term;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $definition1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $definition2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="terms")
     */
    private $category;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $example;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $translation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $variation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pronunciation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $origin;

    /**
     * @ORM\Column(type="integer")
     */
    private $createdDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $editedDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $votesCount;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentary", mappedBy="Term")
     */
    private $commentaries;

    public function __construct()
    {
        $this->commentaries = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTerm(): ?string
    {
        return $this->term;
    }

    public function setTerm(string $term): self
    {
        $this->term = $term;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDefinition1(): ?string
    {
        return $this->definition1;
    }

    public function setDefinition1(string $definition1): self
    {
        $this->definition1 = $definition1;

        return $this;
    }

    public function getDefinition2(): ?string
    {
        return $this->definition2;
    }

    public function setDefinition2(string $definition2): self
    {
        $this->definition2 = $definition2;

        return $this;
    }

    public function getCategory(): ?Categorie
    {
        return $this->category;
    }

    public function setCategory(?Categorie $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getExample(): ?string
    {
        return $this->example;
    }

    public function setExample(?string $example): self
    {
        $this->example = $example;

        return $this;
    }

    public function getTranslation(): ?string
    {
        return $this->translation;
    }

    public function setTranslation(?string $translation): self
    {
        $this->translation = $translation;

        return $this;
    }

    public function getVariation(): ?string
    {
        return $this->variation;
    }

    public function setVariation(?string $variation): self
    {
        $this->variation = $variation;

        return $this;
    }

    public function getPronunciation(): ?string
    {
        return $this->pronunciation;
    }

    public function setPronunciation(?string $pronunciation): self
    {
        $this->pronunciation = $pronunciation;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getCreatedDate(): ?int
    {
        return $this->createdDate;
    }

    public function setCreatedDate(int $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getEditedDate(): ?int
    {
        return $this->editedDate;
    }

    public function setEditedDate(int $editedDate): self
    {
        $this->editedDate = $editedDate;

        return $this;
    }

    public function getVotesCount(): ?int
    {
        return $this->votesCount;
    }

    public function setVotesCount(int $votesCount): self
    {
        $this->votesCount = $votesCount;

        return $this;
    }

    /**
     * @return Collection|Commentary[]
     */
    public function getCommentaries(): Collection
    {
        return $this->commentaries;
    }

    public function addCommentary(Commentary $commentary): self
    {
        if (!$this->commentaries->contains($commentary)) {
            $this->commentaries[] = $commentary;
            $commentary->setTerm($this);
        }

        return $this;
    }

    public function removeCommentary(Commentary $commentary): self
    {
        if ($this->commentaries->contains($commentary)) {
            $this->commentaries->removeElement($commentary);
            // set the owning side to null (unless already changed)
            if ($commentary->getTerm() === $this) {
                $commentary->setTerm(null);
            }
        }

        return $this;
    }
}
