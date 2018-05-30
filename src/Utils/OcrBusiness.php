<?php
/**
 * Created by PhpStorm.
 * User: X3900147
 * Date: 30/05/2018
 * Time: 11:00
 */

namespace App\Utils;

use InvalidArgumentException;
use Smalot\PdfParser\Parser;
use thiagoalessio\TesseractOCR\TesseractOCR;

/**
 * Class OcrBusiness
 * @package App\Utils
 *
 * @todo translation
 */
class OcrBusiness
{

    private $image;
    private $mimeType;
    private $options;

    /**
     * OcrBusiness constructor.
     * @param string $image
     * @param null|string $mimeType
     * @param array|null $options
     */
    public function __construct(string $image, ?string $mimeType, ?array $options = [])
    {
        if ($image === null || !is_string($image)) {
            throw new InvalidArgumentException('Invalid image provided (null or not string)');
        }
        if ($mimeType !== null && !is_string($mimeType)) {
            throw  new InvalidArgumentException('Invalid mimeType provided');
        }
        if ($options !== null && !is_array($options)) {
            throw new InvalidArgumentException('Invalid options provided');
        }

        $this->image = $image;
        $this->mimeType = $mimeType;
        $this->options = $options;
    }

    //FUNCTIONAL

    /**
     * @throws \Exception
     */
    public function extractText()
    {
        if ($this->mimeType === 'application/pdf') {
            $textResult = $this->getTextFromPDF();
        } else {
            $textResult = $this->getTextFromImage();
        }

        return $textResult;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getTextFromPDF()
    {
        $pdfParser = new Parser();
        $pdf = $pdfParser->parseFile($this->image);
        return $pdf->getText();
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getTextFromImage()
    {
        return (new TesseractOCR($this->image))->run();
    }

    //GETTER-SETTER

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     */
    public function setMimeType(string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }
}