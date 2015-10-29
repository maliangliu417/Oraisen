<?php 
namespace App;


use App\Repositories\UserRepository as UserRepository;
use Illuminate\Contracts\Auth\Authenticator as Authenticator;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthenticateUser{

	private $users;
	private $socialite;
	private $auth;

	public function _construct(UserRepository $users, Socialite $socialite, Authenticator $auth)
	{
		$this->users = $users;
		$this->socialite = $socialite;
		$this->auth = $auth;
	}

	public function execute($hasCode)
	{
		if( ! $hasCode ) return $this->getAuthorizationFirst();

		$user = $this->socialite->driver('facebook')->user();
		dd($user);	
	}

	private function getAuthorizationFirst()
	{
		return $this->socialite->driver('facebook')->redirect();
	}
}
