<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String PieceType
 * @property String PieceTitle
 * @property String Categories
 */
class Template extends Generated_Template{
    protected static $tableFields = array('Id', 'PieceType', 'PieceTitle', 'Categories');

    public function __construct($id = null, $app = null){
        parent::__construct('Template', $id, $app);
    }
}

