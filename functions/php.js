const { exec } = require('child_process');
const fs = require('fs');
const path = require('path');

module.exports = async (req, res) => {
  try {
    // For different routes
    const url = req.url || '/';
    
    // Map URLs to PHP files
    let phpFile = 'public/index.php';
    
    if (url === '/info') {
      phpFile = 'api/info.php';
    } else if (url === '/json') {
      phpFile = 'api/json.php';
    } else if (url === '/test') {
      phpFile = 'api/test.php';
    }
    
    // Check if file exists
    if (!fs.existsSync(phpFile)) {
      res.status(404).send('File not found: ' + phpFile);
      return;
    }
    
    // Run PHP
    exec(`php ${phpFile}`, (error, stdout, stderr) => {
      if (error) {
        console.error('PHP Error:', error);
        res.status(500).send(`PHP Error: ${error.message}`);
        return;
      }
      
      // Send the PHP output
      res.setHeader('Content-Type', 'text/html');
      res.send(stdout || stderr);
    });
    
  } catch (error) {
    res.status(500).send('Server error: ' + error.message);
  }
};
