<?php

namespace App\Filament\Resources\ChildResource\Pages;

use App\Filament\Resources\ChildResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChild extends CreateRecord
{
    protected static string $resource = ChildResource::class;

    protected function getRedirectUrl(): string
    {
        /*
         * Setelah pasien dibuat, langsung menuju halaman Edit
         * agar terapis dapat menambahkan daftar aktivitas awal.
         */
        return static::getResource()::getUrl(
            'edit',
            ['record' => $this->record]
        );
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Pasien berhasil didaftarkan';
    }

    
}
