<?php

namespace URM\First\Model;

use Magento\Framework\Model\AbstractModel;

class Assignment extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\URM\First\Model\ResourceModel\Assignment::class);
    }
}

