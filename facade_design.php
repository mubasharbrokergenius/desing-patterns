<?php

/*
Think of the Facade as a simplicity adapter for some complex subsystem.
The Facade isolates complexity within a single class and allows other application code to use the straightforward interface.

In this example, the Facade hides the complexity of the YouTube API and FFmpeg library from the client code.
Instead of working with dozens of classes, the client uses a simple method on the Facade

*/

namespace RefactoringGuru\Facade\RealWorld;

class YouTubeDownloader
{
    protected $youtube;
    protected $ffmpeg;

    public function __construct(string $youtubeApi)
    {
        $this->youtube = new Youtube($youtubeApi);
        $this->ffmpeg = new FFmpeg();
    }

    public function downloadVideo(string $url)
    {
        echo "Fetching video metadata from youtube...\n";

        echo "Saving video file i to a temporary file ...\n";

        echo "Processing source video... \n";

        echo "Normalizing and resizeg the video to smaller dimensions... \n";

        echo "Capturing preview image.... \n";

        echo "Saving video in target formats.... \n";

        echo "Done!\n";

    }
}

class Youtube
{
    public function fetchVideo():string
    {
        return "youtube fetch video function \n";
    }

    public function saveAs(string $path): void
    {
        echo "open function \n";
    }
}

class FFMpeg
{
    public static function create(): FFMpeg
    {
        return "create function \n";
    }
    public function open(string $video):void
    {
        echo "open a file \n";
    }
}

class FFMpegVideo
{
    public function filters():self
    {
        return "this filters function \n";
    }
    public function resize(): self
    {
        return "this resize function \n";
    }

    public function synchronize(): self
    {
        return "this synchronize function \n";
    }

    public function frame(): self
    {
        return "this frame function \n";
    }

    public function save(string $path): self
    {
        return "this save function \n";
    }

}

function clientCode(YouTubeDownloader $facade)
{
    $facade->downloadVideo("https://www.youtube.com/watch?v=QH2-TGUlwu4");
}

$facade = new YouTubeDownloader("APIKEY-XXXXXXXXX");
clientCode($facade);
