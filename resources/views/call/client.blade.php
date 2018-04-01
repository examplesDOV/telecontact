@extends('layouts.app')

@section('content')
<div class="jumbotron">
    @include('call.errors')

    @if ($client)
    <h2><small class="text-muted">Имя:</small> {{ $client->name }}</h2>
    <h2><small class="text-muted">Номер телефона:</small> {{ $client->phone }}</h2>
    <h2>
        <small class="text-muted">Статус последнего звонка:</small> 
        {{ config('client.call_status.'.$client->status) }}
    </h2>

    <form action="{{ route('client.update') }}" method="post">

        <div class="form-group">
            <label>Поле 1</label>
            <textarea name="info[data_1]" 
                      class="form-control" 
                      rows="3">{{ old('info.data_1', $client->info->data_1 OR '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Поле 2</label>
            <textarea name="info[data_2]" 
                      class="form-control" 
                      rows="3">{{ old('info.data_2', $client->info->data_2 OR '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Поле 3</label>
            <textarea name="info[data_3]" 
                      class="form-control" 
                      rows="3">{{ old('info.data_3', $client->info->data_3 OR '') }}</textarea>
        </div>

        @include('call.status')        


        {{ csrf_field() }}
        <input name="id" value="{{ $client->id }}" type="hidden">
        <div class="row">
            <div class="col-md-6 mb-3">        
                <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
            </div>
            <div class="col-md-6 mb-3 text-right">
                <a href="/pause" class="btn btn-secondary">Отдохнуть</a>
            </div>
        </div>
    </form>
</div>

@else
<div class="text-center">

    <h2>Нет свободных клиентов</h2>
    <a href="/call" class="btn btn-primary btn-lg">Получить свободного клиента</a>

</div>
@endif
</div>
@endsection
