@extends('layouts.master-layout')
@section('title')
    Payments | {{Auth::user()->name}}
@endsection

@section('style')
    <style>
        .tree_widget-sec > ul > li.active > a i {
            color: #8b91dd;
        }

        .content-box {
            float: left;
            width: 100%;
            margin-top: 1rem;
            border: 2px solid #e8ecec;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            -ms-border-radius: 8px;
            -o-border-radius: 8px;
            border-radius: 8px;
            padding: 30px;
        }

        label {
            height: 35px;
            position: relative;
            color: #8798AB;
            display: block;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        label > span {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            font-weight: 300;
            line-height: 32px;
            color: #8798AB;
            border-bottom: 1px solid #586A82;
            transition: border-bottom-color 200ms ease-in-out;
            cursor: text;
            pointer-events: none;
        }

        label > span span {
            position: absolute;
            top: 0;
            left: 0;
            transform-origin: 0% 50%;
            transition: transform 200ms ease-in-out;
            cursor: text;
        }

        label:before {
            content: unset !important;
        }

        label .field.is-focused + span span,
        label .field:not(.is-empty) + span span {
            transform: scale(0.68) translateY(-36px);
            cursor: default;
        }

        label .field.is-focused + span {
            border-bottom-color: #34D08C;
        }

        .field {
            background: transparent;
            font-weight: 300;
            border: 0;
            color: white;
            outline: none;
            cursor: text;
            display: block;
            width: 100%;
            line-height: 32px;
            padding-bottom: 3px;
            transition: opacity 200ms ease-in-out;
        }

        .field::-webkit-input-placeholder {
            color: #8898AA;
        }

        .field::-moz-placeholder {
            color: #8898AA;
        }

        /* IE doesn't show placeholders when empty+focused */
        .field:-ms-input-placeholder {
            color: #424770;
        }

        .field.is-empty:not(.is-focused) {
            opacity: 0;
        }

        button:focus {
            background: #24B47E;
        }

        button:active {
            background: #159570;
        }

        .outcome {
            float: left;
            width: 100%;
            padding-top: 8px;
            min-height: 20px;
            text-align: center;
        }

        .success, .error {
            display: none;
            font-size: 15px;
        }

        .success.visible, .error.visible {
            display: inline;
        }

        .error {
            color: #E4584C;
        }

        .success {
            color: #34D08C;
        }

        .success .token {
            font-weight: 500;
            font-size: 15px;
        }

        .stripe-body {
            background: #424770;
        }

        .select-1 {
            cursor: pointer !important;
        }
    </style>
@endsection


@section('content')
    @include('includes.parent-top')
    <section style="margin-bottom: 8rem">
        <div class="block no-padding">
            <div class="container">
                <div class="row no-gape">
                    @include('includes.parent-sidebar')
                    <div class="col-lg-9 column">
                        <div class="padding-left content-box">
                            <div class="manage-jobs-sec">
                                <h3><span style="color: crimson">Payments</span>
                                    <span class="float-right"><button style="width: 6rem" data-toggle="modal"
                                                                      data-target="#modalPayment"
                                                                      class="btn btn-sm btn-success">Pay</button></span>
                                </h3>
                                <table>
                                    <thead>
                                    <tr>
                                        <td>Tutor Name</td>
                                        <td>Amount</td>
                                        <td>Date</td>
                                        <td>Status</td>
                                    </tr>
                                    </thead>
                                    <tbody style="font-weight: bold!important;">

                                    @forelse($payments as $payment)
                                        <tr>
                                            <td>
                                                <span>{{$payment->tutor->profile->name}}</span>
                                            </td>
                                            <td>
                                                <span>{{number_format($payment->amount,2)}}</span>
                                            </td>
                                            <td>
                                                <span>{{\Carbon\Carbon::parse($payment->date)->toFormattedDateString()}}</span>
                                            </td>
                                            <td>
                                                <span class="status">@if($payment->status === 'pending')Not
                                                    Delivered @else Delivered  @endif</span>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>

    </section>
    <!-- The Modal -->
    <div class="modal fade" id="modalPayment">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Pay to Tutor</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body stripe-body">
                    <div class="row ">
                        <div class="col-md-12 ">
                            <form action="{{url('parent/payment-store')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>
                                        <select class="form-control field select-1" name="tutor_id" required
                                                id="tutor_sele">
                                            <option selected value="" disabled>Please select Tutor</option>
                                            @forelse($tutors as $tutor)
                                                <option data-amount="{{($tutor->total_hour*$tutor->amount_per_hour)*30}}"
                                                        value="{{$tutor->tutor_id}}">{{$tutor->tutor->profile->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </label>
                                    <input type="hidden" id="stripe_token" name="stripe_token">
                                    <input type="hidden" id="amount" name="amount">
                                </div>
                                <label>
                                    <input name="cardholder-name" class="field is-empty" placeholder="Card name"/>
                                    <span><span>Name</span></span>
                                </label>
                                <label>
                                    <div id="card-element" class="field is-empty"></div>
                                    <span><span>Credit or debit card</span></span>
                                </label>
                                <div class="col-md-10 m-auto">
                                    <button type="submit" class="btn btn-success btn-block " id="form-btn">Pay</button>
                                </div>
                                <div class="outcome">
                                    <div class="error" role="alert"></div>
                                    <div class="success">
                                        Success! Your Stripe token is <span class="token"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let messageSubscribe = true;
        var stripe = Stripe('pk_test_UoD2DE3iaOuvqO9LGEbflfyU');
        var elements = stripe.elements();

        var card = elements.create('card', {
            iconStyle: 'solid',
            style: {
                base: {
                    iconColor: '#8898AA',
                    color: 'white',
                    lineHeight: '36px',
                    fontWeight: 300,
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSize: '19px',

                    '::placeholder': {
                        color: '#8898AA',
                    },
                },
                invalid: {
                    iconColor: '#e85746',
                    color: '#e85746',
                }
            },
            classes: {
                focus: 'is-focused',
                empty: 'is-empty',
            },
        });
        card.mount('#card-element');

        var inputs = document.querySelectorAll('input.field');
        Array.prototype.forEach.call(inputs, function (input) {
            input.addEventListener('focus', function () {
                input.classList.add('is-focused');
            });
            input.addEventListener('blur', function () {
                input.classList.remove('is-focused');
            });
            input.addEventListener('keyup', function () {
                if (input.value.length === 0) {
                    input.classList.add('is-empty');
                } else {
                    input.classList.remove('is-empty');
                }
            });
        });

        function setOutcome(result) {
            var successElement = document.querySelector('.success');
            var errorElement = document.querySelector('.error');
            successElement.classList.remove('visible');
            errorElement.classList.remove('visible');

            if (result.token) {
                // Use the token to create a charge or a customer

                $('#stripe_token').val(result.token.id)
                document.querySelector('form').submit()


            } else if (result.error) {
                errorElement.textContent = result.error.message;
                errorElement.classList.add('visible');
                $('#form-btn').attr('disabled', false);
            }
        }

        card.on('change', function (event) {
            setOutcome(event);
        });

        document.querySelector('form').addEventListener('submit', function (e) {
            $('#form-btn').attr('disabled', true);
            e.preventDefault();
            var form = document.querySelector('form');
            var extraDetails = {
                name: form.querySelector('input[name=cardholder-name]').value,
            };
            stripe.createToken(card, extraDetails).then(setOutcome);
        });

        $('#tutor_sele').on('change', function () {
            var selected = $(this).find('option:selected');
            var amount = selected.data('amount');
            $('#form-btn').text('Pay ' + amount + '(Rs)')
            $('#amount').val(amount)
        })

        $('#parent-nav-payment').addClass('active')
    </script>
@endsection
