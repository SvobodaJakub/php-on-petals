<?php

# University of Illinois/NCSA Open Source License
# 
# Copyright (c) 2017, Jakub Svoboda.  All rights reserved.
# 
# Developed by: Jakub Svoboda
#               https://github.com/SvobodaJakub
# 
# Permission is hereby granted, free of charge, to any person obtaining a copy of
# this software and associated documentation files (the "Software"), to deal with
# the Software without restriction, including without limitation the rights to
# use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
# of the Software, and to permit persons to whom the Software is furnished to do
# so, subject to the following conditions:
# 
#     Redistributions of source code must retain the above copyright notice, this
#     list of conditions and the following disclaimers.
# 
#     Redistributions in binary form must reproduce the above copyright notice,
#     this list of conditions and the following disclaimers in the documentation
#     and/or other materials provided with the distribution.
# 
#     Neither the names of "SvobodaJakub", "Jakub Svoboda", nor the names of its
#     contributors may be used to endorse or promote products derived from this
#     Software without specific prior written permission.
# 
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.  IN NO EVENT SHALL THE
# CONTRIBUTORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS WITH THE
# SOFTWARE.
# 
# 
# 
# License Notices For Incorporated Pieces Of Code
# ===============================================
# 
# Please read the licenses in the source code of the respective components.
# 


# NOTE: Before deployment, go through the code and act on all TODO comments.
# NOTE: Before deployment, go through all the global strings at the beginning of this file and change/translate them.

# show all errors during development
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
# TODO - after testing it thoroughly and making sure there are no errors and warnings, disable error reporting so that no internal details are leaked
# suppress all errors in production
# error_reporting(0);  # <-- TODO uncomment this line to disable error reporting


# TODO - dependencies necessary for the website to function
# How to get dependencies
# get uikit 2 from https://github.com/uikit/uikit/releases/download/v2.27.4-src/uikit-2.27.4.zip and unpack so that it is in directory "uikit"
# get clippy.js from https://github.com/smore-inc/clippy.js and unpack so that it is in directory "clippy.js"
# get jquery from https://code.jquery.com/jquery-3.2.1.min.js
# get galleria from https://galleria.io/static/galleria-1.5.7.zip

# How to get dependencies (through command line)
# wget https://github.com/uikit/uikit/releases/download/v2.27.4-src/uikit-2.27.4.zip && mkdir uikit && cd uikit && unzip ../uikit-2.27.4.zip
# git clone https://github.com/smore-inc/clippy.js.git
# wget https://code.jquery.com/jquery-3.2.1.min.js
# wget https://galleria.io/static/galleria-1.5.7.zip && unzip galleria-1.5.7.zip
#  - if that fails, available from https://github.com/worseisbetter/galleria/releases/tag/1.5.7 in the directory "dist" but with a bit different filenames
#  - what you need is the following directory structure inside the "galleria" folder:
#     ── galleria
#        ├── galleria-1.5.7.js
#        ├── galleria-1.5.7.min.js
#        ├── plugins
#        │   ├── flickr
#        │   │   ├── flickr-demo.html
#        │   │   ├── flickr-loader.gif
#        │   │   ├── galleria.flickr.js
#        │   │   ├── galleria.flickr.min.js
#        │   │   └── loader.gif
#        │   ├── history
#        │   │   ├── galleria.history.js
#        │   │   ├── galleria.history.min.js
#        │   │   └── history-demo.html
#        │   └── picasa
#        │       ├── galleria.picasa.js
#        │       ├── galleria.picasa.min.js
#        │       ├── loader.gif
#        │       └── picasa-demo.html
#        └── themes
#            ├── classic
#            │   ├── classic-demo-cdn.html
#            │   ├── classic-demo.html
#            │   ├── classic-loader.gif
#            │   ├── classic-map.png
#            │   ├── galleria.classic.css
#            │   ├── galleria.classic.js
#            │   ├── galleria.classic.min.css
#            │   └── galleria.classic.min.js
#            └── fullscreen
#                ├── b.png
#                ├── down.gif
#                ├── down-neg.gif
#                ├── fix.gif
#                ├── fullscreen-demo-cdn.html
#                ├── fullscreen-demo.html
#                ├── galleria.fullscreen.css
#                ├── galleria.fullscreen.js
#                ├── galleria.fullscreen.min.css
#                ├── galleria.fullscreen.min.js
#                ├── index.html
#                ├── i.png
#                ├── l.gif
#                ├── l-neg.png
#                ├── loader.gif
#                ├── n.gif
#                ├── n-neg.png
#                ├── p.gif
#                ├── p-neg.png
#                ├── r.gif
#                ├── r-neg.png
#                ├── up.gif
#                └── up-neg.gif




# After that, edit clippy's behavior:
# find clippy.js/agents/Clippy/agent.js
# find 
#  "branching": {"branches": [{"frameIndex": 15, "weight": 33
# replace with
#  "branching": {"branches": [{"frameIndex": 15, "weight": 99
# This will make clippy create an asterisk 99% of the time for the action Wave (which is what we need on this web page when an error happens)


# NOTE: the txt files with titles and description are trusted and can contain html that is rendered verbatim (only newlines are replaced with <p></p>)
# NOTE: the txt files with main page content are trusted, should contain html fragments, are rendered verbatim

# The directory in which all the txt and jpg files reside. The name should be random so that it is effectively inaccessible on free hostings and it should never be leaked to the user (hence loading jpg files through data uri).
# TODO: randomize the name
# TODO: create and fill the directory during deployment
# TODO & NOTE: Make a note that here will appear '-booked.txt' files with the email address of the person who books an item and optionally also '-booked-note.txt' files if the person also writes a note. Your wedding coordinator should check these files and answer people's questions.
$BASE_DATA_PATH = "files-balletic-tuber";

# The directory in which wedding photos reside. If the directory is empty, a gift list is displayed, if there is at least one photo, the gallery is displayed instead. This directory should always exist. The name should be random so that it is effectively inaccessible on free hostings and it should never be leaked to the user.
# Note: the subdirectories must each contain a file "license.txt" that contains the text that will be displayed on the photo. Subdirectories without this file will be skipped silently.
# TODO: randomize the name
# TODO: create the directory during deployment
# TODO: create subdirectories with photos and license.txt once you want to swtich the website into a gallery
$BASE_PHOTOS_PATH = "photos-melodizing-shoves";
# The directory structure should look like this (the important thing is that there are subfolders (allowing you to order groups of photos into a linear order) and each subfolder MUST contain the license.txt file):
# .
# ├── 010
# │   ├── license.txt
# │   └── DSC_8688.jpg
# ├── 020
# │   ├── license.txt
# │   ├── DSC_8660.jpg
# │   ├── DSC_8662.jpg
# │   ├── DSC_3034.jpg
# │   └── DSC_3037.jpg
# └── 030
#     ├── license.txt
#     ├── DSC_8381.jpg
#     ├── DSC_8649.jpg
#     ├── DSC_8655.jpg
#     └── DSC_8656.jpg
# 

# The directory in which html fragments with content for the main page after login reside. The name should be random so that it is effectively inaccessible on free hostings.
# TODO - if you dont want to source main page content from text files, then put your content here and also search for this line:
#    `# TODO: if you do not want to source main content from separate files, delete the following 6 lines of code`
# TODO: randomize the name
# TODO: create and fill the directory during deployment
$BASE_MAIN_CONTENT_PATH = "main-content-fleet-foot-piggy";


# TODO: change the names of the newlyweds before deployment
# needs the login to be valid - either name1 and name2 being the right values or the cookie saying it is OK
# note: "/bill|william|willy/i" will also automatically match William, WILLIAM, william, Willy, xxxxbillxxxx, William Doe, and so on
#       it basically means "match anything inside which is 'bill' or 'william' or 'willy' and don't care about case sensitivity"
$LOGIN_NAME_1_REGEX = "/bill|william|willy/i";
$LOGIN_NAME_2_REGEX = "/jane|jenny/i";

# Translatable strings

# Frontpage
$NAVBAR_FRONTPAGE = "úvod";

# Main contents
$NAVBAR_MAIN = "hlavní obsah";

# Contacts
$NAVBAR_CONTACTS = "kontakty";

# Given name of one of the newlyweds
$LOGIN_GIVEN_NAME_OF_ONE_OF_THE_NEWLYWEDS = "křestní jméno jednoho ze snoubenců";

# Given name of another one of the newlyweds
$LOGIN_GIVEN_NAME_OF_ANOTHER_OF_THE_NEWLYWEDS = "křestní jméno druhého ze snoubenců";

# Enter the given names of the newlyweds:
$LOGIN_ENTER_NAMES = "Zadej křestní jména snoubenců:";

# Continue
$LOGIN_CONTINUE = "Jít dál";

# Wedding gifts
$MAIN_PAGE_PART_2_HEADING_GIFT_LIST = '
TODO - if you dont want to source main page content from text files, then put your content here and also search for this line:
    `# TODO: if you do not want to source main content from separate files, delete the following 6 lines of code`
';

# TODO add your html that is displayed above the list of wedding gifts
$MAIN_PAGE_PART_1_CONTENT_HTML_FRAGMENT = '
TODO - if you dont want to source main page content from text files, then put your content here and also search for this line:
    `# TODO: if you do not want to source main content from separate files, delete the following 6 lines of code`
';

# TODO add your html that is displayed between the wedding gift list heading and the list
$MAIN_PAGE_PART_2_CONTENT_AFTER_HEADING_BEFORE_GIFT_LIST_HTML_FRAGMENT = '
TODO - if you dont want to source main page content from text files, then put your content here and also search for this line:
    `# TODO: if you do not want to source main content from separate files, delete the following 6 lines of code`
';


# TODO add your html that is displayed after the wedding gift list and before the following heading
$MAIN_PAGE_PART_2_CONTENT_AFTER_GIFT_LIST_HTML_FRAGMENT = '
TODO - if you dont want to source main page content from text files, then put your content here and also search for this line:
    `# TODO: if you do not want to source main content from separate files, delete the following 6 lines of code`
';

# Wedding photos
$MAIN_PAGE_PART_3_TITLE = '
TODO - if you dont want to source main page content from text files, then put your content here and also search for this line:
    `# TODO: if you do not want to source main content from separate files, delete the following 6 lines of code`
';

# Wedding photos will appear there instead of the wedding gift list a week after the wedding.
# TODO & NOTE: After you upload photos, the whole web content after login is replaced by a gallery. (Also, search for `# Note: the subdirectories must each contain a file "license.txt"` to see further information how this works.)
$MAIN_PAGE_PART_3_CONTENT_HTML_FRAGMENT = '
TODO - if you dont want to source main page content from text files, then put your content here and also search for this line:
    `# TODO: if you do not want to source main content from separate files, delete the following 6 lines of code`
';

# Someone has already booked this item.
$GIFT_DETAIL_WARN_ALREADY_BOOKED = "Tento předmět si již někdo rezervoval. Otázky můžeš psát svatebnímu koordinátorovi XXXXXXXXXXXXXXXXXXXXXXXXXX.";

# You have already booked this item.
$GIFT_DETAIL_WARN_YOU_ALREADY_BOOKED = "Tento předmět byl tebou rezervován. Otázky můžeš psát svatebnímu koordinátorovi XXXXXXXXXXXXXXXXXXXXXXXXXX.";

# Your message to the wedding coordinator:
$GIFT_DETAIL_WARN_YOU_ALREADY_SAVED_NOTE = "Vzkaz svatebnímu koordinátorovi od tebe:";

# After the booking is confirmed, you will be presented a page where you can add your note. Or you can ask our wedding coordinator via email (TODO add email address). By booking the gift you want to give, you can prevent someone else from giving the same gift.
$GIFT_DETAIL_FORM_NOTE_YOU_CAN_BOOK = "Po rezervaci se zobrazí stránka, kde můžeš přidat svoji poznámku. Nebo můžeš dotazy a poznámky psát na email našeho svatebního koordinátora XXXXXXXXXXXXXXXXXXXXXXXX. Rezervací zajistíš, že dva různí lidé nedarují to samé.";

