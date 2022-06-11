@extends('user.layouts.master')

@php
    $title = "Thanh toán trading";
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
                    <h3 class="panel-title">{{\App\Models\TradingOfUser::where('user_id' , auth()->id())->first() ? 'Nâng cấp gói '.  \Illuminate\Support\Str::replace( 'MAU BUI VIP | ' , '' , \App\Models\TradingOfUser::where('user_id' , auth()->id())->first()->trading->name)  .' lên gói: ' . \Illuminate\Support\Str::replace( 'MAU BUI VIP | ' , '' , $trading->name) : 'Đăng ký gói: ' . \Illuminate\Support\Str::replace( 'MAU BUI VIP | ' , '' , $trading->name)}}</h3>
                    {{--                    <div class="panel-title mt-3">{{\App\Models\TradingOfUser::where('user_id' , auth()->id())->first() ? "Tiết kiệm: $". ($trading->realPrice($trading->id) - $trading->realPriceUpgrade($trading->id, auth()->id())) ." khi nâng cấp" : ''}}</div>--}}
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
                                <div class="row mt-3">
                                    <div class="col-xs-12">
                                        <button id="btn-payment-stripe"
                                                class="btn btn-primary btn-lg btn-block color-prime"
                                                type="submit">{{\App\Models\TradingOfUser::where('user_id' , auth()->id())->first() ? 'Nâng Cấp Ngay' : 'Thanh toán bằng Stripe'}}
                                            (${{$trading->realPriceUpgrade($trading->id, auth()->id(), $typePaymentItem->id)}}
                                            )
                                        </button>
{{--                                        @if(\App\Models\TradingOfUser::where('user_id' , auth()->id())->first())--}}
{{--                                            <h4 class="text-center p-3 text-white bg-success">Tiết kiệm--}}
{{--                                                ${{($trading->realPrice($trading->id) - $trading->realPriceUpgrade($trading->id, auth()->id()))}}--}}
{{--                                                khi nâng cấp</h4>--}}
{{--                                        @endif--}}
                                    </div>
                                </div>
                            </div>

                        @else
                            <div class="tab-pane fade {{$index == 0 ? 'active' : ''}} in" id="{{$typePaymentItem->id}}">
                                <form action="{{route('user.registerTrading' , ["id" => $trading->id])}}" method="post">
                                    @csrf
                                    <input name="type_payment_id" value="{{$typePaymentItem->id}}"
                                           style="display: none">
                                    <div class="mt-3">
                                        {!! $typePaymentItem->content !!}
                                    </div>
                                    <button class="btn btn-primary btn-lg btn-block btn-payment mt-3 color-prime"
                                            type="submit">
                                        {{\App\Models\TradingOfUser::where('user_id' , auth()->id())->first() ? 'Nâng Cấp Ngay' : 'Đăng ký'}}
                                        (${{$trading->realPriceUpgrade($trading->id, auth()->id(), $typePaymentItem->id)}}
                                        )
                                    </button>

{{--                                    @if(\App\Models\TradingOfUser::where('user_id' , auth()->id())->first())--}}
{{--                                        <h4 class="text-center p-3 text-white bg-success">Tiết kiệm--}}
{{--                                            ${{($trading->realPrice($trading->id) - $trading->realPriceUpgrade($trading->id, auth()->id()))}}--}}
{{--                                            khi nâng cấp</h4>--}}
{{--                                    @endif--}}
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
                'price' => $trading->api_id,
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('user.paymentTradingSuccessStripe' , ['id' => $trading->id]),
            'cancel_url' => url()->current(),
        ]);

    //$session = \Stripe\Checkout\Session::create([
//        'line_items' => [[
//            'price' => $trading->api_id,
//            'quantity' => 1,
//        ]],
//        'mode' => 'payment',
//        'success_url' => route('user.paymentTradingSuccessStripe' , ['id' => $trading->id]),
//        'cancel_url' => url()->current(),
//        'payment_intent_data'=>[
//                "description" => auth()->user()->name . " đăng ký " . $trading->name,
//            ]
//    ]);

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

        stripe.redirectToCheckout({
            sessionId: "{{$session->id}}"
        })
    </script>

@endsection
