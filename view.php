<?php

require('../../config.php');
require_once('../../lib/moodlelib.php');

require_login();

//get our config
$def_config = get_config('block_superiframe');

// week4 recupération source, largeur et hauteur
$src = $def_config->url;
$wdh = $def_config->width;
$hgh = $def_config->height;

$usercontext = context_user::instance($USER->id);
$PAGE->set_course($COURSE);
$PAGE->set_url('/blocks/superiframe/view.php');
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('course');
$PAGE->set_title(get_string('pluginname', 'block_superiframe'));
$PAGE->navbar->add(get_string('pluginname', 'block_superiframe'));


// start output to browser
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'block_superiframe'),5);

echo '<br>' . fullname($USER);
//echo '<br>' . $USER->id. '<br><br>';
//echo '<br>' . $USER->username. '<br><br>';
//echo '<br>' . $USER->firstname. '<br><br>';
//echo '<br>' . $USER->lastname. '<br><br>';
//echo '<br>' . $USER->picture. '<br><br>';

// TEST CECILE echo '<a href="'. $CFG->wwwroot .'/pluginfile.php/5/user/icon/boost/f2?rev='.$USER->picture.'" id="userpicture_randomid"><br> <img src="'. $CFG->wwwroot .'/pluginfile.php/5/user/icon/boost/f2?rev='. $USER->picture .'" alt="Photo Profil" title="Photo Profil" class="userpicture" /></a>'; 

echo '<br>' . $OUTPUT->user_picture($USER).'<br>';

// echo '<iframe src="https://quizlet.com/132695231/scatter/embed" height="410" width="100%" style="border:0"></iframe>';
// récupération des paramètres saisis dans admin
echo '<iframe src="'.$src.'" height="'.$hgh.'" width="'.$wdh.'" style="border:0"></iframe>';

/*
<a href="#" id="userpicture_randomid">
    <img src="#" alt="Picture of Joe" title="Picture of Joe" class="userpicture" width="[35, 100, XX]" height="[35, 100, XX]" />
</a>
*/

//echo '<br>' . print_object($USER). '<br><br>';

// Some content goes here
//echo "I am some dummy content. Get rid of me fast!";	

//send footer out to browser
echo $OUTPUT->footer();
return;