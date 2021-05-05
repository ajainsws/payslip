<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>{{app_config('AppName')}} - {{language_data('Print Payslip')}}</title>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
{!! Html::style("assets/libs/bootstrap/css/bootstrap.min.css") !!}
{!! Html::style("assets/libs/bootstrap-toggle/css/bootstrap-toggle.min.css") !!}
{!! Html::style("assets/libs/font-awesome/css/font-awesome.min.css") !!}
{!! Html::style("assets/libs/alertify/css/alertify.css") !!}
{!! Html::style("assets/libs/alertify/css/alertify-bootstrap-3.css") !!}
{!! Html::style("assets/css/style.css") !!}

<head>
    <style>
        .help-split {
            display: inline-block;
            width: 30%;
        }
    </style>
</head>
<body class="printable-page">

<main id="wrapper" class="wrapper">
    <div class="container container-printable">
        <div class="p-30 p-t-none p-b-none">

            <div class="p-t-30"></div>

            <table width="100%">
                <tbody>
                <tr>
                    <td style="border: 0;  text-align: left" width="62%">
                        <span style="font-size: 18px;"><strong>{{language_data('Payslip NO')}} #{{$payslip->id}}</strong></span>
                        <br>
                        <span><strong>{{language_data('Date')}}:</strong> {{get_date_format($payslip->payment_date)}}</span>
                    </td>
                    <td style="border: 0;  text-align: right" width="62%">
                        <div>
                            <img src="<?php echo asset(app_config('AppLogo')); ?>" alt="logo">
                            <div style="height: 15px;"></div>
                            {!!app_config('Address')!!}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="m-b-20"></div>

            <table width="100%">
                <tbody>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>{{language_data('Employee ID')}}:</strong>
                            </div>
                            <div class="col-xs-6">
                                <span>#{{$payslip->employee_info->employee_code}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>{{language_data('Employee Name')}} :</strong>
                            </div>
                            <div class="col-xs-6">
                                <span>{{$payslip->employee_info->fname}} {{$payslip->employee_info->lname}}</span>
                            </div>
                        </div>
                        @if(isset($payslip->bank_info))
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>PAN :</strong>
                            </div>
                            <div class="col-xs-6">
                                <span>{{$payslip->bank_info->pan_no}}</span>
                            </div>
                        </div>
                        @endif
                        @if($payslip->employee_info->phone!='')
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>{{language_data('Phone')}} :</strong>
                            </div>
                            <div class="col-xs-6">
                                <span>{{$payslip->employee_info->phone}}</span>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>{{language_data('Payment By')}} :</strong>
                            </div>
                            <div class="col-xs-6">
                                <span>{{$payslip->payment_type}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>{{language_data('Department')}} :</strong>
                            </div>
                            <div class="col-xs-6">
                                <span>{{$payslip->department_name->department}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>{{language_data('Designation')}} :</strong>
                            </div>
                            <div class="col-xs-6">
                                <span>{{$payslip->designation_name->designation}}</span>
                            </div>
                        </div>
                    </td>
                    <td class="p-l-100">
                        <table class="table table-condensed table-transparent table-condensed-slim table-bordered">
                            <tr>
                                <td>
                                    <strong>{{language_data('Payslip NO')}} # :</strong>
                                </td>
                                <td class="text-right">
                                    <span>#{{$payslip->id}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{language_data('Salary Month')}} :</strong>
                                </td>
                                <td class="text-right">
                                    <span>{{$payslip->payment_month}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Present Days :</strong>
                                </td>
                                <td class="text-right">
                                    <span>{{$payslip->present_working_days}} out of {{$payslip->total_working_days}}</span>
                                </td>
                            </tr>
                            @if($payslip->employee_info->pf_uan!='')
                                <tr>
                                    <td>
                                        <strong>PF Account (UAN)</strong>
                                    </td>
                                    <td class="text-right">
                                        <span>{{$payslip->employee_info->pf_uan}}</span>
                                    </td>
                                </tr>
                            @endif
                            <!--<tr>
                                <td>
                                    <strong>{{language_data('Overtime Hourly Rate')}} :</strong>
                                </td>
                                <td class="text-right">
                                    <span>{{app_config('Currency')}} {{$payslip->employee_info->overtime_hourly_rate}}</span>
                                </td>
                            </tr>-->
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="m-b-20"></div>
            <div class="row">
                <div class='col-xs-6'>
                    <table class="table table-condensed table-transparent table-condensed-slim table-bordered">
                        <tbody>
                            <?php $workingDays = $payslip->present_working_days/$payslip->total_working_days; ?>
                            <tr>
                                <th width="65%">{{language_data('Basic Salary')}}</th>
                                <td class="text-right">{{app_config('CurrencyCode')}} <?php echo round(($payslip->employee_info->basic_salary+$payslip->employee_info->basic_salary_increment) * $workingDays,2) ." / ".round($payslip->employee_info->basic_salary+$payslip->employee_info->basic_salary_increment,0); ?></td>
                            </tr>
                                @if($payslip->employee_info->hra != 0)
                                <tr>
                                    <th>HRA</th> 
                                    <td  class="text-right">{{app_config('CurrencyCode')}} <?php echo round($payslip->employee_info->hra * $workingDays,2)." / ".round($payslip->employee_info->hra,0); ?></td>
                                </tr>
                                @endif
                                @if($payslip->employee_info->convey_allowance != 0)
                                <tr>
                                    <th>CONVEYANCE ALLOWANCE</th>
                                    <td  class="text-right">{{app_config('CurrencyCode')}} <?php echo round($payslip->employee_info->convey_allowance * $workingDays,2)." / ".round($payslip->employee_info->convey_allowance,0); ?></td>
                                </tr>
                                @endif
                                @if($payslip->employee_info->medical_allowance != 0)
                                <tr>
                                    <th>MEDICAL ALLOWANCE</th>
                                    <td  class="text-right">{{app_config('CurrencyCode')}} <?php echo round($payslip->employee_info->medical_allowance * $workingDays,2)." / ".round($payslip->employee_info->medical_allowance,0); ?></td>
                                </tr>
                                @endif
                                @if($payslip->employee_info->special_allowance != 0)
                                <tr>
                                    <th>SPECIAL ALLOWANCE</th>
                                    <td  class="text-right">{{app_config('CurrencyCode')}} <?php echo round($payslip->employee_info->special_allowance * $workingDays,2)." / ".round($payslip->employee_info->special_allowance,0); ?></td>
                                </tr>
                                @endif
                                @if($payslip->employee_info->education_allowance != 0)
                                <tr>
                                    <th>EDUCATION ALLOWANC</th>
                                    <td  class="text-right">{{app_config('CurrencyCode')}} <?php echo round($payslip->employee_info->education_allowance * $workingDays,2)." / ".round($payslip->employee_info->education_allowance,0); ?></td>
                                </tr>
                                @endif
                                @if($payslip->employee_info->mobile_allowance != 0)
                                <tr>
                                    <th>MOBILE ALLOWANCE</th>
                                    <td  class="text-right">{{app_config('CurrencyCode')}} <?php echo round($payslip->employee_info->mobile_allowance * $workingDays,2)." / ".round($payslip->employee_info->mobile_allowance,0); ?></td>
                                </tr>
                                @endif
                                @if($payslip->employee_info->miscellaneous != 0)
                                <tr>
                                    <th>MISCELLANEOUS</th>
                                    <td  class="text-right">{{app_config('CurrencyCode')}} <?php echo round($payslip->employee_info->miscellaneous * $workingDays,2)." / ".round($payslip->employee_info->miscellaneous,0); ?></td>
                                </tr>
                                @endif
                                @if($payslip->employee_info->retirement_allowance != 0)
                                <tr>
                                    <th>RETIREMENT ALLOWANC</th>
                                    <td  class="text-right">{{app_config('CurrencyCode')}} <?php echo round($payslip->employee_info->retirement_allowance * $workingDays,2)." / ".round($payslip->employee_info->retirement_allowance,0); ?></td>
                                </tr>
                                @endif
                                <tr>
                                    <th>{{language_data('Overtime Salary')}}</th>
                                    <td class="text-right">{{app_config('CurrencyCode')}} {{$payslip->employee_info->overtime_salary+$payslip->employee_info->overtime_salary_increment}} ({{language_data('Hourly')}})</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <div class='col-xs-6'>
                    <table class="table table-condensed table-transparent table-condensed-slim table-bordered">

                        <tbody>

                        <tr class="item-row">
                            <th width="65%">{{language_data('Net Salary')}}</th>
                            <td class="text-right" >{{app_config('CurrencyCode')}} {{$payslip->net_salary}}</td>
                        </tr>
                        @if($payslip->overtime_salary != 0)
                        <tr class="item-row">
                            <th>{{language_data('Overtime Amount')}}</th>
                            <td class="text-right">{{app_config('CurrencyCode')}} {{$payslip->overtime_salary}}</td>
                        </tr>
                        <tr>
                            <th>{{language_data('Subtotal')}}</th>
                            <td class="text-right">{{app_config('CurrencyCode')}} {{$payslip->net_salary+$payslip->overtime_salary}}</td>
                        </tr>
                        @endif
                        @if($payslip->tax != 0)
                        <tr>
                            <th>{{language_data('TAX')}}</th>
                            <td class="text-right">{{app_config('CurrencyCode')}} {{$payslip->tax}}</td>
                        </tr>
                        @endif
                        @if($payslip->provident_fund != 0)
                        <tr>
                            <th>{{language_data('Provident Fund')}}</th>
                            <td class="text-right">{{app_config('CurrencyCode')}} {{$payslip->provident_fund}}</td>
                        </tr>
                        @endif
                        @if($payslip->esic != 0)
                        <tr>
                            <th>ESIC Deducted</th>
                            <td class="text-right">{{app_config('CurrencyCode')}} {{$payslip->esic}}</td>
                        </tr>
                        @endif
                        @if($payslip->loan != 0)
                        <tr>
                            <th>{{language_data('Loan')}}</th>
                            <td class="text-right">{{app_config('CurrencyCode')}} {{$payslip->loan}}</td>
                        </tr>
                        @endif
                        @if($payslip->deduction_amount != 0)
                        <tr>
                            <th>Deductions</th>
                            <td class="text-right">{{app_config('CurrencyCode')}} {{str_replace('.00','',$payslip->deduction_amount)}}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>{{language_data('Grand Total')}}</th>
                            <td class="text-right">{{app_config('CurrencyCode')}} {{$payslip->total_salary}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</main>

{!! Html::script("assets/libs/jquery-1.10.2.min.js") !!}
{!! Html::script("assets/libs/jquery.slimscroll.min.js") !!}
{!! Html::script("assets/libs/bootstrap/js/bootstrap.min.js") !!}
{!! Html::script("assets/libs/bootstrap-toggle/js/bootstrap-toggle.min.js") !!}
{!! Html::script("assets/libs/alertify/js/alertify.js") !!}
{!! Html::script("assets/js/scripts.js") !!}

</body>
</html>