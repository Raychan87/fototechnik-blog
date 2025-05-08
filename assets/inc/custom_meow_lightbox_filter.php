<?php
/**
 * FotoTechnik-Blog Custom Kamera und Objektive für Meow Lightbox
 */

// Customize lens name display
function fototechnik_blog_mwl_img_lens( $value, $mediaId, $meta ) {
	if ( empty( $value ) ) {
		return 'N/A';
	}

	// Example: Clean up common lens naming
	$lens_map = array(
		// Sony
        "FE 24-240mm F3.5-6.3 OSS" => "Sony 24-240mm F3.5-6.3 OSS",
        "FE 16-35mm F4 ZA OSS" => "Sony Zeiss 16-35mm F4 ZA OSS",
        "FE 16-35mm F2.8 GM" => "Sony 16-35mm F2.8 GM",
        "FE 90mm F2.8 Macro G OSS" => "Sony 90mm F2.8 Makro G OSS",
        "FE 200-600mm F5.6-6.3 G OSS" => "Sony 200-600mm F5.6-6.3 G OSS",
        "FE 200-600mm F5.6-6.3 G OSS + 1.4X Teleconverter" => "Sony 200-600mm F5.6-6.3 G OSS + 1.4x TC",
        "11-16mm F2.8 PRO DX" => "Tokina 11-16mm F2.8 PRO DX",
        "18-200mm F3.5-6.3 DC" => "Sigma 18-200mm F3.5-6.3 DC",
        "100mm F2.8 Macro" => "Tamron 90mm F2.8 Macro",
        "120-400mm F4.5-5.6" => "Sigma 120-400mm F4.5-5.6 APO DG HSM",
        "E 70-180mm F2.8 A056" => "Tamron 70-180mm F2.8 Di III VXD",
        "FE 14mm F1.8 GM" => "Sony 14mm F1.8 GM",
        "Sony Xperia 1 VI Wide Camera" => "Wide Camera",
        "FE 70-200mm F2.8 GM OSS II" => "Sony 70-200mm F2.8 GM OSS II",
        "FE 70-200mm F2.8 GM OSS II + 1.4X Teleconverter" => "Sony 70-200mm F2.8 GM OSS II + 1.4x TC",
	);

	return isset( $lens_map[ $value ] ) ? $lens_map[ $value ] : $value;
}
add_filter( 'mwl_img_lens', 'fototechnik_blog_mwl_img_lens', 10, 3 );

// Customize camera model display
function fototechnik_blog_mwl_img_camera( $value, $mediaId, $meta ) {
	if ( empty( $value ) ) {
		return 'N/A';
	}

	// Example: Make names more user-friendly
	$camera_map = array(
        "ILCE-7M3" => "Sony α7 III",
        "DSLR-A580" => "Sony α580",
        "ILCE-7RM4" => "Sony α7R IV",
        "ILCE-7RM5" => "Sony α7R V",
        "XQ-EC54" => "Sony Xperia 1 VI",
	);

	return isset( $camera_map[ $value ] ) ? $camera_map[ $value ] : $value;
}
add_filter( 'mwl_img_camera', 'fototechnik_blog_mwl_img_camera', 10, 3 );