<x-filament-panels::page>
    <form wire:submit="import">
        {{ $this->form }}
        
        <div class="flex justify-end gap-2 mt-6">
            <x-filament::button type="button" wire:navigate href="{{ EmployeeResource::getUrl('index') }}">
                Cancel
            </x-filament::button>
            
            <x-filament::button type="submit" icon="heroicon-o-arrow-up-tray">
                Import Employees
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>