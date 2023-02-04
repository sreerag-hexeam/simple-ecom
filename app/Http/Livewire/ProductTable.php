<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class ProductTable extends DataTableComponent
{
    protected $model = Product::class;

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
                ->sortable()
                ->searchable(),
            Column::make("Name", "name")
                ->sortable(), 
            Column::make("Category", "category.name")
                ->sortable(), 
            ImageColumn::make('Image')
                ->location(
                    fn($row) => asset($row->getFirstMediaUrl('images'))
                )
                ->attributes(fn($row) => [
                    'class' => 'max-w-20 h-20 rounded-lg',
                    'alt' => $row->name . ' Avatar',
                ]),
            LinkColumn::make('Action')
                ->title(fn($row) => 'Edit')
                ->location(fn($row) => route('products.edit', $row))
                ->attributes(fn($row) => [
                    'class' => 'rounded-full',
                ]),            
        ];
    }
    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
            Product::find($item)->delete();

            $this->clearSelected();
        }
    }
}
