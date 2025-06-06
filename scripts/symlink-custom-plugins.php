<?php
/*
 *  Custom script created to symlinked the plugins inside 'Custom' with 'Contrib'.
 */
echo "Symlinking custom plugins to contrib directory..." . PHP_EOL;
$rootDirPath = dirname(dirname(__FILE__));
$customDir = $rootDirPath . '/web/wp-content/plugins/custom';
$contribDir = $rootDirPath . '/web/wp-content/plugins/contrib';
$defaultPluginsDir = $rootDirPath . '/web/wp-content/plugins';
$defaultThemesDir  = $rootDirPath . '/web/wp-content/themes';

// 1. Symlink custom plugins to contrib directory
if (is_dir($customDir)) {
  $plugins = scandir($customDir);
  foreach ($plugins as $plugin) {
    if ($plugin === '.' || $plugin === '..') {
      continue;
    }

    $source = "$customDir/$plugin";
    $target = "$contribDir/$plugin";

    if (!is_dir($source)) {
      continue;
    }

    if (file_exists($target)) {
      if (is_link($target)) {
        echo "Symlink already exists: $plugin\n";
      }
      else {
        echo "Conflict: $target already exists but is not a symlink. Skipping.\n";
      }
      continue;
    }

    symlink($source, $target);
    echo "Symlinked $plugin\n";
  }
}
else {
  echo "Custom plugins directory not found." . PHP_EOL;
}

// 2. Check CiviCRM plugin soft link to vendor directory.
$civicrmDir = $contribDir . '/civicrm/civicrm';
$linkMappings = [
  $contribDir . '/civicrm/civicrm' => $rootDirPath . '/vendor/civicrm/civicrm-core',
  $rootDirPath . '/vendor/civicrm/civicrm-core/packages' => $rootDirPath . '/vendor/civicrm/civicrm-packages',
];
foreach ($linkMappings as $source => $target) {
  if (is_link($source)) {
    echo "Unlinking $source to $target." . PHP_EOL;
    unlink($source);
  }
  if (!is_link($source) && is_dir($target)) {
    symlink($target, $source);
    echo "Symlinked $source to $target." . PHP_EOL;
  }
  else {
    echo "Source directory not found: $target" . PHP_EOL;
  }
}


// 3. Remove default WordPress plugins
echo "Removing default WordPress plugins and themes..." . PHP_EOL;
// Ultra-simple version using system command
function removeItem($path) {
  if (file_exists($path)) exec("rm -rf " . escapeshellarg($path));
}
// plugins
removeItem($defaultPluginsDir . '/hello.php');
removeItem($defaultPluginsDir . '/akismet');
// themes
removeItem($defaultThemesDir . '/twentytwentyfive');
removeItem($defaultThemesDir . '/twentytwentyfour');
removeItem($defaultThemesDir . '/twentytwentythree');
