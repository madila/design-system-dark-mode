<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<div
	<?php echo get_block_wrapper_attributes(); ?>
	data-wp-interactive="dark-mode"
	data-wp-context='{ "isDark": false }'
	data-wp-watch="callbacks.updateScheme"
    data-wp-on-document--scroll="actions.bodyScrolled"
    data-wp-init--start="actions.initScheme"
>
	<button
		data-wp-on--click="actions.toggle"
        data-wp-bind--title="state.label"
	>
        <span class="screen-reader-text"><?php esc_html_e( 'Toggle dark mode', 'design-system-dark-mode' ); ?></span>
        <span class="wp-block-design-system-dark-mode__toggle-icon">
            <svg data-wp-bind--hidden="context.isDark" data-name="sun__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105.36 107.37">
              <g data-name="rays">
                <path d="M52.88,17.85c-1.1,0-2-.9-2-2V4.29c0-1.1.9-2,2-2s2,.9,2,2v11.56c0,1.1-.9,2-2,2Z" fill="#000" stroke-width="0"/>
                <path d="M52.88,104.84c-1.1,0-2-.9-2-2v-11.56c0-1.1.9-2,2-2s2,.9,2,2v11.56c0,1.1-.9,2-2,2Z" fill="#000" stroke-width="0"/>
                <path d="M102.15,55.56h-11.56c-1.1,0-2-.9-2-2s.9-2,2-2h11.56c1.1,0,2,.9,2,2s-.9,2-2,2Z" fill="#000" stroke-width="0"/>
                <path d="M15.16,55.56H3.6c-1.1,0-2-.9-2-2s.9-2,2-2h11.56c1.1,0,2,.9,2,2s-.9,2-2,2Z" fill="#000" stroke-width="0"/>
                <path d="M26.4,28.71c-.52,0-1.03-.2-1.42-.6l-8.12-8.23c-.78-.79-.77-2.05.02-2.83.79-.78,2.05-.77,2.83.02l8.12,8.23c.78.79.77,2.05-.02,2.83-.39.38-.9.58-1.4.58Z" fill="#000" stroke-width="0"/>
                <path d="M87.47,90.66c-.52,0-1.03-.2-1.42-.6l-8.12-8.23c-.78-.79-.77-2.05.02-2.83.79-.78,2.05-.77,2.83.02l8.12,8.23c.78.79.77,2.05-.02,2.83-.39.38-.9.58-1.4.58Z" fill="#000" stroke-width="0"/>
                <path d="M79.73,29.09c-.52,0-1.03-.2-1.42-.6-.78-.79-.77-2.05.02-2.83l8.23-8.12c.79-.78,2.05-.77,2.83.02.78.79.77,2.05-.02,2.83l-8.23,8.12c-.39.38-.9.58-1.4.58Z" fill="#000" stroke-width="0"/>
                <path d="M17.78,90.15c-.52,0-1.03-.2-1.42-.6-.78-.79-.77-2.05.02-2.83l8.23-8.12c.79-.78,2.05-.77,2.83.02.78.79.77,2.05-.02,2.83l-8.23,8.12c-.39.38-.9.58-1.4.58Z" fill="#000" stroke-width="0"/>
              </g>
              <g data-name="sun">
                <path d="M52.88,32.57c11.58,0,21,9.42,21,21s-9.42,21-21,21-21-9.42-21-21,9.42-21,21-21M52.88,28.57c-13.81,0-25,11.19-25,25s11.19,25,25,25,25-11.19,25-25-11.19-25-25-25h0Z" fill="#000" stroke-width="0"/>
              </g>
            </svg>
            <svg data-wp-bind--hidden="!context.isDark" data-name="sun__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105.36 107.37">
              <path d="M52.88,80.06c-14.61,0-26.5-11.89-26.5-26.5,0-11.06,6.97-21.06,17.35-24.88l3.11-1.14-1.19,3.09c-1.04,2.7-1.57,5.54-1.57,8.44,0,12.96,10.54,23.5,23.5,23.5,2.79,0,5.52-.48,8.11-1.44l3.11-1.14-1.19,3.09c-3.91,10.16-13.85,16.99-24.73,16.99ZM41.83,32.82c-7.56,4.04-12.45,12.02-12.45,20.74,0,12.96,10.54,23.5,23.5,23.5,8.57,0,16.48-4.77,20.57-12.15-1.91.43-3.88.65-5.86.65-14.61,0-26.5-11.89-26.5-26.5,0-2.12.25-4.21.75-6.25Z" fill="currentColor" stroke-width="0"/>
            </svg>
        </span>
	</button>
</div>
