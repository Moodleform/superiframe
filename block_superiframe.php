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
 * superiframe block caps.
 *
 * @package    block_superiframe
 * @copyright  Daniel Neis <danielneis@gmail.com>
 * Modified for use in MoodleBites for Developers Level 1 by Richard Jones & Justin Hunt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/*

Notice some rules that will keep plugin approvers happy when you want
to register your plugin in the plugins database

    Use 4 spaces to indent, no tabs
    Use 8 spaces for continuation lines
    Make sure every class has php doc to describe it
    Describe the parameters of each class and function

    https://docs.moodle.org/dev/Coding_style

*/

/**
 *  Class superiframe - note the frankenstyle convention component_name
 *  You will see it a lot.
 *
 */

class block_superiframe extends block_base {
 
    /**
     *  Initialise the block
     */    
    function init() {
        $this->title = get_string('pluginname', 'block_superiframe');
    }
    /**
     * Add some text content to our block
     */
    function get_content() {
		// modif Cécile
        global $CFG, $OUTPUT, $USER;

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';
        $this->content->text = '';
  
        // block should be on course page
        $currentcontext = $this->page->context->get_course_context(false);

        if (empty($currentcontext)) {
            return $this->content;
        }
        
        // Block could be on front page
        if ($this->page->course->id == SITEID) {
            $this->content->text .= "site context <br >";
        }
        // Check the block config string
        if (! empty($this->config->text)) {
            $this->content->text .= $this->config->text;
        }

		// modif Cécile
		$this->content->text .= '<br />'.get_string('welcomeuser','block_superiframe',$USER);
		// ajout week 4
		$this->content->text .= '<br /><a href="' . $CFG->wwwroot . '/blocks/superiframe/view.php">' . get_string('gotosuperiframe', 'block_superiframe') . '</a>';
		
        return $this->content;
    }

    /**
     * This is a list of places where the block may or may not be added by the admin
     */
    public function applicable_formats() {
        return array('all' => false,
                     'site' => true,
                     'site-index' => true,
                     'course-view' => true, 
                     'course-view-social' => false,
                     'mod' => true, 
                     'mod-quiz' => false);
    }

    /**
     * Can we have more than one instance of the block?
     */
    public function instance_allow_multiple() {
          return true;
    }
    /**
     * This block has a config section
     */
    function has_config() {return true;}

}
