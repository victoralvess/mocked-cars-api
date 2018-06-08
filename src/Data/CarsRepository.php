<?php
declare(strict_types = 1);

namespace App\Data;

use App\Utils\FileHandlerInterface;

class CarsRepository implements RepositoryInterface, FileHandlerInterface
{
    private $filename;
    private $data;

    public function __construct(string $filename = __DIR__.'/data.json') {        
        $data = null;

        if (file_exists($filename)) {
            $data = json_decode($this->read($filename, 'r'));
        } else {
            file_put_contents($filename, '');
        }

        $this->filename = $filename;        
        $this->data = $data ?? [];
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

    public function read(string $filename): string
    {
        $content = file_get_contents($filename);
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
