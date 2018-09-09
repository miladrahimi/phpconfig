<?php
/**
 * Created by PhpStorm.
 * User: Milad Rahimi <milad.rahimi@snapp.cab>
 * Date: 9/8/2018 AD
 * Time: 11:54
 */

namespace MiladRahimi\PhpConfig\Tests;

use MiladRahimi\PhpConfig\Config;
use MiladRahimi\PhpConfig\Repositories\ArrayRepository;

class ConfigTest extends TestCase
{
    public function test_getting_data()
    {
        $config = new Config(new ArrayRepository($this->sampleData));

        $this->assertSame($this->sampleData, $config->getRepository()->getData());
    }

    public function test_getting_by_simple_keys()
    {
        $config = new Config(new ArrayRepository($this->sampleData));

        $this->assertEquals($this->sampleData['Band'], $config->get('Band'));
        $this->assertSame($this->sampleData['Albums'], $config->get('Albums'));
        $this->assertSame($this->sampleData['Members'], $config->get('Members'));
    }

    public function test_getting_by_nested_keys()
    {
        $config = new Config(new ArrayRepository($this->sampleData));

        $this->assertSame(
            $this->sampleData['Members']['David_Gilmour'],
            $config->get('Members.David_Gilmour')
        );
    }

    public function test_default_value_for_gets()
    {
        $config = new Config(new ArrayRepository($this->sampleData));

        $this->assertSame('Default', $config->get('Unknown', 'Default'));
        $this->assertSame('Not Found', $config->get('Unknown.Nested', 'Not Found'));
        $this->assertSame(null, $config->get('Unknown.Not_Set'));
        $this->assertSame(false, $config->get('Unknown.False', false));
        $this->assertSame(true, $config->get('Unknown.True', true));
    }

    public function test_checking_by_nested_keys()
    {
        $config = new Config(new ArrayRepository($this->sampleData));

        $this->assertSame(true, $config->has('Members.Roger_Waters'));
        $this->assertSame(false, $config->has('Members.Bon_Jovi'));
    }
}