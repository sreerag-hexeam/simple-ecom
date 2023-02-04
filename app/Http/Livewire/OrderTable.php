<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class OrderTable extends DataTableComponent
{
    public function builder(): Builder
{
    return Order::query()
        ->with('product') // Eager load anything 
        ->select(); // Select some things
}

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }
    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Delete',
        ];
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Order Id", "order_id")
                ->sortable(),    
            Column::make("Customer Name", "customer_name")
                ->sortable(),
            Column::make("Mobile", "mobile")
                ->sortable(),
            Column::make('Net Amount','product.price')
            ->format(
                fn($value, $row, Column $column) =>  $value * $row->quantity
            ),  
            Column::make("Order Date", "created_at")
            ->format(
                fn($value, $row, Column $column) =>  $value->format('d-m-Y')
            ),  
            Column::make("Action", "created_at")
            ->format(
                fn($value, $row, Column $column) =>  sprintf('<button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" wire:click="edit(%d)">Edit<button>
                <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" wire:click="invoice(%d)">Invoice<button>',$row->id,$row->id)
            )->html()
            ,  
            
        ];
    }
    public function edit($id)
    {
         return to_route('orders.edit',$id);
    }
    public function invoice(Order $order)
    {
       
         $pdf = Pdf::loadView('order.invoice', array('order'=>$order))->output();
         return response()->streamDownload(
            fn () => print($pdf),
            "invoce.pdf"
       );
    }
    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
            Order::find($item)->delete();

            $this->clearSelected();
        }
    }
}