# Book the item
$GIFT_DETAIL_FORM_BUTTON_BOOK = "Zarezervovat";

# Email address
$GIFT_DETAIL_FORM_EMAIL_ADDR = "Emailová adresa";

# Give this gift
$GIFT_DETAIL_FIELDSET_LEGEND = "Darovat tento předmět";

# Booking in progress, please wait.
$GIFT_BOOKING_START_MSG = "Probíhá rezervace, počkej prosím.";

# If you want to add a note or to ask our wedding coordinator about something, please add your note here. The note can be saved only once and cannot be changed. Other website visitors will not see the note, only the wedding coordinator will see it. Or you can message our wedding coordinator directly (TODO add email address).
$BOOKED_GIFT_PLEASE_WRITE_MSG_NOTE = "Chceš-li dodat poznámku nebo se svatebního koordinátora na něco zeptat, můžeš to napsat sem. Poznámku můžeš zadat pouze jednou a nelze ji upravovat. Poznámku neuvidí ostatní návštěvníci webu, uvidí ji pouze svatební koordinátor. Nebo můžeš napsat svatebnímu koordinátorovi XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";

# Your note
$BOOKED_GIFT_PLEASE_WRITE_MSG_PLACEHOLDER = "Tvoje poznámka";

# Note
$BOOKED_GIFT_PLEASE_WRITE_MSG_FIELDSET_LEGEND = "Poznámka";

# Save
$BOOKED_GIFT_PLEASE_WRITE_MSG_SUBMIT = "Uložit";

# Booking successful.
$BOOKED_GIFT_PLEASE_WRITE_MSG_SUCCESS = "Rezervace úspěšná.";

# Someone else managed to book the item before you. The booking did not take place.
$BOOKING_RACE_SOMEONE_BOOKED_WHILE_YOU_VIEWED = "Někdo jiný si stihl předmět rezervovat před tebou. K rezervaci nedošlo.";

# Someone else clicked the button at the same moment as you. A collission occurred. The booking did not go through. Return and try again.
$BOOKING_RACE_CONDITION_PROPER = "Někdo jiný kliknul na tlačítko rezervovat ve stejné chvíli jako ty. Došlo ke kolizi. K rezervaci nedošlo. Vrať se zpět a zkus to znovu.";

# Return to the main page.
$LINK_HOMEPAGE = "Vrátit se na hlavní stránku.";

# Please return and enter your email address. The booking did not go through.
$BAD_EMAIL_NULL = "Je nutné zadat emailovou adresu. Zkus rezervaci znovu. K rezervaci nedošlo.";

# The entered email address is most probably not valid and we don't accept it. Please try the booking again. The booking did not go through.
$BAD_EMAIL_BAD = "Zadaná emailová adresa je nejspíš špatně a neakceptujeme ji. Zkus rezervaci znovu. K rezervaci nedošlo.";

# Proceed by clicking on the page.
$FRONT_PAGE_TEXT = 'Pokračuj kliknutím kamkoli :-)';

// # TODO replace by sth very simple
// $FRONT_PAGE_GRAPHIC = '
// <p><b>TODO - replace this HTML snippet with your front page graphic</b></p>
// '
# TODO <insert the html for the graphic of the front page here>
$FRONT_PAGE_GRAPHIC = '

    <div style="width: 100%; height: 100%;">"
        <div class="uk-vertical-align uk-text-center uk-width-1-3 uk-height-1-1" style="float: right; margin: 10%" >
            <div class="uk-vertical-align-middle" style="width: 40% ; max-width: 200px ; ">
                <form class="uk-panel uk-form " action="" >
                    <input type="hidden" name="action" value="login">
                    <input type="submit" class="uk-button uk-button-primary uk-button-large uk-width-1-1"  value="Jít dál">
                </form> 
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>

';


# In case you have questions or feedback, please write to our wedding coordinator. They will filter the information so that we don't know who wants to give us what and hence protects us from spoilers, yet provides the communication channel to e.g. determine which color of something we prefer. Thank you!
$CONTACTS_MSG_1 = 'Máte-li dotazy nebo připomínky ohledně svatebních darů, napište prosím našemu svatebnímu koordinátorovi XXXXXXX. Ten informace přefiltruje tak, abychom se nedozvěděli, kdo nám co dává, a částečně tak udržel překvapení a zprostředkoval komunikaci s námi např. o tom jakou barvu nebo typ něčeho preferujeme. Děkujeme!';

# TODO email address
$CONTACTS_MSG_2 = 'XXXXXXXX@XXXXXXXXX';

# If you want to message us directly, try (TODO add email address).
$CONTACTS_MSG_3 = 'Máte-li dotazy ohledně ubytování, harmonogramu svatby, atd., napište přímo nám na <b>XXXXXXXX@XXXXXXXXX</b> nebo <b>XXXXXXXXXX@XXXXXXXXX.</b>';


/**
 * Sets up session securely. Has to be the first thing executed on the page; definitely before any content.
 */
function secureSessionSetup()
{
    # The victim of the session fix attack loads the page with an existing (fixed) session but without the sess_fix_prevention cookie existing.
    # A new random cookie is generated and it cannot equal to the value in the session, hence the attack is detected and session restarted.
    # New session id is necessary in order to break the link between the attacker's and victim's sessions.
    # Deleting the session data is necessary to forbid the attacker from injecting any state into the victim's session.
    # This doesn't prevent the cookies to be copied but does prevent session fixation by setting the phpsessid GET parameter or cookie.

    # http://stackoverflow.com/questions/5081025/php-session-fixation-hijacking

    session_start();

    # nothing in there can print because we need to set the headers first
    if (!isset($_COOKIE["sess_fix_prevention"])) {
        # not set, set it to sha256(constant + ip addr + ua + pseudorandom number)
        # it doesn't have to be unpredictable - it is enough that it's not constant so that an attacker cannot fix the session through GET request (phpsess GET param)

        # despite the funny comments in this function, the reasoning behind the semi-random strings is that these strings are used to concatenate the individual components (address, user agent, etc) to prevent one component from pretending to be another (e.g. someone setting a user agent to contain a part of an ip address), to provide strings that can be changed for an individual website and thus increase the difficulty of guessing on the part of an attacker, and a semi-random number is appended to the end of the hashed data to make length-extension attacks on merkle-damgard construction more difficult; even those precautions are most probably unnecessary (see the previous comment)

        $constant = "propria-silvertop-zaffers-draperess-unaffixed";  # doesn't really matter, not necessary to be secret, it's just... cargo cult programming :D
        $ipaddr = $_SERVER["REMOTE_ADDR"];
        $ua = $_SERVER["HTTP_USER_AGENT"];
        $rndnum = rand(); # this is low-quality pseudorandom number, still good enough for this use
        $c = "xX-afternoon-wisure-burel-Xx"; # concatenation string, doesn't have to be secret
        $hash = hash('sha256', $constant . $c . $ipaddr . $c . $ua . $c . $rndnum);
        setcookie("sess_fix_prevention", $hash); # send in http headers
        $_COOKIE["sess_fix_prevention"] = $hash; # make it accessible immediately
    }
    # if $_SESSION["sess_fix_prevention"] is not set, set it to the same
    if (!isset($_SESSION["sess_fix_prevention"])) {
        # not set, set it to $_COOKIE["sess_fix_prevention"]
        $_SESSION["sess_fix_prevention"] = $_COOKIE["sess_fix_prevention"];

        # create a user-specific seed for generating hashed links
        # the seed is of no use if the user is not logged in
        # this (wedding) website is not high-profile enough so that someone would want to spoof predictable nonces and get logged-in users to unwittingly access links
        # so if the following constant is not secret, it is not a big problem
        # TODO change this string to a secret random value when deploying the web page
        $constant = "gladsomer-golland-apocarps-fenagled-unrake";
        $rndnum = rand(); # this is low-quality pseudorandom number, still good enough for this use
        $_SESSION["user_specific_link_rand_seed"] = hash('sha256', $constant . $_SESSION["sess_fix_prevention"] . $rndnum . $constant);
    }
    # if $_SESSION["sess_fix_prevention"] !== $_COOKIE["sess_fix_prevention"], the session has been fixed/attacked or cookies have been cleared, delete all data from session, set new sess_fix_prevention in both
    if ($_SESSION["sess_fix_prevention"] !== $_COOKIE["sess_fix_prevention"]) {
        secureSessionTeardown();
        refreshAndDie();
    }
    # only now can be other $_SESSION variables read (like authenticated bool, ...)
    # use session to save data
}


/**
 * Securely destroys session. Has to be executed before any content.
 */
function secureSessionTeardown()
{
    # destroys the session so that it is recreated next page load

    $_SESSION["logged_in"] = false;

    # shotgun programming
    session_regenerate_id(true);  # hopefully destroys the data in the session and the session id
    session_unset();  # hopefully destroys the data in the session if the above didn't work
    session_destroy();  # hopefully destroys the session id if the above didn't work
}


/**
 * Finds out whether a path exists
 * @param $fullpath
 * @return bool
 */
function doesFileExist($fullpath)
{
    $result = file_exists($fullpath);

    return $result;
}


/**
 * Creates a nonexisting file or fails if the file already exists.
 * Returns bool whether it was successful or not; if file already exists, does nothing and returns false.
 * Takes 0, 1, or 2 seconds based on conditions - warning - slow and might theoretically introduce a timing vulnerability in a yet unknown scenario, but doesn't use locks and solves concurrency issues in a simple way.
 * @param $fullpath
 * @param $contents
 * @return bool
 */
