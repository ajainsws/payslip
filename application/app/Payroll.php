<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table='sys_payroll';
    protected $fillable=['emp_id','department','designation','payment_month','payment_date','total_working_days','present_working_days','deduction_amount','net_salary','overtime_salary','total_salary','payment_type','tax','provident_fund','loan','esic'];

    /* employee_name  Function Start Here */
    public function employee_info()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }
    /* employee_name  Function Start Here */
    public function bank_info()
    {
        return $this->hasOne('App\EmployeeBankAccount','emp_id','emp_id');
    }

    /* designation  Function Start Here */
    public function designation_name()
    {
        return $this->hasOne('App\Designation','id','designation');
    }

    /* department  Function Start Here */
    public function department_name()
    {
        return $this->hasOne('App\Department','id','department');
    }


}
