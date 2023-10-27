<?php 

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\IUserService;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    protected User $user;
    protected $userId;

    public function __construct(User $user) {
        $auth = auth()->user();
        $this->userId = $auth['id'];

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

    public function getUsers() : array
    {
        try
        {
            return auth()->check() ? array($this->user->find($this->userId)) : [];
        }
        catch(ModelNotFoundException $e)
        {
            return (['error' => 'ERRO: '. $e->getMessage()]);
        }
        catch(ErrorException $e)
        {
            return (['error' => 'ERRO: '. $e->getMessage()]);
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