function writeNonexistingFile($fullpath, $contents)
{

    # Concurrent file write scenarios:
    # Many independent file writes, each at a slightly different time
    # Many independent file writes, each at the same time
    # The above & file reads

    # Problems in these scenarios:
    # Many independent file writes, each at a slightly different time
    #   * A thread might write valid data but the same thread might read different data later, or operate on obsolete assumptions.
    #       * -> The shortest execution path that returns True takes 2 seconds, checks data 3 times. (For it to be corrupted by another thread, that another thread would have to become delayed by at least 1 second during its execution, which is highly unprobable.)
    #   * Writes can meet and result in invalid data.
    #       * -> dtto
    #   * Threads 1 and 2 can both go through the doesFileExist check (doesn't), and then both write data.
    #       * -> The shortest execution path that returns False & deletes the file takes 0 seconds, the longest takes 1 second, checks data 2 times, and deletes the file immediately when a problem is detected.
    # Many independent file writes, each at the same time
    #   * Writes can meet and result in invalid data.
    #       * -> The shortest execution path that returns True takes 2 seconds, checks data 3 times. (For it to be corrupted by another thread, that another thread would have to become delayed by at least 1 second during its execution, which is highly unprobable.)
    #   * Threads 1 and 2 can both go through the doesFileExist check (doesn't), and then both write data.
    #       * -> The shortest execution path that returns False & deletes the file takes 0 seconds, the longest takes 1 second, checks data 2 times, and deletes the file immediately when a problem is detected.
    #   * Any timed checks might fail in unexpected ways because all threads execute the check at the same time.
    #       * -> The runtime difference between longest False&delete and shortest True result is 1 second and 1 extra check; the last check is read-only so that in the rare case of an error at the last check, the function simply returns False.
    # The above & file reads
    #   * A reading thread might read nonsense.
    #       * ->

    if (!is_string($contents)) {
        return false;
    }
    # there is a possible race condition
    if (doesFileExist($fullpath)) {
        return false;
    }
    # current time of execution since start = ~0.000 s
    $status = file_put_contents($fullpath, $contents);
    # current time of execution since start = ~0.001 s
    # any other thread started now will return False immediately
    # a concurrently running thread migh have written to the same file and corrupted the data
    # OK result means that $status is not false, is int, and has the same value as the length of the written contents
    $ok = !(false === $status);
    if ($ok) {
        $ok = $ok && is_int($status);
    }
    if ($ok) {
        $ok = $ok && ($status === strlen($contents));
    }
    if (!$ok) {
        # current time of execution since start = ~0.001 s
        deleteFile($fullpath); # do not leave broken files, better to signal an error to the user, leave clean state and allow retry in the future (there was a race condition anyway probably)
        # current time of execution since start = ~0.002 s
        return false;
    }
    # now read back the content to see if it is fine (if a race condition happened, the file might be different or gone after a short while)
    sleep(1);
    # current time of execution since start = ~1.001 s
    # a concurrently running thread migh have been delayed by ~0.002 s and this check here might result in $ok===true, while the concurrently running thread would result in $ok===false and proceed to delete the file; or vice versa, this thread might result in $ok===false & delete while the concurrent one might result in $ok===true and run further
    # a concurrently running thread that is faster by at least ~0.002 s might have already deleted the file and another running thread might have written the file; in that case, the check here will result in $ok===false and file deletion, which will result in return False in the other running threads and a clean state
    $read_back_contents = readFileString($fullpath);
    # current time of execution since start = ~1.002 s
    $ok = ($read_back_contents === $contents);
    if (!$ok) {
        # current time of execution since start = ~1.002 s
        # we don't know whether the current file contents are valid data from another thread or garbled mixed data from multiple concurrent writes
        deleteFile($fullpath); # do not leave broken files, better to signal an error to the user, leave clean state and allow retry in the future (there was a race condition anyway probably)
        # current time of execution since start = ~1.003 s
        return false;
    }
    # aaand shotgun programming to really make sure it is fine and no delayed erroneous process deleted it
    sleep(1);
    # current time of execution since start = ~2.002 s
    # with overwhelming probability, any file contents difference that might occur here is that the file has been deleted at the previous step by a concurrently running thread (and might have been written by another running thread in the meantime, the integrity of which is ensured by that thread and not by this thread) and the probability of the file continuing to exist after all threads finish and containing garbage from concurrent writes is very small
    $read_back_contents = readFileString($fullpath);
    # current time of execution since start = ~2.003 s
    $ok = $ok && ($read_back_contents === $contents);
    # most probably, the result is one of these:
    # * True and the file has correct contents and no other thread will ever corrupt it
    # * False and the file doesn't exist
    # * False and the file has been written by a later running thread (after delete in a concurrently running thread), is potentially corrupted, and other currently running thread(s) will collapse the state to one of the previous two clean states (True&good contents, False&non-existent file) within the next two seconds.
    return $ok;

    # If you are asking "Why?" - my motivation was "Why the heck not :)".
}


/**
 * returns string of file contents or false
 * @param $fullpath
 * @return bool|string
 */
function readFileString($fullpath)
{
    # there is a possible race condition
    if (!doesFileExist($fullpath)) {
        return false;
    }
    $result = file_get_contents($fullpath);

    return $result;
}


/**
 * returns string of file contents (good for converting jpg files into data uri) or false
 * @param $fullpath
 * @return bool|string
 */
function readJpgFileDataUriString($fullpath)
{
    # there is a possible race condition
    if (!doesFileExist($fullpath)) {
        return false;
    }
    $type = "jpeg";
    $data = file_get_contents($fullpath);
    if (false === $data) {
        return false;
    }
    $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);

    return $dataUri;
}


/**
 * Deletes a file.
 * Returns false if file didn't even exist, false if error, or true if deletion successful.
 * @param $fullpath
 * @return bool
 */
function deleteFile($fullpath)
{
    if (!doesFileExist($fullpath)) {
        return false;
    }
    $status = unlink($fullpath);

    return $status;
}


/**
 * returns the names of files in the directory as an array of strings
 * @param $dirFullpath
 * @return array
 */
function listFilesInDirNonrecursive($dirFullpath)
{
    # https://secure.php.net/manual/en/function.scandir.php
    return array_diff(scandir($dirFullpath), array('..', '.'));
}


/**
 * returns an array of strings, each being the filename of a directory in the folder in which folders of photos are stored
 * no validation is done
 * @return array
 */
function getAllPhotoDirnames()
{
    global $BASE_PHOTOS_PATH;
    # if the dir doesn't exist, then it generates a warning and will be caught during deployment testing (hopefully)
    $all_files = listFilesInDirNonrecursive($BASE_PHOTOS_PATH);

    return $all_files;
}


/**
 * returns an array of strings, each being the filename of a file in the folder in which photos are stored
 * only .jpg and .jpeg files are returned
 * no other validation is done
 * @param $dir
 * @return array
 */
function getPhotoDirFilenames($dir)
{
    global $BASE_PHOTOS_PATH;
    # if the dir doesn't exist, then it generates a warning and will be caught during deployment testing (hopefully). It would be a weird situation because the filename must have been found there a short while back.
    $all_files = listFilesInDirNonrecursive($BASE_PHOTOS_PATH . "/" . $dir);
    $jpg_files = array();
    foreach ($all_files as $filename) {
        if (preg_match("/.+\.jpe?g$/i", $filename)) {
            $jpg_files[] = $filename;  # append to the array
        }
    }

    return $jpg_files;
}


/**
 * returns the contents of the license.txt file in the folder in which photos are stored if it exists, or false
 * no other validation is done
 * @param $dir
 * @return bool|string
 */
function getPhotoDirLicense($dir)
{
    global $BASE_PHOTOS_PATH;
    $path = $BASE_PHOTOS_PATH . "/" . $dir . "/license.txt";

    return readFileString($path);
}


/**
 * creates a blank index.html file in the specified photo directory so that it is not discoverable
 * skips if the file already exists
 * no other validation is done
 * @param $dir
 */
function setPhotoDirBlankIndex($dir)
{
    global $BASE_PHOTOS_PATH;
    $path = $BASE_PHOTOS_PATH . "/" . $dir . "/index.html";
    if (!doesFileExist($path)) {
        file_put_contents($path, " ");
    }
}


/**
 * returns an array of strings, each being the filename of a file in the folder in which items are stored (eg. itemname-title.txt, itemname-desc.txt)
 * no validation is done
 * @return array
 */
function getAllItemFilenames()
{
    global $BASE_DATA_PATH;
    # 1. enumerate all names
    $all_files = listFilesInDirNonrecursive($BASE_DATA_PATH);

    return $all_files;
}


/**
 * returns an array of strings, each containing an item's name (really, the itemname string in the filename - with filenames like itemname-title.txt, itemname-desc.txt)
 * no validation is done
 * @param $all_filenames
 * @return array
 */
function getAllItemNames($all_filenames)
{
    # 2. strip suffixes, deduplicate (sort, uniq)
    $prefixes_nondeduplicated = array();
    foreach ($all_filenames as $filename) {
        # split by last dash
        # from filename "prefix-with-dashes-suffix.txt" create "txt.xiffus-sehsad-htiw-xiferp" and split into ["txt.xiffus", "sehsad-htiw-xiferp"]
        $rev_exploded = explode("-", strrev($filename), 2);
        if (count($rev_exploded) === 2) {
            # only if there actually is a suffix
            # "prefix-with-dashes"
            $prefix = strrev($rev_exploded[1]);
        } else {
            # the filename doesn't contain a dash
            # "filenamewithoutdashes.txt"
            $prefix = strrev($rev_exploded[0]);
        }
        $prefixes_nondeduplicated[] = $prefix; # append to the end of the array
    }
    $prefixes_dedup = array_unique($prefixes_nondeduplicated);
    sort($prefixes_dedup);

    return $prefixes_dedup;
}


/**
 * validates item names found in the filenames
 * valid are only those names for which all files are available (-title.txt, -desc.txt, -pic.jpg)
 * returns an array of arrays where the first item in the innermost array is item name and the second item is boolean indicating whether the item is valid
 * @param $all_filenames
 * @param $all_item_names
 * @return array
 */
function validateItemNames($all_filenames, $all_item_names)
{
    $results = array();
    $suffixes = array("title.txt", "desc.txt", "pic.jpg");
    foreach ($all_item_names as $item_name) {
        $required_hits = count($suffixes);
        $seen_hits = 0;
        foreach ($suffixes as $suffix) {
            $full_file_name_to_test = $item_name . "-" . $suffix;
            if (in_array($full_file_name_to_test, $all_filenames)) {
                $seen_hits++;
            }
        }
        $valid = ($required_hits === $seen_hits);
        $pair_name_valid = array($item_name, $valid);
        $results[] = $pair_name_valid; # append to the end of the array
    }

    return $results;
}


/**
 * get valid item names from the output of validateItemNames()
 * @param $validateItemNamesResults
 * @return array
 */
function getValidItemNames($validateItemNamesResults)
{
    $results = array();
    foreach ($validateItemNamesResults as $pair_name_valid) {
        $item_name = $pair_name_valid[0];
        $valid = $pair_name_valid[1];
        if ($valid) {
            $results[] = $item_name; # append to the end of the array
        }
    }

    return $results;
}


/**
 * get invalid item names from the output of validateItemNames()
 * @param $validateItemNamesResults
 * @return array
 */
function getInvalidItemNames($validateItemNamesResults)
{
    $results = array();
    foreach ($validateItemNamesResults as $pair_name_valid) {
        $item_name = $pair_name_valid[0];
        $valid = $pair_name_valid[1];
        if (!$valid) {
            $results[] = $item_name; # append to the end of the array
        }
    }

    return $results;
}


/**
 * returns an array containing two dictionaries - 0 => array( name => hash ), 1 => array( hash => name )
 * made so that every user sees different but stable (as far as one login session goes) hashes for individual items
 * @param $itemnames
 * @return array
 */
function getItemNameHashes($itemnames)
{
    $dict_name_hash = array();
    $dict_hash_name = array();
    $seed = getOrNull($_SESSION, "user_specific_link_rand_seed");
    if (null === $seed) {
        # sanity check
        redirectToLogOut();
    }
    foreach ($itemnames as $itemname) {
        # there's no intuitively apparent way the seed or item name can be manipulated or discovered via attacks on the Merkle-Damgard construction and its particular usage here
        $namehash = hash('sha256', $seed . $itemname . $seed);
        $dict_name_hash[$itemname] = $namehash;
        $dict_hash_name[$namehash] = $itemname;
    }
    $result = array();
    $result[0] = $dict_name_hash;
    $result[1] = $dict_hash_name;

    return $result;
}


/**
 * returns the contents of the -title.txt file or false
 * @param $itemName
 * @return bool|string
 */
function readItemTitle($itemName)
{
    global $BASE_DATA_PATH;
    $path = $BASE_DATA_PATH . "/" . $itemName . "-title.txt";

    return readFileString($path);
}


/**
 * returns the contents of the -desc.txt file or false
 * @param $itemName
 * @return bool|string
 */
function readItemDescription($itemName)
{
    global $BASE_DATA_PATH;
    $path = $BASE_DATA_PATH . "/" . $itemName . "-desc.txt";

    return readFileString($path);
}


/**
 * returns the contents of the -booked.txt file or false
 * @param $itemName
 * @return bool|string
 */
function readItemBooking($itemName)
{
    global $BASE_DATA_PATH;
    $path = $BASE_DATA_PATH . "/" . $itemName . "-booked.txt";

    return readFileString($path);
}


/**
 * creates the -booked.txt file (if it doesn't exist) with the prescribed details
 * returns bool whether it was successful (if the -booked.txt file already exists, it does nothing and returns false)
 * @param $itemName
 * @param $email
 * @return bool
 */
function bookItem($itemName, $email)
{
    global $BASE_DATA_PATH;
    $path = $BASE_DATA_PATH . "/" . $itemName . "-booked.txt";

    # there is a possible race condition
    if (doesFileExist($path)) {
        return false;
    }
    # the random sleep has three reasons:
    # * spread around any threads that would be co-occurring at precisely bad times 
    # * make it less predictable
    # * make the check for non-existing file longer, further reducing the probability of badly co-occurring writes (beyond what writeNonexistingFile() provides)
    # In other words, shotgun programming.
    $sleep = rand(0, 30000);
    usleep($sleep);
    # there is a possible race condition
    if (doesFileExist($path)) {
        return false;
    }

    # this takes up to two seconds and checks the integrity of the operation, returns true on success and false on fail, deletes the file on most fails
    return writeNonexistingFile($path, $email);
}


