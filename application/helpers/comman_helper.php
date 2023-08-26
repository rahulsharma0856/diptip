<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('asset_sm')) {

    function asset_sm($path = NULL)
    {
        return base_url() . 'asset/app_social_media/' . $path;
    }
}

if (! function_exists('asset_path')) {

    function asset_path($path = NULL)
    {
        return base_url() . 'asset/' . $path;
    }
}

if (! function_exists('file_path')) {

    function file_path($eid = NULL)
    {
        if ($eid != '') {
            return base_url() . $eid . '/';
        } else {
            return base_url();
        }
    }
}

if (! function_exists('upload_path')) {

    function upload_path()
    {
        return base_url() . 'upload/';
    }
}

function is_logged_admin($adm = NULL)
{
    $CI = & get_instance();

    $user = $CI->session->userdata('smr_web_login_admin');

    if (is_array($user) && $user['login'] == 'true') {

        if ($user['admin'] == 'true') {

            return true;
        } 
        elseif ($adm == 'adm_member') {

            if (is_adm_member()) {

                return true;
            }
        }

        return false;
    } 
    else {
        return false;
    }
}

function is_adm_member($redirect)
{
    $CI = & get_instance();

    $user = $CI->session->userdata('smr_web_login_admin');

    if (is_array($user) && $user['login'] == 'true' && $user['adm_member'] == 'true') {

        if ($redirect == true) {

            header('Location: ' . file_path('admin') . 'testimonial/view/');

            exit();
        }

        return true;
    } else {

        return false;
    }
}

function is_logged_user()
{
    $CI = &get_instance();

    $user = $CI->session->userdata('smr_web_login');

    if (is_array($user) && $user['login'] == 'true') {
        return true;
    } else {
        return false;
    }
}

if (! function_exists('filter_data')) {

    // WARNING: Please avoid using this!!!
    // - The built in 'xss_clean()' function of CI strips and replaces some needed things.
    // - We are using HTMLPurifier instead!
    function filter_data($data)
    {
        $CI = & get_instance();
        
        $data = $CI->security->xss_clean($data);

        if (is_array($data)) {

            foreach ($data as $key => &$value) {

                $value = stripslashes($value);

                //$value = strip_tags($value); // This function strips out ALL html flags..
                
                $value = htmlspecialchars($value);

                $data[$key] = $value;
            }
        }
        
        $data = filter_message($data);

        return $data;
    }
}

if (! function_exists('filter_tag')) {

    function filter_tag($text)
    {
        // PHP's strip_tags() function will remove tags, but it
        // doesn't remove scripts, styles, and other unwanted
        // invisible text between tags. Also, as a prelude to
        // tokenizing the text, we need to insure that when
        // block-level tags (such as <p> or <div>) are removed,
        // neighboring words aren't joined.
        $text = preg_replace(array(
            // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',

            // Add line breaks before & after blocks
            '@<((br)|(hr))@iu',
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu'
        ), array(
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
            "\n\$0",
            "\n\$0",
            "\n\$0",
            "\n\$0",
            "\n\$0",
            "\n\$0",
            "\n\$0",
            "\n\$0"
        ), $text);

        // Remove all remaining tags and comments and return.
        $text = strip_tags($text);

        return getUrls(nl2br($text));
        return $text;
    }
}

if (! function_exists('filter_xss')) {

    // WARNING: Please avoid using this!!!
    // - The built in 'xss_clean()' function of CI strips and replaces some needed things.
    // - We are using HTMLPurifier instead!
    function filter_xss($data)
    {
        $CI = & get_instance();

        $data = $CI->security->xss_clean($data);

        return $data;
    }
}

if (! function_exists('media_path')) {

    function media_path($folder)
    {
        $path = FCPATH . 'upload/media/';

        return $path;
    }
}

if (! function_exists('upload_file')) {

    function upload_file($folder)
    {
        $path = FCPATH . 'upload/';

        return $path;
    }
}

