@extends('layouts.app')

@section('breadcrumb')
    <ul class="breadcrumb">

    </ul>
@endsection

@section('css-include')
    <style>
        body {
            font-size: 1.5em;
        }


        a { color: #fe571e; } /* CSS link color  */
        a:hover { color: #fe571e; } /* CSS link hover  */

        .resultData {
            font-size: 2em;
            color: #fe571e;
        }
        .info {
            font-size: 0.7em;
            padding-bottom: 50px;

        }

    </style>
@endsection

@section('page-content-wrap')

    <div class="container">
        <div class="row">

            <div class="col-md-12 info">
                <div class="col-md-6">
                    <a href="https://www.maqe.com/" target="_blank"><img src="https://maqe.github.io/img/logo.svg" height="60"/></a>
                </div>
                <div class="col-md-6 text-right">
                    <p>Create by: <span style="color:#fe571e">Mr.Chaipat Mangmeenam </span><span style="font-size: 20px; color: #fe571e;">&#x263A;</span></p><p>Contact information: <a href="mailto:doc_19@hotmail.com"> doc_19@hotmail.com</a>.</p>


                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">

                    </div>

                    <form class="form-horizontal" name="create-form" id="create-form" method="post"
                          action="{{route('bot.calculate')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">


                            <div class="form-group col-lg-12">
                                <label class="col-md-3 col-xs-12 control-label">Bot command: <span
                                            class="label-required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="text" name="cmd" id="cmd" class="form-control" value="RW15RW1"/>
                                </div>
                            </div>
                            <div class="form-group col-md-12 text-center resultData" id="result_cmd"></div>

                        </div>

                        <div class="panel-footer">
                            <button type="reset" class="btn btn-default">Clear Form</button>
                            <button class="btn btn-primary pull-right">Execute</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/ex/bootstrap/bootstrap-file-input.js') }}"></script>
    <script src="{{ asset('js/ex/jquery-ui-1.9.2.custom.min.js') }}"></script>

    <script src="{{ asset('js/ex/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('js/ex/sweetalert2/sweetalert2.js') }}"></script>


    <script type="text/javascript">
        $(function () {


        });

        $(function () {

            var formDataId = 'create-form';

            /* init validate form variable */
            var validateRules = {
                cmd: {
                    required: true,

                },

            };

            /* validate form and submit*/
            var createFormValidate = $("#" + formDataId).validate({
                ignore: [],
                rules: validateRules,
                messages: {
                    //cmd: 'กรุณากรอกข้อมูลในช่องนี้'
                },
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: $('#' + formDataId).attr('action'),
                        data: $('#' + formDataId).serializeArray(),
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    }).done(function (resp) {
                        console.log(resp)
                        if (resp.status != '1') {
                            swal({
                                type: "error",
                                title: resp.title,
                                text: resp.message,
                                timer: 2000,
                                showConfirmButton: true
                            });
                        } else {
                            $("#result_cmd").html(resp.message);

                            //window.location.href = resp.redirect_url
                        }
                    });
                }
            });

        });
    </script>
@endpush
