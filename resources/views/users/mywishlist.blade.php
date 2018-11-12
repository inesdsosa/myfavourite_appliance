@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h3>My wishlist</h3>
                </div>

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="panel panel-default">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>title</th>
                            <th>price</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($my_wishlist as $appliance)
                            <tr>
                                <td width="650px">{{ $appliance->title }}</td>
                                <td>{{ number_format ( $appliance->price , 2 , "." , "," ) }}€</td>
                                <td width="20px"></td>
                                @if (Auth::check())
                                    <td width="20px">
                                        <form action = "{{ url('/delwishlist/'. $appliance->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <!-- <input type="submit" class="btn- btn-primary"/> -->
                                            <button type="submit">Del wishlist</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <div class="alert alert-success">
                                <p>No items wishlist</p>
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
