@extends('layouts.admin')

@section('main-content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <a href="{{ route('trips.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Viaggi
            </a>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas {{ $trip->type_icon }} text-{{ $trip->type_color }} mr-2"></i>
                {{ $trip->name }}
            </h1>
            <div class="text-gray-500 small mt-1">
                <i class="fas fa-map-marker-alt mr-1"></i> {{ $trip->destination }}
                &nbsp;·&nbsp;
                <i class="fas fa-calendar mr-1"></i> {{ $trip->departure_date->format('d M Y') }}
                @if ($trip->return_date)
                    → {{ $trip->return_date->format('d M Y') }}
                @endif
                &nbsp;·&nbsp;
                <span class="badge badge-{{ $trip->status_color }}">{{ $trip->status_label }}</span>
            </div>
        </div>
        <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalSaveTemplate">
            <i class="fas fa-layer-group mr-1"></i> Salva come template
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <livewire:packing-list :trip="$trip" />

    {{-- Modale salva come template --}}
    <div class="modal fade" id="modalSaveTemplate" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="{{ route('templates.storeFromTrip', $trip) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-layer-group mr-2 text-primary"></i>Salva template
                        </h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome template</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="es. Mare estivo" value="{{ $trip->name }}" required>
                        </div>
                        <div class="form-group">
                            <label>Tipo</label>
                            <select name="type" class="form-control">
                                <option value="custom" {{ $trip->type === 'custom' ? 'selected' : '' }}>🗂️ Custom</option>
                                <option value="city" {{ $trip->type === 'city' ? 'selected' : '' }}>🏙️ Città</option>
                                <option value="beach" {{ $trip->type === 'beach' ? 'selected' : '' }}>🏖️ Mare</option>
                                <option value="mountain" {{ $trip->type === 'mountain' ? 'selected' : '' }}>⛰️ Montagna</option>
                                <option value="business" {{ $trip->type === 'business' ? 'selected' : '' }}>💼 Business</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-primary">Salva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
