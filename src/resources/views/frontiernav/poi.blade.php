<i data-key="<?php echo sprintf("%s%d", $item->key, $item->inc); ?>"
   data-type="<?php echo $item->type; ?>" data-info='<?php echo str_replace("'", "&#39;", $item->data); ?>'
   class="x-icon x-icon-<?php echo str_replace(' ', '-', $item->type); ?>"
   style="top:<?php echo $item->y; ?>px; left: <?php echo $item->x; ?>px;z-index: 10"></i>