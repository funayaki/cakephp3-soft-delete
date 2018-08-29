<?php
namespace SoftDelete\ORM;

use Cake\ORM\Query as CakeQuery;

/**
 * Soft delete-aware query
 */
class Query extends CakeQuery
{
    /**
     * Overwriting triggerBeforeFind() to let queries not return soft deleted records
     *
     * Cake\ORM\Query::triggerBeforeFind() overwritten to add the condition `deleted IS NULL` to every find request
     * in order to not return soft deleted records.
     * If the query contains the option `withDeleted`, the condition `deleted IS NULL` is not applied.
     *
     * @return void
     */
    public function triggerBeforeFind()
    {
        if (!$this->_beforeFindFired && $this->_type === 'select') {
            parent::triggerBeforeFind();

            if (method_exists($this, 'getRepository')) {
                $repository = $this->getRepository();
            } else {
                $repository = $this->repository();
            }

            $options = $this->getOptions();
            if (method_exists($this, 'getRepository')) {
                $findWithDeleted = in_array('withDeleted', $options) || $this->getRepository()->findWithDeleted();
            } else {
                $findWithDeleted = in_array('withDeleted', $options) || $this->repository()->findWithDeleted();
            }

            if (!is_array($options) || !$findWithDeleted) {
                $aliasedField = $repository->aliasField($repository->getSoftDeleteField());
                $deletedValue = $repository->getNotDeleteValue();
                if ($deletedValue === null) {
                    $this->andWhere($aliasedField . ' IS NULL');

                } else {
                    $this->andWhere([$aliasedField => $deletedValue]);
                }
            }
        }
    }
}
