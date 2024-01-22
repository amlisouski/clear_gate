import * as PDFJS from "pdfjs-dist";
import {WorkerMessageHandler} from "pdfjs-dist/build/pdf.worker.min.mjs";
import {isNull} from "util";

PDFJS.GlobalWorkerOptions.workerSrc = new WorkerMessageHandler();
window.pdfjs = PDFJS;

class RenderToCanvas {
    constructor(canvasElement, file = null, type = null, pdfjsLib = null) {
        this.canvas = canvasElement;
        this.file = file != null ? file : this.canvas.dataset.file;
        this.type = type != null ? type : this.canvas.dataset.type;
        this.pdfjsLib = pdfjsLib != null ? pdfjsLib : window.pdfjs;

        if (this.canvas && this.file && this.type) {
            this.render();
        }
        return this;
    }

    setCanvasId(id) {
        this.canvas = document.getElementById(id);
        return this;
    }

    setFile(file) {
        if (this.isValidURL(file)) {
            this.file = file;
        } else {
            console.error('Path to file is invalid');
        }
        return this;
    }

    setFileType(type) {
        let fileTypes = new Set([
            'application/pdf',
            'image/jpeg',
            'image/jpg',
            'image/png'
        ]);

        if (fileTypes.has(type)) {
            this.type = type;
        } else {
            let fileTypesMap = {
                'pdf': 'application/pdf',
                'jpeg': 'image/jpeg',
                'jpg': 'image/jpg',
                'png': 'image/png'
            };

            if (fileTypesMap[type]) {
                this.type = fileTypesMap[type];
            } else {
                console.error('Invalid type');
                return null;
            }
        }
    }

    render() {
        if (this.canvas && this.file && this.type) {
            if (this.type === 'application/pdf') {
                if (typeof this.pdfjsLib === null) {
                    console.error(`Current type  is ${this.type}, but pdfjsLib not loaded`);
                    return false;
                }
                this.renderPDF(this.canvas, this.file, this.pdfjsLib);
            } else if (
                this.type === 'image/jpeg' ||
                this.type === 'image/jpg' ||
                this.type === 'image/png'
            ) {
                this.renderImage(this.canvas, this.file);
            }
        } else {
            console.log('Nothing to render');
        }
    }

    renderPDF(canvas, file, pdfjsLib) {
        const context = canvas.getContext('2d');
        pdfjsLib.disableWorker = true;
        pdfjsLib.getDocument(file).promise.then(function (pdf) {
            pdf.getPage(1).then(function (page) {
                const viewport = page.getViewport({scale: 1});
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext).promise.then(function () {
                }).catch(function (error) {
                    console.error('render', error);
                });
            }).catch(function (error) {
                console.error('getPage', error);
            });
        }).catch(function (error) {
            console.error('getDocument', error);
        });
    }

    renderImage(canvas, file) {
        const img = new Image();
        img.src = file;
        img.onload = function () {
            canvas.width = img.width;
            canvas.height = img.height;
            canvas.getContext('2d').drawImage(img, 0, 0);
        };
    }

    isValidURL(url) {
        const pattern = new RegExp('^https?:\\/\\/.+\\.(pdf|jpg|jpeg|png)$', 'i');
        return pattern.test(url);
    }
}

export default RenderToCanvas;

