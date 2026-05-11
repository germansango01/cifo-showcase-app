<?php

namespace App\Enums;

enum ProjectFileType: string
{
    case Pdf = 'pdf';
    case Document = 'document';
    case Spreadsheet = 'spreadsheet';
    case Presentation = 'presentation';
    case Markdown = 'markdown';
    case Video = 'video';

    /** @return array<string,string> label keyed by value */
    public static function labels(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_map(
                fn (self $case) => __('admin.projects.file_type_'.$case->value),
                self::cases()
            )
        );
    }
}
