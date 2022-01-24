<?php

namespace Elephox\Docs;

use Elephox\Stream\Contract\Stream;
use Elephox\Stream\StringStream;

class PageRenderer
{
    public function __construct(
        private ContentFiles     $contentFileRenderer,
        private TemplateRenderer $templateRenderer,
    )
    {
    }

    public function render(string $contentFilePath, array $data, string $template = "default"): string
    {
        $content = $this->contentFileRenderer->render($contentFilePath, $data);
        $data = array_merge($data, ['content' => $content]);

        return $this->templateRenderer->render($template, $data);
    }

    public function stream(string $contentFilePath, array $data, string $template = "default"): Stream
    {
        return new StringStream($this->render($contentFilePath, $data, $template));
    }
}
