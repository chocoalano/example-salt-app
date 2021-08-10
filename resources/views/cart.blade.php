@extends('layouts.app')

@section('content')
<h1 class="cover-heading mb-3">{{ __('Keranjang Belanja Anda') }}</h1>
<div class="card-deck mb-3 text-center">
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
            <tr>
                <td>{{ ucfirst(strtolower($value->product->name)) }}</td>
                <td>{{ number_format($value->product->child->price) }}</td>
                <td>
                    <div class="row">
                        <div class="col-md">{{ date($value->created_at) }}</div>
                        <div class="col-md">
                            <form action="{{route('cart.destroy',$value->id)}}" method="post">
                                @csrf
                                {{method_field('delete')}}
                                <button type="submit" class="btn deleted-button" style="background-color:transparent;">
                                    <i class="bi bi-trash text-light"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection
@section('js')
@endsection