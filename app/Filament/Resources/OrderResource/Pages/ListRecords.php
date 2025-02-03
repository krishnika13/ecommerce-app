<?php
// app/Filament/Resources/Pages/ListRecords.php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords as BaseListRecords;

class ListRecords extends BaseListRecords
{
    // Explicitly set the resource
    protected static string $resource = OrderResource::class;
}
