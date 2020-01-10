<?php

namespace App\Controllers;


use Core\View;

class ExpensesController
{
    public function __construct()
    {
        Auth('admin');
    }

    public function manage(){
        $expense = new \App\Models\Expenses();
        $expenses = $expense->getExpense();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['expenses'=>'active']);
        View::render('backend/management/expense/manage_expense.html', [
            'expenses' => $expenses
        ]);
        View::render('backend/layouts/script.html');
    }

    public function add_new_expense_post(){

        // preparing data
        $data = [
            ':expense_title' => clean_post('expense_title'),
            ':amount' => clean_post('amount'),
            ':date' => clean_post('date'),
            ':expense_note' => clean_post('expense_note')
        ];

        $expense = new \App\Models\Expenses();
        $expense->InsertExpense($data);
        redirectWithMessage(
            app_url('admin').'/expense/manage',
            'New Expense Created Successfully',
            'addexpense');
    }

    //delete expense
    public function delete_expense($request){
        $expense = new \App\Models\Expenses();
        $exp = $expense->DeleteExpenseContent($request['id']);
        if($exp){
            redirectWithMessage(app_url('admin').'/expense/manage', 'Expense Deleted Successfully', 'addexpense');
        }else{
            redirectWithMessage(app_url('admin').'/expense/manage', 'Unable to delete Expense information please contact developers', 'addexpense', 'error');
        }
    }

}