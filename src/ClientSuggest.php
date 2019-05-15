<?php

namespace Fomvasss\Dadata;

/**
 * Class ClientHint
 *
 * @package \Fomvasss\Dadata
 */
class ClientSuggest
{

    protected $token;

    protected $config;

    protected $baseUrlsuggestions = 'http://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/';

    protected $baseUrlFindById = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/';

    /**
     * ClientHint constructor.
     */
    public function __construct()
    {
        $this->config = config('dadata');
        $this->token = $this->config['token'];
    }

    public function suggest($type, $fields)
    {
        $result = false;
        if ($ch = curl_init($this->baseUrlsuggestions.$type)) {
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Token '.$this->token
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            // json_encode
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            curl_close($ch);
        }
        return $result;
    }

    public function findParty($inn, $kpp = null)
    {
        // $result = false;

        // if ($ch = curl_init($this->baseUrlFindById . 'party')) {
        //     curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //         'Content-Type: application/json',
        //         'Accept: application/json',
        //         'Authorization: Token ' . $this->token
        //     ));
        //     curl_setopt($ch, CURLOPT_POST, 1);

        //     $query = ['query' => $inn];
            
        //     if (empty($kpp)) {
        //         $query['branch_type'] = 'MAIN';
        //     } else {
        //         $query['kpp'] = $kpp;
        //     }

        //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));

        //     $result = curl_exec($ch);
        //     $result = json_decode($result, true);

        //     curl_close($ch);
        // }

        // return $result;

        dump($this->config);
    }
}
