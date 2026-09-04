import {
    Document,
    Packer,
    Paragraph,
    TextRun,
    ImageRun,
    Table,
    TableRow,
    TableCell,
    WidthType,
    AlignmentType,
    BorderStyle,
    Header,
    Footer,
    PageNumber,
    ShadingType,
    VerticalAlign,
    PageBreak,
    TableLayoutType
} from 'docx';
import fs from 'fs';
import path from 'path';

const ASSETS_DIR = path.resolve('./public/midtrans_flow_doc');
const DOCX_OUTPUT = path.resolve('./Dokumen_Customer_Flow_Midtrans_LandeuhVillage.docx');
const PUBLIC_DOCX = path.resolve('./public/Dokumen_Customer_Flow_Midtrans_LandeuhVillage.docx');
const LOGO_PATH = path.resolve('./public/images/logo-landeuh.png');

// Helper to read image as buffer
function getImageBuffer(filePath) {
    if (fs.existsSync(filePath)) {
        return fs.readFileSync(filePath);
    }
    return null;
}

const logoBuffer = getImageBuffer(LOGO_PATH);
const img01Buffer = getImageBuffer(path.join(ASSETS_DIR, '01_home_page.png'));
const img02Buffer = getImageBuffer(path.join(ASSETS_DIR, '02_katalog_akomodasi.png'));
const img03Buffer = getImageBuffer(path.join(ASSETS_DIR, '03_detail_reservasi_tamu.png'));
const img04Buffer = getImageBuffer(path.join(ASSETS_DIR, '04_pilih_metode_pembayaran.png'));
const img05Buffer = getImageBuffer(path.join(ASSETS_DIR, '05_midtrans_snap_popup.png'));
const img06Buffer = getImageBuffer(path.join(ASSETS_DIR, '06_midtrans_bca_va_detail.png'));
const img07Buffer = getImageBuffer(path.join(ASSETS_DIR, '07_simulator_inquiry.png'));
const img08Buffer = getImageBuffer(path.join(ASSETS_DIR, '08_simulator_payment_success.png'));
const img09Buffer = getImageBuffer(path.join(ASSETS_DIR, '09_konfirmasi_sukses.png'));

// Color palette constants
const C_DARK_GREEN = '2E4A32';
const C_MID_GREEN = '3A523A';
const C_LIGHT_GREEN_BG = 'EEF7EE';
const C_LIGHT_GREEN_BORDER = 'C2E0C6';
const C_CREAM_BG = 'FDFAF3';
const C_CREAM_BORDER = 'EBDCC5';
const C_GRAY_TEXT = '4B5563';
const C_MUTED_TEXT = '6B7280';
const C_LIGHT_GRAY_BG = 'F3F4F6';
const C_BORDER_GRAY = 'E5E7EB';
const C_DARK_TEXT = '111827';
const C_BODY_TEXT = '1F2937';
const C_SUCCESS_GREEN = '15803D';
const C_SUCCESS_BG = 'DCFCE7';
const C_INFO_BLUE = '0369A1';
const C_INFO_BG = 'E0F2FE';

const FONT_FAMILY = 'Segoe UI';

// Border helper
const noBorder = {
    style: BorderStyle.NONE,
    size: 0,
    color: 'FFFFFF'
};

const cellBordersNone = {
    top: noBorder,
    bottom: noBorder,
    left: noBorder,
    right: noBorder
};

const subtleGrayBorder = {
    style: BorderStyle.SINGLE,
    size: 1,
    color: C_BORDER_GRAY
};

const cellBordersSubtle = {
    top: subtleGrayBorder,
    bottom: subtleGrayBorder,
    left: subtleGrayBorder,
    right: subtleGrayBorder
};

// Helper to create page header banner
function createPageHeader(title, subtitle, badgeText) {
    const cells = [];

    // Left column: logo + title
    const leftRuns = [];
    if (logoBuffer) {
        leftRuns.push(
            new ImageRun({
                data: logoBuffer,
                transformation: { width: 42, height: 37 }
            }),
            new TextRun({ text: "   " })
        );
    }
    leftRuns.push(
        new TextRun({
            text: title,
            bold: true,
            size: 24, // 12pt
            color: C_DARK_GREEN,
            font: FONT_FAMILY
        }),
        new TextRun({
            text: "\n" + subtitle,
            size: 16, // 8pt
            color: C_MUTED_TEXT,
            font: FONT_FAMILY
        })
    );

    const leftCell = new TableCell({
        width: { size: 7500, type: WidthType.DXA },
        verticalAlign: VerticalAlign.CENTER,
        borders: {
            top: noBorder,
            left: noBorder,
            right: noBorder,
            bottom: { style: BorderStyle.SINGLE, size: 3, color: C_DARK_GREEN }
        },
        children: [
            new Paragraph({
                spacing: { after: 120 },
                children: leftRuns
            })
        ]
    });

    // Right column: badge
    const rightCell = new TableCell({
        width: { size: 2400, type: WidthType.DXA },
        verticalAlign: VerticalAlign.CENTER,
        borders: {
            top: noBorder,
            left: noBorder,
            right: noBorder,
            bottom: { style: BorderStyle.SINGLE, size: 3, color: C_DARK_GREEN }
        },
        children: [
            new Paragraph({
                alignment: AlignmentType.RIGHT,
                spacing: { after: 120 },
                children: [
                    new TextRun({
                        text: `  ${badgeText}  `,
                        bold: true,
                        size: 15,
                        color: C_DARK_GREEN,
                        font: FONT_FAMILY,
                        shading: {
                            type: ShadingType.CLEAR,
                            fill: C_LIGHT_GREEN_BG
                        }
                    })
                ]
            })
        ]
    });

    return new Table({
        width: { size: 9900, type: WidthType.DXA },
        borders: cellBordersNone,
        rows: [
            new TableRow({
                children: [leftCell, rightCell]
            })
        ]
    });
}

