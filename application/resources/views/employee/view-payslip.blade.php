@extends('employee')

@section('content')

<section class="wrapper-bottom-sec">
			<div class="p-30">
				<div class="row">
					<div class="col-sm-8">
						<h2 class="page-title p-b-15">{{language_data('Payment Salary Details')}}</h2>
					</div>
					<div class="col-sm-4 text-right">
                        <a href="{{url('employee/payslip/print-payslip/'.$payslip->id)}}" target="_blank" class="btn btn-primary btn-animated from-left fa fa-print">
                            <span>{{language_data('Print Payslip')}}</span>
                        </a>
					</div>
				</div>
			</div>
			<div class="p-30 p-t-none p-b-none">

				<div class="panel">
					<div class="panel-heading p-b-none">
						<h3>{{language_data('Payslip')}}<br><small>{{language_data('Salary Month')}}: {{$payslip->payment_month}}</small></h3>
					</div>
					<div class="panel-body p-none m-b-10">
						<table class="table table-no-border table-condensed">
							<tbody>
								<tr>
									<td><strong class="help-split">{{language_data('Employee ID')}}:</strong>#{{$payslip->employee_info->employee_code}}</td>
									<td><strong class="help-split">{{language_data('Employee Name')}}:</strong>{{$payslip->employee_info->fname}} {{$payslip->employee_info->lname}}</td>
									<td><strong class="help-split">{{language_data('Payslip NO')}}:</strong>#{{$payslip->id}}</td>
								</tr>
								<tr>
									<td><strong class="help-split">{{language_data('Phone')}}:</strong>{{$payslip->employee_info->phone}}</td>
									<td><strong class="help-split">{{language_data('Joining Date')}}:</strong>{{get_date_format($payslip->employee_info->doj)}}</td>
									<td><strong class="help-split">{{language_data('Payment By')}}:</strong>{{$payslip->payment_type}}</td>
								</tr>
								<tr>
									<td><strong class="help-split">{{language_data('Department')}}:</strong>{{$payslip->department_name->department}}</td>
									<td><strong class="help-split">{{language_data('Designation')}}:</strong>{{$payslip->designation_name->designation}}</td>
									<td><strong class="help-split">Present Days:</strong>{{$payslip->present_working_days}} out of {{$payslip->total_working_days}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>


			<div class="row">
				<div class="col-sm-6">
					<div class="panel">
						<div class="panel-heading p-b-none">
							<h4 class="m-b-10"><strong>{{language_data('Payment Details')}}</strong></h4>
						</div>
						<div class="panel-body p-none">
							<table class="table table-condensed">
								<tbody>
								@if($payslip->employee_info->payment_type=='Hourly')
                                    <tr>
										<td><strong>{{language_data('Working Hourly Rate')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$payslip->employee_info->working_hourly_rate+$payslip->employee_info->working_hourly_increment_rate}}</span></td>
									</tr>
									<tr>
										<td><strong>{{language_data('Overtime Hourly Rate')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$payslip->employee_info->overtime_hourly_rate+$payslip->employee_info->overtime_hourly_increment_rate}}</span></td>
									</tr>
                                 @else
								 <?php $workingDays = $payslip->present_working_days/$payslip->total_working_days; ?>
                                    <tr>
                                        <td><strong>{{language_data('Basic Salary')}}:</strong> <span class="pull-right">{{app_config('Currency')}} <?php echo round(($payslip->employee_info->basic_salary+$payslip->employee_info->basic_salary_increment) * $workingDays,2) ." / ".round($payslip->employee_info->basic_salary+$payslip->employee_info->basic_salary_increment,0); ?> </span></td>
                                    </tr>
									@if($payslip->employee_info->hra != 0)
									<tr>
                                        <td><strong>HRA:</strong> <span class="pull-right">{{app_config('Currency')}} <?php echo round($payslip->employee_info->hra * $workingDays,2)." / ".round($payslip->employee_info->hra,0); ?></span></td>
                                    </tr>
									@endif
									@if($payslip->employee_info->convey_allowance != 0)
									<tr>
                                        <td><strong>CONVEYANCE ALLOWANCE:</strong> <span class="pull-right">{{app_config('Currency')}} <?php echo round($payslip->employee_info->convey_allowance * $workingDays,2)." / ".round($payslip->employee_info->convey_allowance,0); ?></span></td>
                                    </tr>
									@endif
									@if($payslip->employee_info->medical_allowance != 0)
									<tr>
                                        <td><strong>MEDICAL ALLOWANCE:</strong> <span class="pull-right">{{app_config('Currency')}} <?php echo round($payslip->employee_info->medical_allowance * $workingDays,2)." / ".round($payslip->employee_info->medical_allowance,0); ?></span></td>
                                    </tr>
									@endif
									@if($payslip->employee_info->special_allowance != 0)
									<tr>
                                        <td><strong>SPECIAL ALLOWANCE:</strong> <span class="pull-right">{{app_config('Currency')}} <?php echo round($payslip->employee_info->special_allowance * $workingDays,2)." / ".round($payslip->employee_info->special_allowance,0); ?></span></td>
                                    </tr>
									@endif
									@if($payslip->employee_info->education_allowance != 0)
									<tr>
                                        <td><strong>EDUCATION ALLOWANC:</strong> <span class="pull-right">{{app_config('Currency')}} <?php echo round($payslip->employee_info->education_allowance * $workingDays,2)." / ".round($payslip->employee_info->education_allowance,0); ?></span></td>
                                    </tr>
									@endif
									@if($payslip->employee_info->mobile_allowance != 0)
									<tr>
                                        <td><strong>MOBILE ALLOWANCE:</strong> <span class="pull-right">{{app_config('Currency')}} <?php echo round($payslip->employee_info->mobile_allowance * $workingDays,2)." / ".round($payslip->employee_info->mobile_allowance,0); ?></span></td>
                                    </tr>
									@endif
									@if($payslip->employee_info->miscellaneous != 0)
									<tr>
                                        <td><strong>MISCELLANEOUS:</strong> <span class="pull-right">{{app_config('Currency')}} <?php echo round($payslip->employee_info->miscellaneous * $workingDays,2)." / ".round($payslip->employee_info->miscellaneous,0); ?></span></td>
                                    </tr>
									@endif
									@if($payslip->employee_info->retirement_allowance != 0)
									<tr>
                                        <td><strong>RETIREMENT ALLOWANC:</strong> <span class="pull-right">{{app_config('Currency')}} <?php echo round($payslip->employee_info->retirement_allowance * $workingDays,2)." / ".round($payslip->employee_info->retirement_allowance,0); ?></span></td>
                                    </tr>
									@endif
                                    <tr>
                                        <td><strong>{{language_data('Overtime Salary')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$payslip->employee_info->overtime_salary+$payslip->employee_info->overtime_salary_increment}} ({{language_data('Hourly')}})</span></td>
                                    </tr>
                                @endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel">
						<div class="panel-heading p-b-none">
							<h4 class="m-b-10"><strong>{{language_data('Earning')}}</strong></h4>
						</div>
						<div class="panel-body p-none">
							<table class="table table-condensed">
								<tbody>
									<tr>
										<td><strong>{{language_data('Net Salary')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$payslip->net_salary}}</span></td>
									</tr>
									@if($payslip->overtime_salary != 0)
									<tr>
										<td><strong>{{language_data('Overtime Amount')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$payslip->overtime_salary}}</span></td>
									</tr>
									@endif
									@if($payslip->tax != 0)
									<tr>
										<td><strong>{{language_data('TAX')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$payslip->tax}}</span></td>
									</tr>
									@endif
									@if($payslip->provident_fund != 0)
									<tr>
										<td><strong>{{language_data('Provident Fund')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$payslip->provident_fund}}</span></td>
									</tr>
									@endif
									@if($payslip->esic != 0)
									<tr>
										<td><strong>ESIC Deducted:</strong> <span class="pull-right">{{app_config('Currency')}} {{$payslip->esic}}</span></td>
									</tr>
									@endif
									@if($payslip->loan != 0)
									<tr>
										<td><strong>{{language_data('Loan')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{str_replace('.00','',$payslip->loan)}}</span></td>
									</tr>
									@endif
									@if($payslip->deduction_amount != 0)
									<tr>
										<td><strong>Deductions:</strong> <span class="pull-right">{{app_config('Currency')}} {{str_replace('.00','',$payslip->deduction_amount)}}</span></td>
									</tr>
									@endif
									<tr>
										<td class="td-highlighted"><strong>{{language_data('Grand Total')}}:</strong> <span class="pull-right"><strong>{{app_config('Currency')}} {{$payslip->total_salary}}</strong></span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

                </div>
		</section>


@endsection
