==============================================
# Readme for php-typogrify
==============================================
by Hamish Macpherson (http://hamstu.com)

# What is it?
----------------------------------------------
php-typogrify is a PHP library and WordPress plugin that "Prettifies your 
web typography by preventing ugly quotes and 'widows' and providing CSS 
hooks to style some special cases." 

It's a port of the original 'typogrify' Python code by Christian Metts.
<http://code.google.com/p/typogrify/>

# What can it do?
----------------------------------------------
   * Widon't (tries to prevent text 'widows', where only one word wraps at the end of a line)
   * Run text through SmartyPants, <http://www.michelf.com/projects/php-smartypants/>
   * Wrap initial quotes (and French style (Guillemets) quotes) in class='dquo' or class='quo' depending on if they are single or double
   * Wrap ampersands in class='amp'
   * Wrap multiple adjacent capital letters in class='caps'
   * Add a thinspace before and after en and em dashes
   * And of course it has a function to do all of the above

# Install
----------------------------------------------
IN WORDPRESS:
    Requires WordPress 2.04+
    Just copy the php-typogrify folder into 'wp-content/plugins/' 
    then enable it in the admin menu.
    
    See the options in WP Admin->Options->Typogrify
    Also see Usage notes below!

OTHER:
    Just include() or require() php-typogrify.php in in your PHP code. 
    See usage below for more info.

# Usage
----------------------------------------------
IN WORDPRESS:
    php-typogrify works automagically, so you usually won't need to do anything more 
    than enable the plugin. If you want finer control, checkout the options in WP Admin->Options->Typogrify.

USAGE IN PHP:
    If you would like to use php-typogrify in your own projects, I suggest you look at the 
    source code. It's should be pretty straightforward.
    
    Most of the time you'll want to use the 'typogrify( $text );' function. e.g.,
    
    <?php
    
        require("php-typogrify.php");
        
        $sometext = '<h2>"Jayhawks" & KU fans act extremely obnoxiously</h2>';        
        $sometext = typogrify($sometext);
        
        echo $sometext;
        // <h2><span class="dquo">&#8220;</span>Jayhawks&#8221; <span class="amp">&amp;</span> <span class="caps">KU</span> fans act extremely&nbsp;obnoxiously</h2>
    
    ?>

# Support
----------------------------------------------
Having problems? Need help? Please contact me.
http://blog.hamstu.com/contact/

Changelog
----------------------------------------------
Version 1.6
	- Updated to reflect support for Wordpress 2.5
	- To avoid further annoyances; post titles in Wordpress are no longer typogrified.
	- Adjusted dash function to protect from wrapping an already wrapped em/en dash with a thin space.

Version 1.5.3
	- Fixed a bug where ampersands weren't being detected and wrapped.	

Version 1.5.2
	- Submitting this version to wp-extend
	- Updated README (to conform to wp-extend standards)
	
Version 1.5.1
	- Fixed a typo in the widont function
	
Version 1.5
	- No real code updates. Just added some info on how to fix a common bug. (See README, Usage section)
	- Oh, and it now secretly incorporates a complex (yet hidden) algorithm which makes the user more attractive to the opposite sex. Please note this IS A BETA FEATURE, I take no responsibility for any consequences due to this addition. (i.e., loss of hair, girlfriend, desire to eat vegetables, and so on)
	
Version 1.4
	- Fixed some more small bugs in the widont code
	- Added a Typogrify options menu in the Wordpress admin
	- Added support for French style Guillemet quotes. (Also used in some other lanaguages). Thanks to Vladimir for the suggestion.
	- wp-typogrify now adds &thinsp; before and after en and em dashes. Thanks to John (http://ilovetypography.com/) for the idea.
	 
Version 1.3
	- Fixed bug where widont was adding &nbsp; inside certain tags.
	
Version 1.2
	- Realized that the updated widont wasn't HTML aware, and in fact, borked the functionality. Created a customized version which should work.

Version 1.1
	- Updated widon't to use latest version from Shaun Inman.

Version 1.0
    - Initial Release.

# License
----------------------------------------------

    Copyright (c) 2007, Hamish Macpherson

    All rights reserved.

    Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

       * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
       * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
       * Neither the name of the php-typogrify nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.

    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
    "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
    LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
    A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
    CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
    EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
    PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
    PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
    LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
    NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
    SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
    