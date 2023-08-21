
<form action="" method="post">
    @csrf

    @for ($i = 0; $i < $numberinput; $i++)
        <div class="form-group">
            <label for="libellepiece{{ $i }}">Libellé de la pièce {{ $i + 1 }}</label>
            <input type="text" name="libellepiece[]" id="libellepiece{{ $i }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="referencespiece{{ $i }}">Références de la pièce {{ $i + 1 }}</label>
            <input type="text" name="referencespiece[]" id="referencespiece{{ $i }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="date_piece{{ $i }}">Date de la pièce {{ $i + 1 }}</label>
            <input type="date" name="date_piece[]" id="date_piece{{ $i }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="montantligne{{ $i }}">Montant de la ligne {{ $i + 1 }}</label>
            <input type="number" name="montantligne[]" id="montantligne{{ $i }}" class="form-control">
        </div>
    @endfor

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
