<?php
/*
	Plugin Name: wp-typogrify
	Plugin URI: http://blog.hamstu.com/
	Description: wp-Typogrify is dead.  wp-Typogrify has merged with wp-Hyphenate to become <a href="http://wordpress.org/extend/plugins/wp-typography/">wp-Typography</a>, an all-inclusive typography solution. Long live wp-Typogrify!
	
	Version: 1.6.1
	Author: Hamish Macpherson
	Author URI: http://www.hamstu.com/
*/

$cver = "1.6";

require("php-typogrify.php");

function typogrify_activate( )
{
	add_option("typo_do_amp", "yes");
	add_option("typo_do_widont", "yes");
	add_option("typo_do_smartypants", "yes");
	add_option("typo_do_caps", "yes");
	add_option("typo_do_initial_quotes", "yes");
	add_option("typo_do_guillemets", "yes");
	add_option("typo_do_dash", "yes");
}

function typogrify_add_pages( )
{
	add_options_page('Typogrify', 'Typogrify', 8, 'typogrifyoptions', 'typogrify_options_page');
}

function typogrify_options_page( )
{
	if ($_POST['secret'])
	{
		foreach (array("typo_do_amp", "typo_do_widont", "typo_do_smartypants", "typo_do_caps", "typo_do_initial_quotes", "typo_do_guillemets", "typo_do_dash") as $item)
		{
			if (isset($_POST[$item]))
			{
				update_option($item, "yes");				
			}
			else
			{
				update_option($item, "no");				
			}
		}
	}
		
	global $cver;
	echo "<div class='wrap'>";
	echo "<h2>Typogrify Options</h2>";
	echo "wp-Typogrify is dead.  wp-Typogrify has merged with wp-Hyphenate to become <a href='http://wordpress.org/extend/plugins/wp-typography/'>wp-Typography</a>, an all-inclusive typography solution. Long live wp-Typogrify!";
	?>
		
	<form action="" method="post">		
		<?php wp_nonce_field('update-options') ?>	
		<h3>Standard Options</h3>
		<ul>
			<li>
				<label for="typo_do_amp"><input type="checkbox" name="typo_do_amp" <?php echo (get_option('typo_do_amp') == "yes" ? "checked='checked'" : ""); ?> /> Add <code>&lt;span class=&quot;amp&quot;&gt;</code> to ampersands.</label>
			</li>
			<li>
				<label for="typo_do_widont"><input type="checkbox" name="typo_do_widont" <?php echo (get_option('typo_do_widont') == "yes" ? "checked='checked'" : ""); ?> /> Try to prevent <a href="http://en.wikipedia.org/wiki/Widows_and_orphans">widows</a> by adding <code>&amp;nbsp;</code> between the last two words in blocks of text.</label>
			</li>
			<li>
				<label for="typo_do_smartypants"><input type="checkbox" name="typo_do_smartypants" <?php echo (get_option('typo_do_smartypants') == "yes" ? "checked='checked'" : ""); ?> /> Apply <a href="http://michelf.com/projects/php-smartypants/">SmartyPants</a> to text.</label>
			</li>
			<li>
				<label for="typo_do_caps"><input type="checkbox" name="typo_do_caps" <?php echo (get_option('typo_do_caps') == "yes" ? "checked='checked'" : ""); ?> /> Add <code>&lt;span class=&quot;caps&quot;&gt;</code> to consecutive capital letters (acronyms, etc.).</label>
			</li>
			<li>
				<label for="typo_do_initial_quotes"><input type="checkbox" name="typo_do_initial_quotes" <?php echo (get_option('typo_do_initial_quotes') == "yes" ? "checked='checked'" : ""); ?> /> Add <code>&lt;span class=&quot;dquo&quot;&gt;</code> to initial double quotes, and <code>&lt;span class=&quot;quo&quot;&gt;</code> to initial single quotes.</label>
			</li>
		</ul>
		<h3>Special Options</h3>
		<ul>
			<li>
				<label for="typo_do_guillemets"><input type="checkbox" name="typo_do_guillemets" <?php echo (get_option('typo_do_guillemets') == "yes" ? "checked='checked'" : ""); ?> /> Add <code>&lt;span class=&quot;dquo&quot;&gt;</code> to initial <a href="http://en.wikipedia.org/wiki/Guillemet">Guillemets</a> (&laquo; or &raquo;) as well.</label>
			</li>
			<li>
				<label for="typo_do_dash"><input type="checkbox" name="typo_do_dash" <?php echo (get_option('typo_do_dash') == "yes" ? "checked='checked'" : ""); ?> /> Add thin spaces (<code>&amp;thinsp;</code>) to both sides of em and en dashes.</label>
			</li>
		</ul>
		<p class="submit">
			<input type="submit" name="Submit" value="Update Options &raquo;" />
		</p>
		<input type="hidden" name="secret" value="bla" />
	</form>
	
	<?php
	echo "</div>";
}

function wptypogrify( $text )
{
    if (get_option("typo_do_amp") == "yes")
    {
    	$text = amp( $text );
	}
    if (get_option("typo_do_widont") == "yes")
    {
    	$text = widont( $text );
	}
	if (get_option("typo_do_smartypants") == "yes")
    {
    	$text = SmartyPants( $text );
    }
    if (get_option("typo_do_caps") == "yes")
    {
    	$text = caps( $text );
    }
    if (get_option("typo_do_initial_quotes") == "yes")
    {
    	$text = initial_quotes( $text );
    }
    
    if (get_option("typo_do_guillemets") == "yes")
    {
    	$text = initial_quotes( $text, true );
    }
    
    if (get_option("typo_do_dash") == "yes")
    {
    	$text = dash( $text );
    }
    
    return $text;
}

add_action('admin_menu', 'typogrify_add_pages');
register_activation_hook('__FILE__', 'typogrify_activate'); 

// Remove default Texturize filter that would conflict with php-typogrify.
// Pulled this bit from smartypants.php

remove_filter('category_description', 'wptexturize');
remove_filter('list_cats', 'wptexturize');
remove_filter('comment_author', 'wptexturize');
remove_filter('comment_text', 'wptexturize');
remove_filter('single_post_title', 'wptexturize');
//remove_filter('the_title', 'wptexturize');
remove_filter('the_content', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');

// Add php-typogrify filter with priority 10 (same as Texturize).
add_filter('category_description', 'wptypogrify', 9999);
add_filter('list_cats', 'wptypogrify', 9999);
add_filter('comment_author', 'wptypogrify', 9999);
add_filter('comment_text', 'wptypogrify', 9999);
add_filter('single_post_title', 'wptypogrify', 9999);
//add_filter('the_title', 'wptypogrify', 9999);
add_filter('the_content', 'wptypogrify', 9999);
add_filter('the_excerpt', 'wptypogrify', 9999);

// Strip the potential HTML in the header
add_filter('wp_title', 'strip_tags');


?>