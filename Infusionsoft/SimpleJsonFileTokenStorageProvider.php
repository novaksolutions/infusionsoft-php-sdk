<?php

class Infusionsoft_SimpleJsonFileTokenStorageProvider implements Infusionsoft_TokenStorageProvider{
    public $fileName = '';

    public function __construct($fileName = 'infusionsoft-tokens.php'){
        $this->fileName = $fileName;
    }

    public function saveTokens($appDomainName, $accessToken, $refreshToken, $expiresIn){
        $data = $this->readFile();

        $data[$appDomainName] = array(
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
            'expiresAt' => time() + $expiresIn
        );

        file_put_contents($this->fileName, "<?php\n//" . json_encode($data));
    }

    public function getTokens($appDomainName){
        $data = $this->readFile();
        if(isset($data[$appDomainName])){
            return $data[$appDomainName];
        } else {
            return array(
                'accessToken' => '',
                'refreshToken' => '',
                'expiresAt' => 0
            );
        }
    }

    public function readFile(){
        if (file_exists($this->fileName)) {
            $fileContents = file_get_contents($this->fileName);
            $fileContents = substr($fileContents, 8);
            $data = json_decode($fileContents, true);
            return $data;
        } else {
            $data = array();
            return $data;
        }
    }

    public function getFirstAppName(){
        $data = $this->readFile();
        return array_keys($data)[0];
    }
}