// Helper to create Step Card
function createStepCard(stepNumber, stepTitle, stepUrl, customerAction, systemOutput, imgBuffer, imgCaption, imgWidth = 540, imgHeight = 304) {
    const rows = [];

    // Header Row of Step
    const headerRow = new TableRow({
        children: [
            new TableCell({
                width: { size: 6500, type: WidthType.DXA },
                shading: { type: ShadingType.CLEAR, fill: 'FAFAFA' },
                borders: {
                    top: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                    left: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                    bottom: subtleGrayBorder,
                    right: noBorder
                },
                children: [
                    new Paragraph({
                        spacing: { before: 80, after: 80 },
                        children: [
                            new TextRun({
                                text: `  LANGKAH ${stepNumber}  `,
                                bold: true,
                                size: 16,
                                color: 'FFFFFF',
                                font: FONT_FAMILY,
                                shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN }
                            }),
                            new TextRun({ text: "  " }),
                            new TextRun({
                                text: stepTitle,
                                bold: true,
                                size: 20,
                                color: C_DARK_TEXT,
                                font: FONT_FAMILY
                            })
                        ]
                    })
                ]
            }),
            new TableCell({
                width: { size: 3400, type: WidthType.DXA },
                shading: { type: ShadingType.CLEAR, fill: 'FAFAFA' },
                borders: {
                    top: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                    right: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                    bottom: subtleGrayBorder,
                    left: noBorder
                },
                children: [
                    new Paragraph({
                        alignment: AlignmentType.RIGHT,
                        spacing: { before: 80, after: 80 },
                        children: [
                            new TextRun({
                                text: ` ${stepUrl} `,
                                size: 14,
                                color: C_GRAY_TEXT,
                                font: 'Consolas',
                                shading: { type: ShadingType.CLEAR, fill: C_LIGHT_GRAY_BG }
                            })
                        ]
                    })
                ]
            })
        ]
    });
    rows.push(headerRow);

    // Descriptions Row (2 Columns)
    const descRow = new TableRow({
        children: [
            new TableCell({
                width: { size: 4950, type: WidthType.DXA },
                borders: {
                    left: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                    right: subtleGrayBorder,
                    bottom: subtleGrayBorder,
                    top: noBorder
                },
                shading: { type: ShadingType.CLEAR, fill: 'FFFFFF' },
                children: [
                    new Paragraph({
                        spacing: { before: 80, after: 40 },
                        children: [
                            new TextRun({
                                text: "Aksi Pelanggan (Customer Action):",
                                bold: true,
                                size: 16,
                                color: C_DARK_GREEN,
                                font: FONT_FAMILY
                            })
                        ]
                    }),
                    new Paragraph({
                        spacing: { after: 80 },
                        children: [
                            new TextRun({
                                text: customerAction,
                                size: 16,
                                color: C_BODY_TEXT,
                                font: FONT_FAMILY
                            })
                        ]
                    })
                ]
            }),
            new TableCell({
                width: { size: 4950, type: WidthType.DXA },
                borders: {
                    right: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                    left: subtleGrayBorder,
                    bottom: subtleGrayBorder,
                    top: noBorder
                },
                shading: { type: ShadingType.CLEAR, fill: 'FFFFFF' },
                children: [
                    new Paragraph({
                        spacing: { before: 80, after: 40 },
                        children: [
                            new TextRun({
                                text: "Respon Sistem (System Output):",
                                bold: true,
                                size: 16,
                                color: C_DARK_GREEN,
                                font: FONT_FAMILY
                            })
                        ]
                    }),
                    new Paragraph({
                        spacing: { after: 80 },
                        children: [
                            new TextRun({
                                text: systemOutput,
                                size: 16,
                                color: C_BODY_TEXT,
                                font: FONT_FAMILY
                            })
                        ]
                    })
                ]
            })
        ]
    });
    rows.push(descRow);

    // Image Row
    if (imgBuffer) {
        const imgRow = new TableRow({
            children: [
                new TableCell({
                    columnSpan: 2,
                    width: { size: 9900, type: WidthType.DXA },
                    borders: {
                        left: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        right: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        bottom: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        top: noBorder
                    },
                    shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' },
                    children: [
                        new Paragraph({
                            alignment: AlignmentType.CENTER,
                            spacing: { before: 100, after: 60 },
                            children: [
                                new ImageRun({
                                    data: imgBuffer,
                                    transformation: { width: imgWidth, height: imgHeight }
                                })
                            ]
                        }),
                        new Paragraph({
                            alignment: AlignmentType.CENTER,
                            spacing: { after: 80 },
                            children: [
                                new TextRun({
                                    text: imgCaption,
                                    italics: true,
                                    size: 14,
                                    color: C_MUTED_TEXT,
                                    font: FONT_FAMILY
                                })
                            ]
                        })
                    ]
                })
            ]
        });
        rows.push(imgRow);
    }

    return new Table({
        width: { size: 9900, type: WidthType.DXA },
        borders: cellBordersNone,
        rows: rows
    });
}