if (! function_exists('filesize_formatted')) {

    function filesize_formatted($size)
    {
        $units = array(
            'B',
            'KB',
            'MB',
            'GB',
            'TB',
            'PB',
            'EB',
            'ZB',
            'YB'
        );

        $power = $size > 0 ? floor(log($size, 1024)) : 0;

        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}

if (! function_exists('get_element_in_array')) {

    function get_element_in_array($data, $key)
    {
        $arr = array();

        for ($i = 0; $i < count($data); $i ++) {

            $arr[] = $data[$i][$key];
        }

        return $arr;
    }
}

if (! function_exists('get_wallect_type')) {

    function get_wallect_type($type)
    {

        // 'Coin_Wallet','System_Wallet','Referral_Wallet','Manager_Wallet'
        if ($type == 'Coin_Wallet') {

            return 'C.W.';
        } else if ($type == 'System_Wallet') {
            return 'S.W.';
        } else if ($type == 'Referral_Wallet') {
            return 'R.W.';
        } else if ($type == 'Manager_Wallet') {
            return 'M.W.';
        }
    }
}

if (! function_exists('s_datediff')) {

    function s_datediff($str_interval, $dt_menor, $dt_maior, $relative = false)
    {
        if (is_string($dt_menor))
            $dt_menor = date_create($dt_menor);
        if (is_string($dt_maior))
            $dt_maior = date_create($dt_maior);

        $diff = date_diff($dt_menor, $dt_maior, ! $relative);

        switch ($str_interval) {
            case "y":
                $total = $diff->y + $diff->m / 12 + $diff->d / 365.25;
                break;
            case "m":
                $total = $diff->y * 12 + $diff->m + $diff->d / 30 + $diff->h / 24;
                break;
            case "d":
                $total = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h / 24 + $diff->i / 60;
                break;
            case "h":
                $total = ($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h + $diff->i / 60;
                break;
            case "i":
                $total = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i + $diff->s / 60;
                break;
            case "s":
                $total = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i) * 60 + $diff->s;
                break;
        }

        if ($diff->invert)
            return - 1 * $total;
        else
            return $total;
    }
}

if (! function_exists('ago_time')) {

    function ago_time($timestamp)
    {
        $then = date_create($timestamp);

        // for anything over 1 day, make it rollover on midnight
        $today = date_create('tomorrow'); // ie end of today
        $diff = date_diff($then, $today);

        if ($diff->y > 0)
            return $diff->y . ' year' . ($diff->y > 1 ? 's' : '') . ' ago';
        if ($diff->m > 0)
            return $diff->m . ' month' . ($diff->m > 1 ? 's' : '') . ' ago';
        $diffW = floor($diff->d / 7);
        if ($diffW > 0)
            return $diffW . ' week' . ($diffW > 1 ? 's' : '') . ' ago';
        if ($diff->d > 1)
            return $diff->d . ' day' . ($diff->d > 1 ? 's' : '') . ' ago';

        // for anything less than 1 day, base it off 'now'
        $now = date_create();
        $diff = date_diff($then, $now);

        if ($diff->d > 0)
            return 'yesterday';
        if ($diff->h > 0)
            return $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
        if ($diff->i > 0)
            return $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ago';
        return $diff->s . ' second' . ($diff->s == 1 ? '' : 's') . ' ago';
    }
}

if (! function_exists('youtube_video')) {

    function youtube_video($link)
    {
        if (strpos($link, 'embed') !== false) {
            $u = explode('/', $link);
            $u = explode('?', $u[4]);
            $video_id = $u[0];
        } else {
            $u = explode('=', $link);
            $video_id = $u[1];
        }
        return $video_id;
    }
}

if (! function_exists('user_session')) {

    function user_session($key)
    {
        $CI = & get_instance();

        $user = $CI->session->userdata('smr_web_login');

        if (isset($user[$key])) {

            return $user[$key];
        } else {

            return false;
        }
    }
}

if (! function_exists('time_ago')) {

    function time_ago($timestamp)
    {
        $time_ago = $timestamp;
        $current_time = time();
        $time_difference = $current_time - $time_ago;
        $seconds = $time_difference;
        $minutes = round($seconds / 60); // value 60 is seconds
        $hours = round($seconds / 3600); // value 3600 is 60 minutes * 60 sec
        $days = round($seconds / 86400); // 86400 = 24 * 60 * 60;
        $weeks = round($seconds / 604800); // 7*24*60*60;
        $months = round($seconds / 2629440); // ((365+365+365+365+366)/5/12)*24*60*60
        $years = round($seconds / 31553280); // (365+365+365+365+366)/5 * 24 * 60 * 60
        if ($seconds <= 60) {
            return "Just Now";
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "1 min";
            } else {
                return "$minutes min";
            }
        } 
        else if ($hours <= 24) {
            if ($hours == 1) {
                return "an hour ago";
            } else {
                return "$hours hrs ";
            }
        } 
        else if ($days <= 7) {
            if ($days == 1) {
                return "yesterday";
            } else {
                return "$days days";
            }
        } 
        else if ($weeks <= 4.3) // 4.3 == 52/12
        {
            if ($weeks == 1) {
                return "a week";
            } else {
                return "$weeks w";
            }
        } 
        else if ($months <= 12) {

            if ($months == 1) {
                return "a month ago";
            } else {
                return "$months m";
            }
        } else {
            if ($years == 1) {
                return "one year ago";
            } else {
                return "$years y";
            }
        }
    }
}

