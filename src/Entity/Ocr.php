<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;

/**
 * Class Ocr
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\OcrRepository")
 * @Vich\Uploadable
 */
class Ocr
{

    use TimestampableEntity;

    /**
     * @var string $id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var string $content
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @var File $imageFile
     *
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="ocr_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     */
    private $imageFile;

    /**
     * @var EmbeddedFile $image
     *
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     */
    private $image;

    /**
     * Ocr constructor.
     */
    public function __construct()
    {
        $this->image = new EmbeddedFile();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param null|string $content
     * @return Ocr
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }


    /**
     * @param File|UploadedFile $image
     * @throws \Exception
     */
    public function setImageFile(?File $image = null)
    {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param EmbeddedFile $image
     */
    public function setImage(EmbeddedFile $image)
    {
        $this->image = $image;
    }

    /**
     * @return null|EmbeddedFile
     */
    public function getImage(): ?EmbeddedFile
    {
        return $this->image;
    }
}
