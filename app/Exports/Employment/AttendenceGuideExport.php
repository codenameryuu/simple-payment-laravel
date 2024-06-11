<?php

namespace App\Exports\Employment;

use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use App\Helpers\HashHelper;

use App\Models\Employee;

class AttendenceGuideExport implements
    FromArray,
    ShouldAutoSize,
    WithColumnFormatting,
    WithEvents
{
    /**
     ** Variable instance.
     *
     * @var $request
     */
    protected $request;

    /**
     ** Create a new instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     ** Get data by chunks.
     *
     * @return Array
     */
    public function array(): array
    {
        $result = [];
        $heading = $this->createHeading();
        array_push($result, $heading);

        $data = $this->createData();
        array_push($result, $data);

        return $result;
    }

    /**
     ** Create heading.
     *
     * @return Array
     */
    public function createHeading()
    {
        return [
            'No',
            'NIP',
            'Nama',
            'Waktu',
            'Status',
        ];
    }

    /**
     ** Create data.
     *
     * @param  $i
     * @return Array
     */
    public function createData()
    {
        $request = $this->request;

        $employeeId = HashHelper::decrypt($request->employeeId);
        $employee = Employee::firstWHere('id', $employeeId);

        $result = [];

        $start = Carbon::now()
            ->startOfMonth()
            ->isoFormat('YYYY-MM-DD HH:mm:ss');

        $data = [
            1,
            $employee->employee_number,
            $employee->user->name,
            Date::dateTimeToExcel(Carbon::parse($start)),
            'C/Masuk',
        ];

        array_push($result, $data);

        $next = Carbon::now()
            ->startOfMonth()
            ->addHours(2)
            ->isoFormat('YYYY-MM-DD HH:mm:ss');

        $data = [
            2,
            $employee->employee_number,
            $employee->user->name,
            Date::dateTimeToExcel(Carbon::parse($next)),
            'C/Keluar',
        ];

        array_push($result, $data);

        return $result;
    }

    /**
     ** Set format each column.
     *
     * @return Array
     */
    public function columnFormats(): array
    {
        $currency = '_(* #,##0_)';
        $formatDateIndo = '[$-id-ID]dd mmmm yyyy;@';
        $formatDateTimeIndo = '[$-id-ID]dd mmmm yyyy h:mm;@';

        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => $formatDateTimeIndo,
            'E' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     ** Add style.
     *
     * @return Array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $style = [
                    'font' => [
                        'bold' => true,
                    ],

                    'alignment' => [
                        'vertical' => 'center',
                        'horizontal' => 'center',
                    ],
                ];

                $event->sheet->getStyle('A1:E1')->applyFromArray($style);
            },
        ];
    }
}
