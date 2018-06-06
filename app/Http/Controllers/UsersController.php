<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use App\User;
use App\Http\Requests\{ UserStoreRequest, UserUpdateRequest, ChangePasswordRequest };

class UsersController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->role_id === 2) return redirect()->to('/');
        if (! request()->ajax()) return view('users.index');

        return Datatables::of(User::query())
        ->addColumn('fullname', function ($user) {
            return $user->name . ' ' . $user->last_name;
        })->editColumn('role_id', function ($user) {
            return $user->role->name;
        })->addColumn('action', function ($user) {
            return "<div class='btn-group btn-group-toggle' data-toggle='buttons'>
                      <button id='edit-user' class='btn btn-primary btn-sm' user='$user->id' data-toggle='tooltip' title='Editar a $user->name'><span class='ti-pencil-alt'></span></button>
                      <button id='delete-user' class='btn btn-danger btn-sm' user='$user->id' data-toggle='tooltip' title='Eliminar a $user->name'><span class='ti-close'></span></button>
                    </div>";
        })->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());
        $user->password = bcrypt($request->password);
        return response()->json($user->save());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if($id == 1) return response(['error' => 'Error al modificar usuario'], 422);

        $data = $request->validated();

        if( !empty($request->password) ){
            $data['password'] = bcrypt($this->validate($request, [
                'password' => 'string|min:6|confirmed'
            ])['password']);
        }

        $user = User::findOrFail($id)->fill($data);
        return response()->json($user->save());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 1) return response(['error' => 'Error al modificar usuario'], 422);
        if (\Auth::user()->id == $id)  return response(['error' => 'No se puede borrar usted mismo'], 422);
        
        $user = User::findOrFail($id)->delete();
        return response()->json($user);
    }

    /**
     * restaura el recurso especificado desde el almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if ($id == 1) return response(['error' => 'Error al modificar usuario'], 422);
        /* Indicamos que la busqueda se haga en los registros eliminados con withTrashed y restauramos el recurso */
        $user = User::withTrashed()->findOrFail($id)->restore();
        return response()->json($user);
    }

    /**
     * Edita el password del usuario logueado.
     *
     * @param  \App\Http\Requests\UserUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function editPassword(ChangePasswordRequest $request){
        $data = $request->validated();
        $user = User::findOrFail(\Auth::user()->id)->fill([
            'password' => bcrypt($data['passwordnew'])
        ]);
        return response()->json($user->save());
    }
}
