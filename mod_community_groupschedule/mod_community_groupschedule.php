<?php
//GWMFile
/**
* @copyright (C) 2015 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/

    defined('_JEXEC') or die('Restricted access');

    // Check if JomSocial core file exists
    $corefile   = JPATH_ROOT . '/components/com_community/libraries/core.php';

    jimport( 'joomla.filesystem.file' );
    if( !JFile::exists( $corefile ) )
    {
        return;
    }

    // Include JomSocial's Core file, helpers, settings...
    require_once( $corefile );
    require_once dirname(__FILE__) . '/helper.php';
    
    JFactory::getLanguage()->isRTL() ? CTemplate::addStylesheet('style.rtl') : CTemplate::addStylesheet('style');

    $userid = null; // null by default
    //1 = my events
    $userid = CFactory::getUser()->id;

    $groupsModel = CFactory::getModel('groupschedule');
    /* Follow component */
    
    //Waiting For Your Response
    $schedule = $groupsModel->getPendingSchedule($userid);

    //Your Upcoming
    $useraccept = $groupsModel->getGroupScheduleAcceptList($userid);

    //You Might Be Interested
    $findModel = CFactory::getModel('findgolfers');
    //$mightbeschedule = $groupsModel->getGroupScheduleList($userid);
    $mightbeschedule = $findModel->getFindGolfersListMight($userid);
    
    //Pending Events
    $pending = $groupsModel->getGroupSchedulePendingList($userid);

    require(JModuleHelper::getLayoutPath('mod_community_groupschedule', $params->get('layout', 'default')));
