<?php

namespace App\Filament\Resources\MaintenanceTickets;

use App\Filament\Resources\MaintenanceTickets\Pages\CreateMaintenanceTicket;
use App\Filament\Resources\MaintenanceTickets\Pages\EditMaintenanceTicket;
use App\Filament\Resources\MaintenanceTickets\Pages\ListMaintenanceTickets;
use App\Filament\Resources\MaintenanceTickets\Pages\ViewMaintenanceTicket;
use App\Filament\Resources\MaintenanceTickets\Schemas\MaintenanceTicketForm;
use App\Filament\Resources\MaintenanceTickets\Schemas\MaintenanceTicketInfolist;
use App\Filament\Resources\MaintenanceTickets\Tables\MaintenanceTicketsTable;
use App\Models\MaintenanceTicket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MaintenanceTicketResource extends Resource
{
    protected static ?string $model = MaintenanceTicket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 6;

    protected static string|UnitEnum|null $navigationGroup = 'Maintenance & Support';

    public static function getModelLabel(): string
    {
        return __('filament::resources.maintenance_tickets');
    }

    public static function form(Schema $schema): Schema
    {
        return MaintenanceTicketForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MaintenanceTicketInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaintenanceTicketsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMaintenanceTickets::route('/'),
            'create' => CreateMaintenanceTicket::route('/create'),
            'view' => ViewMaintenanceTicket::route('/{record}'),
            'edit' => EditMaintenanceTicket::route('/{record}/edit'),
        ];
    }
}
