import fs from 'fs';
import path from 'path';

import { src, dest, watch, series } from 'gulp';
import * as dartSass from 'sass'; // Importa Dart Sass.
import gulpSass from 'gulp-sass'; // Importa gulp-sass.
import { glob } from 'glob';
import sharp from 'sharp';

const sass = gulpSass(dartSass);

export function css(done) {
    src('src/sass/app.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(dest('public/build/css'));
    done();
}

export function js(done) {
    src('src/js/**/*.js')
        .pipe(dest('public/build/js'))
    done();
}

export function iconos(done) {
    src('src/images/**/*.svg')
        .pipe(dest('public/build/images'))
    done();
}

export async function imagenes(done) {
    const srcDir = './src/images';
    const buildDir = './public/build/images';
    const images = await glob('./src/images/**/*{jpg,png}')

    images.forEach(file => {
        const relativePath = path.relative(srcDir, path.dirname(file));
        const outputSubDir = path.join(buildDir, relativePath);
        procesarImagenes(file, outputSubDir);
    });
    done();
}

function procesarImagenes(file, outputSubDir) {
    if (!fs.existsSync(outputSubDir)) {
        fs.mkdirSync(outputSubDir, { recursive: true })
    }
    const baseName = path.basename(file, path.extname(file))
    const extName = path.extname(file)
    const outputFile = path.join(outputSubDir, `${baseName}${extName}`)
    const outputFileWebp = path.join(outputSubDir, `${baseName}.webp`)

    const options = { quality: 80 }
    sharp(file).jpeg(options).toFile(outputFile)
    sharp(file).webp(options).toFile(outputFileWebp)
}

export function dev() {
    watch('src/sass/**/*.scss', css);
    watch('src/js/**/*.js', js);
    watch('src/images/**/*.{jpg,png}', imagenes);
    watch('src/images/**/*.svg', iconos);
}

export default series(css, js, imagenes, iconos, dev);
