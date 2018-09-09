<?php
/**
 * Created by PhpStorm.
 * User: Milad Rahimi <milad.rahimi@snapp.cab>
 * Date: 9/8/2018 AD
 * Time: 13:26
 */

namespace MiladRahimi\PhpConfig\Tests;

use MiladRahimi\PhpConfig\Repositories\ArrayRepository;

class ArrayRepositoryTest extends TestCase
{
    public function test_array_repository()
    {
        $repository = new ArrayRepository($this->sampleData);

        $this->assertSame($this->sampleData, $repository->getData());
    }
}