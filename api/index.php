<?php
// SIMPLE TEST - No Laravel complexity
echo "<h1>🚀 PHP IS WORKING ON VERCEL!</h1>";
echo "<p>Timestamp: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Request URI: " . ($_SERVER['REQUEST_URI'] ?? '/') . "</p>";
echo "<p>Script: " . __FILE__ . "</p>";

// Test links
echo '<p><a href="/info">PHP Info</a> | ';
echo '<a href="/json">JSON Test</a> | ';
echo '<a href="/">Home</a></p>';

// If this works, Laravel should work too
echo '<hr><p><strong>If you see this, PHP executes on Vercel!</strong></p>';
echo '<p>Next step: Uncomment Laravel code below.</p>';
?>
