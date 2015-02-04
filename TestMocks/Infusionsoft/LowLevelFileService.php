<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 12/5/2014
 * Time: 3:25 PM
 */

class Infusionsoft_LowLevelFileService extends Infusionsoft_LowLevelMockService {
    public function getFile($args){
        array_shift($args);
        $fileId = array_shift($args);
        return $this->data->fileBoxData[$fileId];
    }

    public function getDownloadUrl($args){
        array_shift($args);
        $fileId = array_shift($args);
        return "http://example.com/getFile/$fileId";
    }

    public function uploadFile($args){
        array_shift($args);
        list(
            $contactId,
            $fileName,
            $base64encodedData
        ) = $args;

        $infusionsoftFileBox = new Infusionsoft_FileBox();
        $infusionsoftFileBox->ContactId = $contactId;
        $infusionsoftFileBox->FileName = $fileName;
        $infusionsoftFileBox->save();
        $this->data->fileBoxData[$infusionsoftFileBox->Id] = $base64encodedData;

        return $infusionsoftFileBox->Id;
    }

    public function replaceFile($args){
        array_shift($args);

        list(
            $fileId,
            $base64encodedData
        ) = $args;

        $this->data->fileBoxData[$fileId] = $base64encodedData;

        return true;
    }

    public function renameFile($args){
        array_shift($args);
        list(
            $fileId,
            $fileName
        ) = $args;
        $infusionsoftFileBox = new Infusionsoft_FileBox($fileId);
        $infusionsoftFileBox->FileName = $fileName;
        $infusionsoftFileBox->save();
    }
} 