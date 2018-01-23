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

    <div class="joms-blankslate"><?php echo 'Waiting For Your Response' ?></div>
 <?php if ($schedule) {  ?>   
    <ul class="joms-list--event">
    	<div class="joms-media__body">
    <?php foreach ($schedule as $row) { ?>
    	<?php 
        $gsid=$row->gsid;
        //group schedule
        $gsModel = CFactory::getModel('groupschedule');
        $gsData = $gsModel->getScheduleDetails($gsid);
        //echo $gsData->needCount . " - " . $gsModel->getGroupScheduleAcceptedCount($gsid);
        if ((trim($gsData->needCount) == "") || ($gsData->needCount > $gsModel->getGroupScheduleAcceptedCount($gsid))) {
        ?>
            <small style="font-weight:bold"><a class="joms-button--link" href="<?php echo CRoute::_('index.php?option=com_community&view=groupschedule&gsid='.$gsid); ?>"><?php echo $gsData->CourseName; ?></a></small>
            <br />
        <?php } 
        
    } ?>
    </div>
</ul>
<small><a class="joms-button--link" href="<?php echo CRoute::_('index.php?option=com_community&view=groupschedule&task=recresponse'); ?>"><?php echo 'Show All'; ?></a></small>
<?php } else { ?>
    <small>Nothing Waiting For Your Response</small>
    <br /><br />
<?php } ?>

   <div class="joms-blankslate"><?php echo 'Your Upcoming Events' ?></div>

    <?php if ($useraccept) {  ?>   
    
    <ul class="joms-list--event">
    	<div class="joms-media__body">
    <?php foreach ($useraccept as $row) { ?>
    	<?php 
            $gsid=$row->id;
            //group schedule
            $gsModel = CFactory::getModel('groupschedule');
            $gsData = $gsModel->getScheduleDetails($gsid);
            //print_r($gsData);
            ?>
            
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
                    	<small style="height:15px; font-weight:bold"><?php echo $gsData->teetime; ?> - <a class="joms-button--link" href="<?php echo CRoute::_('index.php?option=com_community&view=groupschedule&gsid='.$gsid.'&did='.$rowdate->id); ?>"><?php echo $gsData->CourseName; ?></a></small>
                        <br />
              	<?php } ?>
           <?php } ?>
            
    <?php } ?>
    </div>
</ul>
   <small><a class="joms-button--link" href="<?php echo CRoute::_('index.php?option=com_community&view=groupschedule&Itemid=131'); ?>"><?php echo 'Show All'; ?></a></small>
<?php } else { ?>
    <small>You have nothing upcoming</small>
    <br /><br />
<?php } ?>

<?php  ?>
<div class="joms-blankslate"><?php echo 'You Might Be Interested' ?></div>
	<?php if ($mightbeschedule) {  ?>   
        <ul class="joms-list--event">
        	<div class="joms-media__body">
        <?php foreach ($mightbeschedule as $row) { ?>
            <?php 
                $gsid=$row->id;
                //group schedule
                $gsModel = CFactory::getModel('findgolfers');
                $gsData = $gsModel->getScheduleDetails($gsid);
                ?>
                
                    <small style="height:15px; font-weight:bold"><a class="joms-button--link" href="<?php echo CRoute::_('index.php?option=com_community&view=findgolfers&task=recresponse&gsid='.$gsid); ?>"><?php echo $gsData->CourseName; ?></a></small>
                    <br />
                
        <?php } ?>
        </div>
    </ul>
<small><a class="joms-button--link" href="<?php echo CRoute::_('index.php?option=com_community&view=findgolfers&task=recresponse&Itemid=101'); ?>"><?php echo 'Show All'; ?></a></small>
    <?php } else { ?>
        <small>Your List Is Currently Empty</small>
        <br /><br />
    <?php } ?>
    <?php /* ?><small><a class="joms-button--link" href="<?php echo CRoute::_('index.php?option=com_community&view=findgolfers&task=closerequest'); ?>"><?php echo 'Show All'; ?></a></small><?php */ ?>
<?php  ?>

    <div class="joms-blankslate"><?php echo 'Your Pending Events' ?></div>
 <?php if ($pending) {  
     $cnt = 0; ?>   
    <ul class="joms-list--event">
    	<div class="joms-media__body">
    
    <?php foreach ($pending as $row) { ?>
    	<?php 
            $gsid=$row->gsid;
            //print_r($row);
            //echo "gsid: " . $row->gsid;
            //group schedule
            //$gsModel = CFactory::getModel('groupschedule');
            //$gsData = $gsModel->getScheduleDetails($gsid);
            //echo $gsdata;
            if (strtotime($row->sdate) >= time()) {
                ++$cnt;
            ?>
            <small style="font-weight:bold"><?php echo $row->sdate . "-" . $row->Name; ?></small>
            <!--// <a class="joms-button--link" href="<?php //echo CRoute::_('index.php?option=com_community&view=groupschedule&gsid='.$gsid); ?>"> -->
            <br />
    <?php   } //else { echo "removed because date is old<br>"; }
        
        
            }
        if ($cnt == 0) { ?>
            <small>No Pending Events</small>
        <?php }?>
    </div>
</ul>
<small><a class="joms-button--link" href="<?php echo CRoute::_('index.php?option=com_community&view=groupschedule&task=recresponse'); ?>"><?php echo 'Show All'; ?></a></small>
<?php } else { ?>
    <small>No Pending Events</small>
<?php } ?>
   
   