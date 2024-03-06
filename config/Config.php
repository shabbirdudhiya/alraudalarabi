<?php
// PHP Configuration File

// Error Reporting
// error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('UTC');

// Database Connection Parameters
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'alraudalarabi');

// Session Configuration
ini_set('session.cookie_lifetime', 3600); // Session cookie lifetime in seconds
ini_set('session.gc_maxlifetime', 3600);  // Maximum lifetime of session garbage collection

// File Uploads
ini_set('upload_max_filesize', '100M');    // Maximum file upload size
ini_set('post_max_size', '100M');          // Maximum post size