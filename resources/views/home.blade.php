@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Nuovo Viaggio
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row">

        <!-- Viaggi totali -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Viaggi Totali</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-suitcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prossimo viaggio -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Prossimo Viaggio</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Barcellona</div>
                            <div class="text-xs text-gray-500">15 Apr 2026</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Item da spuntare -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Item da Fare</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">7 / 24</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 29%" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-square fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Template salvati -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Template Salvati</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
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

        <!-- Prossimi Viaggi -->
        <div class="col-lg-7 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Prossimi Viaggi</h6>
                    <a href="#" class="btn btn-sm btn-outline-primary">Vedi tutti</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Destinazione</th>
                                    <th>Data</th>
                                    <th>Progresso</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                        <strong>Barcellona</strong>
                                    </td>
                                    <td><span class="text-gray-600">15 Apr 2026</span></td>
                                    <td style="min-width: 120px;">
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                <div class="progress-bar bg-warning" style="width: 29%"></div>
                                            </div>
                                            <span class="text-xs text-gray-600">29%</span>
                                        </div>
                                    </td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Apri</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-map-marker-alt text-success mr-2"></i>
                                        <strong>Londra</strong>
                                    </td>
                                    <td><span class="text-gray-600">3 Mag 2026</span></td>
                                    <td style="min-width: 120px;">
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                <div class="progress-bar bg-success" style="width: 0%"></div>
                                            </div>
                                            <span class="text-xs text-gray-600">0%</span>
                                        </div>
                                    </td>
                                    <td><a href="#" class="btn btn-sm btn-outline-primary">Apri</a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-map-marker-alt text-info mr-2"></i>
                                        <strong>Tokyo</strong>
                                    </td>
                                    <td><span class="text-gray-600">20 Giu 2026</span></td>
                                    <td style="min-width: 120px;">
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                <div class="progress-bar bg-info" style="width: 0%"></div>
                                            </div>
                                            <span class="text-xs text-gray-600">0%</span>
                                        </div>
                                    </td>
                                    <td><a href="#" class="btn btn-sm btn-outline-primary">Apri</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Template -->
            <div class="card shadow">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Template Salvati</h6>
                    <a href="#" class="btn btn-sm btn-outline-primary">Gestisci</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="card border h-100">
                                <div class="card-body py-3 px-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-umbrella-beach text-warning mr-2"></i>
                                        <strong class="small">Mare</strong>
                                    </div>
                                    <div class="text-xs text-gray-500">18 item</div>
                                    <a href="#" class="btn btn-xs btn-outline-secondary mt-2" style="font-size:11px; padding: 2px 8px;">Usa</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="card border h-100">
                                <div class="card-body py-3 px-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-briefcase text-primary mr-2"></i>
                                        <strong class="small">Business</strong>
                                    </div>
                                    <div class="text-xs text-gray-500">12 item</div>
                                    <a href="#" class="btn btn-xs btn-outline-secondary mt-2" style="font-size:11px; padding: 2px 8px;">Usa</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="card border h-100">
                                <div class="card-body py-3 px-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-mountain text-success mr-2"></i>
                                        <strong class="small">Montagna</strong>
                                    </div>
                                    <div class="text-xs text-gray-500">22 item</div>
                                    <a href="#" class="btn btn-xs btn-outline-secondary mt-2" style="font-size:11px; padding: 2px 8px;">Usa</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="card border h-100">
                                <div class="card-body py-3 px-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-city text-info mr-2"></i>
                                        <strong class="small">City Break</strong>
                                    </div>
                                    <div class="text-xs text-gray-500">15 item</div>
                                    <a href="#" class="btn btn-xs btn-outline-secondary mt-2" style="font-size:11px; padding: 2px 8px;">Usa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checklist Barcellona -->
        <div class="col-lg-5 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-map-marker-alt mr-1"></i> Barcellona — Lista
                    </h6>
                    <span class="badge badge-warning">7 / 24</span>
                </div>
                <div class="card-body" style="overflow-y: auto; max-height: 480px;">

                    <!-- Categoria Documenti -->
                    <div class="text-xs font-weight-bold text-uppercase text-gray-500 mb-2">
                        <i class="fas fa-passport mr-1"></i> Documenti
                    </div>
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item1" checked>
                            <label class="custom-control-label text-decoration-line-through text-gray-500" for="item1">Passaporto</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item2" checked>
                            <label class="custom-control-label text-decoration-line-through text-gray-500" for="item2">Carta d'identità</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item3">
                            <label class="custom-control-label" for="item3">Assicurazione viaggio</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item4">
                            <label class="custom-control-label" for="item4">Prenotazione hotel</label>
                        </div>
                    </div>

                    <!-- Categoria Tech -->
                    <div class="text-xs font-weight-bold text-uppercase text-gray-500 mb-2">
                        <i class="fas fa-laptop mr-1"></i> Tech
                    </div>
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item5" checked>
                            <label class="custom-control-label text-decoration-line-through text-gray-500" for="item5">Caricatore telefono</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item6" checked>
                            <label class="custom-control-label text-decoration-line-through text-gray-500" for="item6">Power bank</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item7">
                            <label class="custom-control-label" for="item7">Adattatore prese</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item8">
                            <label class="custom-control-label" for="item8">Cuffie</label>
                        </div>
                    </div>

                    <!-- Categoria Vestiti -->
                    <div class="text-xs font-weight-bold text-uppercase text-gray-500 mb-2">
                        <i class="fas fa-tshirt mr-1"></i> Vestiti
                    </div>
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item9" checked>
                            <label class="custom-control-label text-decoration-line-through text-gray-500" for="item9">T-shirt (3x)</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item10">
                            <label class="custom-control-label" for="item10">Pantaloni</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item11">
                            <label class="custom-control-label" for="item11">Scarpe comode</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item12">
                            <label class="custom-control-label" for="item12">Felpa</label>
                        </div>
                    </div>

                    <!-- Categoria Igiene -->
                    <div class="text-xs font-weight-bold text-uppercase text-gray-500 mb-2">
                        <i class="fas fa-pump-soap mr-1"></i> Igiene
                    </div>
                    <div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item13">
                            <label class="custom-control-label" for="item13">Spazzolino</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item14">
                            <label class="custom-control-label" for="item14">Shampoo</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="item15">
                            <label class="custom-control-label" for="item15">Crema solare</label>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-sm btn-primary btn-block">Apri lista completa</a>
                </div>
            </div>
        </div>

    </div>

@endsection
