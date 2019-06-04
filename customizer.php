<?php
// =============================================================================
// PANEL BUILDER
// =============================================================================
function customizer_api_configuration($customizer_api){

}

// =============================================================================
// REGISTER
// =============================================================================
$customizer_api = new RB_Customizer_API($wp_customize, 'customizer_api_configuration');
$customizer_api->initialize();
