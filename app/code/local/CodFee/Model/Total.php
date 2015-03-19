<?php
/**
 * Created by PhpStorm.
 * User: Marek Kidon
 * Date: 2014-10-19
 * Time: 11:13
 */
class Divante_CodFee_Model_Total extends Mage_Sales_Model_Quote_Address_Total_Shipping
{
    /**
     * Collect totals information about shipping
     *
     * @param   Mage_Sales_Model_Quote_Address $address
     * @return  Mage_Sales_Model_Quote_Address_Total_Shipping
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        $this->_setAddress($address);
        $collection = $address->getQuote()->getPaymentsCollection();

        if ($collection->count() <= 0 || $address->getQuote()->getPayment()->getMethod() == null) {
            return $this;
        }

        $paymentMethod = $address->getQuote()->getPayment()->getMethodInstance();

        if ($paymentMethod->getCode() != 'cashondelivery') {
            return $this;
        }

        $method = $address->getShippingMethod();

        if ($method) {
            foreach ($address->getAllShippingRates() as $rate) {
                if ($rate->getCode()==$method) {
                    $amountPrice = $address->getQuote()->getStore()->convertPrice($rate->getPrice(), false);
                    $this->_setAmount($amountPrice);
                    $this->_setBaseAmount($rate->getPrice());
                    $shippingDescription = $rate->getCarrierTitle() . ' - ' . $rate->getMethodTitle();
                    $address->setShippingDescription(trim($shippingDescription, ' -'));

                    /** COD FEE */
                    if(!$address->getFreeShipping()){
                        $carrier = explode('_', $method);
                        $codFee = Mage::getModel('divante_codfee/fee')->load($carrier[0]);

                        if($fee = $codFee->getFee()) {
                            $address->setShippingAmount($address->getShippingAmount() + $fee);
                        }
                    }

                    break;
                }
            }
        }


        return $this;
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        return $this;
    }
}