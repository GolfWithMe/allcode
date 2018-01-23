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

    <div class="joms-blankslate"><?php echo 'Your Upcoming' ?></div>

    <?php if ($useraccept) {  ?>   
    
    <ul class="joms-list--event">
    <?php foreach ($useraccept as $row) { ?>
    	<?php 
			$gsid=$row->id;
			//group schedule
			$gsModel = CFactory::getModel('groupschedule');
			$gsData = $gsModel->getGroupSchedule($gsid);
			//user request
			$usr = CFactory::getUser($gsData->uid);
			//print_r($usr);
			//course
			$course = $gsModel->getCourseDetails($gsData->selcourse);
			?>
        <li class="joms-media--event">
            <div class="joms-media__body">
            <?php
				$accbutton=0;
				$scheduleDate = $gsModel->getGroupScheduleDate($gsid);
				foreach ( $scheduleDate as $rowdate ) {
					//members request sent
					//$smem= $gsModel->getGroupScheduleMemberCount($gsid);
					//$accmem= $gsModel->getGroupScheduleAcceptCount($gsid,$rowdate->id,2);
					//$acctotmem= $gsModel->getGroupScheduleAcceptCount($gsid,$rowdate->id);
					$accda= $gsModel->getDateAcceptCount($gsid,$rowdate->id);
					
					if($accda->actmem>0) { 
					?>
                    	<small style="height:15px; font-weight:bold">&raquo; <?php echo $rowdate->sdate; ?> - <?php echo $course->Name; ?></small>
              	<?php } ?>
           <?php } ?>
            </div>
        </li>
    <?php } ?>
</ul>
<?php } else { ?>
    <small>Not Avaialable</small>
<?php } ?>