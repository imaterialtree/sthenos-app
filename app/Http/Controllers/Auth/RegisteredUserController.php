<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Qualificacao;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $qualificacoes = Qualificacao::all();
        return view('auth.register', compact('qualificacoes'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tipoUsuario' => ['required', 'in:aluno,instrutor'],
        ]);
        
        $user = User::make([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        if ($request->tipoUsuario === 'aluno') {
            $request->validate([
                'dataNascimento' => 'required|date',
                'peso' => 'required|numeric',
                'altura' => 'required|numeric',
            ]);

            $user->tipo = User::ALUNO;
            $user->save();
            $user->aluno()->create([
                'data_nascimento' => $request->dataNascimento,
                'peso' => $request->peso,
                'altura' => $request->altura,
            ]);
        } else { // tipoUsuario = instrutor
            $request->validate([
                'qualificacoes' => 'required|array|min:1',
                'qualificacoes.*' => 'integer|exists:qualificacoes,id',
            ]);
            
            $user->tipo = User::INSTRUTOR;
            $user->save();
            $instrutor = $user->instrutor()->create();
            $qualificacoesIds = $request->input('qualificacoes', []);
            $instrutor->qualificacoes()->attach($qualificacoesIds);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
