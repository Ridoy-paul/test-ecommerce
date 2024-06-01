<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Utilities\TransactionUtility;

class TransactionsController extends Controller
{
    public function allTransactions(Request $request) {
        try {
            if ($request->ajax()) {
                $data = Transactions::where('user_id', Auth::user()->id);
    
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('date', function($row){
                            return date("d M Y", strtotime($row->date));
                        })
                        ->addColumn('created_at', function($row){
                            return date("d M Y h:s:i A", strtotime($row->created_at));
                        })
                        
                        ->rawColumns(['date', 'created_at'])
                        ->make(true);
            }

            return view('admin.pages.transaction.all');

        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function createDeposit() {
        try {
            return view('admin.pages.transaction.createDeposit');
        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function storeDeposit(Request $request) {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:0.01',
            ]);

            $userId = Auth::id();
            $amount = $request->amount;

            $transaction = new Transactions;
            $transaction->user_id = $userId;
            $transaction->transaction_type = 'deposit';
            $transaction->amount = $amount;
            $transaction->date = date("Y-m-d");
            $transaction->created_at = Carbon::now();

            DB::beginTransaction();

            if ($transaction->save()) {
                if (!TransactionUtility::UpdateUserBalance($userId, 'deposit', $amount)) {
                    DB::rollBack();
                    return back()->wtih('error', 'Failed to update user balance.');
                }
                DB::commit();
                return redirect()->route('transaction.deposit.list')->withSuccess('Deposit successful.');
            } 
            else {
                DB::rollBack();
                return back()->wtih('error', 'Failed to save transaction.');
            }
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage());
        }
    }

    public function depositList(Request $request) {
        try {
            if ($request->ajax()) {
                $data = Transactions::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->where('transaction_type', 'deposit')->get(['id', 'amount', 'date', 'created_at']);
    
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('date', function($row){
                            return date("d M Y", strtotime($row->date));
                        })
                        ->addColumn('created_at', function($row){
                            return date("d M Y h:s:i A", strtotime($row->created_at));
                        })
                        
                        ->rawColumns(['date', 'created_at'])
                        ->make(true);
            }

            return view('admin.pages.transaction.depositList');
        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function createWithdraw() {
        try {
            return view('admin.pages.transaction.createWithdraw');
        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function storeWithdraw(Request $request) {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:0.01',
            ]);

            $userId = Auth::id();
            $amount = $request->amount;

            $withdrawnFeeInfo = TransactionUtility::calculateWithdrawalFee($userId, $amount);


            if(!$withdrawnFeeInfo['success']) {
                return redirect()->back()->with('error', $withdrawnFeeInfo['message']);
            }

            $withdrawalFee = $withdrawnFeeInfo['withdrawalFee'];

            $transaction = new Transactions;
            $transaction->user_id = $userId;
            $transaction->transaction_type = 'withdraw';
            $transaction->amount = $amount;
            $transaction->fee = $withdrawalFee;
            $transaction->date = date("Y-m-d");
            $transaction->created_at = Carbon::now();

            DB::beginTransaction();

            if ($transaction->save()) {
                if (!TransactionUtility::UpdateUserBalance($userId, 'withdraw', ($amount + $withdrawalFee))) {
                    DB::rollBack();
                    return back()->wtih('error', 'Failed to update user balance.');
                }
                DB::commit();
                return redirect()->route('transaction.withdraw.list')->withSuccess('Withdraw successful.');
            } 
            else {
                DB::rollBack();
                return back()->wtih('error', 'Failed to save transaction.');
            }
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return back()->withError($e->getMessage());
        }
    }

    public function withdrawList(Request $request) {
        try {
            if ($request->ajax()) {
                $data = Transactions::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->where('transaction_type', 'withdraw')->get(['id', 'amount', 'fee', 'date', 'created_at']);
                
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('date', function($row){
                            return date("d M Y", strtotime($row->date));
                        })
                        ->addColumn('created_at', function($row){
                            return date("d M Y h:s:i A", strtotime($row->created_at));
                        })
                        
                        ->rawColumns(['date', 'created_at'])
                        ->make(true);
            }

            return view('admin.pages.transaction.withdrawList');
        } 
        catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    

    
}
