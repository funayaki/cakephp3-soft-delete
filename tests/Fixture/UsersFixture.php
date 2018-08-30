<?php

namespace SoftDelete\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;
use Cake\ORM\Table;

use SoftDelete\Model\Table\Entity\SoftDeleteAwareInterface;
use SoftDelete\Model\Table\SoftDeleteTrait;

class UsersTable extends Table implements SoftDeleteAwareInterface
{
    use SoftDeleteTrait;

    public function initialize(array $config)
    {
        $this->hasMany('Posts', [
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    }

    public function getSoftDeleteField()
    {
        return 'deleted';
    }

    public function getSoftDeleteValue()
    {
        return date('Y-m-d H:i:s');
    }

    public function getRestoreValue()
    {
        return null;
    }
}

class UsersFixture extends TestFixture
{

    public $fields = [
        'id' => ['type' => 'integer'],
        'posts_count' => ['type' => 'integer', 'default' => '0', 'null' => false],
        'deleted' => ['type' => 'datetime', 'default' => null, 'null' => true],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']]
        ]
    ];
    public $records = [
        [
            'id' => 1,
            'deleted' => null,
            'posts_count' => 2
        ],
        [
            'id' => 2,
            'deleted' => null,
            'posts_count' => 0
        ],
    ];
}
