<?php
declare(strict_types = 1);

namespace App\Data;

interface RepositoryInterface
{
    public function add($item);
    public function remove($id);
    public function findById($id);
    public function findAll();
}