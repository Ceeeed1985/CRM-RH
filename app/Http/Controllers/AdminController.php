<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\storeAdminRequest;
use App\Http\Requests\submitDefineAccessRequest;
use App\Http\Requests\updateAdminRequest;
use App\Models\ResetCodePassword;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailToAdminAfterRegistrationNotification;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(){
        $admins = User::paginate(10);
        $i = 1;
        return view('admins/index', compact('admins', 'i'));
    }

    public function create()
    {
        return view('admins/create');
    }

    public function edit(User $user)
    {
        return view('admins/edit', compact('user'));
    }

    public function store(storeAdminRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('default');
            $user->save();

            try {
                if ($user) {
                    ResetCodePassword::where('email', $user->email)->delete();
                    $code = rand(1000, 4000);
                    $data = [
                        'code'  => $code,
                        'email' => $user->email,
                    ];
                    ResetCodePassword::create($data);

                    Notification::route('mail', $user->email)
                        ->notify(new SendEmailToAdminAfterRegistrationNotification($code, $user->email));

                    return redirect()->route('administrateurs')->with('success_message', 'Nouvel administrateur ajouté');
                }
            } catch (Exception $e) {
                throw new Exception("Une erreur est survenue lors de l'envoi du mail");
            }

        } catch (Exception $e) {
            throw new Exception("Une erreur est survenue lors de la création de ce nouvel administrateur"); // Correction des apostrophes
        }
    }

    public function update(updateAdminRequest $request, User $user)
    {
        try {
            // Logique de mise à jour en développement
        } catch (Exception $e) {
            dd($e);
            throw new Exception("Une erreur est survenue lors de la mise à jour des informations de cet utilisateur");
        }
    }

    public function delete(User $user)
    {
        try {
            // Logique de suppression en développement
        } catch (Exception $e) {
            dd($e);
            throw new Exception("Une erreur est survenue lors de la suppression du compte de cet administrateur");
        }
    }

    public function defineAccess($email){
        $checkUserExist = User::where('email', $email)->first();
        if($checkUserExist){
            return view('auth.validate-account', compact('email'));
        }else{
            return redirect()->route('login');
        };
    }

    public function submitDefineAccess(submitDefineAccessRequest $request){
        try {
        $user = User::where('email', $request->email)->first();
            if($user){
                $user->password = Hash::make($request->password);
                $user->email_verified_at = Carbon::now();
                $user->update();
                return redirect()->route('login')->with('success_message', 'Vos accès ont été définis avec succès!');
            } else {
                //route404
            }
        } catch(Exception $e){
            dd($e);
        }
    }


}
