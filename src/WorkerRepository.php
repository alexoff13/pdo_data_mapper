<?php

namespace workers;

class WorkerRepository
{
    public static function store(Worker $worker)
    {
        return WorkerMapper::save($worker);
    }

    public static function remove(Worker $worker)
    {
        return WorkerMapper::remove($worker);
    }

    public static function getAll()
    {
        return WorkerMapper::getAll();
    }

    public static function getById($id)
    {
        return WorkerMapper::getById($id);
    }

    public static function getByFields($name, $address)
    {
        return WorkerMapper::getByFields($name, $address);
    }
}