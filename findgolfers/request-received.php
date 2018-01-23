<?php
//GWMFile
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
defined('_JEXEC') or die();
?>

<div class="joms-page">
    <div class="joms-list__search">
        <div class="joms-list__search-title">
            <h3 class="joms-page__title"><?php echo 'You might be interested'; ?></h3>
        </div>
    </div>

    <?php echo $submenu;?>

    <div class="joms-gap"></div>

    <div class="joms-tab__content">
    	

    <?php if ( $rows ) { ?>
    		<ul class="joms-list--friend">
            <?php foreach ( $rows as $row ) { ?>
            <?php 
				$gsid=$row->id;
				//group schedule
				$gsModel = CFactory::getModel('findgolfers');
                $gsData = $gsModel->getFindGolfers($gsid);
				//user request
				$usr = CFactory::getUser($gsData->uid);
				//print_r($usr);
				//course
				$course = $gsModel->getCourseDetails($gsData->selcourse);
			?>
            <li class="joms-list__item">
            	<form name="jsform-group-schedule" id="frmGroupSchedule" action="<?php echo CRoute::_('index.php?option=com_community&view=findgolfers&task=recresponse') ?>" method="POST" class="js-form" onsubmit="return checkcourse();">
					<div class="joms-ribbon__wrapper">
                    	<span class="joms-ribbon">Open Request</span>
                    </div>
                    <div class="joms-list__avatar" style="width:100%; padding-left:37px;">
                    	<span><?php echo $usr->name; ?>, is looking for someone to golf with at <?php echo $course->Name; ?>. If you are interested, select the dates you are available below</span>
                        <br /><br />
                    </div>
                    <?php
					$scheduleDate = $gsModel->getFindGolfersDate($gsid);
					foreach ( $scheduleDate as $rowdate ) {
					?>
                    <div class="joms-list" style="font-size:11px; font-style:normal; width:32%; float:left; text-align:center; margin:1px; background-color:#DFF5F7;">
                        <label><?php echo $rowdate->sdate; ?> <br />
                        <input type="checkbox" name="seldate[]" value="<?php echo $rowdate->id; ?>" id="typesea"  />
                        </label>
                    </div>
                    <?php } ?>
                    
                    <div class="joms-list__actions">
                        <div class="joms-list__button--dropdown">
                        <input type="hidden" name="reqid" value="<?php echo $gsid; ?>" />
                        <input type="hidden" name="gsid" value="<?php echo $gsid; ?>" />
                        <input type="hidden" name="stepset" value="submitresponse" />
                        <input type="button" onclick="window.location='<?php echo CRoute::_('index.php?option=com_community&view=findgolfers&task=recresponse&stepset=cancel&reqid='.$gsid); ?>';" class="joms-button--neutral joms-button--full-small joms-button--smallest" value="<?php echo "Not Available";?>">&nbsp;
                        <input type="submit" class="joms-button--primary joms-button--full-small joms-button--smallest" value="<?php echo "Save";?>">
                        </div>
                    </div>
            	</form>
        	</li>
            
            <?php } ?>
            </ul>

    <?php } else { ?>
        <div class="cEmpty cAlert"><?php echo 'You have no pending response.'; ?></div>
    <?php } ?>
    </div>
</div>





