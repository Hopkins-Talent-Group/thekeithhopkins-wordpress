<?php
/**
 * Plugin Name: Fill My Pipeline - Lead Handler
 * Description: Handles frontend lead form submissions for the Fill My Pipeline page template.
 * Version: 1.0.0
 * Author: CitrixLab
 */

defined( 'ABSPATH' ) || exit;

add_action( 'admin_post_fmp_submit_lead', 'fmp_handle_lead_submission' );
add_action( 'admin_post_nopriv_fmp_submit_lead', 'fmp_handle_lead_submission' );

function fmp_handle_lead_submission() {
	// Verify nonce.
	if ( ! isset( $_POST['fmp_nonce'] ) || ! wp_verify_nonce( $_POST['fmp_nonce'], 'fmp_lead_form' ) ) {
		wp_die( __( 'Security check failed.', 'fill-my-pipeline' ), __( 'Error', 'fill-my-pipeline' ), [ 'response' => 403 ] );
	}

	// Sanitize and validate.
	$name    = isset( $_POST['fmp_name']    ) ? sanitize_text_field( wp_unslash( $_POST['fmp_name']    ) ) : '';
	$email   = isset( $_POST['fmp_email']   ) ? sanitize_email(       wp_unslash( $_POST['fmp_email']   ) ) : '';
	$phone   = isset( $_POST['fmp_phone']   ) ? sanitize_text_field( wp_unslash( $_POST['fmp_phone']   ) ) : '';
	$business= isset( $_POST['fmp_business']) ? sanitize_text_field( wp_unslash( $_POST['fmp_business']) ) : '';
	$message = isset( $_POST['fmp_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['fmp_message'] ) ) : '';

	$errors = [];

	if ( empty( $name ) ) {
		$errors[] = __( 'Full name is required.', 'fill-my-pipeline' );
	}
	if ( empty( $email ) || ! is_email( $email ) ) {
		$errors[] = __( 'A valid email address is required.', 'fill-my-pipeline' );
	}

	if ( ! empty( $errors ) ) {
		$redirect = add_query_arg( [
			'fmp_error' => rawurlencode( implode( ' ', $errors ) ),
		], wp_get_referer() ?: home_url() );
		wp_safe_redirect( esc_url( $redirect ) );
		exit;
	}

	// Build email.
	$to      = get_option( 'fmp_notification_email', get_option( 'admin_email' ) );
	$subject = sprintf( __( 'New Fill My Pipeline Lead: %s', 'fill-my-pipeline' ), $name );

	$body  = sprintf( __( "New Lead Received\n\nName: %s\nEmail: %s\nPhone: %s\nBusiness Type: %s\n\nMessage:\n%s\n", 'fill-my-pipeline' ),
		$name,
		$email,
		$phone,
		$business,
		$message
	);

	$headers = sprintf(
		"From: %s <%s>\r\nReply-To: %s\r\nContent-Type: text/plain; charset=UTF-8\r\n",
		esc_html( $name ),
		sanitize_email( $to ),
		$sanitized_email = $email
	);

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		wp_safe_redirect( add_query_arg( 'submitted', '1', wp_get_referer() ?: home_url() ) );
	} else {
		wp_safe_redirect( add_query_arg( 'submitted', 'error', wp_get_referer() ?: home_url() ) );
	}
	exit;
}
