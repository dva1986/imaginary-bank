<?php

namespace ReportBundle\Service;

use DataBundle\Entity\Deposit;
use Doctrine\ORM\EntityManager;
use ReportBundle\Calculation\Commission;
use ReportBundle\Calculation\Income;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CalculationService
 * @package ReportBundle\Service
 */
class CalculationService
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /** @var \DateTime */
    private $now;

    /** @var EntityManager */
    private $em;

    /**
     * CalculationService constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine')->getManager();
        $this->now = new \DateTime();
    }

    public function process()
    {
        $depositRepo = $this->em->getRepository('DataBundle:Deposit');
        $deposits = $depositRepo->findAll();

        $this->calculateAccrual($deposits);
        if ($this->todayIsFirstDayOfMonth()) {
            $this->calculateCommission($deposits);
        }

        $this->em->flush();
    }

    /**
     * @param array $deposits
     */
    private function calculateAccrual(array $deposits)
    {
        /** @var Deposit $deposit */
        foreach ($deposits as $deposit) {
            if ($this->isNeedCalculateAccrual($deposit)) {
                $income = new Income($deposit);
                $balance = $income->calculate();
                $deposit->setBalance($balance);
            }
        }
    }

    private function calculateCommission(array $deposits)
    {
        /** @var Deposit $deposit */
        foreach ($deposits as $deposit) {
            $commission = new Commission($deposit);
            $balance = $commission->calculate();
            $deposit->setBalance($balance);
        }
    }

    /**
     * @param Deposit $deposit
     * @return bool
     */
    private function isNeedCalculateAccrual(Deposit $deposit)
    {
        $depositDay = $deposit->getOpened()->format('d');
        $now = $this->now->format('d');
        $lastDayOfMonth = (clone $this->now)->modify('last day of this month')->format('d');

        return $now === $depositDay || ($lastDayOfMonth === $now && $lastDayOfMonth <= $depositDay);
    }

    /**
     * @return bool
     */
    private function todayIsFirstDayOfMonth()
    {
        return $this->now->format('Y-m-d') === (clone $this->now)->modify('first day of this month')
            ->format('Y-m-d');
    }

}