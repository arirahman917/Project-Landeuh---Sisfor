const fs = require('fs');
let data = fs.readFileSync('public/js/akomodasi-data.js', 'utf8');
const bookedDatesLists = [
    ['2026-05-15', '2026-05-16', '2026-05-17'],
    ['2026-05-20', '2026-05-21'],
    [],
    ['2026-05-18'],
    ['2026-05-25', '2026-05-26', '2026-05-27']
];
let i = 0;
data = data.replace(/,gambar:"([^"]+)"}/g, function(match, p1) {
    const list = bookedDatesLists[i % bookedDatesLists.length];
    i++;
    return ',gambar:"' + p1 + '",bookedDates:' + JSON.stringify(list) + '}';
});
fs.writeFileSync('public/js/akomodasi-data.js', data);
console.log("Done");
