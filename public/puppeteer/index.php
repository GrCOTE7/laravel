<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your HTML Page</title>
</head>
<body>
  <!-- Include Puppeteer -->
  <script src="https://cdn.jsdelivr.net/npm/puppeteer@2.1.1"></script>

  <!-- Your JavaScript code using Puppeteer -->
  <script>
    // Now you can use puppeteer here
    async function example() {
      const browser = await puppeteer.launch();
      const page = await browser.newPage();
      await page.goto('https://example.com');
      // Perform actions with Puppeteer
      await browser.close();
    //   console.log('oki');
    }

    // Call your function
    example();
  </script>
</body>
</html>
