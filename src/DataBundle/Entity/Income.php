<?php

namespace DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Income
 *
 * @ORM\Table(name="income")
 * @ORM\Entity(repositoryClass="DataBundle\Repository\IncomeRepository")
 */
class Income
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Deposit")
     * @ORM\JoinColumn(name="deposit_id", referencedColumnName="id")
     */
    private $deposit;

    /**
     * @var string
     *
     * @ORM\Column(name="capitalized", type="decimal", precision=10, scale=2)
     */
    private $capitalized;

    /**
     * @var string
     *
     * @ORM\Column(name="balance", type="decimal", precision=10, scale=2)
     */
    private $balance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="accrual", type="datetime")
     */
    private $accrual;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set deposit
     *
     * @param Deposit $deposit
     *
     * @return Income
     */
    public function setDeposit(Deposit $deposit)
    {
        $this->deposit = $deposit;

        return $this;
    }

    /**
     * Get deposit
     *
     * @return Deposit
     */
    public function getDeposit()
    {
        return $this->deposit;
    }

    /**
     * Set capitalized
     *
     * @param string $capitalized
     *
     * @return Income
     */
    public function setCapitalized($capitalized)
    {
        $this->capitalized = $capitalized;

        return $this;
    }

    /**
     * Get capitalized
     *
     * @return string
     */
    public function getCapitalized()
    {
        return $this->capitalized;
    }

    /**
     * Set balance
     *
     * @param string $balance
     *
     * @return Income
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set accrual
     *
     * @param \DateTime $accrual
     *
     * @return Income
     */
    public function setAccrual($accrual)
    {
        $this->accrual = $accrual;

        return $this;
    }

    /**
     * Get accrual
     *
     * @return \DateTime
     */
    public function getAccrual()
    {
        return $this->accrual;
    }
}
