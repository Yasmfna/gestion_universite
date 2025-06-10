


@extends('layouts.app_user')

@section('content')
<div class="row g-3 mb-4">
                <!-- Boîte Demandes passées -->
                <div class="col-sm-4">
                <div class="card shadow-sm text-white bg-info h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                    <i class="fas fa-history fa-3x"></i>
                    <div>
                        <h6 class="card-subtitle mb-2">Demandes passées</h6>
                        <h3 class="card-title mb-0">8</h3>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Boîte Demandes en cours -->
                <div class="col-sm-4">
                <div class="card shadow-sm text-white bg-warning h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                    <i class="fas fa-hourglass-half fa-3x"></i>
                    <div>
                        <h6 class="card-subtitle mb-2">Demandes en cours</h6>
                        <h3 class="card-title mb-0">5</h3>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Boîte Total demandes -->
                <div class="col-sm-4">
                <div class="card shadow-sm text-white bg-success h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                    <i class="fas fa-list fa-3x"></i>
                    <div>
                        <h6 class="card-subtitle mb-2">Demandes totales</h6>
                        <h3 class="card-title mb-0">13</h3>
                    </div>
                    </div>
                </div>
                </div>
            </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
