<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // public function expense(Request $request)
    // {
    //     // code for adding expense goes here
    //     if ($request->getMethod() == 'POST') {
    //         $request->validate([
    //             'name' => 'required|string|max:255',
    //             'description' => 'nullable|string|max:255',
    //             'payment_method' => 'required|string',
    //             'amount' => 'required|integer',
    //             'date' => 'required|',
    //             'branch_id' => 'required|exists:users,id',
    //             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'

    //         ]);
    //         $imagePath = $request->image ? $request->image->store('uploads/Branch') : null;
    //         $expense =  new Expense();
    //         $expense->name = $request->name;
    //         $expense->description = $request->description;
    //         $expense->payment_method = $request->payment_method;
    //         $expense->amount = $request->amount;
    //         $expense->date = $request->date;
    //         $expense->branch_id = $request->branch_id;
    //         $expense->image = $imagePath;
    //         $expense->save();
    //         return redirect()->back()->with('success', 'Expense added successfully');
    //     } else {
    //         $expenses = Expense::all();
    //         return view('Branch.Expense.add',compact('expenses'));
    //     }
    // }
    public function expense(Request $request)
{
    if ($request->getMethod() == 'POST') {
        // Validate expense creation
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'payment_method' => 'required|string',
            'amount' => 'required|integer',
            'date' => 'required|date',
            'branch_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        $imagePath = $request->image ? $request->image->store('uploads/Branch') : null;

        // Create new Expense record
        $expense = new Expense();
        $expense->name = $request->name;
        $expense->description = $request->description;
        $expense->payment_method = $request->payment_method;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->branch_id = $request->branch_id;
        $expense->image = $imagePath;
        $expense->save();

        return redirect()->back()->with('success', 'Expense added successfully');
    } else {
        // Fetch expenses data for the chart
        $start = Carbon::now()->subMonths(5); // Adjust as needed
        $end = Carbon::now();
        $period = CarbonPeriod::create($start, '1 month', $end);

        $monthlyExpenses = collect($period)->map(function ($date) {
            $endDate = $date->copy()->endOfMonth();

            $totalAmount = Expense::whereBetween('date', [$date, $endDate])
                ->sum('amount');

            return [
                'month' => $endDate->format('Y-m'),
                'total_amount' => $totalAmount,
            ];
        });

        $labels = $monthlyExpenses->pluck('month')->toArray();
        $data = $monthlyExpenses->pluck('total_amount')->toArray();

        // Chart configuration using chartjs library
        $chart = app()->chartjs
            ->name('MonthlyExpenseChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    'label' => 'Monthly Expenses',
                    'backgroundColor' => 'rgba(38, 185, 154, 0.31)',
                    'borderColor' => 'rgba(38, 185, 154, 0.7)',
                    'data' => $data,
                ],
            ])
            ->options([
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                    ],
                ],
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Monthly Expenses',
                    ],
                ],
            ]);

        // Pass chart data to the view
        return view('Branch.Expense.add', compact('chart'));
    }
}

}
