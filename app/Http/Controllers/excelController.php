<?php

use App\excel;
use Maatwebsite\Excel\Excel;

class YourController
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    
    public function export()
    {
        return $this->excel->download(new YourExport);
    }
}


?>