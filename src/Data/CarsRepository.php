<?php
declare(strict_types = 1);

namespace App\Data;

use App\Utils\FileHandler;

class CarsRepository implements RepositoryInterface, FileHandler
{
    private $filename;
    private $data;

    public function __construct(string $filename = __DIR__.'/data.json') {        
        $data = json_decode($this->read($filename, 'r'));
        $this->filename = $filename;        
        $this->data = $data;
    }

    public function add(ModelInterface $item)
    {
        $this->data[] = $item->toJson();

        $this->write($this->filename, 'w', json_encode($this->data));

        return $item->toJson();
    }

    public function remove(string $id)
    {
        $index = array_search($id, array_column($this->data, 'id'));
        array_splice($this->data, $index, 1);

        $this->write($this->filename, 'w', json_encode($this->data));

        return [ $id => 'REMOVED'];
    }

    public function findById(string $id)
    {
        $index = array_search($id, array_column($this->data, 'id'));
        if ($index > -1) {
            return $this->data[$index];
        }

        return null;
    }

    public function findAll()
    {
        return $this->data;
    }

    public function read(string $filename, string $mode): string
    {
        $handle = fopen($filename, $mode);
        $content = fread($handle, filesize($filename));
        fclose($handle);

        return $content;
    }

    public function write(string $filename, string $mode, string $content): void
    {
        $handle = fopen($filename, $mode);
        fwrite($handle, $content);
        fclose($handle);

        return;
    }
}
