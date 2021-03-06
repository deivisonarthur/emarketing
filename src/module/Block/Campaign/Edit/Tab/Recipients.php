<?php
/**
 * Mzax Emarketing (www.mzax.de)
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this Extension in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * 
 * @version     {{version}}
 * @category    Mzax
 * @package     Mzax_Emarketing
 * @author      Jacob Siefer (jacob@mzax.de)
 * @copyright   Copyright (c) 2015 Jacob Siefer
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


class Mzax_Emarketing_Block_Campaign_Edit_Tab_Recipients extends Mage_Adminhtml_Block_Template
{

    /**
     * @var Mzax_Emarketing_Model_Campaign
     */
    protected $_campaign;

    
    /**
     * @var Mzax_Emarketing_Block_Campaign_Edit_Tab_Recipients_Grid
     */
    protected $_grid;
    
    
    
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('mzax/emarketing/campaign/recipients.phtml');
    }
    
    
    
    protected function _prepareLayout()
    {
        $grid = $this->getLayout()->createBlock('mzax_emarketing/campaign_edit_tab_recipients_grid');

        $emulate = $this->getLayout()->createBlock('mzax_emarketing/campaign_test_emulate');
        $emulate->setTemplate('mzax/emarketing/campaign/filters/emulate.phtml');
        $emulate->setGrid($grid);

        $this->setChild('emulate', $emulate);
        $this->setChild('grid', $grid);
    }
    
    
    
    
    public function prepareEmulation(Mzax_Emarketing_Model_Object_Filter_Abstract $filter)
    {
        $child = $this->getChild('emulate');
        if($child && method_exists($child, 'prepareEmulation')) {
            $child->prepareEmulation($filter);
        }
    }
        
        
    
    /**
     * Retrieve grid
     * 
     * @return Mzax_Emarketing_Block_Campaign_Edit_Tab_Recipients_Grid
     */
    public function getGrid()
    {
        return $this->getChild('grid');
    }
    
    
    
    
    
    /**
     * 
     * @return Mzax_Emarketing_Model_Campaign
     */
    public function getCampaign()
    {
        if(!$this->_campaign) {
            $this->_campaign = Mage::registry('current_campaign');
        }
        return $this->_campaign;
    }
    


    protected function _toHtml()
    {
        if($this->getRequest()->getParam('emulate')) {
            return $this->getGrid()->toHtml();
        }
        return parent::_toHtml();
    }


}
