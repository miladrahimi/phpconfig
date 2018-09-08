<?php
/**
 * Created by PhpStorm.
 * User: Milad Rahimi <milad.rahimi@snapp.cab>
 * Date: 9/8/2018 AD
 * Time: 13:26
 */

namespace MiladRahimi\PhpConfig\Tests;

use MiladRahimi\PhpConfig\Repositories\DirectoryRepository;

class DirectoryRepositoryTest extends TestCase
{
    /**
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigDirectoryException
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_directory_repository()
    {
        $repository = new DirectoryRepository(__DIR__ . '/resources/config');

        $this->assertSame($this->sampleData2, $repository->getData());
    }

    /**
     * @expectedException  \MiladRahimi\PhpConfig\Exceptions\InvalidConfigDirectoryException
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_directory_repository_with_invalid_path()
    {
        $repository = new DirectoryRepository(__DIR__ . '/resources/no-config');

        $this->assertSame($this->sampleData2, $repository->getData());
    }

    /**
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigDirectoryException
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_directory_repository_with_invalid_files_when_strict_is_off()
    {
        $repository = new DirectoryRepository(__DIR__ . '/resources/config-invalid', false);

        $this->assertSame($this->sampleData2, $repository->getData());
    }

    /**
     * @throws \MiladRahimi\PhpConfig\Exceptions\InvalidConfigDirectoryException
     * @expectedException  \MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException
     */
    public function test_directory_repository_with_invalid_files_when_strict_is_on()
    {
        $repository = new DirectoryRepository(__DIR__ . '/resources/config-invalid', true);

        $this->assertSame($this->sampleData2, $repository->getData());
    }
}