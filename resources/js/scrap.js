
// async function example() {
//     const browser = await puppeteer.launch();
//     const page = await browser.newPage();
//     await page.goto('https://example.com');
//     // Perform actions with Puppeteer
//     await browser.close();
//   }

import puppeteer from 'puppeteer';
// const puppeteer = require('puppeteer');


//# sourceMappingURL=/sm/af25c9de6870cab5a7684c94c62f67f52051ef46e949eb0fce94110a0b1dd4b6.map

async function sample() {
    // Launch the browser and open a new blank page
    console.log('Ready');
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    // Navigate the page to a URL
    await page.goto('https://developer.chrome.com/');

    // Set screen size
    await page.setViewport({ width: 1080, height: 1024 });

    // Type into search box
    await page.type('.search-box__input', 'automate beyond recorder');

    // Wait and click on first result
    const searchResultSelector = '.search-box__link';
    await page.waitForSelector(searchResultSelector);
    await page.click(searchResultSelector);

    // Locate the full title with a unique string
    const textSelector = await page.waitForSelector(
        'text/Customize and automate'
    );
    const fullTitle = await textSelector?.evaluate(el => el.textContent);

    // Print the full title
    console.log('The title of this blog post is "%s".', fullTitle);

    await browser.close();
};
sample();

