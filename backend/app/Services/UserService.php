<?php 

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\IUserService;
use ErrorException;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    protected User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function register(array $request) : array
    {
        try
        {
            return self::storeUser($request) ? ['response' => 'Cadastro efetuado!'] :
                ['response' => 'Este email já foi cadastrado!'];
        }
        catch(ErrorException $e)
        {
            return ['response' => 'Erro: '.$e];
        }
    }

    private function storeUser(array $request) : bool
    {
        $userExists = $this->user->where('email', $request['email'])->first();

        if(!isset($userExists))
        {
            $this->user->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'nickname' => $request['nickname'],
                'active' => $request['active'],
                'password' => Hash::make($request['password'])
            ])->save();
            return true;
        }
        return false;
    }
}