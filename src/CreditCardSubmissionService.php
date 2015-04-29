<?php
namespace NovakSolutions\Infusionsoft;

class CreditCardSubmissionService extends Service{

    /**
     * @param $contactId
     * @param $successUrl
     * @param $failureUrl
     * @param App $app
     * @return array|bool|mixed
     * NOTE: POST the credit card data to this URL: https://appnamehere.infusionsoft.com/app/creditCardSubmission/addCreditCard
     */
    public static function requestCcSubmissionToken($contactId, $successUrl, $failureUrl, App $app = null){

        $params = array(
            (int) $contactId, 
            $successUrl,
            $failureUrl,
        );

        return parent::send($app, "CreditCardSubmissionService.requestSubmissionToken", $params);
    }

    /**
     * @param App $app
     * @return string
     */
    public static function getUrl(App $app = null){
        if ($app == null){
            $app = AppPool::getApp();
        }
        $url = "https://{$app->getHostName()}/app/creditCardSubmission/addCreditCard";
        return $url;
    }

    public static function requestCreditCardId($token, App $app = null){

        $params = array(
            $token
        );

        $result = parent::send($app, "CreditCardSubmissionService.requestCreditCardId", $params);
        foreach ($result as $key => $value){
            $cc_data[ucfirst($key)] = $value;
        }
        $cc = new CreditCard();
        $cc->loadFromArray($cc_data);
        return $cc;
    }

}