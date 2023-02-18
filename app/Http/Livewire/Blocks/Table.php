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
            ColorColumn::make('activity.color'),
            TextColumn::make('activity.title')
                ->formatStateUsing(fn ($record) => $record->activity->space->icon . ' ' . $record->activity->title),
            TextColumn::make('duration'),
            TextColumn::make('start')->dateTime(),
            TextColumn::make('end')->dateTime(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Block::where('user_id', auth()->id())->with('activity.space');
    }
}
