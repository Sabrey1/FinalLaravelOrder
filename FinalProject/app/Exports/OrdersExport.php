<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $id;

    // Accept export by ID or all
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $query = DB::table('orders')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->select(
                'orders.id',
                'orders.name',
                'products.name as product_name',
                'orders.quantity',
                'products.price',
                'orders.total_amount',
                'orders.created_at',
                'orders.updated_at'
            );

        if ($this->id) {
            $query->where('orders.id', $this->id);
        }

        return $query->get();
    }

    // Format rows
    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->product_name ?? 'N/A',
            $row->quantity,
            $row->price,
            $row->total_amount,
            $row->created_at,
            $row->updated_at,
        ];
    }

    // Headings
    public function headings(): array
    {
        return [
            'ID',
            'Order Name',
            'Product Name',
            'Quantity',
            'Product Price',
            'Total Amount',
            'Created At',
            'Updated At'
        ];
    }
}
