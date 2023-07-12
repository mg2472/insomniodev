<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Youtube video template part
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Insomnio Dev
 * @subpackage Insomnio Dev
 * @since 1.0
 * @version 1.0
 */

$settings = [
    'title' => null,
    'videoID' => null,
    'url' => null,
    'startAt' => null,
    'autoload' => null,
    'short' => null,
    'params' => null,
    'cssClass' => null,
    'id' => null
];

if (!empty($args)) {
    $settings = array_merge($settings, $args);
}

$id = uniqid('idt-sc-video-v1-youtube');
$cssClass = 'idt-sc-video-v1-youtube';
$videoID = '';
$videoAttributes = '';

if (isset($settings['videoID']) && $settings['videoID'] != '') {
    $videoID = $settings['videoID'];
} else if (isset($settings['url']) && $settings['url'] != '') {
    $videoUrlParams = parse_url($settings['url']);
    $videoPath = isset($videoUrlParams['path']) ? strtolower($videoUrlParams['path']) : '';
    $videoHost = isset($videoUrlParams['host']) ? strtolower($videoUrlParams['host']) : '';

    if (isset($videoUrlParams['query'])) {
        parse_str($videoUrlParams['query'], $videoParams);
    }

    if (str_contains($videoPath, 'watch')) {
        if (isset($videoParams['v']) && $videoParams['v'] != '') {
            $videoID = $videoParams['v'];
        }
    } elseif (str_contains($videoPath, 'shorts')) {
        $videoID = str_replace('/shorts/', '', $videoUrlParams['path']);
    } elseif (str_contains($videoHost, 'youtu.be')) {
        $videoID = str_replace('/', '', $videoUrlParams['path']);
    }
}

if (isset($settings['params']) && $settings['params'] != '') {
    $videoAttributes .= ' params="' . $settings['params'] . '"';
}

if (isset($settings['id']) && $settings['id'] != '') {
    $id .= ' ' . $settings['id'];
}

if (isset($settings['cssClass']) && $settings['cssClass'] != '') {
    $cssClass .= ' ' . $settings['cssClass'];
}

?>
<?php if ($videoID != ''): ?>
    <div class="<?php echo $cssClass; ?>" id="<?php echo $id; ?>">
        <lite-youtube
            class="idt-sc-video-v1-youtube__video-iframe"
            videoid="<?php echo $videoID; ?>"
            <?php echo $videoAttributes; ?>>
            <button type="button"
                    class="lty-playbtn">
                <span class="lyt-visually-hidden"><?php echo $settings['title']; ?></span>
            </button>
        </lite-youtube>
    </div>
<?php else: ?>
    <p><?php _e('Video not found. Add a valid Youtube video url or video ID', 'insomniodev'); ?></p>
<?php endif; ?>