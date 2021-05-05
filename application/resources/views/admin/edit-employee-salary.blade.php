@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Edit Employee Salary')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('payroll/edit-employee-salary-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Edit Employee Salary')}}</h3>
                                </div>

                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Salary Type')}}</label>
                                    <select name="payment_type" class="form-control selectpicker paymentType">
                                        <option value="Monthly" @if($employee->payment_type=='Monthly') selected @endif>{{language_data('Monthly')}}</option>
                                        <option value="Hourly"  @if($employee->payment_type=='Hourly') selected @endif>{{language_data('Hourly')}}</option>
                                    </select>
                                </div>

                                <div class="show-monthly">
                                    <div class="form-group">
                                        <label>{{language_data('Basic Salary')}}</label>
                                        <span class="help">e.g. "50000"</span>
                                        <input type="text" class="form-control salary" name="basic_salary" id="basic_salary" value="{{$employee->basic_salary}}">
                                    </div>
                                    <div class="form-group">
                                        <label>HRA</label>
                                        <span class="help">Default 40% of Bacis, Can be changed</span>
                                        <input type="text" class="form-control salary" name="hra" id="hra" value="{{$employee->hra}}" >
                                    </div>
                                    <div class="form-group">
                                        <label>Conveyance Allowance</label>
                                        <span class="help">e.g. "1600"</span>
                                        <input type="text" class="form-control salary" name="convey_allowance" id="convey_allowance" value="{{$employee->convey_allowance}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Medical Allowance</label>
                                        <span class="help">e.g. "1250"</span>
                                        <input type="text" class="form-control salary" name="medical_allowance" id="medical_allowance" value="{{$employee->medical_allowance}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Special Allowance</label>
                                        <span class="help">e.g. "3000"</span>
                                        <input type="text" class="form-control salary" name="special_allowance" id="special_allowance" value="{{$employee->special_allowance}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Education Allowance</label>
                                        <span class="help">e.g. "3000"</span>
                                        <input type="text" class="form-control salary" name="education_allowance" id="education_allowance" value="{{$employee->education_allowance}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile allowance</label>
                                        <span class="help">e.g. "3000"</span>
                                        <input type="text" class="form-control salary" name="mobile_allowance" id="mobile_allowance" value="{{$employee->mobile_allowance}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Miscellaneous</label>
                                        <span class="help">e.g. "3000"</span>
                                        <input type="text" class="form-control salary" name="miscellaneous" id="miscellaneous" value="{{$employee->miscellaneous}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Retirement Allowance</label>
                                        <span class="help">e.g. "3000"</span>
                                        <input type="text" class="form-control salary" name="retirement_allowance" id="retirement_allowance" value="{{$employee->retirement_allowance}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Total Salary</label>
                                        <span class="help">e.g. "3000"</span>
                                        <input type="text" class="form-control" name="total_salary" id="total_salary" value="{{$employee->total_salary}}" readonly="readonly">
                                    </div>
                                    <!--<div class="form-group">
                                        <label>{{language_data('Overtime Salary')}}</label>
                                        <span class="help"> ({{language_data('Hourly')}}) e.g. "20"</span>
                                        <input type="text" class="form-control" name="overtime_salary" value="{{$employee->overtime_salary}}">
                                    </div>-->

                                </div>


                                <div class="show-hourly">
                                    <div class="form-group">
                                        <label>{{language_data('Hourly Working Rate')}}</label>
                                        <span class="help">e.g. "16"</span>
                                        <input type="text" class="form-control" name="hourly_working_rate" value="{{$employee->working_hourly_rate}}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{language_data('Hourly Overtime Rate')}}</label>
                                        <span class="help">e.g. "20"</span>
                                        <input type="text" class="form-control" name="hourly_overtime_rate" value="{{$employee->overtime_hourly_rate}}">
                                    </div>

                                </div>


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$employee->id}}" name="cmd">
                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-save"></i> {{language_data('Update')}} </button>
                            </form>
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
    {!! Html::script("assets/js/form-elements-page.js")!!}

    <script>
        $(document).ready(function(){

            var FundType = $('.paymentType');

            if (FundType.val() == 'Monthly') {
                $('.show-hourly').hide();
            }else{
                $('.show-monthly').hide();
            }

            FundType.on('change', function () {
                var value = $(this).val();
                if (value == 'Hourly') {
                    $('.show-hourly').show();
                    $('.show-monthly').hide();
                } else {
                    $('.show-hourly').hide();
                    $('.show-monthly').show();
                }

            });
        $('#wrapper').on('keyup change','#basic_salary',function(){
            var hra = parseFloat($(this).val()) * 0.40;
            $('#hra').val(hra.toFixed(2));
        })
        $("#wrapper").on("keyup change", ".salary", function () {
            var total = 0;
            $(".salary").each(function () {
                var value = parseFloat($(this).val());
                if (!isNaN(value))
                    total += value;
            })
            $('#total_salary').val(total);
        });
        });
    </script>
@endsection
