<?php
/**
 * @var $view \Symfony\Bundle\FrameworkBundle\Templating\PhpEngine
 * @var $slots Symfony\Component\Templating\Helper\SlotsHelper;
 */
$slots = $view['slots'];
?>
<hr/>
<?php $slots->output('_content') ?>
<hr/>