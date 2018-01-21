<?php


namespace ReportBundle\Calculation;

use DataBundle\Entity\Deposit;

class Calculation
{
    /** @var Deposit */
    protected $deposit;

    /**
     * Commission constructor.
     * @param Deposit $deposit
     */
    public function __construct(Deposit $deposit)
    {
        $this->deposit = $deposit;
    }
}