<?php

namespace departmentofhealth\yii2\dohclient;

use yii\authclient\OAuth2;

class DohClient extends OAuth2
{
    public $authUrl = 'http://sso.anamai.moph.go.th/oauth2/authorize/index';

    public $tokenUrl = 'http://sso.anamai.moph.go.th/oauth2/token/index';

    public $apiBaseUrl = 'http://sso.anamai.moph.go.th/api/v1';

    public $attributeNames = [
        'email',
        'username'
    ];

    protected function defaultName()
    {
        return 'doh';
    }

    protected function defaultTitle()
    {
        return 'DOH';
    }

    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 500,
            'popupHeight' => 500,
        ];
    }

    protected function initUserAttributes()
    {
        return $this->api('user/info', 'GET');
    }

    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $data = $request->getData();
        $data['access-token'] = $accessToken->getToken();
        $request->setData($data);
    }

        /** @inheritdoc */
    public function getEmail()
    {
        return isset($this->getUserAttributes()['email'])
            ? $this->getUserAttributes()['email']
            : null;
    }
    /** @inheritdoc */
    public function getUsername()
    {
        return isset($this->getUserAttributes()['username'])
            ? $this->getUserAttributes()['username']
            : null;
    }
}
