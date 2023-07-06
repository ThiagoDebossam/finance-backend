<?php

#System
use Illuminate\Database\Eloquent\Model;

class ExpensesAccountsMonthDao extends Model{

    public function getAll($attributes){

        $query = self::query();
        $query->select();
        $query->from('accounts');
        return collect($query->get())->toArray();
    }

}