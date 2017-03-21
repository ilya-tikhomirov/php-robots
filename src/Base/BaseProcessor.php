<?php

namespace PhpRobots\Base;

use PhpRobots\Base\Exceptions\ParsingException;

class BaseProcessor
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
            ->parseEventsInstructions($instructions)
            ->parseActionsInstructions($instructions);
    }

    /**
     * Parse events instructions
     *
     * @param array $instructions Raw Instructions
     * @return $this
     * @throws \PhpRobots\Base\Exceptions\ParsingException If events count more then processor cache
     * @throws \PhpRobots\Base\Exceptions\ParsingException If method doesn't exists
     */
    protected function parseEventsInstructions(array $instructions = []): BaseProcessor
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
     * Parse actions instructions
     *
     * @param array $instructions Raw Instructions
     * @return $this
     * @throws \PhpRobots\Base\Exceptions\ParsingException If events count more then processor cache
     * @throws \PhpRobots\Base\Exceptions\ParsingException If method doesn't exists
     */
    protected function parseActionsInstructions(array $instructions = []): BaseProcessor
    {
        if (array_key_exists('actions', $instructions)) {
            if (count($instructions['actions']) > $this->maxEventsCount) {
                throw new ParsingException('Actions count more then processor actions cache');
            }

            foreach ($instructions['actions'] as $event) {
                if (method_exists($this, $event['method'])) {
                    throw new ParsingException('Actions method ' . $event['method'] . ' not found');
                }
            }
        }

        return $this;
    }
}
