<?php

namespace SoftDelete\Model\Table\Entity;

interface SoftDeleteAwareInterface
{
    public function getSoftDeleteField();

    public function getSoftDeleteValue();

    public function getRestoreValue();
}
