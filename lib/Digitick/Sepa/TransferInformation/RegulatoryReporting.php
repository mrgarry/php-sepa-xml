<?php

namespace Digitick\Sepa\TransferInformation;

/**
 * Set regulatory reporting data (RgltryRptg tag of the CdtTrfTxInf section)
 */
class RegulatoryReporting
{
    const SCHEMA = [
        'Authrty' => 'Ctry',
        'Dtls' => [
            'Tp',
            'Ctry',
            'Cd',
            'Amt',
            'Inf',
        ],
    ];
    
    /**
     * @var array
     */
    protected $data = [];
    
    /**
     * Set authority country
     * Normally it's the payment institution's country
     * ISO alpha-2 country code
     * @param string $country
     */
    public function setAuthorityCountry(string $country)
    {
        $this->data['Authrty']['Ctry'] = $country;
    }
    
    /**
     * @param string $type
     */
    public function setTransactionType(string $type)
    {
        $this->data['Dtls']['Tp'] = $type;
    }
    
    /**
     * ISO alpha-2 country code
     * @param string $country
     */
    public function setBeneficiaryCountry(string $country)
    {
        $this->data['Dtls']['Ctry'] = $country;
    }
    
    /**
     * Purpose of the transaction
     * It can be external transaction code 
     * (https://www.iso20022.org/catalogue-messages/additional-content-messages/external-code-sets), some
     * banks can require other code sets (eg integer code)
     * @param string $code
     */
    public function setTransactionCode(string $code)
    {
        $this->data['Dtls']['Cd'] = $code;
    }
    
    /**
     * Amount tag has mandatory Ccy attribute, so it's stored as an array here
     * @param string $currency
     * @param string $amount
     */
    public function setAmount(string $currency, string $amount)
    {
        $this->data['Dtls']['Amt'] = [
            'attributes' => [
                'Ccy' => $currency,
            ],
            'value' => $amount,
        ];
    }
    
    /**
     * Other information/comment for the authority
     * @param string $information
     */
    public function setInformation(string $information)
    {
        $this->data['Dtls']['Inf'] = $information;
    }
    
    /**
     * Returns either empty array if no data is set, or an array ready to be converted into XML nodes
     * @return array
     */
    public function asArray()
    {
        return $this->data;
    }
    
}
