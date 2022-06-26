<?php

namespace workers;

class Worker
{
    private ?int $id;
    private ?string $name;
    private ?string $address;
    private ?int $salary;

    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $address
     * @param int|null $salary
     */
    public function __construct(?int $id = null, ?string $name = null, ?string $address = null, ?int $salary = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->salary = $salary;
    }

    /**
     * @return int|null
     */
    public function getSalary(): ?int
    {
        return $this->salary;
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

}