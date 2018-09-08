<?php
/**
 * Created by PhpStorm.
 * User: Milad Rahimi <milad.rahimi@snapp.cab>
 * Date: 9/8/2018 AD
 * Time: 13:26
 */

namespace MiladRahimi\PhpConfig\Tests;

use MiladRahimi\PhpConfig\Repositories\JsonFileRepository;

class JsonFileRepositoryTest extends TestCase
{
    /**
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_json_file_repository()
    {
        $repository = new JsonFileRepository(__DIR__ . '/resources/config.json');

        $this->assertSame($this->sampleData, $repository->getData());
    }

    /**
     * @expectedException \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_file_repository_with_incorrect_file_path()
    {
        $repository = new JsonFileRepository(__DIR__ . '/not-found.json');

        $this->assertSame($this->sampleData, $repository->getData());
    }
}