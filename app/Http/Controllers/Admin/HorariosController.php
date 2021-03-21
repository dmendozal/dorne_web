<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Horario;

class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Horario::all();
        return view('admin.horarios.index', compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.horarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $horarios = Horario::create($request->all());

        return redirect()->route('admin.horarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Horario $horario)
    {
        abort_unless(\Gate::allows('horario_show'), 403);

        return view('admin.horarios.show', compact('horario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {
        abort_unless(\Gate::allows('horario_edit'), 403);
        $programAcademica = ProgramacionAcademica::all()->pluck('descripcion','idprogramacionacademica');
        $horario->load('programAcademica');
        return view('admin.horarios.edit', compact('horario','programAcademica'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHorarioRequest $request, Horario $horario)
    {
        abort_unless(\Gate::allows('horario_edit'), 403);

        $horario->update($request->all());

        return redirect()->route('admin.horarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        abort_unless(\Gate::allows('horario_delete'), 403);

        $horario->delete();

        return back();
    }

    public function massDestroy(MassDestroyHorarioRequest $request)
    {
        dd('hola mundo mass destroy (arreglar ids)');
        Horario::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
