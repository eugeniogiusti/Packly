<div>

    {{-- Switch Partenza / Ritorno --}}
    <div class="card shadow mb-4">
        <div class="card-body py-2 d-flex align-items-center justify-content-between">
            <div class="btn-group" role="group">
                <button wire:click="setMode('packing')"
                        class="btn btn-sm {{ $mode === 'packing' ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="fas fa-suitcase mr-1"></i> Sto partendo
                </button>
                <button wire:click="setMode('unpacking')"
                        class="btn btn-sm {{ $mode === 'unpacking' ? 'btn-success' : 'btn-outline-success' }}">
                    <i class="fas fa-home mr-1"></i> Sono tornato
                </button>
            </div>
            <span class="text-gray-500 small">
                @if ($mode === 'packing')
                    Spunta gli item mentre fai la valigia
                @else
                    Spunta gli item mentre li rimetti a posto
                @endif
            </span>
        </div>
    </div>

    {{-- Progress Bar --}}
    <div class="card shadow mb-4">
        <div class="card-body py-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="font-weight-bold text-gray-700">
                    {{ $mode === 'packing' ? 'Packing' : 'Unpacking' }}
                </span>
                <span class="font-weight-bold {{ $mode === 'packing' ? 'text-primary' : 'text-success' }}">
                    {{ $done }} / {{ $total }}
                </span>
            </div>
            <div class="progress" style="height: 12px;">
                <div class="progress-bar {{ $progress === 100 ? 'bg-success' : ($mode === 'packing' ? 'bg-primary' : 'bg-success') }}"
                     role="progressbar"
                     style="width: {{ $progress }}%"
                     aria-valuenow="{{ $progress }}"
                     aria-valuemin="0"
                     aria-valuemax="100">
                </div>
            </div>
            @if ($progress === 100)
                <div class="text-success text-center mt-2 small font-weight-bold">
                    <i class="fas fa-check-circle mr-1"></i>
                    {{ $mode === 'packing' ? 'Valigia pronta! Buon viaggio 🎉' : 'Tutto rimesso a posto!' }}
                </div>
            @endif
        </div>
    </div>

    {{-- Lista per categoria --}}
    @foreach ($categories as $key => $cat)
        @if (isset($items[$key]) && $items[$key]->count() > 0)
            <div class="card shadow mb-3">
                <div class="card-header py-2 d-flex align-items-center">
                    <i class="fas {{ $cat['icon'] }} text-primary mr-2"></i>
                    <span class="font-weight-bold text-gray-700">{{ $cat['label'] }}</span>
                    <span class="badge badge-light ml-2">
                        @if ($mode === 'packing')
                            {{ $items[$key]->where('packed', true)->count() }} / {{ $items[$key]->count() }}
                        @else
                            {{ $items[$key]->where('unpacked', true)->count() }} / {{ $items[$key]->count() }}
                        @endif
                    </span>
                </div>
                <div class="card-body py-2 px-3">
                    @foreach ($items[$key] as $item)
                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                            <div class="d-flex align-items-center">
                                <input type="checkbox"
                                       class="mr-3"
                                       style="width:18px; height:18px; cursor:pointer;"
                                       wire:click="toggleItem({{ $item->id }})"
                                       {{ ($mode === 'packing' ? $item->packed : $item->unpacked) ? 'checked' : '' }}>
                                <span class="{{ ($mode === 'packing' ? $item->packed : $item->unpacked) ? 'text-decoration-line-through text-muted' : '' }}">
                                    {{ $item->name }}
                                </span>
                            </div>
                            <button wire:click="removeItem({{ $item->id }})"
                                    class="btn btn-sm text-danger p-0 ml-2"
                                    style="background:none; border:none; opacity:0.3;"
                                    onmouseover="this.style.opacity=1"
                                    onmouseout="this.style.opacity=0.3"
                                    title="Rimuovi">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    {{-- Aggiungi item --}}
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <span class="font-weight-bold text-gray-700">
                <i class="fas fa-plus text-primary mr-2"></i>Aggiungi item
            </span>
        </div>
        <div class="card-body py-3">
            <form wire:submit.prevent="addItem" class="form-inline">
                <input type="text"
                       wire:model="newItemName"
                       class="form-control mr-2 mb-2"
                       placeholder="Nome item..."
                       style="min-width: 200px;">
                <select wire:model="newItemCategory" class="form-control mr-2 mb-2">
                    @foreach ($categories as $key => $cat)
                        <option value="{{ $key }}">{{ $cat['label'] }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary mb-2">
                    <i class="fas fa-plus fa-sm mr-1"></i> Aggiungi
                </button>
            </form>
            @error('newItemName')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>
