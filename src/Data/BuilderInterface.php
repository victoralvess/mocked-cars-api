<?php
declare(strict_types = 1);

namespace App\Data;

interface BuilderInterface
{
    public function build(): ModelInterface;
    public function buildFromJsonString(string $json): ModelInterface;
}
