<?php
declare(strict_types = 1);

namespace App\Data;

class CarsRepository implements RepositoryInterface
{
    public function __construct(array $data) {
        $this->data = $data;
    }

    public function add($item) {
        $this->data[] = $item;
    }

    public function remove($id) {
        $index = array_search($id, array_column($this->data, 'id'));
        array_splice($this->data, $index, 1);
    }

    public function findById($id) {
        $index = array_search($id, array_column($this->data, 'id'));
        if ($index > -1) {
            return $this->data[$index];
        }

        return null;
    }

    public function findAll() {
        return $this->data;
    }
}