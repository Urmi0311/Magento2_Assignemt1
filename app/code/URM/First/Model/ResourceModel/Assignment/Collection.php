<?php

namespace URM\First\Model\ResourceModel\Assignment;

use URM\First\Model\Assignment;
use URM\First\Model\ResourceModel\Assignment as AssignmentResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Assignment::class, AssignmentResourceModel::class);
    }
}
