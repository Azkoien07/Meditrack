<?php

namespace App\Http\Controllers;

use App\Models\Admin; // ✅ Importamos el modelo
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = Admin::all(); // Obtener todos los admins
        return view('Admin.indexA', compact('users'));
    }

    public function show(Admin $users) // ✅ Laravel hará el model binding
    {
        return view('Admin.show', compact('users'));
    }

    public function store(Request $request)
    {
        Admin::create($request->all()); // ✅ Guardar un nuevo admin
        return redirect()->route('admin.index');
    }

    public function update(Request $request, Admin $users)
    {
        $users->update($request->all()); // ✅ Actualizar admin
        return redirect()->route('admin.index');
    }

    public function destroy(Admin $users)
    {
        $users->delete(); // ✅ Eliminar admin
        return redirect()->route('admin.index');
    }
}
