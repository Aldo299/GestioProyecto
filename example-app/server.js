import express from 'express';
import { generateQRCode } from './resources/js/generateQRCode.js';
import fs from 'fs';
import path from 'path';

const app = express();
const port = 3000;

// Obtener la ruta absoluta del directorio de la aplicación
const __dirname = path.resolve();

// Middleware para parsear los datos en JSON
app.use(express.json());

// Ruta para generar el código QR
app.get('/generate-qrcode', (req, res) => {
    const { data, filename } = req.query;

    if (!data || !filename) {
        return res.status(400).send('Faltan parámetros');
    }

    // Construir la ruta completa del archivo de salida
    const outputPath = path.resolve(__dirname, 'public', 'images', 'qr_codes', filename);

    // Verificar si la carpeta qr_codes existe, si no, crearla
    const dirPath = path.dirname(outputPath);
    if (!fs.existsSync(dirPath)) {
        fs.mkdirSync(dirPath, { recursive: true });
    }

    // Llamar a la función para generar el QR
    generateQRCode(data, outputPath);

    // Enviar el archivo generado como respuesta
    res.sendFile(outputPath);
});

// Iniciar el servidor
app.listen(port, () => {
    console.log(`Servidor de QR escuchando en http://localhost:${port}`);
});
