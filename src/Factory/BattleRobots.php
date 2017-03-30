<?php

namespace PhpRobots\Factory;

use PhpRobots\Base\BaseRobot;
use PhpRobots\Factory\Exceptions\Exception;

class BattleRobots
{
    /**
     * Build battle robot
     *
     * @param string $robotModel Model
     * @return \PhpRobots\Base\BaseRobot
     * @throws \PhpRobots\Factory\Exceptions\Exception If model not found
     */
    public static function build(string $robotModel): BaseRobot
    {
        if (!class_exists($robotModel)) {
            throw new Exception('Model not found');
        }

        return new $robotModel();
    }
}
