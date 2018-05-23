<?php

namespace App\Tests\Utils;

use App\Utils\Helper;
use PHPUnit\Framework\TestCase;

/**
 * Class HelperTest
 * @package App\Tests\Utils
 */
class HelperTest extends TestCase
{

    /**
     * The function should return a string
     */
    public function testRandomStringGenerator()
    {
        $randomString = Helper::randomStringGenerator();

        echo 'random string: ' . $randomString . "\n";
        $this->assertTrue(is_string($randomString));
    }

    /**
     * The function should return a string of the given length
     */
    public function testRandomStringGeneratorLength()
    {
        $randomString0 = Helper::randomStringGenerator(0);
        $randomString5 = Helper::randomStringGenerator(5);
        $randomString10 = Helper::randomStringGenerator(10);

        echo 'random string 0 : ' . strlen($randomString0) . "\n";
        echo 'random string 5 : ' . strlen($randomString5) . "\n";
        echo 'random string 10 : ' . strlen($randomString10) . "\n";
        $this->assertEquals(0, strlen($randomString0));
        $this->assertEquals(5, strlen($randomString5));
        $this->assertEquals(10, strlen($randomString10));
    }

    /**
     * @todo create test randomStringGenerator without number
     */
    public function testRandomStringGeneratorWithoutNumber()
    {

    }

    /**
     * @todo create test randomStringGenerator without uppercase
     */
    public function testRandomStringGeneratorWithoutUppercase()
    {

    }

    /**
     * @todo create test randomStringGenerator without lowercase
     */
    public function testRandomStringGeneratorWithoutLowercase()
    {

    }
}
