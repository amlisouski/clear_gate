import * as PDFJS from "pdfjs-dist";
import * as WorkerMessageHandler from "pdfjs-dist/build/pdf.worker.min.mjs";

PDFJS.GlobalWorkerOptions.workerSrc = WorkerMessageHandler;
window.pdfjs = PDFJS;