if (! function_exists('getPostImageClass')) {

    function getPostImageClass($count = NULL)
    {
        if ($count == 1) {

            $class = array(
                'noclass'
            );

            $size = array(
                '0-0'
            );
        } elseif ($count == 2) {

            $class = array(
                'half-width',
                'half-width'
            );

            $size = array(
                '350-0',
                '350-0'
            );
        } elseif ($count == 3) {

            $class = array(
                'noclass',
                'half-width',
                'half-width'
            );

            $size = array(
                '0-0',
                '350-350',
                '350-350'
            );
        } elseif ($count == 4) {

            $class = array(
                'half-width',
                'half-width',
                'half-width',
                'half-width'
            );

            $size = array(
                '350-350',
                '350-350',
                '350-350',
                '350-350'
            );
        } else {

            if ($count > 5) {

                $class = array(
                    'half-width',
                    'half-width',
                    'col-3-width',
                    'col-3-width',
                    'more-photos col-3-width'
                );
            } else {

                $class = array(
                    'half-width',
                    'half-width',
                    'col-3-width',
                    'col-3-width',
                    'col-3-width'
                );
            }

            $size = array(
                '350-350',
                '350-350',
                '250-250',
                '250-250',
                '250-250'
            );
        }

        return array(
            'class' => $class,
            'size' => $size
        );
    }
}

if (! function_exists('thumb')) {

    function thumb($fullname = NULL, $width = NULL, $height = NULL)
    {

        // Path to image thumbnail in your root
        $dir = './upload/post/';

        $url = base_url() . 'upload/post/';

        // Get the CodeIgniter super object

        // get src file's extension and file name

        $extension = pathinfo($fullname, PATHINFO_EXTENSION);

        $filename = pathinfo($fullname, PATHINFO_FILENAME);

        $image_org = $dir . $filename . "." . $extension;

        $image_thumb = $dir . $filename . "-" . $height . '_' . $width . "." . $extension;

        $image_returned = $url . $filename . "-" . $height . '_' . $width . "." . $extension;

        if ($width == 0 || ! isset($width)) {

            return $url . $filename . "." . $extension;
        }

        if (! file_exists($image_thumb)) {

            // LOAD LIBRARY

            $CI = &get_instance();

            $CI->load->library('image_lib');

            // CONFIGURE IMAGE LIBRARY

            $config['source_image'] = $image_org;

            $config['new_image'] = $image_thumb;

            $config['width'] = $width;

            $config['height'] = $height;

            $CI->image_lib->initialize($config);

            $CI->image_lib->fit();

            $CI->image_lib->clear();
        }
        return $image_returned;
    }
}

