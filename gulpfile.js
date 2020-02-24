/* ======================================================== */
/* global require */
const { task, src, dest, watch, series, parallel } = require("gulp"); // Собственно gulp

const clean = require("gulp-clean"); // удаление файлов и каталогов

const concat = require("gulp-concat");

const stylus = require("gulp-stylus");

const nib = require('nib');

const less = require("gulp-less");

const postcss = require("gulp-postcss"); // Пост-обработка CSS

const postcssPresetEnv = require("postcss-preset-env"); // CSS Next

const sourcemaps = require("gulp-sourcemaps"); // карты исходного кода

const browsersync = require("browser-sync").create(); // обновление налету

/* ========================================================== */

/**
 * Настройки CSS
 */
const postcssOptions = [
  postcssPresetEnv({
    stage: 0
  })
];

/**
 * source assets
 */
const from_css = "./web/stylus/stylus.styl";
const from_less = "./web/less/*.less";
const from_js = ["./web/js/*.js"];

const to_css = "./web/css";
const to_js = "./web/assets/js";

/* ================================================================= */

/**
 * CLEAN
 * Полная очистка
 */
const Clean = cb => {
  cb();
  return src([to_css, to_js], { read: false, allowEmpty: true }).pipe(clean());
};
task("CLEAN", Clean);

/**
 * CSS
 */
const css = cb => {
  cb();

  return src(from_css)
    .pipe(sourcemaps.init())
    .pipe(stylus({use:[nib()]}))
    .pipe(postcss(postcssOptions))
    .pipe(sourcemaps.write("."))
    .pipe(dest(to_css))
    .pipe(browsersync.stream());
};

/**
 * JS
 */
const js = cb => {
  cb();
  return (
    src(from_js)
      .pipe(sourcemaps.init())
      .pipe(sourcemaps.write("."))
      .pipe(dest(to_js))
      .pipe(browsersync.stream())
  );
};


// ================== DEV ============================
// Слежение за dev
function browserSync() {
  browsersync.init({
    /* server: {
      baseDir: "./frontend/web/"
    }, */
    proxy: "http://trening.local",
    port: 3003
  });
}

function browserSyncReload(done) {
  browsersync.reload();
  done();
}

task(
  "START",
  series(css, js, () => {
    watch(["./web/stylus/**/*.styl", from_css], css);
    watch(from_js, js);
    watch([
      "./web/**/*.php",
      // "./backend/**/*.php",
      "./frontend/**/*.php",
      // "./common/**/*.php"
    ]).on("change", browsersync.reload);

    browserSync();
  })
);
