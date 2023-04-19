<?php

$dynamic_messages = get_field('dynamic_messages');

$message = get_field('default_message');

foreach ($dynamic_messages as $message_option) {
    if (!isset($_GET[$message_option['key']])) {
        continue;
    }

    if ($_GET[$message_option['key']] !== $message_option['equals']) {
        continue;
    }

    $message = $message_option['message'];
}

?>

<p id="<?php echo $block['id']; ?>" class="dynamic-message"><?php echo $message; ?></p>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>