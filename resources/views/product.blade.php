@extends('layouts.app')

@section('content')
<h1 class="cover-heading">{{ __('Product') }}</h1>
<div class="card-deck mb-3 text-center">
    @foreach($data as $k => $v)
    <div class="card mb-4 shadow-sm text-white bg-dark">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{ ucfirst(strtolower($v->name)) }}</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">Rp. {{ number_format($v->child->price) }} <small class="text-muted">/</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
                <li>Rate Total {{ number_format($v->child->content) }} ML</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-light show-modal" data-id="{{ $v->id }}" data-toggle="modal" data-target="#exampleModal">Order now</button>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Checkout Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="name-product"></h5>
                <p class="desc-product"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-light add-to-cart">Add to cart</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('.show-modal').click(function() {
        let id = $(this).data('id');
        let url = APP_URL + 'product/' + id;
        $.get(url, function(e) {
            let res = JSON.parse(e);
            $(".name-product").html(res['data']['name'] + ' /Rp. ' + res['data']['child']['price'] + ' /' + res['data']['child']['content'] + ' ML');
            $(".desc-product").html(res['data']['child']['desc']);
            $('.add-to-cart').attr('dataPostId', res['data']['id']);
            $('.add-to-cart').attr('dataPostPrice', res['data']['child']['price']);
        });
    });

    $(".add-to-cart").click(function() {
        $("#exampleModal").modal('hide');
        const r=$(this).attr('dataPostId');
        const rp=$(this).attr('dataPostPrice');
        $.post(APP_URL + 'cart',{id:r,x:rp},function(e){
            console.log(e);
        });
    });
</script>
@endsection