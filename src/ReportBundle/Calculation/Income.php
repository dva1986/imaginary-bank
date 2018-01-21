<?php

namespace ReportBundle\Calculation;

use ReportBundle\Interfaces\CalculateInterface;

/**
 * Class Income
 * @package ReportBundle\Calculation
 */
class Income extends Calculation implements CalculateInterface
{
    /**
     * @return float
     */
    public function calculate()
    {
        $balance = $this->deposit->getBalance();
        $balance *= (1 + (float) $this->deposit->getInterest());

        return $balance;
    }

}