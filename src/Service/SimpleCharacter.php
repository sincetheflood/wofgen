<?php


namespace App\Service;


use Exception;


class SimpleCharacter
{
    /**
     * @param array $generatorFiles
     * @return array
     */
    public function build(array $generatorFiles): array
    {
        $statuses = $this->getStatuses();

        // Get the dragon's tribe
        if ($statuses['isHybrid']) {
            $tribe = [
                $this->getTribe($generatorFiles['tribe']),
                $this->getTribe($generatorFiles['tribe']),
            ];
        } else {
            $tribe = [$this->getTribe($generatorFiles['tribe'])];
        }

        // Get the dragon's about
        $about = $this->buildAbout(
            $generatorFiles['about'],
            $tribe,
            $statuses['isCriminal'],
            $statuses['isHybrid'],
            $statuses['isNobility']
        );

        // Get the dragon's appearance
        $appearance = $this->buildAppearance(
            $generatorFiles['body'],
            $tribe,
            $statuses['isHybrid'],
            $statuses['isNobility']
        );

        return [
            'status' => $statuses,

            'tribes' => $tribe,

            'about' => $about,

            'appearance' => $appearance,
        ];
    }


    /**
     * Determine the dragon's special statuses
     *
     * @return array
     */
    private function getStatuses(): array
    {
        try {
            $isCriminal = random_int(1, 100) >= 75;
            $isHybrid = random_int(1, 100) >= 80;
            $isNobility = random_int(1, 100) >= 85;
        } catch (Exception $e) {
            // If for some reason the random_int() function fails, fall back to
            // the less random mt_rand() function
            $isCriminal = mt_rand(1, 100) >= 75;
            $isHybrid = mt_rand(1, 100) >= 80;
            $isNobility = mt_rand(1, 100) >= 85;
        }

        return [
            'isCriminal' => $isCriminal,
            'isHybrid' => $isHybrid,
            'isNobility' => $isNobility,
        ];
    }

    /**
     * Get a random tribe
     *
     * @param array $files
     * @return string
     */
    private function getTribe(array $files): string
    {
        $tribesPantala = $this->loadFile($files['pantala.txt']);
        $tribesPyrrhia = $this->loadFile($files['pyrrhia.txt']);

        $tribes = array_merge($tribesPantala, $tribesPyrrhia);
        shuffle($tribes);

        $tribe = $tribes[array_rand($tribes)];

        return $tribe;
    }

    /**
     * Read the contents of a generator file
     *
     * @param string $fileName
     * @return false|string[]
     */
    private function loadFile(string $fileName)
    {
        $fileContents = explode("\n", file_get_contents($fileName));
        shuffle($fileContents);

        return $fileContents;
    }

    /**
     * Assemble the different pieces of the dragon's background information
     *
     * @param array $files
     * @param array|string $tribe
     * @param bool $isCriminal
     * @param bool $isHybrid
     * @param bool $isNobility
     * @return array
     */
    private function buildAbout(array $files, $tribe, bool $isCriminal, bool $isHybrid, bool $isNobility): array
    {
        if ($tribe === ('HiveWing' || 'LeafWing' || 'SilkWing')) {
            $continent = 'Pantala';
        } else {
            $continent = 'Pyrrhia';
        }


        // Hobby
        $hobby = $this->loadFile($files['hobby.txt']);


        // Location
        $location = $this->loadFile($files['location.txt']);
        $locationHiveWingSilkWing = $this->loadFile($files['location-hivewing-silkwing.txt']);
        $locationIceWing = $this->loadFile($files['location-icewing.txt']);
        $locationLeafWing = $this->loadFile($files['location-leafwing.txt']);
        $locationPantala = $this->loadFile($files['location-pantala.txt']);
        $locationPyrrhia = $this->loadFile($files['location-pyrrhia.txt']);

        // If the dragon is a HiveWing/SilkWing or HiveWing/SilkWing hybrid
        if (
            ($tribe === 'HiveWing' || $tribe === 'SilkWing') ||
            ($isHybrid && (array_key_exists('HiveWing', $tribe) || array_key_exists('SilkWing', $tribe)))
        ) {
            array_push($location, ...$locationHiveWingSilkWing);
            shuffle($location);
        }

        // If the dragon is a IceWing or IceWing hybrid
        if ($tribe === 'IceWing' || ($isHybrid && array_key_exists('IceWing', $tribe))) {
            array_push($location, ...$locationIceWing);
            shuffle($location);
        }

        // If the dragon is a LeafWing or LeafWing hybrid
        if ($tribe === 'LeafWing' || ($isHybrid && array_key_exists('LeafWing', $tribe))) {
            array_push($location, ...$locationLeafWing);
            shuffle($location);
        }

        if ($continent === 'Pantala') {
            array_push($location, ...$locationPantala);
            shuffle($location);
        } else {
            array_push($location, ...$locationPyrrhia);
            shuffle($location);
        }

        $locationChoice = $location[array_rand($location)];


        // Job
        $job = $this->loadFile($files['job.txt']);

        $jobNobility = $this->loadFile($files['job-nobility.txt']);

        $jobRemoveCriminal = $this->loadFile($files['job-remove-criminal.txt']);
        $jobRemoveIsland = $this->loadFile($files['job-remove-island.txt']);
        $jobRemoveLeafWing = $this->loadFile($files['job-remove-leafwing.txt']);

        // If the dragon is a LeafWing or LeafWing hybrid
        if ($isNobility) {
            array_push($job, ...$jobNobility);
            shuffle($job);
        }

        if ($isCriminal) {
            $job = array_merge(
                array_diff($job, $jobRemoveCriminal),
                array_diff($jobRemoveCriminal, $job),
            );
            shuffle($job);
        }

        if ($locationChoice === 'on an island between Pyrrhia and Pantala') {
            $job = array_merge(
                array_diff($job, $jobRemoveIsland),
                array_diff($jobRemoveIsland, $job),
            );
            shuffle($job);
        }

        if ($tribe === 'LeafWing' || ($isHybrid && array_key_exists('LeafWing', $tribe))) {
            $job = array_merge(
                array_diff($job, $jobRemoveLeafWing),
                array_diff($jobRemoveLeafWing, $job),
            );
            shuffle($job);
        }

        if ($continent === 'Pyrrhia') {
            array_push($location, ...$locationPyrrhia);
            shuffle($location);
        }


        // Status
        $status = $this->loadFile($files['status.txt']);

        $statusCriminal = $this->loadFile($files['status-criminal.txt']);
        $statusCriminalPantala = $this->loadFile($files['status-criminal-pantala.txt']);
        $statusCriminalPyrrhia = $this->loadFile($files['status-criminal-pyrrhia.txt']);

        $statusPyrrhia = $this->loadFile($files['status-pyrrhia.txt']);

        if ($isCriminal && $continent === 'Pantala') {
            array_push($status, ...$statusCriminal);
            array_push($status, ...$statusCriminalPantala);
            shuffle($status);
        } else if ($isCriminal && $continent === 'Pyrrhia') {
            array_push($status, ...$statusCriminal);
            array_push($status, ...$statusCriminalPyrrhia);
            shuffle($status);
        }

        if ($continent === 'Pyrrhia') {
            array_push($status, ...$statusPyrrhia);
            shuffle($status);
        }


        return [
            'hobby' => $hobby[array_rand($hobby)],

            'location' => $locationChoice,

            'job' => $job[array_rand($job)],

            'status' => $status[array_rand($status)],
        ];
    }

