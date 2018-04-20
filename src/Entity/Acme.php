<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as GEDMO;

/**
 * Class Acme
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\AcmeRepository")
 */
class Acme
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fieldA;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fieldB;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AcmeParent", inversedBy="fieldPB")
     */
    private $acmeParent;

    /**
     * @GEDMO\Slug(fields={"fieldB", "createdAt"})
     * @ORM\Column(length=128, unique=true)
     *
     * @todo change slug datetime to timestamp
     */
    private $slug;

    public function getId()
    {
        return $this->id;
    }

    public function getFieldA(): ?int
    {
        return $this->fieldA;
    }

    public function setFieldA(?int $fieldA): self
    {
        $this->fieldA = $fieldA;

        return $this;
    }

    public function getFieldB(): ?string
    {
        return $this->fieldB;
    }

    public function setFieldB(?string $fieldB): self
    {
        $this->fieldB = $fieldB;

        return $this;
    }

    public function getAcmeParent(): ?AcmeParent
    {
        return $this->acmeParent;
    }

    public function setAcmeParent(?AcmeParent $acmeParent): self
    {
        $this->acmeParent = $acmeParent;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getFieldB();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

}
