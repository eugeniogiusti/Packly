@extends('layouts.admin')

@section('main-content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">I miei viaggi</h1>
        <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalCreateTrip">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Nuovo Viaggio
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    @if ($trips->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-suitcase fa-4x text-gray-300 mb-3"></i>
            <p class="text-gray-500 mb-3">Nessun viaggio ancora. Crea il tuo primo!</p>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreateTrip">
                <i class="fas fa-plus mr-1"></i> Nuovo Viaggio
            </button>
        </div>
    @else
        <div class="row">
            @foreach ($trips as $trip)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow h-100 border-left-{{ $trip->type_color }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div>
                                    <i class="fas {{ $trip->type_icon }} text-{{ $trip->type_color }} mr-1"></i>
                                    <span class="text-xs font-weight-bold text-{{ $trip->type_color }} text-uppercase">
                                        {{ ucfirst($trip->type) }}
                                    </span>
                                </div>
                                <span class="badge badge-{{ $trip->status_color }}">{{ $trip->status_label }}</span>
                            </div>

                            <h5 class="font-weight-bold text-gray-800 mb-1">{{ $trip->name }}</h5>
                            <div class="text-gray-600 mb-2">
                                <i class="fas fa-map-marker-alt fa-sm mr-1"></i> {{ $trip->destination }}
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <i class="fas fa-calendar fa-sm mr-1"></i>
                                {{ $trip->departure_date->format('d M Y') }}
                                @if ($trip->return_date)
                                    → {{ $trip->return_date->format('d M Y') }}
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('trips.show', $trip) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-list fa-sm mr-1"></i> Apri lista
                                </a>
                                <div>
                                    <button class="btn btn-sm btn-outline-secondary mr-1"
                                        data-toggle="modal"
                                        data-target="#modalEditTrip"
                                        data-id="{{ $trip->id }}"
                                        data-name="{{ $trip->name }}"
                                        data-destination="{{ $trip->destination }}"
                                        data-departure="{{ $trip->departure_date->format('Y-m-d') }}"
                                        data-return="{{ $trip->return_date?->format('Y-m-d') }}"
                                        data-type="{{ $trip->type }}"
                                        data-status="{{ $trip->status }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger"
                                        data-toggle="modal"
                                        data-target="#modalDeleteTrip"
                                        data-id="{{ $trip->id }}"
                                        data-name="{{ $trip->name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Modale Crea Viaggio --}}
    <div class="modal fade" id="modalCreateTrip" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('trips.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-plus mr-2 text-primary"></i>Nuovo Viaggio</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome viaggio</label>
                            <input type="text" name="name" class="form-control" placeholder="es. Estate a Barcellona" required>
                        </div>
                        <div class="form-group">
                            <label>Destinazione</label>
                            <input type="text" name="destination" class="form-control" placeholder="es. Barcellona, Spagna" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Data partenza</label>
                                <input type="date" name="departure_date" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Data ritorno</label>
                                <input type="date" name="return_date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tipo di viaggio</label>
                            <select name="type" class="form-control">
                                <option value="city">🏙️ Città</option>
                                <option value="beach">🏖️ Mare</option>
                                <option value="mountain">⛰️ Montagna</option>
                                <option value="business">💼 Business</option>
                            </select>
                        </div>
                        @if ($templates->isNotEmpty())
                            <div class="form-group">
                                <label>Usa un template <span class="text-gray-500 font-weight-normal">(opzionale)</span></label>
                                <select name="template_id" class="form-control">
                                    <option value="">— Lista di default per tipo —</option>
                                    @foreach ($templates as $template)
                                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Se scegli un template, sovrascrive la lista di default.</small>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-primary">Crea Viaggio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modale Modifica Viaggio --}}
    <div class="modal fade" id="modalEditTrip" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formEditTrip" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-edit mr-2 text-primary"></i>Modifica Viaggio</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome viaggio</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Destinazione</label>
                            <input type="text" name="destination" id="editDestination" class="form-control" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Data partenza</label>
                                <input type="date" name="departure_date" id="editDeparture" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Data ritorno</label>
                                <input type="date" name="return_date" id="editReturn" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Tipo</label>
                                <select name="type" id="editType" class="form-control">
                                    <option value="city">🏙️ Città</option>
                                    <option value="beach">🏖️ Mare</option>
                                    <option value="mountain">⛰️ Montagna</option>
                                    <option value="business">💼 Business</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Stato</label>
                                <select name="status" id="editStatus" class="form-control">
                                    <option value="preparing">In preparazione</option>
                                    <option value="traveling">In viaggio</option>
                                    <option value="done">Completato</option>
                                </select>
                            </div>
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

    {{-- Modale Elimina Viaggio --}}
    <div class="modal fade" id="modalDeleteTrip" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="formDeleteTrip" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title text-danger"><i class="fas fa-trash mr-2"></i>Elimina</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare <strong id="deleteTripName"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    // Popola modale modifica
    $('#modalEditTrip').on('show.bs.modal', function (e) {
        const btn = $(e.relatedTarget);
        const id = btn.data('id');
        $('#formEditTrip').attr('action', '/trips/' + id);
        $('#editName').val(btn.data('name'));
        $('#editDestination').val(btn.data('destination'));
        $('#editDeparture').val(btn.data('departure'));
        $('#editReturn').val(btn.data('return'));
        $('#editType').val(btn.data('type'));
        $('#editStatus').val(btn.data('status'));
    });

    // Popola modale elimina
    $('#modalDeleteTrip').on('show.bs.modal', function (e) {
        const btn = $(e.relatedTarget);
        $('#formDeleteTrip').attr('action', '/trips/' + btn.data('id'));
        $('#deleteTripName').text(btn.data('name'));
    });
</script>
@endsection
