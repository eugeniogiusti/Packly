<?php

namespace App\Livewire;

use App\Models\PackingItem;
use App\Models\Trip;
use Livewire\Component;

class PackingList extends Component
{
    public Trip $trip;
    public string $mode = 'packing';  // packing | unpacking
    public string $newItemName = '';
    public string $newItemCategory = 'accessories';

    public function mount(Trip $trip): void
    {
        $this->trip = $trip;
    }

    public function setMode(string $mode): void
    {
        $this->mode = $mode;
    }

    public function toggleItem(int $itemId): void
    {
        $item  = PackingItem::findOrFail($itemId);
        $field = $this->mode === 'packing' ? 'packed' : 'unpacked';
        $item->update([$field => !$item->$field]);
    }

    public function addItem(): void
    {
        $this->validate([
            'newItemName'     => 'required|string|max:255',
            'newItemCategory' => 'required|in:documents,clothes,hygiene,tech,accessories,gear',
        ]);

        $this->trip->packingItems()->create([
            'name'     => $this->newItemName,
            'category' => $this->newItemCategory,
            'order'    => $this->trip->packingItems()->where('category', $this->newItemCategory)->count() + 1,
        ]);

        $this->newItemName = '';
    }

    public function removeItem(int $itemId): void
    {
        PackingItem::findOrFail($itemId)->delete();
    }

    public function render()
    {
        $categories = [
            'documents'   => ['label' => 'Documenti',  'icon' => 'fa-passport'],
            'clothes'     => ['label' => 'Vestiti',    'icon' => 'fa-tshirt'],
            'hygiene'     => ['label' => 'Igiene',     'icon' => 'fa-pump-soap'],
            'tech'        => ['label' => 'Tech',       'icon' => 'fa-laptop'],
            'accessories' => ['label' => 'Accessori',  'icon' => 'fa-glasses'],
            'gear'        => ['label' => 'Gear',       'icon' => 'fa-hiking'],
        ];

        $field    = $this->mode === 'packing' ? 'packed' : 'unpacked';
        $items    = $this->trip->packingItems()->orderBy('order')->get()->groupBy('category');
        $done     = $this->trip->packingItems()->where($field, true)->count();
        $total    = $this->trip->packingItems()->count();
        $progress = $total > 0 ? (int) round(($done / $total) * 100) : 0;

        return view('livewire.packing-list', compact('categories', 'items', 'done', 'total', 'progress'));
    }
}
