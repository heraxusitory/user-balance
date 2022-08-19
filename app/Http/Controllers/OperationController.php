<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function index(Request $request)
    {
        $pagination = $request->get('pagination');
        $type = $request->get('type');
        $limit = $request->get('limit');
        $user = $request->user();
        $balances = $user->balances;

        $operations = collect();
        if ($balances->isNotEmpty()) {
            $operations_query = $balances[0]->operations()->where('type', 'ILIKE', $type)->latest();
            if ($pagination) {
                $operations = $operations_query->paginate();
            } else if ($limit) {
                $operations = $operations_query->limit($limit)->get();
            } else $operations = $operations_query->get();
        }
        return response()->json($operations);
    }
}
