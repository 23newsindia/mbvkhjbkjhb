<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Professional Email Template System - Optimized for Deliverability
 */
class WNS_Email_Templates {
    
    public static function get_email_wrapper($content, $title = '') {
        $site_name = get_bloginfo('name');
        $site_url = home_url();
        
        // Use the specific logo URL provided
        $logo_url = 'https://aistudynow.com/wp-content/uploads/2022/11/LOGO-1.png';
        
        // Get social media links
        $facebook_url = get_option('wns_facebook_url', '');
        $twitter_url = get_option('wns_twitter_url', '');
        $instagram_url = get_option('wns_instagram_url', '');
        $linkedin_url = get_option('wns_linkedin_url', '');
        
        // Build social media links HTML
        $social_links = '';
        if ($facebook_url || $twitter_url || $instagram_url || $linkedin_url) {
            $social_links = '<p style="margin: 15px 0; text-align: center;">';
            if ($facebook_url) {
                $social_links .= '<a href="' . esc_url($facebook_url) . '" style="color: #0066cc; text-decoration: none; margin: 0 10px;">Facebook</a>';
            }
            if ($twitter_url) {
                $social_links .= '<a href="' . esc_url($twitter_url) . '" style="color: #0066cc; text-decoration: none; margin: 0 10px;">Twitter</a>';
            }
            if ($instagram_url) {
                $social_links .= '<a href="' . esc_url($instagram_url) . '" style="color: #0066cc; text-decoration: none; margin: 0 10px;">Instagram</a>';
            }
            if ($linkedin_url) {
                $social_links .= '<a href="' . esc_url($linkedin_url) . '" style="color: #0066cc; text-decoration: none; margin: 0 10px;">LinkedIn</a>';
            }
            $social_links .= '</p>';
        }
        
        return '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . esc_html($title ?: $site_name) . '</title>
</head>
<body style="margin: 0; padding: 0; background-color: #ffffff; font-family: Arial, Helvetica, sans-serif; line-height: 1.4; color: #333333;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border: 1px solid #dddddd;">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #eeeeee;">
                            <img src="' . esc_url($logo_url) . '" alt="' . esc_attr($site_name) . '" style="max-width: 150px; height: auto; display: block;">
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px;">
                            ' . $content . '
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px; background-color: #f8f8f8; border-top: 1px solid #eeeeee; text-align: center;">
                            <p style="margin: 0 0 10px 0; font-size: 14px; color: #666666;">
                                You received this because you subscribed to our newsletter.
                            </p>
                            <p style="margin: 0; font-size: 14px; color: #666666;">
                                <a href="{unsubscribe_link}" style="color: #0066cc; text-decoration: underline;">Unsubscribe</a> | 
                                <a href="' . esc_url($site_url) . '" style="color: #0066cc; text-decoration: underline;">Visit Website</a>
                            </p>
                            ' . $social_links . '
                            <p style="margin: 10px 0 0 0; font-size: 12px; color: #999999;">
                                ' . esc_html($site_name) . '<br>
                                This email was sent to you because you subscribed to our newsletter.
                            </p>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
    }
    
    public static function get_verification_template($verify_link) {
        $site_name = get_bloginfo('name');
        
        $content = '
        <h2 style="color: #333333; font-size: 24px; margin: 0 0 20px 0; font-family: Arial, sans-serif;">
            Email Verification Required
        </h2>
        
        <p style="color: #333333; font-size: 16px; margin: 0 0 20px 0; font-family: Arial, sans-serif; line-height: 1.5;">
            Thank you for subscribing to our newsletter! To complete your subscription and start receiving our updates, please verify your email address by clicking the button below.
        </p>
        
        <table cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
            <tr>
                <td style="background-color: #0066cc; padding: 12px 24px; border-radius: 4px;">
                    <a href="' . esc_url($verify_link) . '" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; display: block;">
                        Verify Email Address
                    </a>
                </td>
            </tr>
        </table>
        
        <p style="color: #666666; font-size: 14px; margin: 20px 0 0 0; font-family: Arial, sans-serif; line-height: 1.5;">
            If the button above does not work, copy and paste this link into your browser:
        </p>
        <p style="color: #0066cc; font-size: 14px; margin: 5px 0 0 0; font-family: Arial, sans-serif; word-break: break-all;">
            ' . esc_url($verify_link) . '
        </p>
        
        <p style="color: #999999; font-size: 12px; margin: 30px 0 0 0; font-family: Arial, sans-serif;">
            This verification link will expire in 24 hours. If you did not subscribe to our newsletter, you can safely ignore this email or <a href="{unsubscribe_link}" style="color: #0066cc;">unsubscribe here</a>.
        </p>';
        
        return self::get_email_wrapper($content, 'Verify Your Email - ' . $site_name);
    }
    
