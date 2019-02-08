@extends('layouts.master-layout')
@section('title')
    Children | {{Auth::user()->name}}
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
                                <h3><span style="color: crimson">About Children</span>
                                    <span class="float-right"><button style="width: 6rem" data-toggle="modal"
                                                                      data-target="#modalChildren"
                                                                      class="btn btn-sm btn-success">Add details</button></span>
                                </h3>
                                <table>
                                    <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Age</td>
                                        <td>Class</td>
                                        <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody style="font-weight: bold!important;">

                                    @forelse($childrens as $children)
                                        <tr>
                                            <td>
                                                <span>{{$children->name}}</span>
                                            </td>
                                            <td>
                                                <span>{{$children->age}}</span>
                                            </td>
                                            <td>
                                                <span>{{$children->class}}</span>
                                            </td>
                                            <td>
                                                <ul class="action_job">
                                                    <li><span>Edit Information</span>
                                                        <a href="#" title="Edit Information"
                                                           onclick="editDetail('{{$children}}')"><i
                                                                    class="la la-pencil la-2x"
                                                                    style="color: #25a32a"></i></a></li>
                                                </ul>
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
    <div class="modal fade" id="modalChildren">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-12 ">
                            <form action="{{url('parent/children-store')}}" method="post" id="child-fom">
                                {{csrf_field()}}
                                <div class="col-lg-12">
                                    <span class="pf-title">Full Name</span>
                                    <div class="pf-field">
                                        <input type="text" id="f_name" class="mb-0" placeholder="Child Name" name="name"
                                               required>
                                    </div>
                                    <p class="text-danger error-show m-0 pl-3 hide error-name"></p>
                                </div>
                                <div class="col-lg-12">
                                    <span class="pf-title">Child Age</span>
                                    <div class="pf-field">
                                        <select data-placeholder="Please Select Age" class="form-control"
                                                name="age" id="f_age">
                                            <option selected disabled>Please Select Age</option>
                                            <option value="04-07 Years">04-07 Years</option>
                                            <option value="08-12 Years">08-12 Years</option>
                                            <option value="13-16 Years">13-16 Years</option>
                                            <option value="above 17 Years">above 17 Years</option>
                                        </select>
                                    </div>
                                    <p class="text-danger error-show m-0 pl-3 hide error-age"></p>
                                </div>
                                <div class="col-lg-12 ">
                                    <span class="pf-title">Class Name</span>
                                    <div class="pf-field">
                                        <input type="text" class="mb-0" id="f_class" placeholder="Child Class"
                                               name="class"
                                               required>
                                    </div>
                                    <p class="text-danger error-show m-0 pl-3 hide error-class"></p>
                                </div>
                                <div class="col-lg-8 m-auto ">
                                    <button class="btn btn-success btn-block mt-4">Submit</button>
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
    <script>
        let messageSubscribe = true;
        $('#parent-nav-children').addClass('active')

        function editDetail(children) {
            children = JSON.parse(children)
            $('#f_name').val(children.name)
            $('#f_class').val(children.class)
            $("#f_age option[value='" + children.age + "']").prop({defaultSelected: true});

            $('#child-fom').attr('action', '{{url('parent/children-store/')}}' + '/' + children.id)
            $('#modalChildren').modal('show')
        }

        $('#modalChildren').on('hidden.bs.modal', function () {
            $('#child-fom').trigger('reset');
            $('#child-fom').attr('action', '{{url('parent/children-store/')}}')
        })
    </script>
@endsection
