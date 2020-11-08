<?php

namespace App\Auth;

use Cache;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;

class MelonUserProvider implements UserProvider
{
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param mixed $identifier
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        // TODO: Implement retrieveById() method.

        // check cache first
        /*if (config('suara.is_cached') == true) {
            $user = Cache::tags("auth")->get('auth_retrievebyid_' . $identifier);
            if ($user != null) {
                return $user;
            }
        }*/

        $qry = User::where('id', '=', $identifier);

        if ($qry->count() > 0) {
            $user = $qry->select('id', 'username', 'email', 'password', 'status')->first();

            // store in cache
            //$this->storeAuthCache('auth_retrievebyid_' . $identifier, $user);

            return $user;
        }

        return null;
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // TODO: Implement retrieveByCredentials() method.
        // check cache first
        /*if (config('suara.is_cached') == true) {
            $user = Cache::tags("auth")->get('auth_retrievebycredential_' . $credentials['username']);
            if ($user != null) {
                return $user;
            }
        }*/

        $qry = User::where('username', '=', $credentials['username']);

        if ($qry->count() > 0) {
            $user = $qry->select('id', 'username', 'email', 'password', 'status')->first();

            // store in cache
            //$this->storeAuthCache('auth_retrievebycredential_' . $credentials['username'], $user);

            return $user;
        }

        return null;
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed $identifier
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
        // check cache first
        /*if (config('suara.is_cached') == true) {
            $user = Cache::tags("auth")->get('auth_retrievebytoken_' . $identifier . '_' . $token);
            if ($user != null) {
                return $user;
            }
        }*/

        $qry = User::where('id', '=', $identifier)->where('remember_token', '=', $token);

        if ($qry->count() > 0) {
            $user = $qry->select('id', 'username', 'email', 'password', 'status')->first();

            // store in cache
            //$this->storeAuthCache('auth_retrievebytoken_' . $identifier . '_' . $token, $user);

            return $user;
        }
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
        $user->setRememberToken($token);
        $user->save();

    }

    /**
     * Validate a user against the given credentials.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     *
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
        // we'll assume if a user was retrieved, it's good

        // echo "<pre/>";print_r($user->username);
        // echo "<pre/>";print_r($user->password);
        // echo "<pre/>";print_r(Hash::make(trim($credentials['password'])));
        // echo "<pre/>";print_r($credentials);

        if(Hash::check($credentials['password'], $user->password)){
            if ($user->username == $credentials['username'] && $user->status == "Y") {
                $user->updated_at = Carbon::now();
                $user->save();

                return true;
            }
        }

        return false;
    }

    /**
     * store auth cache
     * @param string $cacheName
     * @param array $data
     */
    private function storeAuthCache($cacheName = "", $data = []) {
        /*if (config('suara.is_cached') == true) {
            Cache::tags("auth")->put($cacheName, $data, config('suara.cache_ttl_auth'));
        }*/
    }
}
