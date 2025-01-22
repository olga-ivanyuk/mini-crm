<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CompanyService
{
    public function handleLogoUpload($file, $currentLogo = null): ?string
    {
        if ($file) {
            if ($currentLogo) {
                Storage::disk('public')->delete($currentLogo);
            }
            return $file->store('logos', 'public');
        }
        return $currentLogo;
    }
}
