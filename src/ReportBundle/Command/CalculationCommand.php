<?php

namespace ReportBundle\Command;

use ReportBundle\Service\CalculationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculationCommand extends Command
{
    /**
     * @var CalculationService
     */
    private $calculationService;

    /**
     * CalculationCommand constructor.
     * @param CalculationService $calculationService
     */
    public function __construct(CalculationService $calculationService)
    {
        $this->calculationService = $calculationService;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('imaginary-bank:calculate')
            ->setDescription('Calculate accrual of interest and withdrawal of commissions')
            ->setHelp('This command allows you to calculate accrual of interest and to withdrawal of commissions')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('calculation start');
        $this->calculationService->calculate();
        $output->writeln('calculation done');
    }

}