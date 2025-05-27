<?php

namespace SocialiteProviders\Azure;

use SocialiteProviders\Manager\OAuth2\User as oAuth2User;
use Illuminate\Support\Facades\Http;

class User extends oAuth2User
{
    /**
     * The user's principal name.
     *
     * @var string
     */
    public $principalName;

    /**
     * The user's mail.
     *
     * @var string
     */
    public $mail;

    /**
     * Get the principal name for the user.
     *
     * @return string
     */
    public function getPrincipalName()
    {
        return $this->principalName;
    }

    /**
     * Get the mail for the user.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Get the avatar for the user.
     *
     * @return string
     */
    public function getAvatar(): ?string
    {
        $response = Http::withToken($this->token)
            ->get('https://graph.microsoft.com/v1.0/me/photo/$value');

        if ($response->successful()) {
            return $response->body();
        }

        return null;
    }
}
