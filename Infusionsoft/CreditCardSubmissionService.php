<?php
class Infusionsoft_CreditCardSubmissionService extends Infusionsoft_Service{

    /**
     * @param $contactId
     * @param $successUrl
     * @param $failureUrl
     * @param Infusionsoft_App $app
     * @return array|bool|mixed
     * NOTE: POST the credit card data to this URL: https://appnamehere.infusionsoft.com/app/creditCardSubmission/addCreditCard
     */
    public static function requestCcSubmissionToken($contactId, $successUrl, $failureUrl, Infusionsoft_App $app = null){

        $params = array(
            (int) $contactId, 
            $successUrl,
            $failureUrl,
        );

        return parent::send($app, "CreditCardSubmissionService.requestSubmissionToken", $params);
    }

    /**
     * @param Infusionsoft_App $app
     * @return string
     */
    public static function getUrl(Infusionsoft_App $app = null){
        if ($app == null){
            $app = Infusionsoft_AppPool::getApp();
        }
        $url = "https://{$app->getHostName()}/app/creditCardSubmission/addCreditCard";
        return $url;
    }

    public static function requestCreditCardId($token, Infusionsoft_App $app = null){

        $params = array(
            $token
        );

        $result = parent::send($app, "CreditCardSubmissionService.requestCreditCardId", $params);
        foreach ($result as $key => $value){
            $cc_data[ucfirst($key)] = $value;
        }
        $cc = new Infusionsoft_CreditCard();
        $cc->loadFromArray($cc_data);
        return $cc;
    }

}