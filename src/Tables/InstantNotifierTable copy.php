<?php

namespace Botble\InstantNotifier\Tables;

use Botble\InstantNotifier\Models\InstantNotifier;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\FormattedColumn;
use Illuminate\Database\Eloquent\Builder;

class InstantNotifierTable extends TableAbstract
{
    protected $tableIndex = 1;
    public function setup(): void
    {
        
        $this
            ->model(InstantNotifier::class)
            ->addActions([
                DeleteAction::make()->route('instantnotifier.destroy'),
            ])
            ->addColumns([
                FormattedColumn::make('id')->label("Message")->getValueUsing(function (FormattedColumn $column) {
                    $index = request()->get('start', 0) + $this->tableIndex;
                    $this->tableIndex++;

                    $title = $column->getItem()->name;
                    $date = $column->getItem()->created_at;
                    $formattedDate = $date->format('d-M-Y H:i A');
                    $title = $title.' at '.$formattedDate;
                    $message = $column->getItem()->message;
                    $message = explode("\n", $message);
        
                    $half = ceil(count($message) / 2);
                    $firstColumnMessages = array_slice($message, 0, $half);
                    $secondColumnMessages = array_slice($message, $half);
            
                    $firstColumn = array_map(function ($item) {
                        return '<p class="mb-1">'.$item.'</p>';
                    }, $firstColumnMessages);

                    $secondColumn = array_map(function ($item) {
                        return '<p class="mb-1">'.$item.'</p>';
                    }, $secondColumnMessages);
        
                    $output = [
                        '<div class="card mb-3">',
                        '<div class="card-header bg-primary text-white"><h4 class="mb-0 text-white">'.$index.'. '.$title.'</h4></div>',
                        '<div class="card-body">',
                        '<div class="row">',
                        '<div class="col-md-6">',
                        implode('', $firstColumn),
                        '</div>',
                        '<div class="col-md-6">',
                        implode('', $secondColumn),
                        '</div>',
                        '</div>',
                        '</div>',
                        '</div>' 
                    ];
                    return implode('', $output);
                })
            ])            
            ->addBulkActions([
                DeleteBulkAction::make()->permission('instantnotifier.destroy'),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                    'id',
                    'name',
                    'message',
                    'message_type',
                    'response',
                    'created_at',
                ])->orderBy('id', "DESC");
            });
    }
}
