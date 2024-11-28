// En generateQRCode.js
import QRCode from 'qrcode';
import fs from 'fs';
import path from 'path';

// Función para generar el código QR y guardarlo como imagen
export function generateQRCode(data, outputPath) {
    // Si los datos son JSON, los convertimos en un string para el QR
    const qrData = JSON.parse(data); // Convertir los datos JSON a un objeto

    QRCode.toFile(outputPath, JSON.stringify(qrData), { // Convertir nuevamente a cadena
        color: {
            dark: '#000000',  // Color del código QR
            light: '#FFFFFF'  // Color de fondo
        },
        width: 300 // Tamaño del QR
    }, function (err) {
        if (err) throw err;
        console.log('QR Code generado en: ' + outputPath);
    });
}
