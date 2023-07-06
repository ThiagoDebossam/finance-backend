<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Daos\ExpensesAccountsMonthDao;

class ExpensesAccountsMonth extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->dao = new ExpensesAccountsMonthDao();
    }

    static function getAll($id){
        $dao = new ExpensesAccountsMonthDao();
        return $dao->getAll($id);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
        'month_id',
        'year'
    ];
}
