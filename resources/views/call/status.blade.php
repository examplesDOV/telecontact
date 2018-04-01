<div class="row">
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label>Статусы</label>
            <select id="status" name="status" class="form-control" required>
                <option value=""> -- Выбрать статус -- </option>
                @foreach (config('client.call_status') as $idStatus => $nameStatus)
                    @if ($idStatus > 0)
                        <option value="{{ $idStatus }}" 
{{ (old('status', $client->status) == $idStatus) ? 'selected' : '' }} >
                            {{ $nameStatus }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div> 
    </div> 
    <div class="col-md-6 mb-3">
        <div id="status4" class="form-group" style="display: none;">
            <label>Указать когда</label>
            <input type="text" name="timeout" value="{{ old('timeout') }}" id="datetimepicker" class="form-control">    
        </div>
    </div> 
</div>    