if (! function_exists('chat_thumb')) {

    function chat_thumb($fullname = NULL, $width = NULL, $height = NULL)
    {

        // Path to image thumbnail in your root
        $dir = './upload/chat/';

        $url = base_url() . 'upload/chat/';

        // Get the CodeIgniter super object

        // get src file's extension and file name

        $extension = pathinfo($fullname, PATHINFO_EXTENSION);

        $filename = pathinfo($fullname, PATHINFO_FILENAME);

        $image_org = $dir . $filename . "." . $extension;

        $image_thumb = $dir . $filename . "-" . $height . '_' . $width . "." . $extension;

        $image_returned = $url . $filename . "-" . $height . '_' . $width . "." . $extension;

        if ($width == 0 || ! isset($width)) {

            return $url . $filename . "." . $extension;
        }

        if (! file_exists($image_thumb)) {

            // LOAD LIBRARY

            $CI = &get_instance();

            $CI->load->library('image_lib');

            // CONFIGURE IMAGE LIBRARY

            $config['source_image'] = $image_org;

            $config['new_image'] = $image_thumb;

            $config['width'] = $width;

            $config['height'] = $height;

            $CI->image_lib->initialize($config);

            $CI->image_lib->fit();

            $CI->image_lib->clear();
        }

        return $image_returned;
    }
}

if (! function_exists('img_path')) {

    function img_path($image_name = NULL, $folder = NULL, $default = NULL)
    {
        $image_path = './upload/' . $folder . '/' . $image_name;

        $url = base_url() . 'upload/' . $folder . '/';

        if (! file_exists($image_path)) {

            return base_url('upload/' . $folder . '/' . $default);
        } else {

            return base_url('upload/' . $folder . '/' . $image_name);
        }
    }
}

function getUrls($string)
{
    $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';

    $string = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $string);

    return $string;
}

function findURLTurnToClickableLink($string)
{

    // FIND URLS INSIDE TEXT
    // The Regular Expression filter
    $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?Â«Â»â€œâ€�â€˜â€™]))/";

    // Check if there is a url in the text
    if (preg_match($reg_exUrl, $string, $url)) {

        if (strpos($url[0], ":") === false) {
            $link = 'http://' . $url[0];
        } else {
            $link = $url[0];
        }

        // make the urls hyper links
        $string = preg_replace($reg_exUrl, '<a href="' . $link . '" title="' . $url[0] . '" target="_blank">' . $url[0] . '</a>', $string);
    }

    return $string;
}

function ProfileImg($name = NULL)
{
    if ($name != "" && $name != NULL) {
        return $name;
    } else {
        return "profile.png";
    }
}

/*
 * Basic filter text for malicious code tags.  Adjusts formatting & characters for safety..
 * - Does NOT use HTMLPurifier
 *
 * @param Text $text Input text
 *
 * @author squidicuz <squid@sqdmc.net>
 * @returns Text
 */
function filter_text($text) {

    // Get the CI Instance    
    //$CI = & get_instance();
    
    // Strips the text of malicious xss tags.
    // -- This method leaves artifacts in the result and breaks other things we may need.. try to avoid using!  :(
    //$text = $CI->security->xss_clean($text);
    
    if (is_array($text)) {
        
        foreach ($text as $key => &$value) {
            
            // This fixes newlines..
            //$value = str_replace(["\n"], ["<br/>"], $value);
            
            $value = stripslashes($value);
            
            //$value = strip_tags($value);
            
            $value = htmlspecialchars($value);
            
            $text[$key] = $value;
            
        }
        
    } else {
        
        // This fixes newlines..
        //$text = str_replace(["\n"], ["<br/>"], $text);
        
        $text = stripslashes($text);
        
        $text = htmlspecialchars($text);
        
    }
    
    // Return the resulting applied filtered text
    return $text;
}

/*
 * Filters Emoji into input text with placeholders replaced with emoji <img> tags
 * - Parses Emoji
 *
 * @param Text $text Input text
 *
 * @author squidicuz <squid@sqdmc.net>
 * @returns Text
 */
function filter_emoji($text) {

    // Get the CI Instance
    $CI = &get_instance();
    
    // *******************************
    // Load the Emoji Libraries
    $CI->load->library('squidoji/Squidoji');
    
    // Create new Emoji Object
    $emoji = new Squidoji();
    
    // *********************************************
    // This adds the emoji.  Replaces matching placeholder tags with <img>
    $text = $emoji->text($text);
 
    // Return the resulting applied filtered text with included emoji
    return $text;
}


