<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as GEDMO;

/**
 * Class AcmeParent
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\AcmeParentRepository")
 */
class AcmeParent
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fieldPA;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Acme", mappedBy="acmeParent", cascade={"persist"})
     */
    private $fieldPB;

    /**
     * @GEDMO\Slug(fields={"fieldPA", "createdAt"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


    public function __construct()
    {
        $this->fieldPB = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFieldPA(): ?string
    {
        return $this->fieldPA;
    }

    public function setFieldPA(?string $fieldPA): self
    {
        $this->fieldPA = $fieldPA;

        return $this;
    }

    /**
     * @return Collection|Acme[]
     */
    public function getFieldPB(): Collection
    {
        return $this->fieldPB;
    }

    public function addFieldPB(Acme $fieldPB): self
    {
        if (!$this->fieldPB->contains($fieldPB)) {
            $this->fieldPB[] = $fieldPB;
            $fieldPB->setAcmeParent($this);
        }

        return $this;
    }

    public function removeFieldPB(Acme $fieldPB): self
    {
        if ($this->fieldPB->contains($fieldPB)) {
            $this->fieldPB->removeElement($fieldPB);
            // set the owning side to null (unless already changed)
            if ($fieldPB->getAcmeParent() === $this) {
                $fieldPB->setAcmeParent(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getId() . ' - ' . $this->getFieldPA();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

}
