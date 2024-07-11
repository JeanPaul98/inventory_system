<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit.prevent="generateReport">
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date de début <span class="text-danger">*</span></label>
                                    <input wire:model="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date de fin <span class="text-danger">*</span></label>
                                    <input wire:model="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Transactions</label>
                                    <select wire:model="payments" class="form-control" name="payments">
                                        <option value="">Sélectionner les transactions</option>
                                        <option value="sale">Ventes</option>
                                        <option value="sale_return">Retours de ventes</option>
                                        <option value="purchase">Achats</option>
                                        <option value="purchase_return">Retours d'achats</option>
                                    </select>
                                    @error('payments')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Méthode de paiement</label>
                                    <select wire:model="payment_method" class="form-control" name="payment_method">
                                        <option value="">Sélectionner la méthode de paiement</option>
                                        <option value="Cash">Espèces</option>
                                        <option value="Credit Card">Carte de crédit</option>
                                        <option value="Bank Transfer">Virement bancaire</option>
                                        <option value="Cheque">Chèque</option>
                                        <option value="Other">Autre</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading wire:target="generateReport" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i wire:loading.remove wire:target="generateReport" class="bi bi-shuffle"></i>
                                Filtrer le rapport
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($information->isNotEmpty())
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Chargement...</span>
                                </div>
                            </div>
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Référence</th>
                                <th>{{ ucwords(str_replace('_', ' ', $payments)) }}</th>
                                <th>Total</th>
                                <th>Méthode de paiement</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($information as $data)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($data->date)->format('d M, Y') }}</td>
                                    <td>{{ $data->reference }}</td>
                                    <td>
                                        @if($payments == 'sale')
                                            {{ $data->sale->reference }}
                                        @elseif($payments == 'purchase')
                                            {{ $data->purchase->reference }}
                                        @elseif($payments == 'sale_return')
                                            {{ $data->saleReturn->reference }}
                                        @elseif($payments == 'purchase_return')
                                            {{ $data->purchaseReturn->reference }}
                                        @endif
                                    </td>
                                    <td>{{ format_currency($data->amount) }}</td>
                                    <td>{{ $data->payment_method }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">Aucune donnée disponible !</span>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div @class(['mt-3' => $information->hasPages()])>
                            {{ $information->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="alert alert-warning mb-0">
                            Aucune donnée disponible !
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