/**
 * returns the contents of the -booked-note.txt file or false
 * @param $itemName
 * @return bool|string
 */
function readItemBookingNote($itemName)
{
    global $BASE_DATA_PATH;
    $path = $BASE_DATA_PATH . "/" . $itemName . "-booked-note.txt";

    return readFileString($path);
}


/**
 * creates the -booked-note.txt file (if it doesn't exist) with the prescribed details
 * returns bool whether it was successful (if the -booked-note.txt file already exists, it does nothing and returns false)
 * @param $itemName
 * @param $note
 * @return bool
 */
function makeItemBookingNote($itemName, $note)
{
    global $BASE_DATA_PATH;
    $path = $BASE_DATA_PATH . "/" . $itemName . "-booked-note.txt";

    # there is a possible race condition
    if (doesFileExist($path)) {
        return false;
    }
    # the random sleep has three reasons:
    # * spread around any threads that would be co-occurring at precisely bad times 
    # * make it less predictable
    # * make the check for non-existing file longer, further reducing the probability of badly co-occurring writes (beyond what writeNonexistingFile() provides)
    # In other words, shotgun programming.
    $sleep = rand(0, 30000);
    usleep($sleep);
    # there is a possible race condition
    if (doesFileExist($path)) {
        return false;
    }

    # this takes up to two seconds and checks the integrity of the operation, returns true on success and false on fail, deletes the file on most fails
    return writeNonexistingFile($path, $note);
}


/**
 * returns the contents of the -pic.jpg file as a string good for data uri or false
 * @param $itemName
 * @return bool|string
 */
function readItemPicture($itemName)
{
    global $BASE_DATA_PATH;
    $path = $BASE_DATA_PATH . "/" . $itemName . "-pic.jpg";

    return readJpgFileDataUriString($path);
}


/**
 * generates a token that is specific to the current logged in session
 * @return string
 */
function genUserSpecificToken()
{
    $seed = getOrNull($_SESSION, "user_specific_link_rand_seed");
    if (null === $seed) {
        # sanity check
        redirectToLogOut();
    }
    $sharedConstant = "user-specific token blablablabla do not use this as an item name";  # not necessary to be secret at all; no item name will ever have this name
    # there's no intuitively apparent way the seed or token can be manipulated or discovered via attacks on the Merkle-Damgard construction and its particular usage here
    $seed_hashed = hash('sha256', $seed);
    $token = hash('sha256', $seed_hashed . $sharedConstant . $seed_hashed);

    return $token;
}


/**
 * generates a token that is specific to the current logged in session and to the supplied item name
 * the user is not able to guess the resulting token for a given input nor to guess the input for a given token
 * @param $itemname
 * @return string
 */
function genUserSpecificItemSpecificToken($itemname)
{
    $seed = getOrNull($_SESSION, "user_specific_link_rand_seed");
    if (null === $seed) {
        # sanity check
        redirectToLogOut();
    }
    $sharedConstant = "user-specific token blablablabla do not use this as an item name";  # from genUserSpecificToken()
    if ($itemname === $sharedConstant) {
        # this item name can never be used, else it would be the same as the user-specific token
        redirectToLogOut();
    }
    # there's no intuitively apparent way the seed or token can be manipulated or discovered via attacks on the Merkle-Damgard construction and its particular usage here
    $seed_hashed = hash('sha256', $seed);
    $token = hash('sha256', $seed_hashed . $itemname . $seed_hashed);

    return $token;
}


/**
 * converts plaintext to the same text but with plaintext newlines replaced by <p></p>
 * beware that you still need to sanitize the text using htmlspecialchars() before converting the newlines if you take it from the user
 * @param $plaintext
 * @return string
 */
function newlinesToHtmlParagraphs($plaintext)
{
    $desc_lines = preg_split("/\\r\\n|\\r|\\n/", $plaintext);  # https://stackoverflow.com/questions/3997336/explode-php-string-by-new-line
    $desc = '';
    foreach ($desc_lines as $line) {
        $desc = $desc . '<p>' . $line . '</p>';
    }

    return $desc;
}


/**
 * If the name exists in the array, return the value; if it doesn't exist, return null.
 * @param $array
 * @param $name
 * @return null
 */
function getOrNull($array, $name)
{
    if (isset($array[$name])) {
        return $array[$name];
    } else {
        return null;
    }
}


/**
 * Prints html template.
 * If enable_clippy is false or 0, clippy.js is disabled; if it is 1 or true, it is enabled but not shown, if it is 2, it is enabled and shown.
 * @param $meta
 * @param $head
 * @param $body
 * @param $use_uk_container
 * @param $use_uk_stylesheet
 * @param $use_viewport
 * @param $enable_clippy
 */
function printHtmlPageBaseCustomMetaHead($meta, $head, $body, $use_uk_container, $use_uk_stylesheet, $use_viewport, $enable_clippy)
{
    $result = "";

    $result .= '<html>';
    $result .= '<meta charset=utf-8>';
    #$result .= '<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, user-scalable=0"/>';
    if ($use_viewport) {
        $result .= '<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>';
    }
    $result .= $meta;
    $result .= "<head>";
    if ($use_uk_stylesheet) {
        $result .= "<link rel=\"stylesheet\" href=\"uikit/css/uikit.gradient.min.css\">";
    }
    if ($enable_clippy) {
        $result .= '<link rel="stylesheet" type="text/css" href="clippy.js/build/clippy.css" media="all">';
        $result .= '<script src="jquery-3.2.1.min.js"></script>';
        $result .= '<script src="clippy.js/build/clippy.js"></script>';
    }
    $result .= $head;
    $result .= "</head>";
    $result .= "<body >";
    if ($enable_clippy) {
        # clippy.js
        $run_immediately = "";
        if ($enable_clippy === 2) {
            $run_immediately = 'clippy_agent_show();';
        }
        $result .= '
            <script type="text/javascript">
                function width(){
                   return window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth||0;
                }
                function height(){
                   return window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight||0;
                }
                clippy_agent_public = null;
                clippy_agent_custom_action_after_load = null; // allows another script to specify a function that is run immediately after clippy is shown, but not any sooner
                clippy_agent_show = function() {
                    clippy_agent_public.show(true); // fast
                    clippy_agent_public.moveTo(width() - 130, height() - 130, 0);
                    if (null !== clippy_agent_custom_action_after_load) {
                        clippy_agent_custom_action_after_load();
                    }
                };
                clippy.load("Clippy", function(agent){
                    clippy_agent_public = agent;
                    ' . $run_immediately . '
                });
            </script>
        ';
    }
    if ($use_uk_container) {
        $navbar = '<div class="uk-navbar uk-margin-bottom" >';

        global $NAVBAR_FRONTPAGE;
        global $NAVBAR_MAIN;
        global $NAVBAR_CONTACTS;
        $navul = '<ul class="uk-navbar-nav">';
        $navul .= '<li><a href="' . getPageAddrWithAction("noaction") . '">' . $NAVBAR_FRONTPAGE . '</a></li>';
        $navul .= '<li><a href="' . getPageAddrWithAction("mainafterlogin") . '">' . $NAVBAR_MAIN . '</a></li>';
        $navul .= '<li><a href="' . getPageAddrWithAction("contacts") . '">' . $NAVBAR_CONTACTS . '</a></li>';
        $navul .= '</ul>';

        $navbar .= $navul;
        $navbar .= '</div>';
        $result .= "<div class=\"uk-container\">";
        $result .= $navbar;
    }
    #$result .= "hello world<br>";
    $result .= $body;

    if ($use_uk_container) {
        $result .= "</div>";
    }

    $result .= "</body>";
    $result .= "</html>";

    echo $result;
    exit();
}


/**
 * Prints html template.
 * @param $meta
 * @param $body
 */
function printHtmlPageBaseCustomMeta($meta, $body)
{
    printHtmlPageBaseCustomMetaHead($meta, "", $body, true, true, true, false);
}

$MAIN_BG_STYLE = '
        <style>
        body {
          background: url(background/main_bg.jpg);
          background-size: cover;
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-position: center center;
        }
        </style>
';


/**
 * Prints html template with background and with clippy.js.
 * @param $meta
 * @param $body
 */
function printHtmlPageBaseCustomMetaWithBgWithClippy($meta, $body)
{
    global $MAIN_BG_STYLE;
    $style_bg = $MAIN_BG_STYLE;
    printHtmlPageBaseCustomMetaHead($meta, $style_bg, $body, true, true, true, 2);
}


/**
 * Prints html template with clippy.js.
 * @param $meta
 * @param $body
 */
function printHtmlPageBaseCustomMetaWithClippy($meta, $body)
{
    printHtmlPageBaseCustomMetaHead($meta, "", $body, true, true, true, 2);
}


/**
 * Prints html template.
 * @param $body
 */
function printHtmlPageBase($body)
{
    printHtmlPageBaseCustomMeta("", $body);
}


/**
 * Prints html template with background.
 * @param $body
 */
function printHtmlPageBaseWithBg($body)
{
    global $MAIN_BG_STYLE;
    $style_bg = $MAIN_BG_STYLE;
    printHtmlPageBaseCustomMetaHead("", $style_bg, $body, true, true, true, false);
}


/**
 * Prints html template with background and clippy.js.
 * @param $body
 */
function printHtmlPageBaseWithBgWithClippy($body)
{
    global $MAIN_BG_STYLE;
    $style_bg = $MAIN_BG_STYLE;
    printHtmlPageBaseCustomMetaHead("", $style_bg, $body, true, true, true, 2);
}


/**
 * Prints html template with clippy.js.
 * @param $body
 */
function printHtmlPageBaseWithClippy($body)
{
    printHtmlPageBaseCustomMetaWithClippy("", $body);
}


/**
 * Returns the path and name of this webpage (for use in links to itself).
 * @return string
 */
function getPageAddr()
{
    # returns thispage.php
    return htmlspecialchars($_SERVER['SCRIPT_NAME']);
}


/**
 * Returns the path and name of this webpage with a get parameter to the specified action (for use in links to itself).
 * @param $action
 * @return string
 */
function getPageAddrWithAction($action)
{
    # returns thispage.php?action=specifiedaction
    return htmlspecialchars($_SERVER['SCRIPT_NAME']) . '?action=' . htmlspecialchars($action);
}


/**
 * Prints html page that meta refreshes and calls exit().
 */
function refreshAndDie()
{
    # this must be executed before anything from body is printed

    # print a simple http meta refresh page and die
    echo '<html><head><meta http-equiv="refresh" content="0"></head><body></body></html>';
    exit();
}


/**
 * Prints html page that meta refreshes to the specified action and calls exit().
 * @param $action
 */
function refreshRedirectToActionAndDie($action)
{
    # this must be executed before anything from body is printed

    # print a simple http meta refresh/redirect page and die
    echo '<html><head><meta http-equiv="refresh" content="0;' . getPageAddrWithAction($action) . '"></head><body></body></html>';
    exit();
}


/**
 * Prints html page that meta refreshes to the specified address and calls exit().
 * The address is not sanitized!
 * @param $addr
 */
function refreshRedirectToAddrAndDie($addr)
{
    # this must be executed before anything from body is printed

    # print a simple http meta refresh/redirect page and die
    echo '<html><head><meta http-equiv="refresh" content="0;' . $addr . '"></head><body></body></html>';
    exit();
}


/**
 * generates the <meta> html tag that performs refresh after the specified number of seconds to the specified address (set time to 0 for immediate redirect)
 * no validation or sanitization is performed!
 * @param $addr
 * @param $time
 * @return string
 */
function genMetaRedirect($addr, $time)
{
    return '<meta http-equiv="refresh" content="' . $time . ';' . $addr . '">';
}


