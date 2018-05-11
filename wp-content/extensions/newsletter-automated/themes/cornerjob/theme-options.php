<?php
/*
 * This is a pre packaged theme options page. Every option name
 * must start with "theme_" so Newsletter can distinguish them from other
 * options that are specific to the object using the theme.
 *
 * An array of theme default options should always be present and that default options
 * should be merged with the current complete set of options as shown below.
 *
 * Every theme can define its own set of options, the will be used in the theme.php
 * file while composing the email body. Newsletter knows nothing about theme options
 * (other than saving them) and does not use or relies on any of them.
 *
 * For multilanguage purpose you can actually check the constants "WP_LANG", until
 * a decent system will be implemented.
 */
$theme_defaults = array(
    // colors:
    'theme_color'               => '#009ac8',
    'theme_title_background'    => '#01526d',
    'theme_title_color'         => '#ffffff',
    'theme_read_more_color'     => '#009ac8',
    'theme_post_title_color'    => '#000000',

    // font-family:
    'theme_font_family' => 'Arial, Helvetica, sans-serif',
    'theme_titles_font_family' => 'Montserrat, sans-serif',

    // posts:
    'theme_post_image_size' => 'medium',
    'theme_full_post' => '0',

    // texts:
    'theme_view_online_label' => 'Click here if this email doesn\'t show properly',
    'theme_title' => '',
    'theme_header' => '',
    'theme_footer_left' => '',
    'theme_footer_right' => '',
    'theme_footer' => '<p>You\'re receiving this email because you subscribed to it at ' . get_option('blogname') .
    ' as {email}.</p><p>To modify or cancel your subscription, <a href="{profile_url}">click here</a>.',
    'theme_read_more_label' => 'Read more',
);



// Mandatory!
$controls->merge_defaults($theme_defaults);
$fonts = array(
    'Montserrat, sans-serif'        => 'Montserrat',
    'Arial, Helvetica, sans-serif'  => 'Arial, Helvetica',
    'Verdana, Arial, sans-serif'    => 'Verdana', 
    'Tahoma, Arial, sans-serif'     => 'Tahoma',  
    'Trebuchet MS, sans-serif'      => 'Trebuchet MS', 
    'Georgia, Times, serif'         => 'Georgia'
);
?>
<p>This theme (for perfect rendering) requires posts with featured images large at least 600 pixel.</p>
<div class="accordion">
    <h3>Header</h3>
    <div>
        <table class="form-table">
            <tr valign="top">
                <th>Text for "View online" link</th>
                <td>
                    <?php $controls->text('theme_view_online_label', 70); ?>
                </td>
            </tr>

            <tr valign="top">
                <th>Logo</th>
                <td>
                    <?php $controls->media('theme_logo'); ?>
                </td>
            </tr>

            <tr valign="top">
                <th>Title</th>
                <td>
                    <?php $controls->text('theme_title', 70); ?>
                </td>
            </tr>

            <tr valign="top">
                <th>Style</th>
                <td>
                    <?php $controls->color('theme_title_background', 'Header Background'); ?><br>
                    <?php $controls->color('theme_title_color', 'Title color'); ?><br>
                    <?php $controls->select('theme_titles_font_family', $fonts, null, 'Titles Font'); ?>
                </td>
            </tr>

        </table>
    </div>

    <h3>Content</h3>
    <div>
        <table class="form-table"> 
            <tr valign="top">
                <th>Introduction</th>
                <td>
                    <p class="description">Content before the posts list (optional).</p>
                    <?php $controls->wp_editor('theme_header'); ?>
                </td>
            </tr>
            <tr valign="top">
                <th>Post titles color</th>
                <td>
                    <?php $controls->color('theme_post_title_color', 'Color'); ?><br>
                </td>
            </tr>
            <tr valign="top">
                <th>Read more label</th>
                <td>
                    <?php $controls->text('theme_read_more_label', 50); ?><br>
                    <?php $controls->color('theme_read_more_color', 'Background color'); ?>
                </td>
            </tr> 
        </table>
    </div>
    <h3>Footer</h3>
    <div>
        <table class="form-table">
            <tr valign="top">
                <th>Footer left column</th>
                <td>
                    <?php $controls->wp_editor('theme_footer_left'); ?>
                </td>
            </tr>
            <tr valign="top">
                <th>Footer right column</th>
                <td>
                    <?php $controls->wp_editor('theme_footer_right'); ?>
                </td>
            </tr>
            <tr valign="top">
                <th>Bottom message</th>
                <td>
                    <?php $controls->wp_editor('theme_footer'); ?>
                    <p class="description">
                        Write here your copyright notice and your address. Remeber to add the {profile_url} and eventually the {unsubscription_url}
                    </p>
                </td>
            </tr>
        </table>
    </div>
</div>