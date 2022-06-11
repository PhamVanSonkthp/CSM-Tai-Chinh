@extends('user.layouts.master')

@php
    $title = "Thanh toán khóa học";
@endphp

@section('title')
    <title>{{$title}}</title>
@endsection

@section('name')
    <h4 class="page-title">{{$title}}</h4>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>

    <style type="text/css">
        .panel-title {
            display: inline;
            font-weight: bold;
        }

        .display-table {
            display: table;
        }

        .display-tr {
            display: table-row;
        }

        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }

        .header-right {
            display: none !important;
        }
    </style>
@endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-default credit-card-box" style="margin-top: 40px;">
            <div class="panel-heading">
                <div class="row">
                    <h3 class="panel-title">{{\App\Models\ProductOfUser::where('user_id' , auth()->id())->where('product_id',$product->id)->first() ? 'Gia hạn khóa học' : 'Đăng ký khóa học'}}
                        : {{$product->name}}</h3>
                    <h3 class="panel-title mt-3">Vui lòng chọn hình thức thanh toán dưới đây:</h3>
                </div>
            </div>

            <div class="panel-body">

                @if (Session::has('success-register'))
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success-register') }}</p>
                    </div>
                @endif

                <ul id="myTab" class="nav nav-tabs">
                    @foreach(\App\Models\TypePayment::all() as $index => $typePaymentItem)
                        <li class="{{$index == 0 ? 'active' : ''}}"><a href="#{{$typePaymentItem->id}}"
                                                                       data-toggle="tab">{{$typePaymentItem->name}}</a>
                        </li>
                    @endforeach
                </ul>
                <div id="myTabContent" class="tab-content">
                    @foreach(\App\Models\TypePayment::all() as $index => $typePaymentItem)

                        @if(\Illuminate\Support\Str::contains(\Illuminate\Support\Str::upper($typePaymentItem->name), \Illuminate\Support\Str::upper('Credit Card')))
                            <div class="tab-pane fade {{$index == 0 ? 'active' : ''}} in" id="{{$typePaymentItem->id}}">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                @endif

                                @if (Session::has('error'))
                                    <div class="alert alert-danger text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('error') }}</p>
                                    </div>
                                @endif

                                <form style="display: none;"
                                      role="form"
                                      action="{{ route('stripe_product.post' , ['id'=>$product->id]) }}"
                                      method="post"
                                      class="require-validation mt-3"
                                      data-cc-on-file="false"
                                      data-stripe-publishable-key="{{ $paymentStripe->public_key }}"
                                      id="payment-form">
                                    @csrf

                                    <input name="type_payment_id" value="{{$typePaymentItem->id}}"
                                           style="display: none">
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Tên trên thẻ</label> <input
                                                class='form-control' size='4' type='text'>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group card required'>
                                            <label class='control-label'>Số thẻ</label> <input
                                                autocomplete='on' class='form-control card-number' size='20'
                                                type='text'>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                                            class='form-control card-cvc'
                                                                                            placeholder='ex. 311'
                                                                                            size='4'
                                                                                            type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Tháng hết hạn</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Năm hết hạn</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                type='text'>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class='col-md-12 error form-group hide'>
                                            <div class='alert-danger alert'>Please correct the errors and try
                                                again.
                                            </div>
                                        </div>
                                    </div>


                                </form>

                                    <div class="mt-3">
                                        {!! $typePaymentItem->content !!}
                                    </div>
                                @if (!Session::has('success'))
                                    <div class="row mt-3">
                                        <div class="col-xs-12">
                                            <button id="btn-payment-stripe"
                                                    class="btn btn-warning btn-lg btn-block color-prime"
                                                    type="button">Thanh toán bằng Stripe
                                                (${{$product->realPrice($product->id, $typePaymentItem->id)}})
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="tab-pane fade {{$index == 0 ? 'active' : ''}} in" id="{{$typePaymentItem->id}}">
                                <form action="{{route('user.registerProduct' , ["id" => $product->id])}}" method="post">
                                    @csrf
                                    <input name="type_payment_id" value="{{$typePaymentItem->id}}"
                                           style="display: none">
                                    <div class="mt-3">
                                        {!! $typePaymentItem->content !!}
                                    </div>
                                    <button class="btn btn-warning btn-lg btn-block btn-payment mt-3 color-prime"
                                            type="submit">
                                        {{\App\Models\ProductOfUser::where('user_id' , auth()->id())->where('product_id',$product->id)->first() ? 'Gia hạn' : 'Đăng ký'}}
                                        (${{$product->realPrice($product->id, $typePaymentItem->id)}})
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection

@php
    require_once __DIR__ . '/../../../vendor/autoload.php';

    \Stripe\Stripe::setApiKey($paymentStripe->secret_key);

    $session = \Stripe\Checkout\Session::create([
        'line_items' => [[
            'price' => $product->api_id,
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('user.paymentProductSuccessStripe' , ['id' => $product->id]),
        'cancel_url' => url()->current(),
        'payment_intent_data'=>[
                "description" => auth()->user()->name . " đăng ký " . $product->name,
            ]
    ]);
@endphp

@section('js')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function () {
            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function (e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $('.btn-payment').hide()
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>


    <script>
        const stripe = Stripe("{{$paymentStripe->public_key}}")

        const btn = document.getElementById('btn-payment-stripe')

        btn.addEventListener('click', function (e) {
            e.preventDefault()

            stripe.redirectToCheckout({
                sessionId: "{{$session->id}}"
            })
        })
    </script>

@endsection