    /**
     * Assemble the different pieces of the dragon's appearance
     *
     * @param array $files
     * @param array|string $tribe
     * @param bool $isHybrid
     * @param bool $isNobility
     * @return array
     */
    private function buildAppearance(array $files, $tribe, bool $isHybrid, bool $isNobility): array
    {
        // Base appearance
        $appearanceAdjectives = $this->loadFile($files['adjective.txt']);

        $appearanceBase = $this->loadFile($files['appearance.txt']);
        $appearanceNobility = $this->loadFile($files['appearance-nobility.txt']);
        $appearanceSeaWing = $this->loadFile($files['appearance-seawing.txt']);

        if ($isNobility) {
            array_push($appearanceBase, ...$appearanceNobility);
            shuffle($appearanceBase);
        }

        if ($tribe === 'SeaWing' || ($isHybrid && array_key_exists('SeaWing', $tribe))) {
            array_push($appearanceBase, ...$appearanceSeaWing);
            shuffle($appearanceBase);
        }


        // Horn appearance
        $hornAdjectives = $this->loadFile($files['horn-adjective.txt']);
        $hornAdjectiveNobility = $this->loadFile($files['horn-adjective-nobility.txt']);

        $hornDescription = $this->loadFile($files['horn-description.txt']);
        $hornDescriptionNobility = $this->loadFile($files['horn-description-nobility.txt']);

        if ($isNobility) {
            array_push($hornAdjectives, ...$hornAdjectiveNobility);
            shuffle($hornAdjectives);

            array_push($hornDescription, ...$hornDescriptionNobility);
            shuffle($hornDescription);
        }


        // Scale appearance
        $scaleAdjectives = $this->loadFile($files['scale-adjective.txt']);


        // Wing appearance
        $wingAdjectives = $this->loadFile($files['wing-adjective.txt']);

        $wingDescription = $this->loadFile($files['wing-description.txt']);

        $wingSize = $this->loadFile($files['wing-size.txt']);
        $wingSizeHybrid = $this->loadFile($files['wing-size-hybrid.txt']);

        if ($isHybrid) {
            array_push($wingSize, ...$wingSizeHybrid);
            shuffle($wingSize);
        }


        return [
            'body' => [
                'adjective' => $appearanceAdjectives[array_rand($appearanceAdjectives)],
                'description' => $appearanceBase[array_rand($appearanceBase)],
            ],

            'horns' => [
                'adjective' => $hornAdjectives[array_rand($hornAdjectives)],
                'description' => $hornDescription[array_rand($hornDescription)],
            ],

            'scales' => ['adjective' => $scaleAdjectives[array_rand($scaleAdjectives)]],

            'wings' => [
                'adjective' => $wingAdjectives[array_rand($wingAdjectives)],
                'description' => $wingDescription[array_rand($wingDescription)],
                'size' => $wingSize[array_rand($wingSize)],
            ],
        ];
    }
}