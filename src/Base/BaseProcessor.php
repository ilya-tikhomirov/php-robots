<?php

namespace PhpRobots\Base;

use PhpRobots\Base\Exceptions\ParsingException;

abstract class BaseProcessor
{
    /**
     * Contains maximum actions count, which processor can do in one tact
     *
     * @var int
     */
    protected $maxActionsCount = 0;

    /**
     * Available events actions
     *
     * @var string[]
     */
    protected $availableActions = [];

    /**
     * Contains maximum events count, which processor can do in one tact
     *
     * @var int
     */
    protected $maxEventsCount = 0;

    /**
     * Available events instructions
     *
     * @var string[]
     */
    protected $availableEvents = [];

    /**
     * Communication bus with robot
     *
     * @var \PhpRobots\Base\BaseRobot
     */
    protected $robot;

    /**
     * BaseProcessor constructor.
     *
     * @param \PhpRobots\Base\BaseRobot $robot Robot instance
     */
    public function __construct(BaseRobot $robot)
    {
        $this->robot = $robot;
    }

    /**
     * Set processor instructions
     *
     * @param array $instructions Instructions
     * @return $this
     */
    public function setInstructions(array $instructions = []): BaseProcessor
    {
        return $this
            ->validateEventsInstructions($instructions)
            ->validateActionsInstructions($instructions);
    }

    /**
     * Validate events instructions
     *
     * @param array $instructions Raw Instructions
     * @return $this
     * @throws \PhpRobots\Base\Exceptions\ParsingException If events count more then processor cache
     * @throws \PhpRobots\Base\Exceptions\ParsingException If method doesn't exists
     */
    protected function validateEventsInstructions(array $instructions = []): BaseProcessor
    {
        if (array_key_exists('events', $instructions)) {
            if (count($instructions['events']) > $this->maxEventsCount) {
                throw new ParsingException('Events count more then processor events cache');
            }

            foreach ($instructions['events'] as $event) {
                if (method_exists($this, $event['method'])) {
                    throw new ParsingException('Events method ' . $event['method'] . ' not found');
                }
            }
        }

        return $this;
    }

    /**
     * Validate actions instructions
     *
     * @param array $instructions Raw Instructions
     * @return $this
     * @throws \PhpRobots\Base\Exceptions\ParsingException If events count more then processor cache
     * @throws \PhpRobots\Base\Exceptions\ParsingException If method doesn't exists
     */
    protected function validateActionsInstructions(array $instructions = []): BaseProcessor
    {
        if (array_key_exists('actions', $instructions)) {
            if (count($instructions['actions']) > $this->maxActionsCount) {
                throw new ParsingException('Actions count more then processor actions cache');
            }

            foreach ($instructions['actions'] as $action) {
                if (method_exists($this, $action['method'])) {
                    throw new ParsingException('Actions method ' . $action['method'] . ' not found');
                }
            }
        }

        return $this;
    }
}
