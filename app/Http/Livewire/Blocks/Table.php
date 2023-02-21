<?php

namespace App\Http\Livewire\Blocks;

use App\Models\Activity;
use App\Models\Block;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Table extends Component implements HasTable
{
    use InteractsWithTable;
    public $view = 'table';

    public function render()
    {
        return view('livewire.blocks.table');
    }

    protected function getTableColumns(): array
    {
        return [
            ColorColumn::make('activity.color')
                ->searchable()
                ->sortable(),
            TextColumn::make('activity.title')
                ->formatStateUsing(fn ($record) => $record->activity->space->icon . ' ' . $record->activity->title)
                ->searchable()
                ->sortable(),
            TextColumn::make('duration')
                ->searchable()
                ->sortable(),
            TextColumn::make('start')
                ->dateTime()
                ->searchable()
                ->sortable(),
            TextColumn::make('end')
                ->dateTime()
                ->searchable()
                ->sortable(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Block::where('user_id', auth()->id())->with('activity.space');
    }

    protected function getTablePollingInterval(): ?string
    {
        return '10s';
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'end';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'asc';
    }
}
