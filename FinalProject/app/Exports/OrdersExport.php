<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $id;

    // If ID is null → export all
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function collection()
    {
        if ($this->id) {
            return Order::where('id', $this->id)->get();
        }

        return Order::all();
    }

    public function headings(): array
    {
        return [
            'ID', 'Order Name', 'Product', 'Quantity', 'Total Amount', 'Created At', 'Updated At'
        ];
    }
}