/**
 * Prints html page that meta refreshes to login, then exit() is called.
 */
function redirectToLogin()
{
    refreshRedirectToActionAndDie("login");
}


/**
 * Handles request to print and prints login page.
 */
function handleLogin()
{
    # no input conditions for sanity check

    # if already logged in, meta redirect to mainafterlogin
    redirectToMainAfterLoginIfLoggedIn();

    global $LOGIN_GIVEN_NAME_OF_ONE_OF_THE_NEWLYWEDS;
    global $LOGIN_GIVEN_NAME_OF_ANOTHER_OF_THE_NEWLYWEDS;
    global $LOGIN_ENTER_NAMES;
    global $LOGIN_CONTINUE;

    # else print the login form
    $form = '
    <form class="uk-panel uk-panel-box uk-form " action="" >
        <input type="hidden" name="action" value="validatelogin">
        <p>' . $LOGIN_ENTER_NAMES . '</p>
        <p><input type="text" name="name1" value="" class="uk-form-large uk-width-1-1" placeholder="' . $LOGIN_GIVEN_NAME_OF_ONE_OF_THE_NEWLYWEDS . '"></p>
        <p><input type="text" name="name2" value="" class="uk-form-large uk-width-1-1" placeholder="' . $LOGIN_GIVEN_NAME_OF_ANOTHER_OF_THE_NEWLYWEDS . '"></p>
        <p><input type="submit" class="uk-button uk-button-primary uk-button-large uk-width-1-1"  value="' . $LOGIN_CONTINUE . '"></p>
    </form> 
        ';
    $body = '<div>' . $form . '</div>';
    $body = '<div class="uk-vertical-align-middle" style="width: 100% ; max-width: 500px ; ">' . $body . '</div>';
    $body = '<div class="uk-vertical-align uk-text-center uk-width-1-1 uk-height-1-1" >' . $body . '</div>';

    printHtmlPageBaseWithBg($body);
}


/**
 * Handles request to print and prints validatelogin page. Redirects to the right page based on login validity.
 */
function handleValidateLogin()
{

    # if already logged in, meta redirect to mainafterlogin
    redirectToMainAfterLoginIfLoggedIn();

    global $LOGIN_NAME_1_REGEX;
    global $LOGIN_NAME_2_REGEX;

    # needs the login to be valid - either name1 and name2 being the right values or the cookie saying it is OK
    $regexp1 = $LOGIN_NAME_1_REGEX;
    $regexp2 = $LOGIN_NAME_2_REGEX;
    $name1_tainted = getOrNull($_GET, "name1");
    $name2_tainted = getOrNull($_GET, "name2");

    $regexp_attack_1 = "/' or/i";
    $regexp_attack_2 = "/;.*'/i";
    $regexp_attack_3 = "/where.*'/i";

    if (null === $name1_tainted) {
        $_SESSION["logged_in"] = false;
        redirectToLogin();

        return;
    } elseif (null === $name2_tainted) {
        $_SESSION["logged_in"] = false;
        redirectToLogin();

        return;
    } elseif ((preg_match($regexp1, $name1_tainted) && preg_match($regexp2, $name2_tainted)) || (preg_match($regexp2, $name1_tainted) && preg_match($regexp1, $name2_tainted))) {
        $_SESSION["logged_in"] = true;
        redirectToMainAfterLogin();

        return;
    } elseif (preg_match($regexp_attack_1, $name1_tainted) || preg_match($regexp_attack_2, $name1_tainted) || preg_match($regexp_attack_3, $name1_tainted) || preg_match($regexp_attack_1, $name2_tainted) || preg_match($regexp_attack_2, $name2_tainted) || preg_match($regexp_attack_3, $name2_tainted)) {
        # easter egg
        refreshRedirectToAddrAndDie("https://lmddgtfy.net/?q=how%20to%20become%20a%20hacker");
    } else {
        $_SESSION["logged_in"] = false;
        redirectToLogin();

        return;
    }
}


/**
 * If logged in, prints html page that meta refreshes to mainafterlogin, then exit() is called.
 * If not logged in, does nothing.
 * Can be used to skip login screen if already logged in.
 */
function redirectToMainAfterLoginIfLoggedIn()
{
    # if already logged in, meta redirect to mainafterlogin
    $logged_in = getOrNull($_SESSION, "logged_in");
    if (true === $logged_in) {
        redirectToMainAfterLogin();
    }
}


/**
 * Prints html page that meta refreshes to mainafterlogin, then exit() is called.
 */
function redirectToMainAfterLogin()
{
    refreshRedirectToActionAndDie("mainafterlogin");
}


/**
 * Handles request to print and prints mainafterlogin page. Displays gift list or photo gallery.
 */
function handleMainAfterLogin()
{
    redirectToNoActionIfNotLoggedIn();

    $photos_exist = count(getAllPhotoDirnames()) > 1;
    if ($photos_exist) {
        partialHandleMainAfterLoginGallery();

    } else {
        partialHandleMainAfterLoginGiftList();
    }
}


/**
 * Prints a gift list.
 * Not meant as a full-fledged handler, must not be called without first validating the data and the login.
 */
function partialHandleMainAfterLoginGiftList()
{
    redirectToNoActionIfNotLoggedIn();
    global $BASE_MAIN_CONTENT_PATH;
    global $MAIN_PAGE_PART_1_CONTENT_HTML_FRAGMENT;
    global $MAIN_PAGE_PART_2_HEADING_GIFT_LIST;
    global $MAIN_PAGE_PART_2_CONTENT_AFTER_HEADING_BEFORE_GIFT_LIST_HTML_FRAGMENT;
    global $MAIN_PAGE_PART_2_CONTENT_AFTER_GIFT_LIST_HTML_FRAGMENT;
    global $MAIN_PAGE_PART_3_TITLE;
    global $MAIN_PAGE_PART_3_CONTENT_HTML_FRAGMENT;

    # using file_get_contents on purpose so that it fails loud if something is wrong
    # TODO: if you do not want to source main content from separate files, delete the following 6 lines of code
    $MAIN_PAGE_PART_1_CONTENT_HTML_FRAGMENT = file_get_contents($BASE_MAIN_CONTENT_PATH . "/MAIN_PAGE_PART_1_CONTENT_HTML_FRAGMENT.txt");
    $MAIN_PAGE_PART_2_HEADING_GIFT_LIST = file_get_contents($BASE_MAIN_CONTENT_PATH . "/MAIN_PAGE_PART_2_HEADING_GIFT_LIST.txt");
    $MAIN_PAGE_PART_2_CONTENT_AFTER_HEADING_BEFORE_GIFT_LIST_HTML_FRAGMENT = file_get_contents($BASE_MAIN_CONTENT_PATH . "/MAIN_PAGE_PART_2_CONTENT_AFTER_HEADING_BEFORE_GIFT_LIST_HTML_FRAGMENT.txt");
    $MAIN_PAGE_PART_2_CONTENT_AFTER_GIFT_LIST_HTML_FRAGMENT = file_get_contents($BASE_MAIN_CONTENT_PATH . "/MAIN_PAGE_PART_2_CONTENT_AFTER_GIFT_LIST_HTML_FRAGMENT.txt");
    $MAIN_PAGE_PART_3_TITLE = file_get_contents($BASE_MAIN_CONTENT_PATH . "/MAIN_PAGE_PART_3_TITLE.txt");
    $MAIN_PAGE_PART_3_CONTENT_HTML_FRAGMENT = file_get_contents($BASE_MAIN_CONTENT_PATH . "/MAIN_PAGE_PART_3_CONTENT_HTML_FRAGMENT.txt");
    # end of block to delete

    $allItemFilenames = getAllItemFilenames();
    $allItemNames = getAllItemNames($allItemFilenames);
    $itemNameValidation = validateItemNames($allItemFilenames, $allItemNames);
    $validItemNames = getValidItemNames($itemNameValidation);
    $hashes = getItemNameHashes($validItemNames);
    $dict_name_hash = $hashes[0];
    $body = "";

    $body .= $MAIN_PAGE_PART_1_CONTENT_HTML_FRAGMENT;
    $body .= '<h1 class="uk-article-title uk-margin">' . $MAIN_PAGE_PART_2_HEADING_GIFT_LIST . '</h1>';
    $body .= $MAIN_PAGE_PART_2_CONTENT_AFTER_HEADING_BEFORE_GIFT_LIST_HTML_FRAGMENT;

    $grid = "";
    foreach ($validItemNames as $itemname) {
        $title = readItemTitle($itemname);
        $booked = (readItemBooking($itemname) !== false);
        $divcontents = $title;
        if ($booked) {
            $divcontents = "<s>" . $divcontents . "</s>";
        }
        $link_hash = $dict_name_hash[$itemname];
        $link = getPageAddrWithAction("giftdetails") . "&itemhash=" . $link_hash;
        $divcontents = "<a href=\"" . $link . "\">" . $divcontents . "</a>";
        $divcontents = "<p>" . $divcontents . "</p>";
        $div = "<div class=\"uk-panel uk-panel-box\" >" . $divcontents . "</div>";
        $div = "<div class=\"uk-width-medium-1-1 uk-margin-small\" >" . $div . "</div>";
        $grid = $grid . $div;
    }
    $body .= "<div class=\"uk-grid\">" . $grid . "</div>";
    $body .= '<p>' . $MAIN_PAGE_PART_2_CONTENT_AFTER_GIFT_LIST_HTML_FRAGMENT . '</p>';

    $body .= '<h1 class="uk-article-title uk-margin">' . $MAIN_PAGE_PART_3_TITLE . '</h1>';
    $body .= '<p class="uk-margin-large-bottom">' . $MAIN_PAGE_PART_3_CONTENT_HTML_FRAGMENT . '</p>';
    printHtmlPageBaseWithBg($body);
}


/**
 * Prints a gallery.
 * Not meant as a full-fledged handler, must not be called without first validating the data and the login.
 */
function partialHandleMainAfterLoginGallery()
{
    redirectToNoActionIfNotLoggedIn();
    $meta = '';

    $head = '<script src="jquery-3.2.1.min.js"></script>';
    $head .= '<script src="galleria/galleria-1.5.7.min.js"></script>';

    $img_list = '';
    $dir_list = getAllPhotoDirnames();
    foreach ($dir_list as $dir) {
        $jpg_list = getPhotoDirFilenames($dir);
        $license = getPhotoDirLicense($dir);  # read without sanitization, so it can contain e.g. &nbsp;
        if (!$license || !$jpg_list) {
            # do not show folders without license
            continue;
        }
        setPhotoDirBlankIndex($dir);
        foreach ($jpg_list as $jpg) {

            # this (these two commented lines) is the simple way of referencing the original files
            #$jpg_path = $BASE_PHOTOS_PATH . "/" . $dir . "/" . $jpg;
            #$img_href = '<img src="' . $jpg_path . '" data-description="' . $license . '"  >';

            $jpg_name = htmlspecialchars($jpg);
            $dir_name = htmlspecialchars($dir);
            $jpg_token = genUserSpecificItemSpecificToken("jpg name " . $jpg);
            $dir_token = genUserSpecificItemSpecificToken("dir name " . $dir);
            $user_token = genUserSpecificToken();
            $img_href = '<img src="' . getPageAddr() . '?action=displayjpg&jpg_name=' . $jpg_name . '&dir_name=' . $dir_name . '&jpg_token=' . $jpg_token . '&dir_token=' . $dir_token . '&user_token=' . $user_token . '" data-description="' . $license . '"  >';
            $img_list .= $img_href;
        }
    }

    $galleria_div = '<div class="galleria uk-width-1-1 uk-height-1-1" >' . $img_list . '</div>';

    $galleria_theme_load = '<script> (function() { Galleria.loadTheme("galleria-fullscreenmod/fullscreen/galleria.fullscreenmod.js"); Galleria.run(".galleria");  }()); </script>';

    # this theme has a too long inactivity timeout and doesn't have fullscreen button
    #$galleria_theme_load = '<script> (function() { Galleria.loadTheme("galleria/themes/fullscreen/galleria.fullscreen.js"); Galleria.run(".galleria"); }()); </script>';

    # these themes break (picture displayed only partially) when there's a lot of pictures / there's more than a few tens of megabytes, idk why
    #$galleria_theme_load = '<script> (function() { Galleria.loadTheme("galleria/themes/classic/galleria.classic.min.js"); Galleria.run(".galleria"); }()); </script>';
    #$galleria_theme_load = '<script> (function() { Galleria.loadTheme("galleria-classicmod/galleria-classicmod/galleria.classicmod.js"); Galleria.run(".galleria"); }()); </script>';

    $body = '<p>...loading...</p>';
    $body .= $galleria_div . $galleria_theme_load;

    printHtmlPageBaseCustomMetaHead($meta, $head, $body, false, true, true, false);
}


