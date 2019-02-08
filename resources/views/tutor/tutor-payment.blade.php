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
    @include('includes.tutor-top')
    <section style="margin-bottom: 8rem">
        <div class="block no-padding">
            <div class="container">
                <div class="row no-gape">
                    @include('includes.tutor-sidebar')
                    <div class="col-lg-9 column">
                        <div class="padding-left content-box">
                            <div class="manage-jobs-sec">
                                <table>
                                    <thead>
                                    <tr>
                                        <td>Student Name</td>
                                        <td>Amount</td>
                                        <td>Date</td>
                                        {{--<td>Status</td>--}}
                                    </tr>
                                    </thead>
                                    <tbody style="font-weight: bold!important;">

                                    @forelse($payments as $payment)
                                        <tr>
                                            <td>
                                                <span>{{$payment->user->name}}</span>
                                            </td>
                                            <td>
                                                <span>{{number_format($payment->amount,2)}}</span>
                                            </td>
                                            <td>
                                                <span>{{\Carbon\Carbon::parse($payment->date)->toFormattedDateString()}}</span>
                                            </td>
                                            {{--<td>--}}
                                            {{--<span class="status">@if($payment->status === 'pending')Not--}}
                                            {{--Delivered @else Delivered  @endif</span>--}}
                                            {{--</td>--}}
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

@endsection

@section('scripts')
    <script>

        let messageSubscribe = true;
        $('#tutor-nav-payment').addClass('active')
    </script>
@endsection
