@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection

<link href='https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Payslip')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Search Condition')}}</h3>
                        </div>
                        <div class="panel-body">
                            <form class="" role="form" method="post" action="{{url('payroll/payslip/post-custom-search')}}">

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="el2">{{language_data('Date')}}</label>
                                            <input type="text" id="el2" class="form-control monthPicker" required="" name="date" value="{{$date}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="el3">{{language_data('Employee')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="employee">
                                                <option value="0">Select Employee</option>
                                                @foreach($employee as $d)
                                                    <option value="{{$d->id}}" @if($d->id==$emp_id) selected @endif>{{$d->fname}} {{$d->lname}} ({{$d->employee_code}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="el3">{{language_data('Department')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="department" id="department_id">
                                                <option value="0">{{language_data('Select Department')}}</option>
                                                @foreach($department as $d)
                                                <option value="{{$d->id}}" @if($dep_id==$d->id) selected @endif> {{$d->department}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="el3">{{language_data('Designation')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" disabled name="designation" id="designation">
                                                <option value="0">{{language_data('Select Designation')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-search"></i> {{language_data('Search')}}</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>


                <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('All Payments')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 15%;">{{language_data('Code')}}</th>
                                    <th style="width: 25%;">{{language_data('Name')}}</th>
                                    <th style="width: 30%;">Account Number</th>
                                    <th style="width: 15%;">{{language_data('Payment Amount')}}</th>
                                    <th style="width: 15%;" class="text-right">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payroll as $d)
                                    <tr>
                                        <td>{{$d->employee_info->employee_code}}</td>
                                        <td>{{$d->employee_info->fname}} {{$d->employee_info->lname}}</td>
                                        <!--<td> {{$d->employee_info->payment_type}}</td>-->
                                        <td> @if(isset($d->bank_info))
                                            {{$d->bank_info->account_number}}
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>{{app_config('Currency')}} {{$d->total_salary}}</td>
                                        <td class="text-right">
                                            <a href="{{url('payroll/view-details/'.$d->id)}}" class="btn btn-complete btn-xs"><i class="fa fa-eye"></i> {{language_data('Details')}}</a>
                                            <a href="#" id="{{$d->id}}" class="btn btn-danger btn-xs deletePayroll"><i class="fa fa-trash"></i> {{language_data('Delete')}}</a>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/libs/moment/moment.min.js")!!}
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function () {

            /*For DataTable*/
            $('.data-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
             'excel', 'pdf', 'print'
        ]
            }
               
            );

            /*For Designation Loading*/
            $("#department_id").change(function () {
                var id = $(this).val();
                var _url = $("#_url").val();
                var dataString = 'dep_id=' + id;
                $.ajax
                ({
                    type: "POST",
                    url: _url + '/payroll/get-designation',
                    data: dataString,
                    cache: false,
                    success: function ( data ) {
                        $("#designation").html( data).removeAttr('disabled').selectpicker('refresh');
                    }
                });
            });


            /*For Delete Payslip*/

            /*For Delete Job Info*/
            $(".makePayment").click(function (e) {
                e.preventDefault();
                var id = this.id;
                var paymentDate=$('#payment_date').val();
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/payroll/pay-payment/" + id +"/"+paymentDate;
                    }
                });
            });

            /*For Delete Job Info*/
            $(".deletePayroll").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure to delete Salary?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/payroll/delete/" + id ;
                    }
                });
            });

        });
    </script>


@endsection
