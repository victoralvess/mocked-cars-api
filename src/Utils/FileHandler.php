<?php
declare(strict_types = 1);

namespace App\Utils;

interface FileHandler
{
    public function read(string $filename, string $mode): string;
    public function write(string $filename, string $mode, string $content): void;
}