// Helper to create Two-Image Step Card
function createTwoImageStepCard(stepTag, stepTitle, stepUrl, descCol1Title, descCol1Text, descCol2Title, descCol2Text, img1Buf, img1Cap, img2Buf, img2Cap) {
    const rows = [];

    // Header Row
    rows.push(
        new TableRow({
            children: [
                new TableCell({
                    width: { size: 6500, type: WidthType.DXA },
                    shading: { type: ShadingType.CLEAR, fill: 'FAFAFA' },
                    borders: {
                        top: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        left: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        bottom: subtleGrayBorder,
                        right: noBorder
                    },
                    children: [
                        new Paragraph({
                            spacing: { before: 80, after: 80 },
                            children: [
                                new TextRun({
                                    text: `  ${stepTag}  `,
                                    bold: true,
                                    size: 16,
                                    color: 'FFFFFF',
                                    font: FONT_FAMILY,
                                    shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN }
                                }),
                                new TextRun({ text: "  " }),
                                new TextRun({
                                    text: stepTitle,
                                    bold: true,
                                    size: 20,
                                    color: C_DARK_TEXT,
                                    font: FONT_FAMILY
                                })
                            ]
                        })
                    ]
                }),
                new TableCell({
                    width: { size: 3400, type: WidthType.DXA },
                    shading: { type: ShadingType.CLEAR, fill: 'FAFAFA' },
                    borders: {
                        top: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        right: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        bottom: subtleGrayBorder,
                        left: noBorder
                    },
                    children: [
                        new Paragraph({
                            alignment: AlignmentType.RIGHT,
                            spacing: { before: 80, after: 80 },
                            children: [
                                new TextRun({
                                    text: ` ${stepUrl} `,
                                    size: 14,
                                    color: C_GRAY_TEXT,
                                    font: 'Consolas',
                                    shading: { type: ShadingType.CLEAR, fill: C_LIGHT_GRAY_BG }
                                })
                            ]
                        })
                    ]
                })
            ]
        })
    );

    // Description Row (2 Cols)
    rows.push(
        new TableRow({
            children: [
                new TableCell({
                    width: { size: 4950, type: WidthType.DXA },
                    borders: {
                        left: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        right: subtleGrayBorder,
                        bottom: subtleGrayBorder,
                        top: noBorder
                    },
                    children: [
                        new Paragraph({
                            spacing: { before: 80, after: 40 },
                            children: [
                                new TextRun({
                                    text: descCol1Title,
                                    bold: true,
                                    size: 16,
                                    color: C_DARK_GREEN,
                                    font: FONT_FAMILY
                                })
                            ]
                        }),
                        new Paragraph({
                            spacing: { after: 80 },
                            children: [
                                new TextRun({
                                    text: descCol1Text,
                                    size: 16,
                                    color: C_BODY_TEXT,
                                    font: FONT_FAMILY
                                })
                            ]
                        })
                    ]
                }),
                new TableCell({
                    width: { size: 4950, type: WidthType.DXA },
                    borders: {
                        right: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        left: subtleGrayBorder,
                        bottom: subtleGrayBorder,
                        top: noBorder
                    },
                    children: [
                        new Paragraph({
                            spacing: { before: 80, after: 40 },
                            children: [
                                new TextRun({
                                    text: descCol2Title,
                                    bold: true,
                                    size: 16,
                                    color: C_DARK_GREEN,
                                    font: FONT_FAMILY
                                })
                            ]
                        }),
                        new Paragraph({
                            spacing: { after: 80 },
                            children: [
                                new TextRun({
                                    text: descCol2Text,
                                    size: 16,
                                    color: C_BODY_TEXT,
                                    font: FONT_FAMILY
                                })
                            ]
                        })
                    ]
                })
            ]
        })
    );

    // Two Images Side-by-Side Row
    rows.push(
        new TableRow({
            children: [
                new TableCell({
                    width: { size: 4950, type: WidthType.DXA },
                    borders: {
                        left: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        bottom: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        right: subtleGrayBorder,
                        top: noBorder
                    },
                    shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' },
                    children: [
                        new Paragraph({
                            alignment: AlignmentType.CENTER,
                            spacing: { before: 80, after: 40 },
                            children: [
                                new ImageRun({
                                    data: img1Buf,
                                    transformation: { width: 260, height: 146 }
                                })
                            ]
                        }),
                        new Paragraph({
                            alignment: AlignmentType.CENTER,
                            spacing: { after: 60 },
                            children: [
                                new TextRun({
                                    text: img1Cap,
                                    italics: true,
                                    size: 14,
                                    color: C_MUTED_TEXT,
                                    font: FONT_FAMILY
                                })
                            ]
                        })
                    ]
                }),
                new TableCell({
                    width: { size: 4950, type: WidthType.DXA },
                    borders: {
                        right: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        bottom: { style: BorderStyle.SINGLE, size: 2, color: C_DARK_GREEN },
                        left: subtleGrayBorder,
                        top: noBorder
                    },
                    shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' },
                    children: [
                        new Paragraph({
                            alignment: AlignmentType.CENTER,
                            spacing: { before: 80, after: 40 },
                            children: [
                                new ImageRun({
                                    data: img2Buf,
                                    transformation: { width: 260, height: 146 }
                                })
                            ]
                        }),
                        new Paragraph({
                            alignment: AlignmentType.CENTER,
                            spacing: { after: 60 },
                            children: [
                                new TextRun({
                                    text: img2Cap,
                                    italics: true,
                                    size: 14,
                                    color: C_MUTED_TEXT,
                                    font: FONT_FAMILY
                                })
                            ]
                        })
                    ]
                })
            ]
        })
    );

    return new Table({
        width: { size: 9900, type: WidthType.DXA },
        borders: cellBordersNone,
        rows: rows
    });
}

