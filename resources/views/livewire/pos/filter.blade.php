<div>
    <div class="form-row">
        <div class="col-md-7">
            <div class="form-group">
                <label>Catégorie de Produit</label>
                <select wire:model.live="category" class="form-control">
                    <option value="">Tous les produits</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>Nombre de Produits</label>
                <select wire:model.live="showCount" class="form-control">
                    <option value="9">9 Produits</option>
                    <option value="15">15 Produits</option>
                    <option value="21">21 Produits</option>
                    <option value="30">30 Produits</option>
                    <option value="">Tous les produits</option>
                </select>
            </div>
        </div>
    </div>
</div>
