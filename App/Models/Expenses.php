<?php

namespace App\Models;
use PDO;

class Expenses extends \Core\Model
{
	public function getExpense(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM expense");
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // public function InsertExpense
    public function InsertExpense($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO expense
                (expense_title, amount, 
                date, expense_note)
                VALUES
                (:expense_title, :amount, :date, 
                :expense_note)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }

    //    delete the expense
    public function DeleteExpenseContent($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM expense WHERE id = :id");
        if($stmt->execute([':id' => $id])){
            return true;
        }else{
            return false;
        }
    }



}



?>