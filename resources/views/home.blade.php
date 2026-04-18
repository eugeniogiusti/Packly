@extends('layouts.admin')

@section('main-content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="{{ route('trips.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Nuovo Viaggio
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Viaggi Totali</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTrips }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-suitcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Prossimo Viaggio</div>
                            @if ($nextTrip)
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nextTrip->destination }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $nextTrip->departure_date->format('d M Y') }}</div>
                            @else
                                <div class="h5 mb-0 font-weight-bold text-gray-400">—</div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Template Salvati</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTemplates }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        {{-- Lista Viaggi --}}
        <div class="col-lg-7 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">I miei viaggi</h6>
                    <a href="{{ route('trips.index') }}" class="btn btn-sm btn-outline-primary">Gestisci</a>
                </div>
                @if ($trips->isEmpty())
                    <div class="card-body text-center py-5">
                        <i class="fas fa-suitcase fa-3x text-gray-300 mb-3"></i>
                        <p class="text-gray-500 mb-3">Nessun viaggio ancora.</p>
                        <a href="{{ route('trips.index') }}" class="btn btn-sm btn-primary">Crea il primo</a>
                    </div>
                @else
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Destinazione</th>
                                        <th>Data</th>
                                        <th>Stato</th>
                                        <th>Progresso</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trips as $trip)
                                        @php
                                            $total    = $trip->packingItems()->count();
                                            $packed   = $trip->packingItems()->where('packed', true)->count();
                                            $progress = $total > 0 ? (int) round(($packed / $total) * 100) : 0;
                                        @endphp
                                        <tr>
                                            <td>
                                                <i class="fas {{ $trip->type_icon }} text-{{ $trip->type_color }} mr-1"></i>
                                                <strong>{{ $trip->destination }}</strong>
                                            </td>
                                            <td class="text-gray-600 small">
                                                {{ $trip->departure_date->format('d M Y') }}
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $trip->status_color }}">
                                                    {{ $trip->status_label }}
                                                </span>
                                            </td>
                                            <td style="min-width:100px;">
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 mr-2" style="height:6px;">
                                                        <div class="progress-bar bg-primary" style="width:{{ $progress }}%"></div>
                                                    </div>
                                                    <span class="text-xs text-gray-500">{{ $progress }}%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('trips.show', $trip) }}" class="btn btn-sm btn-primary">
                                                    Apri
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Template --}}
        <div class="col-lg-5 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Template Salvati</h6>
                </div>
                @if ($templates->isEmpty())
                    <div class="card-body text-center py-5">
                        <i class="fas fa-layer-group fa-3x text-gray-300 mb-3"></i>
                        <p class="text-gray-500 small">Nessun template ancora.<br>Apri un viaggio e salvalo come template.</p>
                    </div>
                @else
                    <div class="card-body">
                        <div class="row">
                            @foreach ($templates as $template)
                                <div class="col-6 mb-3">
                                    <div class="card border h-100">
                                        <div class="card-body py-3 px-3">
                                            <div class="d-flex align-items-center mb-1">
                                                <i class="fas {{ $template->type_icon }} text-{{ $template->type_color }} mr-2"></i>
                                                <strong class="small">{{ $template->name }}</strong>
                                            </div>
                                            <div class="text-xs text-gray-500">{{ $template->items->count() }} item</div>
                                            <form action="{{ route('templates.destroy', $template) }}" method="POST" class="d-inline mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-xs btn-outline-danger mt-1"
                                                        style="font-size:11px; padding:2px 8px;"
                                                        onclick="return confirm('Eliminare il template?')">
                                                    <i class="fas fa-trash fa-xs"></i> Elimina
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

@endsection
