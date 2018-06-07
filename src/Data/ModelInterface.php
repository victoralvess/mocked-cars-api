<?php
declare(strict_types = 1);

namespace App\Data;

interface ModelInterface
{
    public function getId(): string;
    public function toJson(): array;
    public function toString(): string;
}