/**
 * Prints binary jpg with the correct headers (image/jpg file) based on get data and login status, or prints an html
 * that meta redirects to a different page.
 */
function handleGalleryJpg()
{
    global $BASE_PHOTOS_PATH;
    redirectToNoActionIfNotLoggedIn();
    $jpg_name_tainted = getOrNull($_GET, "jpg_name");
    $dir_name_tainted = getOrNull($_GET, "dir_name");

    # first layer of protection - not processing requests that don't have valid authentication tokens
    $jpg_token_tainted = getOrNull($_GET, "jpg_token");
    $dir_token_tainted = getOrNull($_GET, "dir_token");
    $user_token_tainted = getOrNull($_GET, "user_token");
    if (null === $jpg_token_tainted) {
        redirectToMainAfterLogin();
    }
    if (null === $dir_token_tainted) {
        redirectToMainAfterLogin();
    }
    if (null === $user_token_tainted) {
        redirectToMainAfterLogin();
    }
    if (null === $jpg_name_tainted) {
        redirectToMainAfterLogin();
    }
    if (null === $dir_name_tainted) {
        redirectToMainAfterLogin();
    }
    $user_token = genUserSpecificToken();
    if ($user_token_tainted !== $user_token) {
        redirectToMainAfterLogin();
    }
    # after this line, $user_token_tainted === $user_token
    $jpg_token = genUserSpecificItemSpecificToken("jpg name " . $jpg_name_tainted);
    if ($jpg_token_tainted !== $jpg_token) {
        redirectToMainAfterLogin();
    }
    $dir_token = genUserSpecificItemSpecificToken("dir name " . $dir_name_tainted);
    if ($dir_token_tainted !== $dir_token) {
        redirectToMainAfterLogin();
    }

    # second (not perfect) layer of protection - sanitizing names
    $jpg_name = str_replace("../", "", $jpg_name_tainted);
    $dir_name = str_replace("../", "", $dir_name_tainted);
    $jpg_name = str_replace("/", "", $jpg_name);
    $dir_name = str_replace("/", "", $dir_name);
    $jpg_name = str_replace("%", "", $jpg_name);
    $dir_name = str_replace("%", "", $dir_name);
    $jpg_name = str_replace("\n", "", $jpg_name);
    $dir_name = str_replace("\n", "", $dir_name);
    $jpg_name = str_replace("\r", "", $jpg_name);
    $dir_name = str_replace("\r", "", $dir_name);
    $jpg_name = str_replace("\0", "", $jpg_name);
    $dir_name = str_replace("\0", "", $dir_name);
    $jpg_name = str_replace(".php", "", $jpg_name);
    $dir_name = str_replace(".php", "", $dir_name);
    $jpg_name = str_replace(".html", "", $jpg_name);
    $dir_name = str_replace(".html", "", $dir_name);

    $jpg_name_content_disposition = str_replace(" ", "_", $jpg_name);
    $path = $BASE_PHOTOS_PATH . "/" . $dir_name . "/" . $jpg_name;
    if (!preg_match("/.+\.jpe?g$/i", $path)) {
        # the path must end with .jpg or .jpeg
        redirectToMainAfterLogin();
    }
    if (!doesFileExist($path)) {
        redirectToMainAfterLogin();
    }
    header('Content-Type: image/jpeg');
    header('Content-Length: ' . filesize($path));
    header('Content-Disposition: filename=' . $jpg_name_content_disposition);
    header('Cache-Control: max-age=864000, public');
    readfile($path);
    exit();
}


/**
 * Handles request to print and prints giftdetails page.
 */
function handleGiftDetails()
{

    redirectToNoActionIfNotLoggedIn();
    $itemhash_tainted = getOrNull($_GET, "itemhash");
    $item_token_tainted = getOrNull($_POST, "item_token");
    $user_token_tainted = getOrNull($_POST, "user_token");
    $inputnote_tainted = getOrNull($_POST, "input_note");
    if (null === $itemhash_tainted) {
        redirectToMainAfterLogin();
    }

    global $GIFT_DETAIL_WARN_ALREADY_BOOKED;
    global $GIFT_DETAIL_WARN_YOU_ALREADY_BOOKED;
    global $GIFT_DETAIL_WARN_YOU_ALREADY_SAVED_NOTE;
    global $GIFT_DETAIL_FORM_NOTE_YOU_CAN_BOOK;
    global $GIFT_DETAIL_FORM_BUTTON_BOOK;
    global $GIFT_DETAIL_FORM_EMAIL_ADDR;
    global $GIFT_DETAIL_FIELDSET_LEGEND;

    $allItemFilenames = getAllItemFilenames();
    $allItemNames = getAllItemNames($allItemFilenames);
    $itemNameValidation = validateItemNames($allItemFilenames, $allItemNames);
    $validItemNames = getValidItemNames($itemNameValidation);
    $hashes = getItemNameHashes($validItemNames);
    $dict_hash_name = $hashes[1];
    $itemname = getOrNull($dict_hash_name, $itemhash_tainted);
    if (null === $itemname) {
        redirectToMainAfterLogin();
    }
    $itemhash = $itemhash_tainted;
    # below this line, $itemhash can only be a well-formed non-malicious hash (otherwise, the complementary item name wouldn't have been found)

    $booked = (readItemBooking($itemname) !== false);

    if (($booked) && (null !== $inputnote_tainted) && (null !== $item_token_tainted) && (null !== $user_token_tainted)) {
        # if all these GET parameters are not null, validate them (if any of them is null, ignore them all, no validation performed)
        # if the item is not booked, no note can be added
        # if the validation fails, return to main page (that would be a deliberate tampering or a bad session)
        $user_token = genUserSpecificToken();
        if ($user_token_tainted !== $user_token) {
            redirectToMainAfterLogin();
        }
        # $user_token_tainted === $user_token
        $item_token = genUserSpecificItemSpecificToken($itemname);
        if ($item_token_tainted !== $item_token) {
            redirectToMainAfterLogin();
        }
        # $item_token_tainted === $item_token

        # if the code is running at this point in this if condition, it means that user_token and item_token are correct, therefore the user themselves submitted the booking note

        $note_already_exists = (readItemBookingNote($itemname) !== false);
        if (!$note_already_exists) {
            $inputnote_max_length = 1800;
            $inputnote_trimmed_tainted = mb_strimwidth($inputnote_tainted, 0, $inputnote_max_length, "...", "UTF-8");
            makeItemBookingNote($itemname, $inputnote_trimmed_tainted);
        }
    }

    $title = readItemTitle($itemname);
    $desc = readItemDescription($itemname);
    $pic = readItemPicture($itemname);
    $booking_note_tainted = readItemBookingNote($itemname);

    if ($booked) {
        $title = "<s>" . $title . "</s>";
    }
    $title = '<h1 class="uk-article-title">' . $title . '</h1>';
    $desc = newlinesToHtmlParagraphs($desc);
    $pic_div = '<div class="uk-thumbnail">' . '<img src="' . $pic . '" style="width: auto ; max-width: 100% ; " >' . '</div>';

    $form = "";

    $session_booking_note = "user_booked_item_" . $itemhash;
    $session_booking_note_status = getOrNull($_SESSION, $session_booking_note);
    $this_user_already_booked_from_session = (true === $session_booking_note_status);

    # display a form or a simple box based on the booking status
    if (!$booked) {
        $inputEmail = '<p><input type="text" name="input_email" class="uk-form-large uk-width-1-1" placeholder="' . $GIFT_DETAIL_FORM_EMAIL_ADDR . '" ></p>';
        $inputSubmit = '<p><input type="submit" name="input_submit" value="' . $GIFT_DETAIL_FORM_BUTTON_BOOK . '" class="uk-button uk-button-primary uk-button-large uk-width-1-1" ></p>';
        $formNote = '<p>' . $GIFT_DETAIL_FORM_NOTE_YOU_CAN_BOOK . '</p>';
        $inputHiddenUsertoken = '<input type="hidden" name="user_token" value="' . genUserSpecificToken() . '" >';
        $inputHiddenItemtoken = '<input type="hidden" name="item_token" value="' . genUserSpecificItemSpecificToken($itemname) . '" >';
        $inputHiddenItemhash = '<input type="hidden" name="item_hash" value="' . $itemhash . '" >';
        $inputHiddenAction = '<input type="hidden" name="action" value="giftbookingbeginning" >';
        $formelements = $inputEmail . $formNote . $inputSubmit . $inputHiddenUsertoken . $inputHiddenItemtoken . $inputHiddenItemhash . $inputHiddenAction;
        $fieldset = '<fieldset><legend>' . $GIFT_DETAIL_FIELDSET_LEGEND . '</legend>' . $formelements . '</fieldset>';
        $link = getPageAddr();
        $form = '<form action="' . $link . '" method="get" class="uk-panel uk-panel-box uk-form">' . $fieldset . '</form>';
    } elseif ($booked && $this_user_already_booked_from_session) {
        $msg1 = '<p>' . $GIFT_DETAIL_WARN_YOU_ALREADY_BOOKED . '</p>';
        $msg2 = '';
        if (false !== $booking_note_tainted) {

            $msg2 = '<p>' . $GIFT_DETAIL_WARN_YOU_ALREADY_SAVED_NOTE . '</p>';
            $msg2 .= newlinesToHtmlParagraphs(htmlspecialchars($booking_note_tainted));
        }
        $msg_div = '<div class="uk-margin">' . $msg1 . $msg2 . '</div>';
        $form = '<div class="uk-panel uk-panel-box uk-form uk-margin">' . $msg_div . '</div>';
    } elseif ($booked && !$this_user_already_booked_from_session) {
        $msg = '<div class="uk-margin"><p>' . $GIFT_DETAIL_WARN_ALREADY_BOOKED . '</p></div>';
        $form = '<div class="uk-panel uk-panel-box uk-form uk-margin">' . $msg . '</div>';
    }

    $form_div = '<div style="width: auto ; max-width: 400px ;">' . $form . '</div>';
    $body = '<div class="uk-article">' . $title . $pic_div . $desc . $form_div . '</div>';
    $clippy = '
        <script type="text/javascript">
            function getRandomElem(array) {
                var i = Math.floor(Math.random()*(array.length));
                return array[i];
            }
            // some actions are there multiple times deliberately
            clippy_actions = [
                "CheckingSomething", "IdleHeadScratch", "IdleHeadScratch", "IdleHeadScratch", "Searching", "IdleFingerTap", "IdleFingerTap", "IdleFingerTap", "Writing", "Writing", "Processing", "Print", 
                "CheckingSomething", "IdleHeadScratch", "IdleHeadScratch", "IdleHeadScratch", "Searching", "IdleFingerTap", "IdleFingerTap", "IdleFingerTap", "Writing", "Writing", "Processing", "Print", 
                "GetAttention", "GetArtsy",
            ];
            clippy_delays = [25000, 13000, 7000, 55000];
            clippy_agent_custom_action_after_load = function() {
                clippy_agent_public.play("LookUpRight");
                setTimeout(clippy_actions_1, 8000);
            };
            function clippy_actions_2() {
                var action = getRandomElem(clippy_actions);
                clippy_agent_public.play(action);
                var delay = getRandomElem(clippy_delays);
                setTimeout(clippy_actions_2, delay);
            }
            function clippy_actions_1() {
                var action = getRandomElem(clippy_actions);
                clippy_agent_public.play(action);
                setTimeout(clippy_actions_2, 10000);
            }
        </script>
    ';
    $body .= $clippy;
    printHtmlPageBaseWithBgWithClippy($body);
}


