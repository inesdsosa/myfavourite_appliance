@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ $appliances->currentPage() }} de {{ $appliances->lastPage() }}
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>title</th>
                                <th>price</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appliances as $item)
                                <tr>
                                    <td width="650px">{{ $item->title }}</td>
                                    <td>{{ $item->price }} </td>
                                    <td width="20px"></td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