// -------------------------------------------------------------
// DOCUMENT CONTENT BUILDER
// -------------------------------------------------------------
const doc = new Document({
    creator: "Landeuh Village Riverside",
    title: "Dokumen Flow Transaksi (Customer Journey) - Midtrans Snap",
    description: "Dokumen Verifikasi dan Customer Journey Integrasi Payment Gateway Midtrans Snap",
    sections: [
        {
            properties: {
                page: {
                    margin: {
                        top: 1000,
                        bottom: 1000,
                        left: 1000,
                        right: 1000
                    }
                }
            },
            headers: {
                default: new Header({
                    children: [
                        new Paragraph({
                            alignment: AlignmentType.RIGHT,
                            spacing: { after: 120 },
                            children: [
                                new TextRun({
                                    text: "Landeuh Village Riverside  |  Payment Gateway Integration Document",
                                    size: 14,
                                    color: C_MUTED_TEXT,
                                    font: FONT_FAMILY
                                })
                            ]
                        })
                    ]
                })
            },
            footers: {
                default: new Footer({
                    children: [
                        new Paragraph({
                            alignment: AlignmentType.BOTH,
                            children: [
                                new TextRun({
                                    text: "Dokumen Verifikasi Payment Gateway Midtrans Snap • landeuhvillage.com",
                                    size: 14,
                                    color: C_MUTED_TEXT,
                                    font: FONT_FAMILY
                                }),
                                new TextRun({
                                    text: "\t\tHalaman ",
                                    size: 14,
                                    color: C_MUTED_TEXT,
                                    font: FONT_FAMILY
                                }),
                                new TextRun({
                                    children: [PageNumber.CURRENT],
                                    size: 14,
                                    color: C_MUTED_TEXT,
                                    font: FONT_FAMILY
                                }),
                                new TextRun({
                                    text: " dari ",
                                    size: 14,
                                    color: C_MUTED_TEXT,
                                    font: FONT_FAMILY
                                }),
                                new TextRun({
                                    children: [PageNumber.TOTAL_PAGES],
                                    size: 14,
                                    color: C_MUTED_TEXT,
                                    font: FONT_FAMILY
                                })
                            ]
                        })
                    ]
                })
            },
            children: [
                // ==================== PAGE 1 ====================
                createPageHeader(
                    "DOKUMEN FLOW TRANSAKSI (CUSTOMER JOURNEY)",
                    "Integrasi Payment Gateway Midtrans Snap • Landeuh Village Riverside",
                    "SANDBOX VERIFIED"
                ),
                new Paragraph({ spacing: { after: 140 } }),

                // Metadata Banner Table
                new Table({
                    width: { size: 9900, type: WidthType.DXA },
                    borders: cellBordersSubtle,
                    rows: [
                        new TableRow({
                            children: [
                                new TableCell({
                                    width: { size: 2475, type: WidthType.DXA },
                                    shading: { type: ShadingType.CLEAR, fill: C_CREAM_BG },
                                    borders: {
                                        top: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        bottom: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        left: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        right: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER }
                                    },
                                    children: [
                                        new Paragraph({
                                            spacing: { before: 60, after: 20 },
                                            children: [
                                                new TextRun({ text: "NAMA MERCHANT", bold: true, size: 13, color: '78716C', font: FONT_FAMILY })
                                            ]
                                        }),
                                        new Paragraph({
                                            spacing: { after: 60 },
                                            children: [
                                                new TextRun({ text: "Landeuh Village Riverside", bold: true, size: 17, color: '292524', font: FONT_FAMILY })
                                            ]
                                        })
                                    ]
                                }),
                                new TableCell({
                                    width: { size: 2475, type: WidthType.DXA },
                                    shading: { type: ShadingType.CLEAR, fill: C_CREAM_BG },
                                    borders: {
                                        top: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        bottom: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        left: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        right: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER }
                                    },
                                    children: [
                                        new Paragraph({
                                            spacing: { before: 60, after: 20 },
                                            children: [
                                                new TextRun({ text: "WEBSITE LIVE", bold: true, size: 13, color: '78716C', font: FONT_FAMILY })
                                            ]
                                        }),
                                        new Paragraph({
                                            spacing: { after: 60 },
                                            children: [
                                                new TextRun({ text: "landeuhvillage.com", bold: true, size: 17, color: '292524', font: FONT_FAMILY })
                                            ]
                                        })
                                    ]
                                }),
                                new TableCell({
                                    width: { size: 2475, type: WidthType.DXA },
                                    shading: { type: ShadingType.CLEAR, fill: C_CREAM_BG },
                                    borders: {
                                        top: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        bottom: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        left: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        right: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER }
                                    },
                                    children: [
                                        new Paragraph({
                                            spacing: { before: 60, after: 20 },
                                            children: [
                                                new TextRun({ text: "METODE PEMBAYARAN", bold: true, size: 13, color: '78716C', font: FONT_FAMILY })
                                            ]
                                        }),
                                        new Paragraph({
                                            spacing: { after: 60 },
                                            children: [
                                                new TextRun({ text: "BCA Virtual Account", bold: true, size: 17, color: '292524', font: FONT_FAMILY })
                                            ]
                                        })
                                    ]
                                }),
                                new TableCell({
                                    width: { size: 2475, type: WidthType.DXA },
                                    shading: { type: ShadingType.CLEAR, fill: C_CREAM_BG },
                                    borders: {
                                        top: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        bottom: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        left: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER },
                                        right: { style: BorderStyle.SINGLE, size: 1, color: C_CREAM_BORDER }
                                    },
                                    children: [
                                        new Paragraph({
                                            spacing: { before: 60, after: 20 },
                                            children: [
                                                new TextRun({ text: "SIMULASI UNIT / TOTAL", bold: true, size: 13, color: '78716C', font: FONT_FAMILY })
                                            ]
                                        }),
                                        new Paragraph({
                                            spacing: { after: 60 },
                                            children: [
                                                new TextRun({ text: "Cabin 1 • IDR 1.600.000", bold: true, size: 17, color: '292524', font: FONT_FAMILY })
                                            ]
                                        })
                                    ]
                                })
                            ]
                        })
                    ]
                }),
                new Paragraph({ spacing: { after: 140 } }),

                // Flow Stepper 4 Steps Table
                new Table({
                    width: { size: 9900, type: WidthType.DXA },
                    borders: cellBordersSubtle,
                    rows: [
                        new TableRow({
                            children: [
                                new TableCell({
                                    width: { size: 2475, type: WidthType.DXA },
                                    children: [
                                        new Paragraph({
                                            spacing: { before: 60, after: 20 },
                                            children: [
                                                new TextRun({ text: "  1  ", bold: true, size: 15, color: 'FFFFFF', shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN } }),
                                                new TextRun({ text: "  Buka Website", bold: true, size: 16, color: C_DARK_TEXT, font: FONT_FAMILY })
                                            ]
                                        }),
                                        new Paragraph({
                                            spacing: { after: 60 },
                                            children: [
                                                new TextRun({ text: "Home & Katalog Unit", size: 14, color: C_MUTED_TEXT, font: FONT_FAMILY })
                                            ]
                                        })
                                    ]
                                }),
                                new TableCell({
                                    width: { size: 2475, type: WidthType.DXA },
                                    children: [
                                        new Paragraph({
                                            spacing: { before: 60, after: 20 },
                                            children: [
                                                new TextRun({ text: "  2  ", bold: true, size: 15, color: 'FFFFFF', shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN } }),
                                                new TextRun({ text: "  Reservasi Unit", bold: true, size: 16, color: C_DARK_TEXT, font: FONT_FAMILY })
                                            ]
                                        }),
                                        new Paragraph({
                                            spacing: { after: 60 },
                                            children: [
                                                new TextRun({ text: "Data Tamu & Tanggal", size: 14, color: C_MUTED_TEXT, font: FONT_FAMILY })
                                            ]
                                        })
                                    ]
                                }),
                                new TableCell({
                                    width: { size: 2475, type: WidthType.DXA },
                                    children: [
                                        new Paragraph({
                                            spacing: { before: 60, after: 20 },
                                            children: [
                                                new TextRun({ text: "  3  ", bold: true, size: 15, color: 'FFFFFF', shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN } }),
                                                new TextRun({ text: "  Midtrans Snap", bold: true, size: 16, color: C_DARK_TEXT, font: FONT_FAMILY })
                                            ]
                                        }),
                                        new Paragraph({
                                            spacing: { after: 60 },
                                            children: [
                                                new TextRun({ text: "Popup & Nomor VA", size: 14, color: C_MUTED_TEXT, font: FONT_FAMILY })
                                            ]
                                        })
                                    ]
                                }),
                                new TableCell({
                                    width: { size: 2475, type: WidthType.DXA },
                                    children: [
                                        new Paragraph({
                                            spacing: { before: 60, after: 20 },
                                            children: [
                                                new TextRun({ text: "  4  ", bold: true, size: 15, color: 'FFFFFF', shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN } }),
                                                new TextRun({ text: "  Bayar Sukses", bold: true, size: 16, color: C_DARK_TEXT, font: FONT_FAMILY })
                                            ]
                                        }),
                                        new Paragraph({
                                            spacing: { after: 60 },
                                            children: [
                                                new TextRun({ text: "Simulator & E-Ticket", size: 14, color: C_MUTED_TEXT, font: FONT_FAMILY })
                                            ]
                                        })
                                    ]
                                })
                            ]
                        })
                    ]
                }),
                new Paragraph({ spacing: { after: 160 } }),

                // STEP 1
                createStepCard(
                    "1",
                    "Mengakses Halaman Utama (Home Page)",
                    "https://landeuhvillage.com",
                    "Pelanggan membuka alamat website resmi landeuhvillage.com melalui browser. Pengguna dapat melihat profil resort, navigasi menu, dan filter ketersediaan kamar.",
                    "Website merender hero section Landeuh Village Riverside, bilah pencarian tanggal menginap, serta menu navigasi menuju katalog Akomodasi.",
                    img01Buffer,
                    "Gambar 1: Tampilan Halaman Beranda (Home Page) landeuhvillage.com",
                    540,
                    304
                ),

                // ==================== PAGE 2 ====================
                new Paragraph({ children: [new PageBreak()] }),
                createPageHeader(
                    "PROSES PEMILIHAN AKOMODASI & DATA TAMU",
                    "Langkah 2 & 3: Katalog Unit hingga Formulir Pemesanan Lengkap",
                    "BOOKING FLOW"
                ),
                new Paragraph({ spacing: { after: 140 } }),

                // STEP 2
                createStepCard(
                    "2",
                    "Memilih Unit Akomodasi (Cabin 1)",
                    "https://landeuhvillage.com/akomodasi",
                    "Pelanggan membuka menu \"Akomodasi\" untuk melihat daftar kamar yang tersedia, lalu memilih unit Cabin 1.",
                    "Sistem menampilkan foto kamar, spesifikasi kapasitas (4 dewasa), kelengkapan fasilitas, rincian harga sewa (IDR 1.600.000 weekend), dan tombol reservasi.",
                    img02Buffer,
                    "Gambar 2: Halaman Katalog Akomodasi menampilkan unit Cabin 1",
                    540,
                    240
                ),
                new Paragraph({ spacing: { after: 160 } }),

                // STEP 3
                createStepCard(
                    "3",
                    "Mengisi Data Tamu & Verifikasi Tanggal Menginap",
                    "https://landeuhvillage.com/reservasi/overview/1",
                    "Pelanggan mengisi check-in (5 Sept 2026) s.d check-out (6 Sept 2026), Nama Pemesan (Ari Rahman), WhatsApp (085795016378), menyetujui kebijakan, lalu klik \"Lanjutkan\".",
                    "Sistem memvalidasi ketersediaan unit di MySQL, mengunci total harga IDR 1.600.000, serta menerbitkan nomor pesanan resmi (No. Pesanan).",
                    img03Buffer,
                    "Gambar 3: Formulir Pengisian Identitas Tamu & Rincian Harga Reservasi",
                    540,
                    240
                ),

                // ==================== PAGE 3 ====================
                new Paragraph({ children: [new PageBreak()] }),
                createPageHeader(
                    "INTEGRASI MIDTRANS SNAP (PAYMENT MODAL)",
                    "Langkah 4, 5, & 6: Pemilihan Metode Pembayaran & Popup Snap Modal",
                    "MIDTRANS SNAP"
                ),
                new Paragraph({ spacing: { after: 140 } }),

                // STEP 4
                createStepCard(
                    "4",
                    "Memilih Metode Pembayaran di Website",
                    "https://landeuhvillage.com/reservasi/metode-pembayaran/1",
                    "Pelanggan memilih opsi \"BCA Virtual Account\" pada daftar metode pembayaran dan mengklik tombol \"Bayar\".",
                    "Frontend mengirim permintaan pembuatan Snap Token ke server backend Laravel melalui endpoint POST /reservasi/get-snap-token.",
                    img04Buffer,
                    "Gambar 4: Halaman Pemilihan Metode Pembayaran (BCA Virtual Account dipilih)",
                    540,
                    240
                ),
                new Paragraph({ spacing: { after: 160 } }),

                // STEP 5 & 6 (TWO IMAGES)
                createTwoImageStepCard(
                    "LANGKAH 5 & 6",
                    "Muncul Popup Midtrans Snap & Nomor Virtual Account",
                    "SDK: app.sandbox.midtrans.com/snap/snap.js",
                    "Langkah 5 (Tampil Popup Midtrans Snap):",
                    "Fungsi window.snap.pay(token) memunculkan modal Midtrans Snap resmi dengan rincian merchant Landeuh Village Riverside dan nominal tagihan Rp 1.600.000.",
                    "Langkah 6 (Nomor VA Diterbitkan):",
                    "Pelanggan memilih Bank BCA, Midtrans menampilkan nomor Virtual Account resmi serta panduan cara pembayaran (ATM BCA, KlikBCA, m-BCA).",
                    img05Buffer,
                    "Gambar 5: Modal Midtrans Snap resmi tampil",
                    img06Buffer,
                    "Gambar 6: Nomor BCA VA siap dibayarkan"
                ),

                // ==================== PAGE 4 ====================
                new Paragraph({ children: [new PageBreak()] }),
                createPageHeader(
                    "SIMULASI PEMBAYARAN & KONFIRMASI SUKSES",
                    "Langkah 7, 8, & 9: Simulasi Sandbox, Pelunasan & Terbit E-Ticket",
                    "SETTLEMENT COMPLETE"
                ),
                new Paragraph({ spacing: { after: 140 } }),

                // STEP 7 & 8 (TWO IMAGES)
                createTwoImageStepCard(
                    "LANGKAH 7 & 8",
                    "Simulasi Pembayaran di Midtrans Simulator Sandbox",
                    "https://simulator.sandbox.midtrans.com/bca/va/index",
                    "Langkah 7 (Inquiry Nomor VA):",
                    "Nomor VA dimasukkan ke simulator. Sistem menampilkan inquiry: Nama Ari Rahman dan tagihan IDR 1.600.000,00.",
                    "Langkah 8 (Eksekusi Bayar / Pay):",
                    "Tombol \"Pay\" diklik. Simulator menampilkan status \"Simulated payment is successful\" dan mengirim notifikasi webhook ke server Landeuh.",
                    img07Buffer,
                    "Gambar 7: Inquiry Tagihan VA di Simulator",
                    img08Buffer,
                    "Gambar 8: Status Pembayaran Berhasil di Simulator"
                ),
                new Paragraph({ spacing: { after: 140 } }),

                // STEP 9
                createStepCard(
                    "9",
                    "Halaman Konfirmasi Reservasi & E-Ticket (Berhasil)",
                    "https://landeuhvillage.com/reservasi/konfirmasi?status=success",
                    "Pelanggan menerima tampilan konfirmasi sukses, rincian reservasi Cabin 1, dan dapat mengklik tombol \"Unduh PDF\" untuk menyimpan bukti booking.",
                    "Database mengubah status booking menjadi 'success', men-generate invoice PDF otomatis, dan mengirimkannya ke email pelanggan & WhatsApp resmi.",
                    img09Buffer,
                    "Gambar 9: Halaman Konfirmasi Pembayaran Berhasil & E-Ticket Siap Diunduh",
                    540,
                    220
                ),
                new Paragraph({ spacing: { after: 160 } }),

                // SUMMARY TABLE
                new Table({
                    width: { size: 9900, type: WidthType.DXA },
                    borders: cellBordersSubtle,
                    rows: [
                        // Table Header
                        new TableRow({
                            children: [
                                new TableCell({
                                    width: { size: 900, type: WidthType.DXA },
                                    shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN },
                                    children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "Tahap", bold: true, size: 15, color: 'FFFFFF', font: FONT_FAMILY })] })]
                                }),
                                new TableCell({
                                    width: { size: 2700, type: WidthType.DXA },
                                    shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN },
                                    children: [new Paragraph({ children: [new TextRun({ text: "Halaman / Endpoint", bold: true, size: 15, color: 'FFFFFF', font: FONT_FAMILY })] })]
                                }),
                                new TableCell({
                                    width: { size: 2700, type: WidthType.DXA },
                                    shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN },
                                    children: [new Paragraph({ children: [new TextRun({ text: "Aksi Pengguna", bold: true, size: 15, color: 'FFFFFF', font: FONT_FAMILY })] })]
                                }),
                                new TableCell({
                                    width: { size: 2400, type: WidthType.DXA },
                                    shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN },
                                    children: [new Paragraph({ children: [new TextRun({ text: "Respon Sistem", bold: true, size: 15, color: 'FFFFFF', font: FONT_FAMILY })] })]
                                }),
                                new TableCell({
                                    width: { size: 1200, type: WidthType.DXA },
                                    shading: { type: ShadingType.CLEAR, fill: C_DARK_GREEN },
                                    children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "Status", bold: true, size: 15, color: 'FFFFFF', font: FONT_FAMILY })] })]
                                })
                            ]
                        }),
                        // Row 1
                        new TableRow({
                            children: [
                                new TableCell({ children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "01", bold: true, size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ children: [new Paragraph({ children: [new TextRun({ text: "landeuhvillage.com/", size: 14, font: 'Consolas' })] })] }),
                                new TableCell({ children: [new Paragraph({ children: [new TextRun({ text: "Buka beranda & pilih menu", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ children: [new Paragraph({ children: [new TextRun({ text: "Menampilkan profil & katalog unit", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: " Normal ", size: 13, bold: true, color: C_INFO_BLUE, shading: { type: ShadingType.CLEAR, fill: C_INFO_BG } })] })] })
                            ]
                        }),
                        // Row 2
                        new TableRow({
                            children: [
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "02", bold: true, size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ children: [new TextRun({ text: "/reservasi/overview/1", size: 14, font: 'Consolas' })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ children: [new TextRun({ text: "Input data tamu (Ari Rahman)", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ children: [new TextRun({ text: "Validasi slot tanggal & buat booking", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: " Pending ", size: 13, bold: true, color: C_INFO_BLUE, shading: { type: ShadingType.CLEAR, fill: C_INFO_BG } })] })] })
                            ]
                        }),
                        // Row 3
                        new TableRow({
                            children: [
                                new TableCell({ children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "03", bold: true, size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ children: [new Paragraph({ children: [new TextRun({ text: "/reservasi/metode-pembayaran", size: 14, font: 'Consolas' })] })] }),
                                new TableCell({ children: [new Paragraph({ children: [new TextRun({ text: "Pilih BCA VA & klik \"Bayar\"", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ children: [new Paragraph({ children: [new TextRun({ text: "Request Snap Token ke server", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: " Pending ", size: 13, bold: true, color: C_INFO_BLUE, shading: { type: ShadingType.CLEAR, fill: C_INFO_BG } })] })] })
                            ]
                        }),
                        // Row 4
                        new TableRow({
                            children: [
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "04", bold: true, size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ children: [new TextRun({ text: "Midtrans Snap Modal", size: 14, font: 'Consolas' })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ children: [new TextRun({ text: "Pilih Bank BCA di popup", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ children: [new TextRun({ text: "Menerbitkan Nomor Virtual Account", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: " Waiting VA ", size: 13, bold: true, color: C_INFO_BLUE, shading: { type: ShadingType.CLEAR, fill: C_INFO_BG } })] })] })
                            ]
                        }),
                        // Row 5
                        new TableRow({
                            children: [
                                new TableCell({ children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "05", bold: true, size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ children: [new Paragraph({ children: [new TextRun({ text: "Midtrans Simulator", size: 14, font: 'Consolas' })] })] }),
                                new TableCell({ children: [new Paragraph({ children: [new TextRun({ text: "Inquiry & Bayar Nomor VA", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ children: [new Paragraph({ children: [new TextRun({ text: "Transaksi settled di Sandbox", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: " Paid ", size: 13, bold: true, color: C_SUCCESS_GREEN, shading: { type: ShadingType.CLEAR, fill: C_SUCCESS_BG } })] })] })
                            ]
                        }),
                        // Row 6
                        new TableRow({
                            children: [
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "06", bold: true, size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ children: [new TextRun({ text: "/reservasi/konfirmasi", size: 14, font: 'Consolas' })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ children: [new TextRun({ text: "Menerima konfirmasi pembayaran", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ children: [new TextRun({ text: "E-Ticket terbit, kirim Email & WA", size: 14, font: FONT_FAMILY })] })] }),
                                new TableCell({ shading: { type: ShadingType.CLEAR, fill: 'F9FAFB' }, children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: " Success ", size: 13, bold: true, color: C_SUCCESS_GREEN, shading: { type: ShadingType.CLEAR, fill: C_SUCCESS_BG } })] })] })
                            ]
                        })
                    ]
                })
            ]
        }
    ]
});

async function main() {
    console.log("=== MEMBUAT DOKUMEN DOCX CUSTOMER FLOW ===");
    const buffer = await Packer.toBuffer(doc);
    fs.writeFileSync(DOCX_OUTPUT, buffer);
    console.log("Dokumen Word tersimpan di:", DOCX_OUTPUT);

    // Salin ke folder public agar bisa diunduh langsung lewat web jika dibutuhkan
    fs.writeFileSync(PUBLIC_DOCX, buffer);
    console.log("Salinan Publik tersimpan di:", PUBLIC_DOCX);
    console.log("=== DOKUMEN DOCX BERHASIL DIBUAT ===");
}

main().catch(err => {
    console.error("Gagal membuat dokumen docx:", err);
    process.exit(1);
});
