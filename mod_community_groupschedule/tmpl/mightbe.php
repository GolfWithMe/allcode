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
defined('_JEXEC') or die();
?>
    <div class="joms-blankslate"><?php echo 'You Might Be Interested' ?></div>
	<?php if ($mightbeschedule) {  ?>   
        <ul class="joms-list--event">
        <?php foreach ($mightbeschedule as $row) { ?>
            <?php 
                $gsid=$row->id;
                //group schedule
                $gsModel = CFactory::getModel('groupschedule');
                $gsData = $gsModel->getGroupSchedule($gsid);
                //user request
                $usr = CFactory::getUser($gsData->uid);				
                //course
				$courseid=$gsData->selcourse;
                $courseMb = $gsModel->getCourseDetails($courseid);
                ?>
            <li class="joms-media--event">
                <div class="joms-media__body">
                    <small style="height:15px; font-weight:bold">&raquo; <?php echo $courseMb->Name; ?></small>
                </div>
            </li>
        <?php } ?>
    </ul>
    <?php } else { ?>
        <small>Not Avaialable</small>
    <?php } ?>
    <small><a class="joms-button--link" href="<?php echo CRoute::_('index.php?option=com_community&view=groupschedule&task=closerequest'); ?>"><?php echo 'Show All'; ?></a></small>

