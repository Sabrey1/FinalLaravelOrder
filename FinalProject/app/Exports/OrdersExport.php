<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $query = Order::with('customer', 'products');

        if ($this->id) {
            $query->where('id', $this->id);
        }

        return $query->get();
    }

    public function map($order): array
    {
        // Combine product names and quantities
        $products = $order->products->map(function ($product) {
            return $product->name . ' (Qty: ' . $product->pivot->quantity . ', $' . $product->pivot->price . ')';
        })->implode(', ');

        return [
            $order->id,
            $order->name,
            $order->customer->name ?? 'N/A',
            $products,
            $order->total_amount,
            $order->created_at,
            $order->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Order Name',
            'Customer Name',
            'Products',
            'Total Amount',
            'Created At',
            'Updated At'
        ];
    }
}

