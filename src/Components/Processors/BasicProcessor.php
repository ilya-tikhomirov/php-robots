<?php

namespace PhpRobots\Components\Processors;

use PhpRobots\Base\BaseProcessor;

class BasicProcessor extends BaseProcessor
{
    /**
     * @inheritdoc
     */
    protected $maxActionsCount = 2;

    /**
     * @inheritdoc
     */
    protected $maxEventsCount = 1;
}
