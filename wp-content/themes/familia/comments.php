<?php 
/**
 * The template for displaying comments
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

 global $familia_option;

if ( $familia_option['display_comments'] ): // check on/ off display comments

    // Do not delete these lines  
    if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
        die ( _e( 'Please do not load this page directly. Thanks!', 'familia' ) );

        if ( !empty( $post->post_password ) ) { // if there's a password
            if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) {  // and it doesn't match the cookie
    ?>
        <p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'familia' ) ; ?></p>
    <?php
            return;
            }
        }
    ?>

    <?php if ( have_comments() ) : ?>

        <!-- START: COMMENT LIST -->
        <div class="article-widget">
            <div class="comments-widget">
                <h4 class="widget-title"><span><?php comments_number( __( 'No Comments', 'familia' ), __( '1 Comment', 'familia' ), __( '% Comments', 'familia' ) ); ?></span></h4>
                    <ul>
                    <?php wp_list_comments( 'callback=warrior_comment_list' ); ?>
                    </ul>
            
                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                    <div class="navigation clearfix">
                        <span class="prev"><?php previous_comments_link(__( '&larr; Previous', 'familia' ), 0); ?></span>
                        <span class="next"><?php next_comments_link(__( 'Next &rarr;', 'familia' ), 0); ?></span>
                    </div>  
                <?php endif; ?>

            </div>
        </div>  
        <!-- END: COMMENT LIST -->
        
    <?php else : // or, if we don't have comments: ?>      
    <?php endif; // end have_comments() ?> 

    <!-- START: Respond -->
    <?php if ( comments_open() ) : ?>
        <div class="article-widget">
            <?php 
            comment_form( array(
                'title_reply'           =>  '<h4 class="widget-title"><span>'. __( 'Leave a Comment','familia' ) .'</span></h4>',
                'comment_notes_before'  =>  '',
                'comment_notes_after'   =>  '',
                'label_submit'          =>  __( 'Submit', 'familia' ),
                'cancel_reply_link'     =>  __( 'Cancel Reply', 'familia' ),
                'logged_in_as'          =>  '<p class="logged-user">' . sprintf( __( 'You are logged in as <a href="%1$s">%2$s</a> &#8212; <a href="%3$s">Logout &raquo;</a>', 'familia' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
                'fields'                => array(
                    'author'                =>  '<div class="form-group col-60"><input type="text" name="author" id="input-name" class="input-s" value="" placeholder="'. __('Fullname', 'familia') .'" /></div>',
                'email'                 =>  '<div class="form-group col-60"><input type="text" name="email" id="input-email" class="input-s" value=""  placeholder="'. __('Email Address', 'familia') .'" /></div>',
                'url'                   =>  '<div class="form-group col-60"><input type="text" name="url" id="input-email" class="input-s" value="" placeholder="'. __('Web URL','familia') .'" /></div>'
                                        ),
                'comment_field'         =>  '<div class="form-group col-100"><textarea name="comment" id="message" placeholder="'. __('Message', 'familia') .'" /></textarea></div>',
                'label_submit'          => __('Submit','familia')
                ));
            ?>
        </div>
    <?php endif; // END: Respond ?>
<?php endif; // END: check on/ off comments ?>