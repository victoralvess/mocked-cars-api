<?php
declare(strict_types = 1);

namespace App\Data;

interface RepositoryInterface
{
    public function add(ModelInterface $item);
    public function remove(string $id);
    public function findById(string $id);
    public function findAll();
}