/**
 * Handles request to print and prints giftbookingbeginning page.
 * It just displays a message "please wait" and meta redirects to the actual gift booking that might take a while.
 * Reads the parameters for the next action and performs the redirect.
 * Displays a message "please wait" because the booking action that is about to happen is going to take up to 2 seconds.
 */
function handleGiftBookingBeginning()
{
    global $GIFT_BOOKING_START_MSG;
    redirectToNoActionIfNotLoggedIn();
    $itemhash_tainted = getOrNull($_GET, "item_hash");
    $item_token_tainted = getOrNull($_GET, "item_token");
    $user_token_tainted = getOrNull($_GET, "user_token");
    $email_tainted = getOrNull($_GET, "input_email");
    if (null === $itemhash_tainted) {
        redirectToMainAfterLogin();
    }
    if (null === $item_token_tainted) {
        redirectToMainAfterLogin();
    }
    if (null === $user_token_tainted) {
        redirectToMainAfterLogin();
    }
    $user_token = genUserSpecificToken();
    if ($user_token_tainted !== $user_token) {
        redirectToMainAfterLogin();
    }
    # after this line, $user_token_tainted === $user_token

    $email_null = (null === $email_tainted);
    $email_too_short = false;
    $email_badly_formed = false;
    if (!$email_null) {
        $email_too_short = (strlen($email_tainted) < 5);
        # very basic and lax verification of email address with the catch that sth like postbox@com is not allowed
        $email_badly_formed = (!preg_match("/.+@.+\..+/i", $email_tainted));
    }
    if ($email_null || $email_too_short || $email_badly_formed) {
        partialHandleBookGiftBadEmail($email_null, $email_too_short, $email_badly_formed);
    }

    $allItemFilenames = getAllItemFilenames();
    $allItemNames = getAllItemNames($allItemFilenames);
    $itemNameValidation = validateItemNames($allItemFilenames, $allItemNames);
    $validItemNames = getValidItemNames($itemNameValidation);
    $hashes = getItemNameHashes($validItemNames);
    $dict_hash_name = $hashes[1];
    $itemname = getOrNull($dict_hash_name, $itemhash_tainted);
    if (null === $itemname) {
        redirectToMainAfterLogin();
    }
    $itemhash = $itemhash_tainted;
    # below this line, $itemhash can only be a well-formed non-malicious hash (otherwise, the complementary item name wouldn't have been found)

    $item_token = genUserSpecificItemSpecificToken($itemname);
    if ($item_token_tainted !== $item_token) {
        redirectToMainAfterLogin();
    }
    # after this line, $item_token_tainted === $item_token

    $title = readItemTitle($itemname);
    $booked = (readItemBooking($itemname) !== false);
    if ($booked) {
        $title = "<s>" . $title . "</s>";
    }
    $title = '<p>' . $title . '</p>';
    $message = '<p>' . $GIFT_BOOKING_START_MSG . '</p>';
    $body = $title . $message;
    $body = '<div class="uk-panel uk-panel-box uk-form">' . $body . '</div>';
    $body = '<div class="uk-vertical-align-middle" style="width: auto ; max-width: 300px ; ">' . $body . '</div>';
    $body = '<div class="uk-vertical-align uk-text-center uk-width-1-1 uk-height-1-1" >' . $body . '</div>';

    $itemhash_param = $itemhash;
    $item_token_param = $item_token;
    $user_token_param = $user_token;
    $email_param = htmlspecialchars($email_tainted);
    $email_sha256 = hash('sha256', $email_tainted);  # hashing so that the user can choose only from a limited variety of inputs into genUserSpecificItemSpecificToken()
    $email_hash_param = genUserSpecificItemSpecificToken($email_sha256);

    $addr = getPageAddrWithAction("giftbookingattempt");
    $addr .= '&item_hash=' . $itemhash_param;
    $addr .= '&item_token=' . $item_token_param;
    $addr .= '&user_token=' . $user_token_param;
    $addr .= '&email=' . $email_param;
    $addr .= '&email_token=' . $email_hash_param;

    $meta = genMetaRedirect($addr, "3");

    $clippy = '
        <script type="text/javascript">
            function getRandomElem(array) {
                var i = Math.floor(Math.random()*(array.length));
                return array[i];
            }
            clippy_actions = ["Save", "Thinking", "SendMail", "EmptyTrash"];
            clippy_agent_custom_action_after_load = function() {
                var action = getRandomElem(clippy_actions);
                clippy_agent_public.play(action);
            }
        </script>
    ';
    $body .= $clippy;
    printHtmlPageBaseCustomMetaWithBgWithClippy($meta, $body);
}


/**
 * Handles request to print and prints giftbookingattempt page.
 * Might take up to 2 seconds to process.
 */
function handleGiftBookingAttempt()
{
    redirectToNoActionIfNotLoggedIn();

    $itemhash_tainted = getOrNull($_GET, "item_hash");
    $item_token_tainted = getOrNull($_GET, "item_token");
    $user_token_tainted = getOrNull($_GET, "user_token");
    $email_tainted = getOrNull($_GET, "email");
    $email_token_tainted = getOrNull($_GET, "email_token");
    if (null === $itemhash_tainted) {
        redirectToMainAfterLogin();
    }
    if (null === $item_token_tainted) {
        redirectToMainAfterLogin();
    }
    if (null === $user_token_tainted) {
        redirectToMainAfterLogin();
    }
    if (null === $email_tainted) {
        redirectToMainAfterLogin();
    }
    if (null === $email_token_tainted) {
        redirectToMainAfterLogin();
    }
    $user_token = genUserSpecificToken();
    if ($user_token_tainted !== $user_token) {
        redirectToMainAfterLogin();
    }
    # after this line, $user_token_tainted === $user_token

    $email_sha256 = hash('sha256', $email_tainted);  # hashing so that the user can choose only from a limited variety of inputs into genUserSpecificItemSpecificToken()
    $email_token = genUserSpecificItemSpecificToken($email_sha256);
    if ($email_token_tainted !== $email_token) {
        redirectToMainAfterLogin();
    }

    # after this line, $email_token_tainted === $email_token
    # after this line, $email_tainted might still contain evil data but it is exactly what the user (or MITM at the gift details page) entered

    $allItemFilenames = getAllItemFilenames();
    $allItemNames = getAllItemNames($allItemFilenames);
    $itemNameValidation = validateItemNames($allItemFilenames, $allItemNames);
    $validItemNames = getValidItemNames($itemNameValidation);
    $hashes = getItemNameHashes($validItemNames);
    $dict_hash_name = $hashes[1];
    $itemname = getOrNull($dict_hash_name, $itemhash_tainted);
    if (null === $itemname) {
        redirectToMainAfterLogin();
    }
    $itemhash = $itemhash_tainted;
    # below this line, $itemhash can only be a well-formed non-malicious hash (otherwise, the complementary item name wouldn't have been found)

    $item_token = genUserSpecificItemSpecificToken($itemname);
    if ($item_token_tainted !== $item_token) {
        redirectToMainAfterLogin();
    }
    # after this line, $item_token_tainted === $item_token

    $result_status_booking_failed_already_booked = false;
    $result_status_booking_failed_probably_race_condition = false;
    $result_status_booking_succeeded = false;
    $result_status_booking_failed_internal_logic_error = true;  # if the logic fails and this stays true, it all fails
    $result_status_logic_finished = false;  # don't try more things, it's already decided

    # detect whether already booked
    $booked_before = (readItemBooking($itemname) !== false);
    if ($booked_before) {
        $result_status_booking_failed_already_booked = true;
        $result_status_booking_failed_internal_logic_error = false;
    }

    if (!$result_status_logic_finished) {
        $booking_status = bookItem($itemname, $email_tainted);
        if ($booking_status) {
            $session_booking_note = "user_booked_item_" . $itemhash;
            $_SESSION[$session_booking_note] = true;
            $result_status_booking_succeeded = true;
            $result_status_booking_failed_internal_logic_error = false;
        } else {
            $result_status_booking_failed_probably_race_condition = true;
            $result_status_booking_failed_internal_logic_error = false;
        }
    }

    if ($result_status_booking_failed_internal_logic_error) {
        redirectToMainAfterLogin();
    }

    # detect if it was the user themselves and if so, change the logic results
    # if a user refreshes or somehow sends multiple requests, they all should succeed the same way
    if ($result_status_booking_failed_already_booked || $result_status_booking_failed_probably_race_condition) {
        sleep(1);  # so that there is a delay between the last reading of readItemBooking() and the following one
        $session_booking_note = "user_booked_item_" . $itemhash;
        $note_status = getOrNull($_SESSION, $session_booking_note);
        $booked_email = readItemBooking($itemname);
        $this_user_already_booked_from_session = (true === $note_status);
        $this_user_already_booked_from_email = ($email_tainted === $booked_email);
        $this_user_already_booked = ($this_user_already_booked_from_session || $this_user_already_booked_from_email);
        if ($this_user_already_booked) {
            $result_status_booking_succeeded = true;
            $result_status_booking_failed_already_booked = false;
            $result_status_booking_failed_probably_race_condition = false;
        }
    }

    if ($result_status_booking_succeeded) {
        partialHandleBookedGift($itemhash, $itemname, $email_tainted);
    } elseif ($result_status_booking_failed_probably_race_condition) {
        partialHandleBookGiftRaceCondition(true);
    } elseif ($result_status_booking_failed_already_booked) {
        partialHandleBookGiftRaceCondition(false);
    }

    # the code should never reach this line
    redirectToMainAfterLogin();
}


/**
 * Generates a form offering the chance to enter a note, to be displayed after successful booking.
 * $itemhash and $itemname must be verified non-malicious strings!
 * @param $itemhash
 * @param $itemname
 * @param $formNote1_tainted
 * @param $formNote2_tainted
 * @return string
 */
function genDivFormBookedGiftNote($itemhash, $itemname, $formNote1_tainted, $formNote2_tainted)
{
    global $BOOKED_GIFT_PLEASE_WRITE_MSG_NOTE;
    global $BOOKED_GIFT_PLEASE_WRITE_MSG_PLACEHOLDER;
    global $BOOKED_GIFT_PLEASE_WRITE_MSG_FIELDSET_LEGEND;
    global $BOOKED_GIFT_PLEASE_WRITE_MSG_SUBMIT;
    $inputNote = '<p><textarea name="input_note" maxlength="1799" class="uk-form-large uk-width-1-1" placeholder="' . $BOOKED_GIFT_PLEASE_WRITE_MSG_PLACEHOLDER . '" ></textarea></p>';
    $inputSubmit = '<p><input type="submit" name="input_submit" value="' . $BOOKED_GIFT_PLEASE_WRITE_MSG_SUBMIT . '" class="uk-button uk-button-primary uk-button-large uk-width-1-1" ></p>';
    # even an evil input can only result in client-side code execution, and a user can only attack themselves, because there is no other page where the note is rendered
    $formNote1 = '<p>' . htmlspecialchars($formNote1_tainted) . '</p>';
    $formNote2 = '<p>' . htmlspecialchars($formNote2_tainted) . '</p>';
    $formNote3 = '<p>' . $BOOKED_GIFT_PLEASE_WRITE_MSG_NOTE . '</p>';
    $inputHiddenUsertoken = '<input type="hidden" name="user_token" value="' . genUserSpecificToken() . '" >';
    $inputHiddenItemtoken = '<input type="hidden" name="item_token" value="' . genUserSpecificItemSpecificToken($itemname) . '" >';
    $formelements = $inputNote . $formNote1 . $formNote2 . $formNote3 . $inputSubmit . $inputHiddenUsertoken . $inputHiddenItemtoken;

    $fieldset = '<fieldset><legend>' . $BOOKED_GIFT_PLEASE_WRITE_MSG_FIELDSET_LEGEND . '</legend>' . $formelements . '</fieldset>';
    # action and itemhash as GET data
    $link = getPageAddrWithAction("giftdetails");
    $link .= '&itemhash=' . htmlspecialchars($itemhash);
    $form = '<form action="' . $link . '" method="post" class="uk-panel uk-panel-box uk-form">' . $fieldset . '</form>';

    return $form;
}


