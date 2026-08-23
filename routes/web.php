<?php

use Illuminate\Support\Facades\Route;
use App\Models\TreatmentCertificate;
use App\Models\Child;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

     Route::get('/children/{child}/report/preview', function (Child $child) {
        $child->load([
            'childActivities.evaluationDetails.session',
            'evaluationSessions.evaluator',
        ]);

        return view('pdf.child-report-preview', [
            'child' => $child,
        ]);
    })->name('children.report.preview');

    Route::get('/children/{child}/report/download', function (Child $child) {
        $child->load([
            'childActivities.evaluationDetails.session',
            'evaluationSessions.evaluator',
        ]);

        $pdf = Pdf::loadView('pdf.child-report', [
            'child' => $child,
        ])->setPaper('a4', 'portrait');

        $fileName = 'laporan-perkembangan-' . str($child->name)->slug() . '.pdf';

        return $pdf->download($fileName);
    })->name('children.report.download');

    Route::get(
        '/treatment-certificates/{certificate}/preview',
        function (TreatmentCertificate $certificate) {

            $certificate->load([
                'child',
                'creator',
            ]);

            return view(
                'treatment-certificates.preview',
                compact('certificate')
            );
        }
    )->name('treatment-certificates.preview');

    Route::get(
        '/treatment-certificates/{certificate}/pdf',
        function (TreatmentCertificate $certificate) {

            $certificate->load([
                'child',
                'creator',
            ]);

            $pdf = Pdf::loadView(
                'treatment-certificates.pdf',
                compact('certificate')
            )->setPaper(
                'a4',
                'portrait'
            );

            return $pdf->download(
                'surat-keterangan-dalam-perawatan-'
                    . str($certificate->child->name)->slug()
                    . '.pdf'
            );
        }
    )->name('treatment-certificates.pdf');
});
