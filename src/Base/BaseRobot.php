<?php

namespace PhpRobots\Base;

use PhpRobots\Base\Exceptions\MissedComponentException;

class BaseRobot
{
    /**
     * Engine
     *
     * @var \PhpRobots\Base\BaseEngine
     */
    protected $engine;

    /**
     * Processor
     *
     * @var \PhpRobots\Base\BaseProcessor
     */
    protected $processor;

    /**
     * Memory
     *
     * @var \PhpRobots\Base\BaseMemory
     */
    protected $memory;

    /**
     * Sensors
     *
     * @var \PhpRobots\Base\BaseSensor[]
     */
    protected $sensors = [];

    /**
     * Set engine
     *
     * @param \PhpRobots\Base\BaseEngine $engine Engine
     * @return $this
     */
    public function setEngine(BaseEngine $engine): BaseRobot
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * Set memory
     *
     * @param \PhpRobots\Base\BaseMemory $memory Memory
     * @return $this
     */
    public function setMemory(BaseMemory $memory): BaseRobot
    {
        $this->memory = $memory;

        return $this;
    }

    /**
     * Set processor
     *
     * @param \PhpRobots\Base\BaseProcessor $processor Processor
     * @return $this
     */
    public function setProcessor(BaseProcessor $processor): BaseRobot
    {
        $this->processor = $processor;

        return $this;
    }

    /**
     * Add sensor
     *
     * @param \PhpRobots\Base\BaseSensor $sensor Sensor
     * @return $this
     */
    public function addSensor(BaseSensor $sensor): BaseRobot
    {
        $this->sensors[] = $sensor;

        return $this;
    }

    /**
     * Run robot
     *
     * @return $this
     */
    public function run(): BaseRobot
    {
        return $this->checkSystems();
    }

    /**
     * Check robot systems
     *
     * @return $this
     * @throws \PhpRobots\Base\Exceptions\MissedComponentException If engine not found
     * @throws \PhpRobots\Base\Exceptions\MissedComponentException If processor not found
     * @throws \PhpRobots\Base\Exceptions\MissedComponentException If memory not found
     * @throws \PhpRobots\Base\Exceptions\MissedComponentException If sensors not found
     */
    protected function checkSystems(): BaseRobot
    {
        if (!$this->isEngineInstalled()) {
            throw new MissedComponentException('Engine');
        }

        if (!$this->isProcessorInstalled()) {
            throw new MissedComponentException('Processor');
        }

        if (!$this->isMemoryInstalled()) {
            throw new MissedComponentException('Memory');
        }

        if (!$this->isSensorsInstalled()) {
            throw new MissedComponentException('Sensors');
        }

        return $this;
    }

    /**
     * Is engine installed
     *
     * @return bool
     */
    public function isEngineInstalled()
    {
        return (bool) $this->engine;
    }

    /**
     * Is processor installed
     *
     * @return bool
     */
    public function isProcessorInstalled()
    {
        return (bool) $this->processor;
    }

    /**
     * Is memory installed
     *
     * @return bool
     */
    public function isMemoryInstalled()
    {
        return (bool) $this->memory;
    }

    /**
     * Is sensors installed
     *
     * @return bool
     */
    public function isSensorsInstalled()
    {
        return (bool) $this->sensors;
    }
}