    public static function get_welcome_template($email) {
        $site_name = get_bloginfo('name');
        
        $content = '
        <h2 style="color: #333333; font-size: 24px; margin: 0 0 20px 0; font-family: Arial, sans-serif;">
            Welcome to Our Newsletter!
        </h2>
        
        <p style="color: #333333; font-size: 16px; margin: 0 0 20px 0; font-family: Arial, sans-serif; line-height: 1.5;">
            Thank you for subscribing to our newsletter. We are pleased to have you as part of our community and look forward to sharing our latest updates with you.
        </p>
        
        <p style="color: #333333; font-size: 16px; margin: 0 0 20px 0; font-family: Arial, sans-serif; line-height: 1.5;">
            You will receive updates about our latest content, news, and exclusive offers directly in your inbox.
        </p>
        
        <table cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
            <tr>
                <td style="background-color: #0066cc; padding: 12px 24px; border-radius: 4px;">
                    <a href="' . esc_url(home_url()) . '" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; display: block;">
                        Visit Our Website
                    </a>
                </td>
            </tr>
        </table>
        
        <p style="color: #666666; font-size: 14px; margin: 20px 0 0 0; font-family: Arial, sans-serif; line-height: 1.5;">
            If you have any questions or need assistance, please feel free to contact us. We\'re here to help!
        </p>';
        
        return self::get_email_wrapper($content, 'Welcome to ' . $site_name);
    }
    
    public static function get_new_post_template($post) {
        $post_title = get_the_title($post->ID);
        $post_url = get_permalink($post->ID);
        $post_excerpt = has_excerpt($post->ID) ? get_the_excerpt($post->ID) : wp_trim_words(strip_tags($post->post_content), 30);
        $post_date = get_the_date('F j, Y', $post->ID);
        
        // Get featured image if available
        $featured_image = '';
        if (has_post_thumbnail($post->ID)) {
            $image_url = get_the_post_thumbnail_url($post->ID, 'medium');
            $featured_image = '
            <div style="text-align: center; margin: 20px 0;">
                <img src="' . esc_url($image_url) . '" alt="' . esc_attr($post_title) . '" style="max-width: 100%; height: auto; border-radius: 4px;">
            </div>';
        }
        
        $content = '
        <h2 style="color: #333333; font-size: 24px; margin: 0 0 20px 0; font-family: Arial, sans-serif;">
            New Post Published
        </h2>
        
        <h3 style="color: #333333; font-size: 20px; margin: 0 0 15px 0; font-family: Arial, sans-serif;">
            ' . esc_html($post_title) . '
        </h3>
        
        <p style="color: #666666; font-size: 14px; margin: 0 0 15px 0; font-family: Arial, sans-serif;">
            Published on ' . esc_html($post_date) . '
        </p>
        
        ' . $featured_image . '
        
        <p style="color: #333333; font-size: 16px; margin: 0 0 25px 0; font-family: Arial, sans-serif; line-height: 1.5;">
            ' . esc_html($post_excerpt) . '
        </p>
        
        <table cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
            <tr>
                <td style="background-color: #0066cc; padding: 12px 24px; border-radius: 4px;">
                    <a href="' . esc_url($post_url) . '" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; display: block;">
                        Read Full Article
                    </a>
                </td>
            </tr>
        </table>';
        
        return self::get_email_wrapper($content, 'New Post: ' . $post_title);
    }
    
    public static function get_newsletter_template($subject, $content) {
        $formatted_content = '
        <h2 style="color: #333333; font-size: 24px; margin: 0 0 20px 0; font-family: Arial, sans-serif;">
            ' . esc_html($subject) . '
        </h2>
        
        <div style="color: #333333; font-size: 16px; font-family: Arial, sans-serif; line-height: 1.5;">
            ' . wp_kses_post($content) . '
        </div>';
        
        return self::get_email_wrapper($formatted_content, $subject);
    }
    
    public static function get_unsubscribe_template($email) {
        $site_name = get_bloginfo('name');
        
        $content = '
        <h2 style="color: #333333; font-size: 24px; margin: 0 0 20px 0; font-family: Arial, sans-serif;">
            You Have Been Unsubscribed
        </h2>
        
        <p style="color: #333333; font-size: 16px; margin: 0 0 20px 0; font-family: Arial, sans-serif; line-height: 1.5;">
            You have successfully unsubscribed from our newsletter. We\'re sorry to see you go!
        </p>
        
        <p style="color: #333333; font-size: 16px; margin: 0 0 20px 0; font-family: Arial, sans-serif; line-height: 1.5;">
            If this was a mistake, you can always resubscribe by visiting our website and signing up again.
        </p>
        
        <table cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
            <tr>
                <td style="background-color: #0066cc; padding: 12px 24px; border-radius: 4px;">
                    <a href="' . esc_url(home_url()) . '" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; display: block;">
                        Visit Our Website
                    </a>
                </td>
            </tr>
        </table>
        
        <p style="color: #666666; font-size: 14px; margin: 20px 0 0 0; font-family: Arial, sans-serif; line-height: 1.5;">
            Thank you for being part of our community. We hope to see you again soon!
        </p>';
        
        return self::get_email_wrapper($content, 'Unsubscribed - ' . $site_name);
    }
}