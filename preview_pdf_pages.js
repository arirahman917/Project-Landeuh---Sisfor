import { chromium } from 'playwright-core';
import path from 'path';

async function checkPages() {
    const browser = await chromium.launch({
        executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
        headless: true
    });
    const page = await browser.newPage({ viewport: { width: 1200, height: 1600 } });
    await page.goto(`file://${path.resolve('./customer_flow_template.html')}`, { waitUntil: 'networkidle' });
    
    const pageElements = await page.$$('.page');
    console.log("Found .page elements count:", pageElements.length);
    for (let i = 0; i < pageElements.length; i++) {
        await pageElements[i].screenshot({ path: path.resolve(`./public/midtrans_flow_doc/pdf_page_preview_${i + 1}.png`) });
        console.log(`Saved pdf_page_preview_${i + 1}.png`);
    }
    await browser.close();
}

checkPages().catch(console.error);
