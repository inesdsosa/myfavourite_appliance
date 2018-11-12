@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h3>All Appliances</h3>


                </div>
                <div class="panel panel-default">
                    <div class="btn-group" role="group" aria-label="...">
                        <h5>Order by</h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                Seleccione una opción
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                    <li><a href="{{'/?orderby=price'}}">Price</a></li>
                                    <li><a href="{{'/?orderby=title'}}">Title</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

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
                        @forelse ($appliances as $appliance)
                            <tr>
                                <td width="650px">{{ $appliance->title }}</td>
                                <td>{{ number_format ( $appliance->price , 2 , "." , "," ) }}€</td>
                                <td width="20px"></td>
                                @if (Auth::check())
                                    <td width="20px">
                                        <form action = "{{ url('/addwishlist/'. $appliance->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <!-- <input type="submit" class="btn- btn-primary"/> -->
                                            <button type="submit">Add wishlist</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <div class="alert alert-success">
                                <p>No appliances</p>
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                </div>


                {{ $appliances->links() }}
            </div>
        </div>
    </div>
@endsection
