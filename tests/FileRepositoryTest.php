<?php
/**
 * Created by PhpStorm.
 * User: Milad Rahimi <milad.rahimi@snapp.cab>
 * Date: 9/8/2018 AD
 * Time: 13:26
 */

namespace MiladRahimi\PhpConfig\Tests;

use MiladRahimi\PhpConfig\Repositories\FileRepository;

class FileRepositoryTest extends TestCase
{
    /**
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_file_repository()
    {
        $repository = new FileRepository(__DIR__ . '/resources/config.php');

        $this->assertSame($this->sampleData, $repository->getData());
    }

    /**
     * @expectedException \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_file_repository_with_incorrect_file_path()
    {
        $repository = new FileRepository(__DIR__ . '/not-found.php');

        $this->assertSame($this->sampleData, $repository->getData());
    }
}