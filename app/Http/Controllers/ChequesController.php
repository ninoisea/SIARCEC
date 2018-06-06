<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use App\Models\{ Bank, Cheque, Shelf, Box, Image, Folder };
use App\Http\Requests\{ ChequesStoreRequest, ChequesUpdateRequest};

class ChequesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) return view('cheques.index');

        return Datatables::of(Cheque::query())
        ->addColumn('state', function ($b) {
            return ($b->state) ? 'Físico' : 'Digital';
        })->addColumn('bank_id', function ($b) {
            return $b->bank->name;
        })->addColumn('folder_id', function ($b) {
            if ($b->folder_id == 0) return '';
            $folder = $b->folder->name;
            $box = $b->folder->box->name;
            $shelf = $b->folder->box->shelf->name;
            return $folder . ' / ' . $box . ' / ' . $shelf;
        })->addColumn('action', function ($b) {
            return "<div class='btn-group btn-group-toggle' data-toggle='buttons'>
                <button href='".route('cheques.show', $b->id)."' id='cheques-show' class='btn btn-warning btn-sm' data-toggle='tooltip' title='Ver'><span class='ti-eye' style='color:white'></span></button>
                <button href='".route('cheques.edit', $b->id)."' id='cheques-update' class='btn btn-primary btn-sm' data-toggle='tooltip' title='Editar'><span class='ti-pencil-alt'></span></button>
                ".((\Auth::user()->role_id === 1) ? "<button id='delete-cheque' class='btn btn-danger btn-sm' cheque='$b->id' data-toggle='tooltip' title='Eliminar'><span class='ti-close'></span></button>" : "")."
            </div>";
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cheques.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChequesStoreRequest $request)
    {
        return Cheque::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cheque = Cheque::findOrFail($id);
        if ($cheque->state == 1) $cheque->folder->box->shelf;
        $cheque->bank;
        $cheque->image;
        if (request()->ajax()) return response()->json($cheque);
        return view('cheques.show', compact('cheque'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cheques.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChequesUpdateRequest $request, $id)
    {
        $cheque = Cheque::findOrFail($id)->update($request->validated());
        return response()->json($cheque);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cheque = Cheque::findOrFail($id)->delete();
        return response()->json($cheque);
    }

    public function restore($id)
    {
        $cheque = Cheque::withTrashed()->findOrFail($id)->restore();
        return response()->json($cheque);
    }

    public function data(Request $request)
    {
        if ($request->action == 'shelf') {
            $boxes = Shelf::findOrFail($request->shelf)->boxes->pluck('name', 'id');
            return response()->json(compact('boxes'));
        } elseif ($request->action == 'box') {
            $folders = Box::findOrFail($request->box)->folder->pluck('name', 'id');
            return response()->json(compact('folders'));
        } elseif ($request->action == 'folder') {
            $boxes = Folder::findOrFail($request->folder)->box->pluck('name', 'id');
            return response()->json(compact('boxes'));
        } else {
            $banks = Bank::all()->pluck('name', 'id');
            $shelves = Shelf::all()->pluck('name', 'id');
            return response()->json(compact('banks', 'shelves'));
        }
    }
}
