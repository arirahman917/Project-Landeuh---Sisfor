import { chromium } from 'playwright-core';

async function test() {
    console.log("Launching Chrome...");
    const browser = await chromium.launch({
        executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
        headless: false, // show browser or stealth
        args: ['--disable-blink-features=AutomationControlled']
    });
    const context = await browser.newContext({
        viewport: { width: 1280, height: 800 },
        userAgent: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36'
    });
    const page = await context.newPage();
    console.log("Navigating to landeuhvillage.com...");
    await page.goto('https://landeuhvillage.com', { waitUntil: 'domcontentloaded', timeout: 30000 });
    await page.waitForTimeout(5000);
    console.log("Page title:", await page.title());
    console.log("Current URL:", page.url());
    await browser.close();
}

test().catch(err => {
    console.error("Test error:", err);
    process.exit(1);
});
