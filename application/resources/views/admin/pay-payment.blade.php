@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Pay Payment')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-4">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" method="post" action="{{url('payroll/pay-payment-post')}}">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{language_data('Payment For')}} {{$text_date}}  (DOJ : {{ date("j F, Y", strtotime($doj)) }})</h3>
                                </div>
                                <div class="form-group">
                                    <label>No of Present Days from {{$total_working_day}}</label>
                                    <input type='hidden' name='total_working_day' id='total_working_day' value="{{$total_working_day-1}}">
                                    <span class="help"></span>
                                    <select name="present_days" class="present_days" id="presend_days">
                                        @for($i = 1; $i <= $total_working_day; $i++)
                                        @if($total_working_day == $i)
                                        <option value="{{$i}}" selected="selected">{{$i}}</option>
                                        @else
                                        <option value="{{$i}}" >{{$i}}</option>
                                        @endif
                                        @endfor
                                    </select>
                                    <!--<input type="text" class="form-control"  value="{{$total_working_day}}" name="present_days">-->
                                </div>
                                <div class="form-group">
                                    <label>{{language_data('Net Salary')}}</label>
                                    <span class="help">Pay In {{app_config('Currency')}}</span>
                                    <input type="text" class="form-control net_salary" readonly value="{{$net_salary}}" name="net_salary">
                                </div>
                                @if(!empty($overtime_salary))
                                <div class="form-group">
                                    <label>{{language_data('Overtime Salary')}}</label>
                                    <span class="help">Pay In {{app_config('Currency')}}</span>
                                    <input type="text" class="form-control overtime_salary" readonly value="{{$overtime_salary}}" name="overtime_salary">
                                </div>
                                @endif
                                
                                @if(!empty($deducted_tax))
                                <div class="form-group">
                                    <label>{{language_data('TAX')}}</label>
                                  <span class="help">Pay In {{app_config('Currency')}}</span>
                                    <input type="text" class="form-control deducted_tax" readonly value="{{$deducted_tax}}" name="tax">
                                </div>
                                @endif
                                @if($loan_deducted!='')
                                <div class="form-group">
                                    <label>{{language_data('Loan')}}</label>
                                    <span class="help">Pay In {{app_config('Currency')}}</span>
                                    <input type="text" class="form-control loan_deducted" value="{{$loan_deducted}}" name="loan">
                                </div>
                                @endif

                                @if($provident_deducted!='')
                                <div class="form-group">
                                    <label>{{language_data('Provident Fund')}}</label>
                                    <span class="help">Pay In {{app_config('Currency')}}</span>
                                    <input type="text" class="form-control provident_deducted" readonly value="{{$provident_deducted}}" name="provident_fund">
                                </div>
                                @endif
                                @if($esic_amount != "0")
                                <div class="form-group">
                                    <label>ESIC Deduction</label>
                                    <span class="help">Pay In {{app_config('Currency')}}</span>
                                    <input type="text" class="form-control esic_deducted" readonly value="{{$esic_amount}}" name="esic_deducted">
                                </div>
                                @endif

                                <div class="form-group">
                                    <label>Payable Amount</label>
                                    <span class="help">Pay In {{app_config('Currency')}}</span>
                                    <input type="text" class="form-control payable_amount" readonly value="{{$payment_amount}}" name="payable_amount">
                                </div>
                                <div class="form-group">
                                    <label>Deduction Amount</label>
                                    <span class="help">Pay In {{app_config('Currency')}}</span>
                                    <input type="text" class="form-control deduction_amount" value="0.00" name="deduction_amount" >
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Payment Amount')}}</label>
                                    <span class="help">Pay In {{app_config('Currency')}}</span>
                                    <input type="text" class="form-control payment_amount" readonly value="{{$payment_amount}}" name="payment_amount">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Payment Type')}}</label>
                                    <select class="selectpicker form-control" name="payment_type">
                                            <option value="Cash Payment">{{language_data('Cash Payment')}}</option>
                                            <option value="Bank Payment">{{language_data('Bank Payment')}}</option>
                                            <option value="Cheque Payment">{{language_data('Cheque Payment')}}</option>
                                    </select>
                                </div>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="emp_id" value="{{$emp_id}}">
                                <input type="hidden" name="text_date" value="{{$text_date}}">
                                <input type="hidden" name="date" value="{{$date}}">
                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-credit-card"></i> {{language_data('Pay')}} </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('All Payments')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">{{language_data('SL')}}#</th>
                                    <th style="width: 20%;">{{language_data('Payment Month')}}</th>
                                    <th style="width: 20%;">{{language_data('Payment Date')}}</th>
                                    <th style="width: 20%;">{{language_data('Paid Amount')}}</th>
                                    <th style="width: 20%;">{{language_data('Payment Type')}}</th>
                                    <th style="width: 15%;">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payroll as $p)
                                <tr>
                                    <td data-label="SL">{{$p->id}}</td>
                                    <td data-label="Payment Month"><p>{{$p->payment_month}}</p></td>
                                    <td data-label="Payment Date"><p>{{$p->payment_date}}</p></td>
                                    <td data-label="Paid Amount"><p>{{app_config('Currency')}} {{$p->total_salary}}</p></td>
                                    <td data-label="Payment Type"><p>{{$p->payment_type}}</p></td>
                                    <td>
                                        <a href="{{url('payroll/view-details/'.$p->id)}}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> {{language_data('Details')}}</a>
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
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}
    <script>
        $(document).ready(function(){
            $('.data-table').DataTable();
            $('#wrapper').on('keyup change','#presend_days',function(){ 
                var present_day = $(this).val();
                calculateSalary(present_day);
            });
			$('#wrapper').on('keyup change','.deduction_amount',function(){ 
                calculateSalary($('#presend_days').val());
            });
            $('#wrapper').on('keyup change','.loan_deducted',function(){ 
                calculateSalary($('#presend_days').val());
            });

            function calculateSalary(present_day){
                $('.net_salary').val(({!! $net_salary !!}/{!! $total_working_day !!}*present_day).toFixed(0));
                $('.provident_deducted').val(({!! $provident_deducted !!}/{!! $total_working_day !!}*present_day).toFixed(0));
                $('.esic_deducted').val(({!! $esic_amount !!}/{!! $total_working_day !!}*present_day).toFixed(0));
                //$('.payment_amount , .payable_amount').val(({!! $payment_amount !!}/{!! $total_working_day !!}*present_day).toFixed(0) ); //+ {!! $loan_deducted !!} - $('.loan_deducted').val()- parseInt($('.loan_deducted').val())
                var payable = $('.net_salary').val();
                if($('.esic_deducted').val() != undefined){
                    payable -=   parseInt($('.esic_deducted').val());
                }
                if($('.provident_deducted').val() != undefined){
                    payable -=   parseInt($('.provident_deducted').val());
                }
                if($('.loan_deducted').val() != undefined){
                    payable -=   parseInt($('.loan_deducted').val());
                }
                $('.payment_amount , .payable_amount').val(payable); //+ {!! $loan_deducted !!} - $('.loan_deducted').val()- parseInt($('.loan_deducted').val())
				$('.payment_amount').val(($('.payable_amount').val() - $('.deduction_amount').val()).toFixed(0));
            }

        });
    </script>
@endsection
