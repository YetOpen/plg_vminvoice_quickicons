<?php
/**
 * VMInvoice QuickIcon Plugin
 *
 * @copyright (C) 2014 YetOpen S.r.l. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.yetopen.it
 **/
defined ( '_JEXEC' ) or die ();

/**
 * Class plgQuickiconVminvoice
 */
class plgQuickiconVminvoice extends JPlugin {

	public function __construct(& $subject, $config) {
		parent::__construct ( $subject, $config );

		$this->loadLanguage('plg_quickicon_vminvoice.sys');
		$this->loadLanguage('com_vminvoice.sys');
	}

	/**
	 * Display VMInvoice backend icon in Joomla 2.5+
	 *
	 * @param string $context
	 * @return array|null
	 */
	public function onGetIcons($context) {
		if ($context != $this->params->get('context', 'mod_quickicon') || !JFactory::getUser()->authorise('core.manage', 'com_vminvoice')) {
			return null;
		}

		$useIcons = version_compare(JVERSION, '3.0', '>');;

		return array( 
            array(
                'link' => JRoute::_("index.php?option=com_vminvoice&controller=invoices&task=addOrder"),
                'image' => $useIcons ? "add" : "header/icon-48-article-add.png",
                'text' => JText::_('COM_VMINVOICE_CREATE_NEW_ORDER'),
                'access' => array('com_vminvoice'),
                'id' => 'com_vminvoice_neworder_icon' 
            ),
            array(
                'link' => JRoute::_("index.php?option=com_vminvoice&controller=invoices"),
                'image' => $useIcons ? "article" : "header/icon-48-article.png",
                'text' => JText::_('COM_VMINVOICE_INVOICE_ORDER_MANAGEMENT'),
                'access' => array('core.manage', 'com_vminvoice'),
                'id' => 'com_vminvoice_orderlist_icon' 
            ),
        );
	}
}
