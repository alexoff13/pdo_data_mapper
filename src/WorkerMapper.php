<?php

namespace workers;

class WorkerMapper
{

    public static function save(Worker $worker)
    {
        $workerByFields = self::getByFields($worker->getName(), $worker->getAddress());
        if ($worker->getId() == null) {
            if (!$workerByFields->getId()) {
                $foundWorker = DBRequester::execute_with_fetch(
                    'insert into workers.workers(name, address, salary) VALUES(:name,:address,:salary)',
                    ['name' => $worker->getName(), 'address' => $worker->getAddress(), 'salary' => $worker->getSalary()]);
                return true;
            }
            return false;
        } else {
            if ($workerByFields->getName() != $worker->getName() && $workerByFields->getAddress() != $worker->getAddress()) {
                DBRequester::execute('update workers.workers set name=:name,address=:address,salary=:salary WHERE id=:id',
                    ['name' => $worker->getName(), 'address' => $worker->getAddress(),
                        'salary' => $worker->getSalary(), 'id' => $worker->getId()]);

                return self::getById($worker->getId());
            }
            return false;
        }
    }

    public static function remove(Worker $worker): bool
    {
        if (WorkerMapper::getById($worker->getId())->getId()) {
            DBRequester::execute(
                'delete from workers.workers where id=?',
                [$worker->getId()]);
            return true;
        }
        return false;
    }

    public static function getAll(): array
    {
        $workers = [];
        $rows = DBRequester::execute_with_fetch(
            'select * from workers.workers', [], true);
        foreach ($rows as $row) {
            $worker = new Worker(
                (int)$row['id'],
                (string)$row['name'],
                (string)$row['address'],
                (int)$row['salary']);
            $workers[] = $worker;
        }
        return $workers;
    }

    public static function getById(int $id): Worker
    {
        $foundWorker = DBRequester::execute_with_fetch(
            'select * from workers.workers where id=?',
            [$id]);
        return !$foundWorker ? new Worker() : new Worker(
            $foundWorker['id'],
            $foundWorker['name'],
            $foundWorker['address'],
            $foundWorker['salary']);
    }

    public static function getByFields(string $name, string $address): Worker
    {
        $foundWorker = DBRequester::execute_with_fetch(
            'select * from workers.workers where name=:name and address=:address',
            ['name' => $name, 'address' => $address]);

        return !$foundWorker ? new Worker() : new Worker(
            $foundWorker['id'],
            $foundWorker['name'],
            $foundWorker['address'],
            $foundWorker['salary']);
    }
}