function filter_post($text) {
	return $text;
    // Get the CI Instance
    $CI = &get_instance();

    // *******************************
    // Load the Parsedown Libraries
    $CI->load->library('parsedown/Parsedown');
    $CI->load->library('parsedown/ParsedownExtra');
    $CI->load->library('parsedown/ParsedownExtraPlugin');

    // Create new Parsedown Object
    $parsedown = new ParsedownExtraPlugin();

    // Setup Parsedown
    $parsedown->setMarkupEscaped(true);
    $parsedown->setUrlsLinked(true);
    $parsedown->setStrictMode(false);
    $parsedown->setBreaksEnabled(true);

    // code class lang
    $parsedown->code_class = 'lang-%s';

    // custom link attributes
    $parsedown->links_attr = array(
        'title' => 'This is an Internal OR Known Link.'
    );

    // custom external link attributes
    $parsedown->links_external_attr = array(
        'rel' => 'nofollow',
        'target' => '_blank',
        'title' => 'CAUTION!!  This Link Leads to External Content..'
    );

    // custom external image attributes
    $parsedown->images_external_attr = array(
        'title' => 'CAUTION!!  This Image Content Exists Externally..'
    );

    // Markdown footnotes..
    $parsedown->footnote_class = 'footnotes';
    $parsedown->footnote_link_id = 'cite_note:%s';
    $parsedown->footnote_link_class = 'footnotes-ref';
    $parsedown->footnote_link_text = function($text) {
        return '[' . $text . ']';
    };
    $parsedown->footnote_back_link_id = 'cite_ref:%s-%s';
    $parsedown->footnote_back_link_class = 'footnotes-backref';
    $parsedown->footnote_back_link_text = ' &#8592;';

    // *******************************
    // Load the HTMLPurifier Library
    $CI->load->library('htmlpurifier/HTMLPurifier');

    // Load the HTMLPurifier config
    $config = HTMLPurifier_Config::createDefault();
    $config->set('URI.Host', $_SERVER['SERVER_NAME']);
    $config->set('URI.DisableExternal', 'false');
    $config->set('URI.DisableExternalResources', 'true');
    $config->set('HTML.EnableAttrID', 'true');

    // Crate HTMLPurifier Object
    $purifier = new HTMLPurifier($config);

    // *********************************************   
    // This adds fancy markdown things
    $text = $parsedown->text($text);
    
    // This cleans the text for anything dangerous
    $text = $purifier->purify($text);

    // This fixes newlines.. TODO: revisit this part? (over and over..)
    //$text = str_replace(["\n"], ["<br>"], $text);

    // This filters and adds Emoji
    $text = filter_emoji($text);

    // Return the resulting applied filtered text
    return $text;
}

/*
 * Advanced filter for removing malicious code tags and inserting Emoji.
 * - Cleans Input
 * - Parses Emoji
 *
 * @param Text $text Input text
 *
 * @author squidicuz <squid@sqdmc.net>
 * @returns Text
 */
function filter_message($text) {
	return $text;
    // Get the CI Instance
    $CI = &get_instance();

    // *******************************
    // Load the HTMLPurifier Library
    $CI->load->library('htmlpurifier/HTMLPurifier');
	
    // Load the HTMLPurifier config
    $config = HTMLPurifier_Config::createDefault();   
    $config->set('URI.Host', $_SERVER['SERVER_NAME']);
    $config->set('URI.DisableExternal', 'false');
    $config->set('URI.DisableExternalResources', 'true');
    $config->set('HTML.EnableAttrID', 'true');
   
    // Crate HTMLPurifier Object
    $purifier = new HTMLPurifier($config);
	
    // *********************************************
    // This filters the raw text and replaces any special characters
    $text = filter_text($text);
    
    // This fixes newlines..
    $text = str_replace("\n", "<br>", $text);
    //$text = nl2br($text, false);

    // This cleans the text for anything dangerous
    $text = $purifier->purify($text);
	
    // This filters and adds Emoji
    $text = filter_emoji($text);
	
    // Return the resulting applied filtered text
    return $text;    
}

/*
 * Advanced filter for inserting special formatting (Markdown).
 * - Parses Markdown
 *
 * @param Text $text Input text
 *
 * @author squidicuz <squid@sqdmc.net>
 * @returns Text
 */
