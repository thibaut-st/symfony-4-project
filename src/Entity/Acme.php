<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AcmeRepository")
 */
class Acme
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
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

    public function setFieldB(string $fieldB): self
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
}
