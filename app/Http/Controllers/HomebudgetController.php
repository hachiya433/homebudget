<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeBudget;

class HomebudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homebudgets = HomeBudget::with('category')->orderBy('date', 'desc')->paginate(5);
        $income = HomeBudget::where('category_id', 6)->sum('price');
        $payment = HomeBudget::where('category_id', '!=', 6)->sum('price');
        return view('homebudget.index', compact('homebudgets', 'income', 'payment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'category' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $result = HomeBudget::create([
            'date' => $request->date,
            'category_id' => $request->category,
            'price' => $request->price
        ]);

        if (!empty($result)) {
            session()->flash('flash_message', '収支を登録しました。');
        } else {
            session()->flash('flash_error_message', '収支を登録できませんでした。');
        }
        // ブログポストは有効

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $homebudget = HomeBudget::find($id);
    return view('homebudget.edit', compact('homebudget', 'id'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'category' => 'required|numeric',
            'price' => 'required|numeric'
        ]);
    // dd($request);
        // 指定されたIDのレコードを取得
        $hasData = HomeBudget::find($request->id);
    
        if ($hasData) {
            // レコードが存在する場合、更新を実行
            $hasData->update([
                'date' => $request->date,
                'category_id' => $request->category,
                'price' => $request->price
            ]);
    
            // 更新成功のフラッシュメッセージを設定
            session()->flash('flash_message', '収支を更新しました。');
        } else {
            // レコードが存在しない場合、エラーメッセージを設定
            session()->flash('flash_error_message', '収支を更新できませんでした。');
        }
    
        // リダイレクト
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $homebudget = HomeBudget::find($id);
        dd($homebudget);
        $homebudget->delete();
        session()->flash('flash_message', '収支を削除しました。');
        return redirect('/');
    }
}
