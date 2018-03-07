<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/**
 * superiframe renderer
 *
 * @package    block_superiframe
 * @copyright  HRDNZ: MoodleBites for Developers Level 1 by Justin Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_superiframe_renderer extends plugin_renderer_base {
    /**
     * Function to return all the content that goes in the block
     */
    function fetch_block_content() {
        global $CFG,$USER;
        
        $content = '';
        $content .= '<br />' 
                 . get_string('welcomeuser','block_superiframe',$USER) . '<br />';
        
        // Add the link to the view page
        $link = new moodle_url('/blocks/superiframe/view.php');
        $content .= html_writer::link($link, get_string('gotosuperiframe', 'block_superiframe'));
        return $content;
    }
    //Here we aggregate all the pieces of content of the view page and display them
    function display_view_page($url, $width, $height) {
		// PERSONNALISATION
		global $CFG,$USER;
        // start output to browser
        echo $this->output->header();        
        
        // page heading
        echo $this->output->heading(get_string('pluginname', 'block_superiframe'), 3);
		
		// PERSONNALISATION
		echo '<br> Nom utilisateur : '. fullname($USER);
		echo '<br>' . $this->output->user_picture($USER).'<br>';
		
		// WEEK 5 task 2
		// add the links to specify irame size
		echo $this->fetch_size_links();
		
		// prepare our rame
		$iframe_atts = array();
		$iframe_atts['src']=$url;
		$iframe_atts['height']=$height;
		$iframe_atts['width']=$width;
		$iframe_atts['class']='block_superiframe_iframe';
		$iframe = html_writer::tag('iframe', '', $iframe_atts);
		echo '<br>'.$iframe;
		// FIN WEEK 5 TASK 2
		
		/*
		echo '<div class="block_superiframe_sizes"> 
			<a class="block_superiframe_size_custom" href="'.$CFG->wwwroot.'/blocks/superiframe/view.php?size=custom"> Personnalisé </a>
			<a class="block_superiframe_size_small" href="'.$CFG->wwwroot.'/blocks/superiframe/view.php?size=small"> Petit </a>  
			<a class="block_superiframe_size_medium" href="'.$CFG->wwwroot.'/blocks/superiframe/view.php?size=medium"> Moyen </a> 
			<a class ="block_superiframe_size_big" href ="'.$CFG->wwwroot.'/blocks/superiframe/view.php?size=big"> Grand </a> 
			</ div>';
		*/
		
		// retrait week 5 task 2
        // Build the iframe
        //$attributes = array('src'=>$url, 'width'=>$width, 'height'=>$height);
        //echo html_writer::start_tag('iframe', $attributes);
        //echo html_writer::end_tag('iframe');
 
       //send footer out to browser - don't forget!!
       echo $this->output->footer();
    
    }
	
	function fetch_size_links() {
		
		$customlink = new moodle_url('/blocks/superiframe/view.php', array('size'=>'custom'));
		$smalllink = new moodle_url('/blocks/superiframe/view.php', array('size'=>'small'));
		$mediumlink = new moodle_url('/blocks/superiframe/view.php', array('size'=>'medium'));
		$biglink = new moodle_url('/blocks/superiframe/view.php', array('size'=>'big'));
		
		$links = array();
		
		$links[] = html_writer::link($customlink, get_string('custom', 'block_superiframe'), array('class'=>'block_superiframe_size_custom'));
		$links[] = html_writer::link($smalllink, get_string('small', 'block_superiframe'), array('class'=>'block_superiframe_size_small'));
		$links[] = html_writer::link($mediumlink, get_string('medium', 'block_superiframe'), array('class'=>'block_superiframe_size_medium'));
		$links[] = html_writer::link($biglink, get_string('big', 'block_superiframe'), array('class'=>'block_superiframe_size_big'));
		
		/*
		$links[] = html_writer::link($customlink, get_string('custom', 'block_superiframe'), array('class'=>'block_superiframe_sizes'));
		$links[] = html_writer::link($smalllink, get_string('small', 'block_superiframe'), array('class'=>'block_superiframe_sizes'));
		$links[] = html_writer::link($mediumlink, get_string('medium', 'block_superiframe'), array('class'=>'block_superiframe_sizes'));
		$links[] = html_writer::link($biglink, get_string('big', 'block_superiframe'), array('class'=>'block_superiframe_sizes'));
		*/
		return html_writer::div(implode(' ',$links), 'block_superiframe_sizes');
	}
	
}