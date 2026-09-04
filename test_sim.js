import { chromium } from 'playwright-core';
import path from 'path';

async function testSim() {
    const browser = await chromium.launch({
        executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
        headless: false
    });
    const page = await browser.newPage();
    await page.goto('https://simulator.sandbox.midtrans.com/bca/va/index');
    await page.fill('#inputMerchantId', '51180756831007064407324');
    await page.click('input[value="Inquire"]');
    await page.waitForTimeout(2000);
    console.log("Page URL after inquire:", page.url());
    const body = await page.$eval('.content, main, body', el => el.innerText);
    console.log("INQUIRY RESULT TEXT:\n", body);
    await page.screenshot({ path: path.resolve('./public/midtrans_flow_doc/07_simulator_inquiry.png') });

    // Look for pay button
    const pay = await page.$('input[value="Pay"], input[type="submit"], button:has-text("Pay")');
    if (pay) {
        console.log("Found Pay button! Clicking...");
        await pay.click();
        await page.waitForTimeout(2000);
        await page.screenshot({ path: path.resolve('./public/midtrans_flow_doc/08_simulator_payment_success.png') });
        console.log("08 saved!");
        const postPay = await page.$eval('.content, main, body', el => el.innerText);
        console.log("POST PAY RESULT:\n", postPay);
    }
    await browser.close();
}

testSim().catch(console.error);
