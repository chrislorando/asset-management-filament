<?php
namespace App\Filament\Resources\AuditLogs\Tables;

use App\Models\AuditLog;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns;

class AuditLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("id")
                    ->label("ID")
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make("user.name")
                    ->label("User")
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(fn ($record) => $record->user?->name ?? "System")
                    ->badge()
                    ->color("primary"),

                Tables\Columns\TextColumn::make("formatted_action")
                    ->label("Action")
                    ->sortable()
                    ->badge()
                    ->color(fn ($record) => match($record->action) {
                        "create" => "success",
                        "update" => "warning", 
                        "delete" => "danger",
                        "restore" => "info",
                        "force_delete" => "danger",
                        default => "gray",
                    }),

                Tables\Columns\TextColumn::make("model_name")
                    ->label("Model")
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color("secondary"),

                Tables\Columns\TextColumn::make("model_id")
                    ->label("Model ID")
                    ->sortable(),

                Tables\Columns\TextColumn::make("changes_description")
                    ->label("Changes")
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make("ip_address")
                    ->label("IP Address")
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                Tables\Columns\TextColumn::make("created_at")
                    ->label("Date & Time")
                    ->dateTime()
                    ->sortable()
                    ->timezone("UTC"),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make("action")
                    ->options([
                        "create" => "Created",
                        "update" => "Updated", 
                        "delete" => "Deleted",
                        "restore" => "Restored",
                        "force_delete" => "Force Deleted",
                    ])
                    ->label("Action"),

                Tables\Filters\SelectFilter::make("model_type")
                    ->options(function () {
                        return AuditLog::distinct("model_type")
                            ->pluck("model_type", "model_type")
                            ->mapWithKeys(fn ($type) => [$type => class_basename($type)])
                            ->toArray();
                    })
                    ->label("Model Type"),

                Tables\Filters\SelectFilter::make("user_id")
                    ->options(function () {
                        return \App\Models\User::pluck("name", "id")
                            ->toArray();
                    })
                    ->label("User"),
            ])
            ->actions([
                ViewAction::make(),
            ]);
    }
}
