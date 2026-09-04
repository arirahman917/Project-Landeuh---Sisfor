import { chromium } from 'playwright-core';

async function dumpInquiry() {
    const browser = await chromium.launch({
        executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
        headless: true
    });
    const page = await browser.newPage();
    await page.goto('https://simulator.sandbox.midtrans.com/bca/va/index');
    await page.fill('#inputMerchantId', '1788509250');
    await page.click('input[value="Inquire"]');
    await page.waitForTimeout(2000);
    const body = await page.$eval('.content, main, body', el => el.innerHTML);
    console.log("INQUIRY BODY:\n", body);
    await browser.close();
}

dumpInquiry().catch(console.error);
