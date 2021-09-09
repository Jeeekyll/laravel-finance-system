<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    private TransactionRepository $transactionRepository;
    private UserRepository $userRepository;

    /**
     * @param TransactionRepository $repository
     */
    public function __construct(TransactionRepository $transactionRepository, UserRepository $userRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $transactions = [];
        $amountArray = [];
        $labelsArray = [];
        if (Auth::user()) {
            $transactions = $this->userRepository->find(Auth::user()->id)->transactions;
            foreach ($transactions as $transaction) {
                $amountArray[] = strval($transaction->amount);
                $labelsArray[] = $transaction->name;
            }
        }
        $user = Auth::user();
        return view('home.index')->with([
            'transactions' => $transactions,
            'user' => $user,
            'amount' => $amountArray,
            'labels' => $labelsArray,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransactionRequest $request)   {

        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        if ($request->hasFile('image')) {
            $avatarPath = $request->file('image');
            $avatarName = time() . '.' . $avatarPath->getClientOriginalExtension();

            $path = $request->file('image')->storeAs('uploads/image/' . Auth::id(), $avatarName, 'public');
            $data['image'] = '/storage/' . $path;
        };

        $this->transactionRepository->create($data);
        return redirect()->route("transactions.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->transactionRepository->find($id)->delete();
        return redirect()->route('transactions.index');
    }
}
