<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marek
 * Date: 22.04.13
 * Time: 13:32
 * To change this template use File | Settings | File Templates.
 */

class Divante_CodFee_Model_Source_Methods
{
    public function toOptionArray()
    {
        $options =  array();

        foreach (Mage::app()->getStore()->getConfig('carriers') as $code => $carrier) {
            if ($carrier['active'] && isset($carrier['title'])) {
                $options[] = array(
                    'value' => $code,
                    'label' => $carrier['title']
                );
            }
        }
        return $options;
    }
}