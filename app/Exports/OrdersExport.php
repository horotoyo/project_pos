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
    public function __construct($y, $m, $u)
    {
        $this->y     = $y;
        $this->m     = $m;
        $this->u     = $u;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {

        $orders  = new Order();

        if ($this->y) {
            $orders = $orders->whereYear('created_at', $this->y);
        }
        
        if ($this->m) {
            $orders = $orders->whereMonth('created_at', $this->m);
        }
        
        if ($this->u) {
            $orders = $orders->where('user_id', $this->u);
        }

        $orders = $orders->get();

        return view('admin.reports.download-excel', compact('orders'));
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
