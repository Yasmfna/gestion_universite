<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $utilisateurs = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('role', 'like', "%$search%");
        })->get();

        return view('listeUtillisateur', compact('utilisateurs', 'search'));
    }


    public function addUser(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required',
            // champs étudiant si rôle = user
            'prenom'          => 'required_if:role,user|nullable|string',
            'date_naissance' => 'required_if:role,user|nullable|date',
            'matricule'       => 'required_if:role,user|nullable|string',
            'niveau'          => 'required_if:role,user|nullable|string',

        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        if ($request->role === 'user') {
            Etudiant::create([
                'nom'               => $request->name,
                'prenom'            => $request->prenom,
                'email'             => $request->email,
                'date_naissance'    => $request->date_naissance,
                'matricule'         => $request->matricule,
                'niveau'            => $request->niveau,
                'user_id'           => $user->id,
                'statut_financier'  => 0,
                'date_inscription'  => now(),
            ]);
        }

        // Envoi de mail
        Mail::to($user->email)->send(new \App\Mail\BienvenueUtilisateur($user, $request->password));

        return redirect()->route('listeUtillisateur')->with('status', 'Utilisateur ajouté avec succès.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('ajouterUtilisateur', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('listeUtillisateur')->with('status', 'Utilisateur modifié avec succès.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
         \DB::table('role_user')->where('user_id', $id)->delete();
        $user->delete();

        return redirect()->route('listeUtillisateur')->with('status', 'Utilisateur supprimé.');
    }



}
