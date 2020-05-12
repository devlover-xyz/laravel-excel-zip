<?php


namespace Devlover\ExcelZip;


trait WithZipCollection
{

    protected $collection;

    public function collection()
    {
        return $this->collection;
    }

    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }

}
