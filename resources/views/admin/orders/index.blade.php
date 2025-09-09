@extends('admin.layout')

@section('title')
    Toutes les commandes
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Section header --}}
        <section class="content-header">
            <div class="content-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Toutes les commandes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Commandes</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section content --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Liste de toutes les commandes</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.orders.pending') }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-clock"></i> Commandes en attente
                                        <span class="badge badge-light">{{ $orders->where('status', 'pending')->count() }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">

                                {{-- Message de succès --}}
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Client</th>
                                            <th>Total</th>
                                            <th>Statut</th>
                                            <th>Paiement</th>
                                            <th>Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $orderItem)
                                        <tr>
                                            <td>#{{ $orderItem->id }}</td>
                                            <td>
                                                @if($orderItem->user)
                                                    {{ $orderItem->user->name }}<br>
                                                    <small class="text-muted">{{ $orderItem->user->phone ?? 'N/A' }}</small>
                                                @else
                                                    Client invité
                                                @endif
                                            </td>
                                            <td>{{ number_format($orderItem->total_amount, 0, ',', ' ') }} FG</td>
                                            <td class="text-center">
                                                <span class="badge 
                                                    @if($orderItem->status == 'pending') badge-warning
                                                    @elseif($orderItem->status == 'paid') badge-success
                                                    @elseif($orderItem->status == 'cancelled') badge-danger
                                                    @else badge-secondary @endif">
                                                    {{ ucfirst($orderItem->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge 
                                                    @if($orderItem->payment_status == 'pending') badge-warning
                                                    @elseif($orderItem->payment_status == 'confirmed') badge-success
                                                    @else badge-secondary @endif">
                                                    {{ ucfirst($orderItem->payment_status) }}
                                                </span>
                                            </td>
                                            <td>{{ $orderItem->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.orders.show', $orderItem->id) }}" class="btn btn-info btn-sm" title="Voir détails">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($orderItem->status == 'pending')
                                                    <form action="{{ route('admin.orders.approve', $orderItem->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm" title="Valider la commande" onclick="return confirm('Confirmez-vous la validation de cette commande ?')">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.orders.reject', $orderItem->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Refuser la commande" onclick="return confirm('Confirmez-vous le refus de cette commande ? Les stocks seront restaurés.')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            },
            "order": [[0, 'desc']]
        });
    });
</script>
@endsection