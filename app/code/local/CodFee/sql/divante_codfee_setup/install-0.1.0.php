<?php
/**
 * Created by PhpStorm.
 * User: Marek Kidon
 * Date: 2014-10-19
 * Time: 11:20
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
    CREATE  TABLE IF NOT EXISTS {$this->getTable('divante_codfee/fee')} (
      `carrier` VARCHAR(255) NOT NULL ,
      `fee` DECIMAL(12,4) NULL ,
      PRIMARY KEY (`carrier`) )
    ENGINE = InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();

$installer->endSetup();