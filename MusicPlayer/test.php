<?php

class Medien {
    private $volume = 1; //min 0, max 100
    private $counter = 0;
    private $volumeHolder = 0;

    public function LauterLeiser ($eingabe) {
        if ($eingabe == "leiser") {
            $this->volume--;
            if($this->Soundcheck($this->volume)) {
                echo "Lautstärke leiser: $this->volume<br>";
            }
        } elseif ($eingabe == "lauter") {
            $this->volume++;
            if ($this->Soundcheck($this->volume)) {
                echo "Lautstärke lauter: $this->volume<br>";
            }
        }
    }

    //ueberprüfen auf min/max volumen
    protected function Soundcheck ($input) {
        if ($input > 99) {
            echo "Das ist zu laut! Dein Volumen ist schon bei: $input<br>";
            $input--;
            $this->volume = $input;
            return false;
        }elseif ($input < 1) {
            echo "Leiser geht es nicht. Dein Volumen ist bei: $input<br>";
            $input++;
            $this->volume = $input;
            return false;
        }else {
            return true;
        }
    }

    public function Mute () {
        if ($this->counter > 0) {
            $this->volume = $this->volumeHolder;
            $this->volumeHolder = 0;
            $this->counter = 0;
            echo "Sound UN-muted - Sound: $this->volume<br>";
            return;
        }
        $this->volumeHolder = $this->volume;
        $this->volume = 0;
        $this->counter++;
        echo "Sound muted - Sound: $this->volume<br>";
        return;
    }
}

class iPod extends Medien {
    public $playlist = array();
    private $playCount = 0;
    private $currentTitle = "";
    private $musicPlay = false;

    private function startPlaylist ($playlist) {
        if ($this->playCount == 0) {
            $this->currentTitle = $playlist[0];
            $this->musicPlay = true;
            echo "Anfangen zu Spielen: $this->currentTitle <br>";
            return;
        }
        echo "Es Spielt bereits: $this->currentTitle <br>";
        return;
    }

    public function getTitle () {
        echo $this->currentTitle;
    }

    public function ChangeTitle ($eingabe) {
        if ($eingabe == "weiter") {
            $this->playCount++;
            $this->musicPlay = true;
            $this->currentTitle = $this->playlist[$this->playCount];
            echo "Der nächste Titel: >$this->currentTitle< wird gespielt <br>";
            return;
        }elseif ($eingabe == "zurück") {
            $this->playCount--;
            $this->musicPlay = true;
            $this->currentTitle = $this->playlist[$this->playCount];
            echo "Der vorherige Titel: >$this->currentTitle< wird gespielt <br>";
            return;
        }
        return;
    }

    public function playStatus() {
        if ($this->musicPlay) {
            echo "Es Spielt Musik <br>";
            return;
        }
        echo "Es spielt keine Musik <br>";
        return;
    }

    public function startStop() {
        if ($this->musicPlay) {
            echo "Die Musik hört auf zu spielen <br>";
            $this->musicPlay = false;
            return;
        }
        echo "Dis Musk fängt an zu spielen <br>";
        $this->musicPlay = true;
        return;
    }

    public function __construct($titel)
    {
        $this->playlist = $titel;
        $this->startPlaylist($this->playlist);
    }
}

$iphod = new iPod(["Linkin Park - In The End", "Linkin Park - One Step Closer", "Oliver Heldens - Koala"]);
$iphod->ChangeTitle("weiter");
$iphod->playStatus();
$iphod->startStop();
$iphod->startStop();
$iphod->LauterLeiser("lauter");