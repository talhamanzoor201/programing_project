@extends('layouts.admin-layout')

@section('content')
    <div class="content" id="app">
        <div class="container-fluid">
            <div class="row">
                <div class=" col-md-10 m-auto">
                    <div class="col-md-12 m-auto">
                        <div class="card">
                            <div class="card-header card-header-icon card-header-danger">
                                <div class="card-icon">
                                    <i class="material-icons">update</i>
                                </div>
                                <h4 class="card-title"> Challan-
                                    <small class="category">Update Challan information.</small>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data"
                                      action="{{url('/update/challan/'.$challan->id)}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label class="bmd-label-floating">Challan type</label>
                                                <input type="text" name="challan_type"
                                                       value="{{$challan->challan_type}}"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label class="bmd-label-floating">Vehicle Type</label>
                                                <input type="text" name="vehicle_type"
                                                       value="{{$challan->vehicle_type}}"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group bmd-form-group">
                                                <label class="bmd-label-floating">Amount</label>
                                                <input type="number" name="amount" value="{{$challan->amount}}"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group bmd-form-group">
                                                <select name="status" class="form-control">
                                                    <option @if($challan->status === 'pending') selected @endif
                                                    value="pending">Pending
                                                    </option>
                                                    <option @if($challan->status === 'done') selected
                                                            @endif value="done">Done
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-danger pull-right">Save Information</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('success'))
            <div data-notify="container" id="alertN"
                 class="col-xs-11 col-sm-4 alert alert-info alert-with-icon animated fadeInDown " role="alert"
                 data-notify-position="top-center"
                 style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; left: 0px; right: 0px;">
                <button type="button" aria-hidden="true" class="close" data-notify="dismiss" data-dismiss="alert"
                        aria-label="Close"
                        style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;"><i
                            class="material-icons">close</i></button>
                <i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span> <span
                        data-notify="message">{{Session::get('success') }}</span><a
                        href="#" target="_blank" data-notify="url"></a></div>
        @endif
        @if(Session::has('errorp'))
            <div data-notify="container" id="alertN"
                 class="col-xs-11 col-sm-4 alert alert-danger alert-with-icon animated fadeInDown " role="alert"
                 data-notify-position="top-center"
                 style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; top: 20px; left: 0px; right: 0px;">
                <button type="button" aria-hidden="true" class="close" data-notify="dismiss" data-dismiss="alert"
                        aria-label="Close"
                        style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;"><i
                            class="material-icons">close</i></button>
                <i data-notify="icon" class="material-icons">add_alert</i><span data-notify="title"></span> <span
                        data-notify="message">{{Session::get('errorp') }}</span><a
                        href="#" target="_blank" data-notify="url"></a></div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('#bUserM').addClass('active');
        })

    </script>
@endSection
