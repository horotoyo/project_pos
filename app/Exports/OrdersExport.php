<?php

namespace App\Exports;

use App\Model\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use \Maatwebsite\Excel\Sheet;

Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
    $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
});

class OrdersExport implements FromView, ShouldAutoSize, WithEvents
{
    public function __construct($date, $user_id, $sendDate)
    {
        $this->date         = $date;
        $this->user_id      = $user_id;
        $this->sendDate     = $sendDate;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('admin.reports.download-excel', [
            'orders' => Order::where([
                            ['created_at', 'like', "$this->date%"],
                            ['user_id', $this->user_id],
                        ])->get(),
            'time' => $this->sendDate,
        ]);
    }

	public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ],
                ];
                // $worksheet->getStyle('A1:F1')->applyFromArray($styleArray);
            },
        ];
    }

    public function export() 
	{
	    return Excel::download(new OrdersExport, 'orders.xlsx');
	}


}
