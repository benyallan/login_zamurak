<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserExportController extends Controller
{
    public function downloadCsv(): StreamedResponse
    {
        $fileName = 'users.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Nome', 'Usuário', 'Status', 'E-mail', 'Data']);

            User::query()->each(function ($user) use ($handle) {
                fputcsv($handle, [
                    $user->name,
                    '@' . $user->username,
                    $user->status->name,
                    $user->email,
                    $user->date->format('n/j/y')
                ]);
            });

            fclose($handle);
        }, $fileName, ['Content-Type' => 'text/csv']);
    }
}