function markdown_text($text) {
    
    // Get the CI Instance
    $CI = &get_instance();
    
    // *******************************
    // Load the Parsedown Libraries
    $CI->load->library('parsedown/Parsedown');
    $CI->load->library('parsedown/ParsedownExtra');
    $CI->load->library('parsedown/ParsedownExtraPlugin');
    
    // Create new Parsedown Object
    $parsedown = new ParsedownExtraPlugin();
    
    // Setup Parsedown
    $parsedown->setMarkupEscaped(True);
    $parsedown->setUrlsLinked(true);
    //$parsedown->setStrictMode(True);
    
    // *********************************************
    // This adds fancy markdown things
    $text = $parsedown->text($text);
    
    // This _mostly_ fixes newlines..
   // $text = str_replace(["</p>\n\n<p>", '<p>', '</p>'], ["", "", ""], $text);
    $text = str_replace(array("</p>\n\n<p>", '<p>', '</p>'), array("", "", ""), $text);
    $text = str_replace("\n", "<br>", $text);
    
    // Return the resulting applied filtered text
    return $text;
}

/*
 * Filter username per requirements.
 *
 * @param Text $username Input username
 *
 * @returns Text
 */
function filter_username($username) {
    $pattern = '/[^a-zA-Z0-9]/';
    $username = preg_replace($pattern, '', (string) $username);
    
    return $username;
}

/*
 * Filter a password per requirements.
 *
 * @param Text $password Input password
 *
 * @returns Text
 */
function filter_password($password) {
    $pattern = '/[^a-zA-Z0-9!@#$%_]/';
    $password = preg_replace($pattern, '', (string) $password);
    
    return $password;
}


if ( ! function_exists('get_user_ip')){
	function get_user_ip(){		
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
			$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
			$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];
		if(filter_var($client, FILTER_VALIDATE_IP)){
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP)){	
			$ip = $forward;	
		}
		else{
			$ip = $remote;
		}
		return  $ip;
	}
}


//passowrd encrypt
if (!function_exists('pass_encrypt'))
{
	function pass_encrypt($pass)
	{
		
		$CI =& get_instance();
		$CI->load->library('bcrypt');
		
		$hash = $CI->bcrypt->hash_password($pass);
		
		if(isset($hash))
		{
			return $hash;
		}
	}
	
}
//passowrd decrypt and check
if (!function_exists('pass_decrypt_chk'))
{
	function pass_decrypt_chk($pass,$stored_hash)
	{
		
		$CI =& get_instance();
		$CI->load->library('bcrypt');
		if ($CI->bcrypt->check_password($pass, $stored_hash))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
}

if(!function_exists('is_valid_password_pattern'))
{
	function is_valid_password_pattern($password)
	{
		
		$uppercase 		= preg_match('@[A-Z]@', $password);
		$lowercase 		= preg_match('@[a-z]@', $password);
		$number    		= preg_match('@[0-9]@', $password);
		$special_cha 	= preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password);
		
		$min_len	=	9;
		$max_len	=   30; 
		
		if(!$uppercase || !$lowercase || !$number || !$special_cha || strlen($password) < $min_len || strlen($password) > $max_len) {
		 
		 	return FALSE;
		}
		else
		{
			return TRUE;
		}
		
		
	}
	
}

if (! function_exists('ipCheck')) {
    function ipCheck($ip)
    {
        $CI =& get_instance();
        $sql="SELECT * from ip_block where ip = '".$ip."'";  
        $query = $CI->db->query($sql);
        $data =  $query->result_array();
        
        if (!empty($data)) {
            return $data[0];
        }
        return false; 
    }
}

if (! function_exists('addIpBlockRequest')) {
    function addIpBlockRequest($ip, $type = null)
    {
        $CI =& get_instance();
        
        $info = [
            'ip' => $ip,
            'url' => full_url($_SERVER ),
            'post_data' => json_encode($_POST),
            'get_data' => json_encode($_GET),
            'create_at' => date('Y-m-d H:i:s'),
            'time_info' => time(),
            'type' => $type ?? null
        ];
        $CI->db->insert('ip_block_request', $info);
    }
}

if (! function_exists('getClientIp')) {
    function getClientIp() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
            
        return $ipaddress;
    }
}


