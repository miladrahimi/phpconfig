<?php
/**
 * Created by PhpStorm.
 * User: Milad Rahimi <milad.rahimi@snapp.cab>
 * Date: 9/8/2018 AD
 * Time: 13:26
 */

namespace MiladRahimi\PhpConfig\Tests;

use MiladRahimi\PhpConfig\Repositories\JsonDirectoryRepository;

class JsonDirectoryRepositoryTest extends TestCase
{
    /**
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigDirectoryException
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_directory_repository()
    {
        $repository = new JsonDirectoryRepository(__DIR__ . '/resources/config-json');

        $this->assertSame($this->sampleData2, $repository->getData());
    }

    /**
     * @expectedException  \MiladRahimi\PhpConfig\Exceptions\InvalidConfigDirectoryException
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_directory_repository_with_invalid_path()
    {
        $repository = new JsonDirectoryRepository(__DIR__ . '/resources/no-config');

        $this->assertSame($this->sampleData2, $repository->getData());
    }

    /**
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigDirectoryException
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_directory_repository_with_invalid_files_when_strict_is_off()
    {
        $repository = new JsonDirectoryRepository(
            __DIR__ . '/resources/config-json-invalid',
            false
        );

        $this->assertSame($this->sampleData2, $repository->getData());
    }

    /**
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigDirectoryException
     * @expectedException  \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_directory_repository_with_invalid_files_when_strict_is_on()
    {
        $repository = new JsonDirectoryRepository(__DIR__ . '/resources/config-json-invalid', true);

        $this->assertSame($this->sampleData2, $repository->getData());
    }
}