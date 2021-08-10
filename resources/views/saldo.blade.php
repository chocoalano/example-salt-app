@extends('layouts.app')

@section('content')
<h1 class="cover-heading">{{ __('Isi Saldo Sekarang') }}</h1>
<div class="card-deck mb-3 text-center">
    <div class="input-group mb-3">
        <select class="custom-select show-modal" required="">
            <option value="">Choose...</option>
            @foreach($data as $k => $v)
            <option value="{{ $v->id }}">Rate {{ number_format($v->child->content) }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <button class="btn btn-dark text-light" type="button" id="button-addon2">Checkout</button>
        </div>
    </div>
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
    $('#button-addon2').click(function() {
        let id = $(".show-modal").val();
        let url = APP_URL + 'product/' + id;
        $("#exampleModal").modal('show');
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
        const r = $(this).attr('dataPostId');
        const rp = $(this).attr('dataPostPrice');
        $.post(APP_URL + 'cart', {
            id: r,
            x: rp
        }, function(e) {
            let res = JSON.parse(e);
            toastr.success('Success')
        });
    });
</script>
@endsection