<?php

namespace ReportBundle\Calculation;

use ReportBundle\Interfaces\CalculateInterface;

/**
 * Class Commission
 * @package ReportBundle\Calculation
 */
class Commission extends Calculation implements CalculateInterface
{

    /**
     * @return float
     */
    public function calculate()
    {
        $balance = $this->deposit->getBalance();

        switch (true) {
            case $balance < 1000:
                $commission = 0.05*$balance;
                $commission = $commission < 50 ? 50 : $commission;
                break;
            case $balance >= 1000 && $balance < 10000:
                $commission = 0.06*$balance;
                break;
            default:
                $commission = 0.07*$balance;
                $commission = $commission > 5000 ? 5000 : $commission;
        }

        if ($this->deposit->getOpened()->format('m') ===
            (new \DateTime())->modify('-1 month')->format('m')) {
            $now = new \DateTime();
            $interval = $this->deposit->getOpened()->diff($now);

            $commission *= ($interval->days / 31);
        }

        return $balance - $commission;
    }
}