/**
 * Generates a page telling the user that booking was successful.
 * Not meant as a full-fledged handler, must not be called without first validating the data and the login.
 * @param $itemhash
 * @param $itemname
 * @param $email_tainted
 */
function partialHandleBookedGift($itemhash, $itemname, $email_tainted)
{
    redirectToNoActionIfNotLoggedIn();
    global $BOOKED_GIFT_PLEASE_WRITE_MSG_SUCCESS;
    $form = genDivFormBookedGiftNote($itemhash, $itemname, $BOOKED_GIFT_PLEASE_WRITE_MSG_SUCCESS, $email_tainted);
    $body = '<div>' . $form . '</div>';
    $body = '<div class="uk-vertical-align-middle" style="width: 100% ; max-width: 600px ; ">' . $body . '</div>';
    $body = '<div class="uk-vertical-align uk-text-center uk-width-1-1 uk-height-1-1" >' . $body . '</div>';
    $clippy = '
        <script type="text/javascript">
            function getRandomElem(array) {
                var i = Math.floor(Math.random()*(array.length));
                return array[i];
            }
            // some actions are there multiple times deliberately
            clippy_actions = [
                "IdleHeadScratch", "IdleHeadScratch", "IdleHeadScratch", "IdleFingerTap", "IdleFingerTap", "IdleFingerTap", "Writing", "Writing", "Writing", "Print", "LookRight", "LookRight", "LookRight", 
                "GetAttention", "Wave", "GetArtsy",
            ];
            clippy_delays = [25000, 13000, 13000, 7000, 55000];
            clippy_agent_custom_action_after_load = function() {
                clippy_agent_public.play("Congratulate");
                setTimeout(clippy_actions_0, 3000);
            };
            function clippy_actions_2() {
                var action = getRandomElem(clippy_actions);
                clippy_agent_public.play(action);
                var delay = getRandomElem(clippy_delays);
                setTimeout(clippy_actions_2, delay);
            }
            function clippy_actions_1() {
                clippy_agent_public.play("Writing");
                setTimeout(clippy_actions_2, 10000);
            }
            function clippy_actions_0() {
                clippy_agent_public.play("Congratulate");
                setTimeout(clippy_actions_1, 8000);
            }
        </script>
    ';
    $body .= $clippy;
    printHtmlPageBaseWithBgWithClippy($body);
}


/**
 * Generates a page telling the user that a race condition happened while booking.
 * Not meant as a full-fledged handler, must not be called without first validating the data and the login.
 * @param $race_condition_proper
 */
function partialHandleBookGiftRaceCondition($race_condition_proper)
{
    redirectToNoActionIfNotLoggedIn();
    global $BOOKING_RACE_SOMEONE_BOOKED_WHILE_YOU_VIEWED;
    global $BOOKING_RACE_CONDITION_PROPER;
    global $LINK_HOMEPAGE;
    $msg = $BOOKING_RACE_SOMEONE_BOOKED_WHILE_YOU_VIEWED;
    if ($race_condition_proper) {
        $msg = $BOOKING_RACE_CONDITION_PROPER;
    }
    $body = '<div class="uk-margin">' . $msg . '</div>';
    $body .= '<a href="' . getPageAddrWithAction("mainafterlogin") . '" class="uk-button uk-button-primary uk-button-large">' . $LINK_HOMEPAGE . '</a>';
    $body = '<div class="uk-panel uk-panel-box uk-form">' . $body . '</div>';
    $body = '<div class="uk-vertical-align-middle" style="width: auto ; max-width: 300px ; ">' . $body . '</div>';
    $body = '<div class="uk-vertical-align uk-text-center uk-width-1-1 uk-height-1-1" >' . $body . '</div>';
    $clippy = '
        <script type="text/javascript">
            clippy_agent_custom_action_after_load = function() {
                clippy_agent_public.play("Wave");
            }
        </script>
    ';
    $body .= $clippy;
    printHtmlPageBaseWithBgWithClippy($body);
}


/**
 * Generates a page telling the user that the email address they entered is wrong.
 * Not meant as a full-fledged handler, must not be called without first validating the data and the login.
 * @param $email_null
 * @param $email_too_short
 * @param $email_badly_formed
 */
function partialHandleBookGiftBadEmail($email_null, $email_too_short, $email_badly_formed)
{
    redirectToNoActionIfNotLoggedIn();
    global $BAD_EMAIL_NULL;
    global $BAD_EMAIL_BAD;
    global $LINK_HOMEPAGE;
    # assuming that if $email_badly_formed === true, we display this warning, and if it is also too short, the too short/null warnings take precedence
    # also assuming that if this function is called, the email is bad anyway
    $msg = $BAD_EMAIL_BAD;
    if ($email_too_short || $email_null) {
        $msg = $BAD_EMAIL_NULL;
    }
    $body = '<div class="uk-margin">' . $msg . '</div>';
    $body .= '<a href="' . getPageAddrWithAction("mainafterlogin") . '" class="uk-button uk-button-primary uk-button-large">' . $LINK_HOMEPAGE . '</a>';
    $body = '<div class="uk-panel uk-panel-box uk-form">' . $body . '</div>';
    $body = '<div class="uk-vertical-align-middle" style="width: auto ; max-width: 300px ; ">' . $body . '</div>';
    $body = '<div class="uk-vertical-align uk-text-center uk-width-1-1 uk-height-1-1" >' . $body . '</div>';
    $clippy = '
        <script type="text/javascript">
            clippy_agent_custom_action_after_load = function() {
                clippy_agent_public.play("Wave");
            }
        </script>
    ';
    $body .= $clippy;
    printHtmlPageBaseWithBgWithClippy($body);
}


/**
 * If not logged in, prints html page that meta refreshes to noaction (front page), then exit() is called.
 * If logged in, does nothing.
 */
function redirectToNoActionIfNotLoggedIn()
{
    # if not already logged in, meta redirect to noaction
    $logged_in = getOrNull($_SESSION, "logged_in");
    if (true !== $logged_in) {
        redirectToNoAction();
    }
}


/**
 * Prints html page that meta refreshes to noaction (front page), then exit() is called.
 */
function redirectToNoAction()
{
    refreshRedirectToActionAndDie("noaction");
}


/**
 * Handles request to print and prints noaction page (front page).
 */
function handleNoAction()
{
    # displays main page, a graphic, and a link for login

    global $FRONT_PAGE_TEXT;
    # insert your own graphic as html code here
    global $FRONT_PAGE_GRAPHIC;
    $result = "";
    $result .= '<a href="' . getPageAddrWithAction("login") . '" style="text-decoration:none;" >' . $FRONT_PAGE_GRAPHIC . '<br><br></a><br>';


    $meta = '';
    $head = '
        <style>
        body {
          background: url(background/front_bg.jpg);
          background-size: cover;
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-position: left center;
        }
        </style>
    ';
    $body = $result;
    # add clippy.js
    $body .= '
        <script type="text/javascript">
            function clippy_mainpage_2() {
                clippy_agent_public.play("GestureUp");
                setTimeout(clippy_mainpage_2, 7000);
            }
            function clippy_mainpage() {
                clippy_agent_public.show();
                clippy_agent_public.moveTo(width() - 400, height() - 150);
                clippy_agent_public.speak("' . $FRONT_PAGE_TEXT . '");
                setTimeout(clippy_mainpage_2, 5000);
            }
            setTimeout(clippy_mainpage, 7000);
        </script>
    ';
    printHtmlPageBaseCustomMetaHead($meta, $head, $body, false, true, false, true);
}


/**
 * Handles request to print and prints contacts page.
 */
function handleContacts()
{
    redirectToNoActionIfNotLoggedIn();
    $photos_exist = count(getAllPhotoDirnames()) > 1;
    if ($photos_exist) {
        redirectToMainAfterLogin();
    }
    global $CONTACTS_MSG_1;
    global $CONTACTS_MSG_2;
    global $CONTACTS_MSG_3;
    $body = '<p>' . $CONTACTS_MSG_1 . ' ';
    $body .= '<b>' . $CONTACTS_MSG_2 . '</b></p>';
    $body .= '<p>' . $CONTACTS_MSG_3 . '</p>';
    $body = '<div style="height: 100%; min-height: 300px;">' . $body . '</div>';
    printHtmlPageBaseWithBg($body);
}


/**
 * Handles request to print and prints listinvaliditemfiles page.
 */
function handleListInvalidItemFiles()
{
    $allItemFilenames = getAllItemFilenames();
    $allItemNames = getAllItemNames($allItemFilenames);
    $itemNameValidation = validateItemNames($allItemFilenames, $allItemNames);
    $validItemNames = getValidItemNames($itemNameValidation);
    $invalidItemNames = getInvalidItemNames($itemNameValidation);
    $body = "";
    foreach ($invalidItemNames as $itemname) {
        $body .= "<p>${itemname}</p>";
    }
    printHtmlPageBase($body);
}

/**
 * Prints html page that meta refreshes to logout, then exit() is called.
 */
function redirectToLogOut()
{
    refreshRedirectToActionAndDie("logout");
}


/**
 * Handles request to print and prints logout page.
 */
function handleLogout()
{
    secureSessionTeardown();
    redirectToNoAction();
}


/**
 * Handles request to the page determined by the $action parameter.
 * Runs the relevant page handler based on the $action parameter.
 * @param $action
 */
function handleAction($action)
{
    # WARNING! print nothing here, handlers use redirects and http headers and these require that nothing is printed

    # each handler has to check the input conditions on its own - e.g. if login is required

    # The content-generating calls must be mutually exclusive - only one can be called (so that two pages are not mixed together)

    if ("login" === $action) {
        # displays login form
        handleLogin();
    } elseif ("logout" === $action) {
        # logs out
        handleLogout();
    } elseif ("validatelogin" === $action) {
        # validates login credentials
        handleValidateLogin();
    } elseif ("mainafterlogin" === $action) {
        # displays the main content after login - list of gifts
        handleMainAfterLogin();
    } elseif ("giftdetails" === $action) {
        # displays a form to book the selected gift
        handleGiftDetails();
    } elseif ("giftbookingbeginning" === $action) {
        # displays a message "please wait" because the booking action that is about to happen is going to take up to 2 seconds
        handleGiftBookingBeginning();
    } elseif ("giftbookingattempt" === $action) {
        # tries to book the gift
        handleGiftBookingAttempt();
    } elseif ("displayjpg" === $action) {
        # tries to book the gift
        handleGalleryJpg();
    } elseif ("contacts" === $action) {
        # display contacts page
        handleContacts();
    } elseif ("noaction" === $action) {
        # displays main page, a graphic, link to login
        handleNoAction();
    } elseif ("listinvaliditemfiles" === $action) {
        # displays a list of files that do not comprise valid item files
        handleListInvalidItemFiles();
    } else {
        # displays main page, a graphic, link to login
        handleNoAction();
    }
}


/**
 * This function should run as the very first thing that is executed.
 * It sets up the session.
 */
function pageInitEveryTime()
{
    # nothing in there can print because we need to set the headers first
    secureSessionSetup();
}

# note: if you want to add code that is executed (a call to a function, ...), do so below this line (above are only function definitions)

pageInitEveryTime();

# note: do not print the html before calling action handlers because they sometimes use http headers and meta redirects
# note: print the surrounding html only after the handler knows it wants to print it

if (isset($_GET["action"])) {
    handleAction($_GET["action"]);
} else {
    handleNoAction();
}

?>
