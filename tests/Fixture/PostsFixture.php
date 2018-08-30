<?php

namespace SoftDelete\Test\Fixture;

use Cake\ORM\Table;
use Cake\TestSuite\Fixture\TestFixture;

use SoftDelete\Model\Table\Entity\SoftDeleteAwareInterface;
use SoftDelete\Model\Table\SoftDeleteTrait;

class PostsTable extends Table implements SoftDeleteAwareInterface
{
    use SoftDeleteTrait;

    protected $_softDeleteField = 'deleted';

    public function initialize(array $config)
    {
        $this->belongsTo('Users');
        $this->belongsToMany('Tags');
        $this->addBehavior('CounterCache', ['Users' => ['posts_count']]);
    }

    public function setSoftDeleteField($field)
    {
        $this->_softDeleteField = $field;
    }

    public function getSoftDeleteField()
    {
        return $this->_softDeleteField;
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


class PostsFixture extends TestFixture
{

    public $fields = [
        'id' => ['type' => 'integer'],
        'user_id' => ['type' => 'integer', 'default' => '0', 'null' => false],
        'deleted' => ['type' => 'datetime', 'default' => null, 'null' => true],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']]
        ]
    ];
    public $records = [
        [
            'id' => 1,
            'user_id' => 1,
            'deleted' => null,
        ],
        [
            'id' => 2,
            'user_id' => 1,
            'deleted' => null,
        ],
    ];
}


