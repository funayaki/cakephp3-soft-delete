<?php

namespace SoftDelete\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;
use Cake\ORM\Table;

use SoftDelete\Model\Table\Entity\SoftDeleteAwareInterface;
use SoftDelete\Model\Table\SoftDeleteTrait;

class StaffsTable extends Table implements SoftDeleteAwareInterface
{
    use SoftDeleteTrait;

    public function initialize(array $config)
    {
    }

    public function getSoftDeleteField()
    {
        return 'delflg';
    }

    public function getSoftDeleteValue()
    {
        return 9;
    }

    public function getRestoreValue()
    {
        return 1;
    }
}

class StaffsFixture extends TestFixture
{

    public $fields = [
        'id' => ['type' => 'integer'],
        'delflg' => ['type' => 'string', 'default' => '1', 'null' => false],
        'name' => ['type' => 'string', 'null' => false],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']]
        ]
    ];

    public $records = [
        ['id' => 1, 'delflg' => 1, 'name' => 'aaa'],
        ['id' => 2, 'delflg' => 9, 'name' => 'bbb'],
    ];
}
