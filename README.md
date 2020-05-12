#NOTE
This is a very early stage package that aims to become a successor of laravel-excel-zip package. It started as a fork because we needed Laravel 6.0 compatibility. I will try to make it compatible with Laravel 6 and up.

# laravel-excel-zip
download excels wrap in zip
laravel-excel-zip is a solution to download a large excel. You can define when to chunk excels into a zip file.

## Install

`composer require Devlover/laravel-excel-zip -vvv`

## Usage

run command to create `config/excel_zip.php`

`php artisan vendor:publish --provider="Devlover\ExcelZip\ExcelZipServiceProvider"`

### Export

use CustomCollection in your `Export` and ***Don't define `collection` function***

```php
<?php

use Devlover\ExcelZip\WithZipCollection;
use Maatwebsite\Excel\Concerns\FromCollection;

class MemberExport implements FromCollection
{
    use WithZipCollection;
}
```

### Controller

```php
<?php

use Devlover\ExcelZip\ExcelZip;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    // chunk by database(better!)
    public function export1(ExcelZip $excelZip, MemberExport $export)
    {
        $excelZip = $excelZip->setExport($export);
    
        Member::chunk(5000, function ($members) use ($excelZip) {
            $excelZip->excel($members);
        });
    
        return $excelZip->zip();
    }
    
    // chunk in laravel-excel-zip
    public function export2(ExcelZip $excelZip, MemberExport $export)
    {
        return $excelZip->download(Member::all(), $export);
    }
}
```

