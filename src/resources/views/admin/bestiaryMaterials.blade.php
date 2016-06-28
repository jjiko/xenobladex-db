<form class="form">
    <input type="hidden" name="bestiary_id" id="bestiary_id-hidden">
    <input type="hidden" name="material_id" id="bestiary_id-hidden">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <label>Bestiary</label>
                <input class="form-control" list="bestiary" id="bestiary_id"></label>
                <datalist id="bestiary">
                    @foreach(\Jiko\XBXDB\Models\Bestiary::all() as $model)
                        <option data-value="<?php echo $model->id; ?>"><?php echo $model->name; ?></option>
                    @endforeach
                </datalist>
            </div>
            <div class="col-sm-6">
                <label>Materials</label>
                <input class="form-control" list="materials" id="material_id"></label>
                <datalist id="materials">
                    @foreach(\Jiko\XBXDB\Models\Materials::all() as $model)
                        <option data-value="<?php echo $model->id; ?>"><?php echo $model->name; ?></option>
                    @endforeach
                </datalist>
            </div>
        </div>
    </div>
    <div class="btn-group">
        <button class="btn btn-default">Fetch Drops</button>
        <button class="btn btn-default">Add to list</button>
    </div>
    <table class="table"></table>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<script>
    $('input[list]').on('input', function (evt) {
        var $input = $(evt.target),
                list = $input.attr('list'),
                $options = $("#" + list + ' option'),
                hiddenInput = $("#" + $input.attr('id') + '-hidden'),
                inputValue = $input.prop('value');

        hiddenInput.prop('value', inputValue);
        $options.each(function (i, e) {
            if (e.innerText == inputValue) {
                hiddenInput.prop('value', $(e).attr('data-value'));
                return;
            }
        });
    });
</script>